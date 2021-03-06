<?php

namespace app\components;

use app\helpers\BrowserHelper;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use const YII_ENV_TEST;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AppBaseController extends Controller {

    //public $layout = "@app/views/app/layouts/main.php";
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
       
//        $browser = new BrowserHelper;
//        if(!$browser->isMobile()){
//            return $this->redirect("default/{$this->action->id}");
//        }
//        var_Dump();die;
//        var_Dump(Yii::$app->controller->id,$this->action->id);
//        die;
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout', 'capecha', 'register', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                // 'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'maxLength' => 4,
                'minLength' => 4,
            ],
        ];
    }

}
