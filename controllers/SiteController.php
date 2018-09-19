<?php

namespace app\controllers;

use app\components\WebBaseController;
use app\models\site\CreateForm;
use app\models\StudyEnroll;
use app\models\Title;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

class SiteController extends WebBaseController {

    public $fileTransportPath = '@runtime/uplode';
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $model = new CreateForm();
        if( Yii::$app->request->post()){
            $model->load($_REQUEST);
            $model->imageFile = UploadedFile::getInstance($model, "imageFile");
            $transaction = Yii::$app->db->beginTransaction();
            if ($model->save() === false) {
                throw new BadRequestHtbeginTransactiontpException(Yii::t("app", "添加失败"));
            }
            $transaction->commit();
            // 文件上传成功
            return $this->redirect(["site/sponsor"]);
        }

        return $this->render('index',["model" => $model]);
    }
    
    public function actionLaunch()
    {
        $query = Title::find()->andWhere(["created_by" => Yii::$app->user->id, "deleted_at" => 0]);
        $dataProvider = new ActiveDataProvider(["query" => $query]);

        return $this->render('launch', compact("dataProvider", 'fileTransportPath'));
    }
    
    /**
     * 我创建的
     * @return type
     */
    public function actionSponsor()
    {
        $query = Title::find()->andWhere(["created_by" => Yii::$app->user->id, "state" => Title::STATE_ADOPT, "deleted_at" => 0]);
        $dataProvider = new ActiveDataProvider(["query" => $query]);
        
        return $this->render('sponsor',["dataProvider" => $dataProvider]);
    }
    
    /**
     * 我参与的
     * @return type
     */
    public function actionJoin()
    {
        
        $query = \app\models\Enroll::find()->andWhere([\app\models\Enroll::tableName().".user_id" => Yii::$app->user->id, "deleted_at" => 0]);
        
        //$query = StudyEnroll::find()->andWhere(["user_id" => Yii::$app->user->id]);
        $dataProvider = new ActiveDataProvider(["query" => $query]);
        return $this->render("join",["dataProvider" => $dataProvider]);
    }
    
    
    public function actionPartake()
    {
        return $this->render("partake");
    }
    
    public function actionEnrolldelete(){
        
        if(!isset($_GET["id"])){
            throw new \yii\web\BadRequestHttpException("参数有误");
        }
        
        $enroll = \app\models\Enroll::findOne(["id" => $_GET["id"], "deleted_at" => 0]);
        if(empty($enroll)){
            throw new \yii\web\BadRequestHttpException("数据已被删除或不存在");
        }
        $enroll->deleted_at = time();
        if($enroll->save() === false){
            throw new \yii\web\BadRequestHttpException("删除失败");
        }
        return $this->redirect(["site/join"]);
    }

}
