<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\BadRequestHttpException;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $newPassword;
    public $password;
    public $mobile;
    public $email;
    public $verifyCode;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password','mobile', 'newPassword'], 'required'],
            [["mobile"],'match','pattern'=>'/^1\d{10}$/','message'=>'手机号有误'],
            ['password', 'string', 'min' => 6],
            ['newPassword', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false, 'message' => "两次密码不不一致"],
            ["email",'email'],
            ['verifyCode', 'captcha'],
            ["email","userEmail"],
            ["mobile","userMobile"],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => '验证码',
        ];
    }
    
    public function userEmail($attribute)
    {
        if (!$this->hasErrors()) {
            $userEmail = UserModel::findOne(["email" => $this->email]);
                if($userEmail){
                    $this->addError($attribute, '邮箱已存在。');
                    //throw new BadRequestHttpException(Yii::t("app", "邮箱已存在"));
                }

//            if (!$user || !$user->validatePassword($this->password)) {
//                $this->addError($attribute, '用户名或密码不正确。');
//            }
        }
    }
    
    public function userMobile($attribute)
    {
        if (!$this->hasErrors()) {
            $userEmail = UserModel::findOne(["mobile" => $this->mobile]);
                if($userEmail){
                    $this->addError($attribute, '手机号已存在。');
                }
        }
    }


    public function create()
    {
        if(!$this->validate()){
            return false;
        }
        
        $model = new UserModel;
        $model->name = $this->username;
        $model->mobile = $this->mobile;
        $model->email = $this->email;
        $model->passwd_hash = Yii::$app->security->generatePasswordHash($this->password);
        $model->role = UserModel::ROLE_PARTICIPANT;
        $model->generateAuthKey();
        if($model->save() === false){
            throw new BadRequestHttpException(Yii::t("app", "创建角色失败"));
        }
        
        return $model;
        
    }
}
