<?php
namespace app\controllers;

use app\components\WebBaseController;
use app\models\ApplyForm;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\Study;
use app\models\Title;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use const YII_ENV_TEST;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DefaultController extends WebBaseController
{
    public function behaviors() 
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'count', 'apply'],
                'rules' => [
                    [
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
    public function actions()
    {
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
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $title = @$_REQUEST["title"];
        if(empty($title)){
            //throw new BadRequestHttpException("参数错误");
            $title = '36';
        }
        
        $titleData = Title::find()->andWhere(["id" => $title])->one();
        if(empty($titleData) || $titleData["state"] == Title::STATE_FAIL){
            throw new BadRequestHttpException("找不到次记录");
        }

        $imgUrl = \app\models\Attachment::find()->andWhere(["model_id" => $titleData->id])->select("img_url")->column();
        
        $descriptions = \app\models\Description::find()->andWhere(["title_id" => $titleData->id, "deleted_at" => 0])->all();
        
        $enrollInfos = \app\models\StudyEnroll::find()->andWhere(["title_id" => $titleData->id])->select(["count(user_id)", "user_id"])->groupBy("user_id")->asArray()->all();
        return $this->render('index', ["model" => $titleData, "imgUrl" => $imgUrl, "enrollCount" => count($enrollInfos), "enrollInfos" => $enrollInfos, "descriptions" => $descriptions ]);
    }
    
    /**
     * 统计
     * @return type
     */
    public function actionCount()
    {
        return $this->render("count");
    }
    
    public function actionApply()
    {
        $id = @$_REQUEST["id"];
        if(empty($id)){
            throw new BadRequestHttpException("参数错误");
        }

        $titleData = Title::findOne(["id" => $id]);
        if(empty($titleData) || $titleData->state != Title::STATE_ADOPT){
            throw new BadRequestHttpException("找不到次记录");
        }
        
        if($titleData->enroll_state == Title::ENROLL_STATE_STOP){
            throw new BadRequestHttpException("报名已终止");
        }
        
        $query = Study::find()->andWhere(["title_id" => $titleData->id]);
        $dataProvider = new ActiveDataProvider(["query" => $query]);
        $apply = new ApplyForm();
        if(Yii::$app->request->post()){
            $apply->load($_REQUEST);
            $transaction = Yii::$app->db->beginTransaction();
            if ($apply->save() === false) {
                throw new BadRequestHtbeginTransactiontpException(Yii::t("app", "添加失败"));
            }
            $transaction->commit();
            return $this->redirect(["site/join"]);
        }
        
        return $this->render("apply", ["dataProvider" => $dataProvider, "title" => $titleData, "apply" => $apply]);
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