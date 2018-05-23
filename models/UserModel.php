<?php

namespace app\models;

use app\behaviors\UniqueIdGenerator;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class UserModel extends ActiveRecord implements IdentityInterface
{
    const ROLE_ADMIN = "admin";
    const ROLE_PARTICIPANT = "participant";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                "class" => UniqueIdGenerator::className()
            ],
            [
                "class" => TimestampBehavior::className()
            ]
        ];
    }
    
    public static function getRoles()
    {
        return [
            self::ROLE_ADMIN => Yii::t("app", "管理员(ADMIN)"),
            self::ROLE_PARTICIPANT => Yii::t("app","参与者"),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'passwd_hash','mobile', 'role'], 'required'],
            [["email"], "safe"]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
        #return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $userToken = UserModel::find()->andWhere(["uid" => $token])->one();
        if (empty($userToken)) {
            return null;
        }
        return new static($userToken);
        //return $userToken->user;
        
        
        
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }
//
//        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        
        $r = Yii::$app->security->validatePassword($password, $this->passwd_hash);
        
        /**
         * edit by LiangFuJian 2018-01-29
         */
        if (!$r && !empty($this->password_md5)) {
            $r = (self::hashPassword($password) === $this->password_md5) ? true : false;
        }
        
        return $r;
        
    }
    
    /**
     * 生成 "remember me" 认证key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
