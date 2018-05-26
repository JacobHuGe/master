<?php
namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use app\models\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DefaultController extends \app\components\WebBaseController
{
    
    public function behaviors() 
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout', 'register', 'login'],
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    { 
        return $this->render('index');
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    /**
     * 修改密码
     */
    public function actionUpdatePasswd()
    {
        return $this->render("update-passwd");
    }
    
    /**
     * 
     */
    public function actionRegister()
    {
        
        $model = new RegisterForm();
        $model->load($_REQUEST, "");
        
        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            return $this->goHome();
        }
        
        $model->password = '';
        return $this->render('register', [
            'model' => $model,
        ]);
    }
}