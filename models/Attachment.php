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
}
