<?php

namespace app\models;

use app\behaviors\UniqueIdGenerator;
use Closure;
use Yii;
use yii\base\InvalidParamException;
use yii\base\InvalidValueException;
use yii\behaviors\TimestampBehavior;
use yii\console\Application;
use yii\db\ActiveRecord;
use yii\gii\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;
use function Symfony\Component\Debug\header;

/**
 * Description of Attachment
 * php yii schema/migrate @app/modules/media/models app\\modules\\media\\models
 * 
 * $model->attachment->
 *
 * @author James Hu <james@zhinantech.com>
 */
class Attachment extends ActiveRecord
{

    public $name;
    public $size;
    public $type;
    public $extension;
    public $filepath;
    public $filehash;
    public $group;
    public $ip;

    /**
     * The default basepath to store uploaded file.
     * The reason introducing basepath is all filepaths in database are relative
     * so it's easy to mount local storage for scanalibility
     *
     */
    const DEFAULT_BASEPATH = "@app/runtime/uploads";

    /**
     * The default relative path to store uploaded file
     */
    const DEFAULT_PATH = "{date}/{hash21}";

    public static function tableName()
    {
        return "{{%attachment}}";
    }

    public static function tableSchema()
    {
        return <<<SQL
        CREATE TABLE `attachment` (
            `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `uid` varchar(32) NOT NULL,
            `owner_id` int NULL,
            `model_id` varchar(32) DEFAULT NULL,
            `model_class` varchar(32) DEFAULT NULL,
            `deleted_at` int NOT NULL,
            `created_at` int NOT NULL,
            `updated_at` int NOT NULL,
            unique key uni_uid (`uid`),
            foreign key (owner_id) references user (id) on delete set null
        );
SQL;
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
                    [
                        "class" => UniqueIdGenerator::className()
                    ],
                    [
                        "class" => TimestampBehavior::className()
                    ]
        ]);
    }

    public function beforeSave($insert)
    {
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        //if ($insert) {
        //    $this->link("profile", new AttachmentProfile());
        //}

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * Get the owner model
     * 
     * @return type
     */
    public function getOwner()
    {
        return $this->hasOne($this->model_class, ["id" => "model_id"]);
    }

    public function deleteAttachment($unlinkFile = false)
    {
        if ($unlinkFile) {
            $physicalPath = Yii::getAlias("{$this->profile->basepath}/{$this->profile->filepath}");
            if (file_exists($physicalPath)) {
                @unlink($physicalPath);
            }
        }

        $this->deleted_at = time();
        $this->save();
    }

    public function getProfile()
    {
        return $this->hasOne(AttachmentProfile::className(), ["attachment_id" => "id"]);
    }

    public function getPhysicalPath()
    {
        return Yii::getAlias("{$this->profile->basepath}/{$this->profile->filepath}");
    }

    public function getOriginLink()
    {
        return Url::to(["/media/file/download", "uid" => $this->uid]);
    }

    public function getThumbnailLink($absolute = false, $width = 200)
    {
        return Url::to(["/media/image/thumbnail", "uid" => $this->uid, 'w' => $width], $absolute);
    }

    public static function uploadFile(UploadedFile $uploadedFile, $params = [])
    {
        $params = ArrayHelper::merge([
                    "localFile" => false,
                    "deleteTempFile" => true,
                    "generateNewName" => true,
                    "basepath" => Attachment::getDefaultBasePath(),
                    "path" => Attachment::getDefaultPath(),
                    "context" => [],
                    "model" => []
        ], $params);

        /** The relative path to store uploaded file * */
        $relativePath = self::resolvePath($uploadedFile, $params);
        /** The physical path to store uploaded file * */
        $physicalPath = Yii::getAlias("{$params["basepath"]}/{$relativePath}");
        /** Create directory if not exists * */
        if (!FileHelper::createDirectory(dirname($physicalPath))) {
            throw new InvalidParamException("Directory doesn't exist or cannot be created.");
        }

        if (@$params["localFile"]) {
            if (!copy($uploadedFile->tempName, $physicalPath)) {
                throw new InvalidValueException(Yii::t("app", "Failed to save uploaded file {name} to local disk", ["name" => $uploadedFile->name]));
            }
        } else {
            if (!$uploadedFile->saveAs($physicalPath, $params["deleteTempFile"]) || !file_exists($physicalPath)) {
                throw new InvalidValueException(Yii::t("app", "Failed to save uploaded file {name} to local disk", ["name" => $uploadedFile->name]));
            }
        }

        $attachment = new Attachment();
        if (Yii::$app instanceof Application) {
            $attachment->owner_id = 1;
        } else {
            $attachment->owner_id = Yii::$app->user->id;
        }
        
        if (!empty($params["model"])) {
            if ($params["model"] instanceof ActiveRecord) {
                $attachment->model_id = $params["model"]->id;
                $attachment->model_class = $params["model"]->className();
            } else {
                $attachment->model_id = $params["model"]["model_id"];
                $attachment->model_class = $params["model"]["model_class"];
            }
        }

        if (!$attachment->save()) {
            throw new InvalidValueException(Yii::t("app", "Failed to save uploaded file info to database."));
        }

        /* basic information */
        $profile = new AttachmentProfile();
        $profile->attachment_id = $attachment->id;
        $profile->filepath = $relativePath;
        $profile->basepath = $params["basepath"];
        $profile->name = $uploadedFile->name;
        $profile->size = $uploadedFile->size;
        $profile->type = $uploadedFile->type;
        $profile->extension = $uploadedFile->extension;
        /* context information */
        $profile->ip = @Yii::$app->request->userIP;
        if ($profile->save() === false) {
            throw new InvalidValueException(Yii::t("app", "Failed to save uploaded file info to database."));
        }

        return $attachment;
    }

    
    public static function findNameByUid($uid, $defaultName = "")
    {
        $attachmentName = Attachment::find()->select("name")->andWhere(["uid" => $uid])->limit(1)->scalar();
        return empty($attachmentName) ? $defaultName : $attachmentName;
    }

    public static function getDownloadLink($mixed, $profile = "")
    {
        if ($mixed instanceof Attachment) {
            $mixed = $mixed->uid;
        }

        return Url::to(["/media/file/download", "id" => $mixed, "profile" => $profile], true);
    }

    /**
     * 依据文件相对路径生成下载链接
     * @author qianzhiwei 2017-7-20
     * @param type $relateFilePath
     * @example 
     * getDownloadLinkByFile('stat/2016-04-02~2017-10-10.xls24') => 
     * http://console.clinify.cn/media/file/down?file=stat%2F2016-04-02~2017-10-10.xls24
     * @return string
     */
    public static function getDownloadLinkByFile($relateFilePath = ''){
        return Url::to(["/media/file/down", 'file'=> $relateFilePath], true);
    }
    
    /**
     * 根据文件路径下载文件
     * @author qianzhiwei 2017-7-20
     * @param string $fullPath 文件绝对路径
     */
    public static function downloadFile($fullPath = '')
    {
        #文件下载
        $fileinfo = pathinfo($fullPath);
        $filename = $fileinfo['filename'];
        header('Content-type: application/x-' . $fileinfo['extension']);
        header('Content-Disposition: attachment; filename=' . $fileinfo['basename']);
        header('Content-Length: '.filesize($fullPath));
        readfile($fullPath);
    }
    /**
     * 获得相对文件完整路径
     * @author qianzhiwei 2017-7-20
     * @param type $fullPath
     * @return string
     */
    public static function getFullFilePath($fullPath = '')
    {
        return \Yii::getAlias(\Yii::$app->params['file.save.path'] . '/' . $fullPath);
    }

    public static function getDefaultBasePath()
    {
        if (Yii::$app->hasModule("media") && Yii::$app->getModule("media") instanceof Module) {
            $module = Yii::$app->getModule("media");
            if (!empty($module->upload_basepath)) {
                return $module->upload_basepath;
            }
        }

        if (isset(Yii::$app->params["media.upload.basepath"])) {
            return Yii::$app->params["media.upload.basepath"];
        }

        return self::DEFAULT_BASEPATH;
    }

    public static function getDefaultPath()
    {
        if (Yii::$app->hasModule("media") && Yii::$app->getModule("media") instanceof Module) {
            $module = Yii::$app->getModule("media");
            if (!empty($module->upload_path)) {
                return $module->upload_path;
            }
        }

        if (isset(Yii::$app->params["media.upload.path"])) {
            return Yii::$app->params["media.upload.path"];
        }

        return self::DEFAULT_PATH;
    }

    public static function resolveName(UploadedFile $uploadedFile, $params = [])
    {
        $generateNewName = isset($params["generateNewName"]) ? $params["generateNewName"] : true;

        if ($generateNewName) {
            return $generateNewName instanceof Closure ? call_user_func($generateNewName, $uploadedFile) : self::generateFileName($uploadedFile);
        } else {
            return self::sanitize($uploadedFile->name);
        }
    }

    /**
     * Replaces all placeholders in path variable with corresponding values.
     */
    public static function resolvePath(UploadedFile $uploadedFile, $params = [])
    {
        if (empty($params["path"])) {
            throw new InvalidParamException(Yii::t("Missed parameter {name}", ["name" => "path"]));
        }

        $resolvedPath = preg_replace_callback('/{([^}]+)}/', function ($matches) use ($uploadedFile, $params) {
            $hash = md5($uploadedFile->name . ":" . $uploadedFile->size);

            switch ($name = $matches[1]) {
                case "date":
                    return date('Ymd');
                case "year":
                    return date("Y");
                case "month":
                    return date("m");
                case "day":
                    return date("d");
                case "hash11":
                    return substr($hash, -1, 1);
                case "hash21":
                    return substr($hash, -2, 1) . "/" . substr($hash, -1, 1);
                case "hash31":
                    return substr($hash, -3, 1) . "/" . substr($hash, -2, 1) . "/" . substr($hash, -1, 1);
                case "randomhash":
                    return md5(microtime(true));
            }

            if (Yii::$app->has($name) && $component = Yii::$app->$name && $component instanceof ActiveRecord) {
                /* @var $component ActiveRecord */
                if ($component->hasAttribute("uid")) {
                    return $component->uid;
                }

                if ($component->hasAttribute("id")) {
                    return $component->id;
                }
            }

            if (isset(Yii::$app->params[$name])) {
                $attribute = Yii::$app->params[$name];
                if (is_string($attribute) || is_numeric($attribute)) {
                    return $attribute;
                }
            }

            return $matches[0];
        }, $params["path"]);

        $filename = self::resolveName($uploadedFile, $params);
        return Yii::getAlias("{$resolvedPath}/{$filename}");
    }

    public static function registerModel($model)
    {
        if (Yii::$app->getSession()) {
            $sid = md5(microtime(true) . ":" . $model->className());
            Yii::$app->getSession()->set($sid, [
                "model_id" => $model->id,
                "model_class" => $model->className()
            ]);
            return $sid;
        } else {
            return "";
        }
    }

    public static function uid2json($uid)
    {
        $model = Attachment::findOne(["uid" => $uid]);
        return $model? $model->toJson() : null;
    }
    
    public static function getRegisteredModel($sid)
    {
        if (Yii::$app->getSession()) {
            return Yii::$app->getSession()->get($sid);
        } else {
            return null;
        }
    }

    /**
     * Replaces characters in strings that are illegal/unsafe for filename.
     *
     * #my*  unsaf<e>&file:name?".png
     *
     * @param string $filename the source filename to be "sanitized"
     * @return boolean string the sanitized filename
     */
    protected static function sanitize($filename)
    {
        return str_replace([' ', '"', '\'', '&', '/', '\\', '?', '#'], '-', $filename);
    }

    /**
     * Generates random filename.
     * @param UploadedFile $file
     * @return string
     */
    protected static function generateFileName($uploadedFile)
    {
        return uniqid() . '.' . $uploadedFile->extension;
    }

    public function fields()
    {
        return [
            "id" => function($model) {
                return $model->uid;
            },
            "profile",
            "link" => function($model) {
                return self::getDownloadLink($model);
            }
        ];
    }
    
    public function toJson()
    {
        return [
            "id" => $this->uid,
            "downloaded" => $this->downloaded,
            "name" => $this->profile->name,
            "size" => $this->profile->size,
            "extension" => $this->profile->extension,
            "type" => $this->profile->type
        ];
    }
}
