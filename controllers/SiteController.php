<?php

namespace app\controllers;

use app\components\Upload;
use app\components\WebBaseController;
use app\models\Attachment;
use app\models\Enroll;
use app\models\site\CreateForm;
use app\models\site\TitleUpdateForm;
use app\models\site\UploadForm;
use app\models\Title;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class SiteController extends WebBaseController {
    
    public function behaviors() 
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['logout', 'index',"launch"],
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

    public $fileTransportPath = '@runtime/uplode';
    
    /**
     * 添加标题
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $model = new CreateForm();
        if( Yii::$app->request->post()){
            $model->load($_REQUEST);
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
    
    /**
     * 删除标题
     * @return type
     */
    public function actionTitleDelete(){
        $title = $this->titleOne();
        
        $title->deleted_at = time();
        $title->enroll_state = Title::ENROLL_STATE_STOP;
        if($title->save() === false){
            throw new BadRequestHttpException("删除失败，请重试!");
        }
        
        return $this->redirect(["site/sponsor"]);
    }
    
    /**
     * 修改标题
     * @return type
     */
    public function actionTitleUpdate()
    {
        $title = $this->titleOne();
        
        $model = new TitleUpdateForm();
        if(Yii::$app->request->post()){
            $model->load($_REQUEST);
            $transaction = Yii::$app->db->beginTransaction();
            if($model->save() === false){
                throw new BadRequestHttpException("数据更改失败");
            }
            $transaction->commit();
            return $this->redirect(["site/sponsor"]);
        }
        
        $attachments = Attachment::find()->andWhere(["model_id" => $title->id])->all();
        $img = "";
        foreach($attachments as $attachment){
            $comma = "";
            if(!empty($img)){
                $comma = ",";
            }
            $img = $img.$comma.$attachment["img_url"];
        }
        $model["imageFile"] = $img;
        $model["name"] = $title->name;
        $model["content"] = $title->content;
        $model["end_at"] = empty($title->end_at) || $title->end_at == 0 ? "" : date("Y-m-d", $title->end_at);
        $model["is_show_name"] = $title->is_show_name;
        $model["is_show_phone"] = $title->is_show_phone;
        $model["is_show_leave"] = $title->is_show_leave;
        
        $studys = \app\models\Study::find()->andWhere(["title_id" => $title->id, "deleted_at" => 0])->all();
        
        return $this->render("title-update", ["model" => $model, "studys" => $studys]);
    }
    
    public static function titleOne(){
        if(!isset($_GET["id"])){
            throw new BadRequestHttpException("参数有误");
        }
        
        $id = $_GET["id"];
        
        $title = Title::findOne(["id" => $id, "deleted_at" => 0]);
        if(empty($title)){
            throw new BadRequestHttpException("数据已被删除或不存在");
        }
        return $title;
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
        $query = Title::find()->andWhere(["created_by" => Yii::$app->user->id]);
        $countQuery = clone $query;
        
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>5]);
        $models = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        //$dataProvider = new ActiveDataProvider(["query" => $query]);
        
        return $this->render('sponsor',["dataProvider" => $models, 'pages' => $pages,]);
    }
    
    /**
     * 我参与的
     * @return type
     */
    public function actionJoin()
    {
        
        $query = Enroll::find()->andWhere([Enroll::tableName().".user_id" => Yii::$app->user->id, "deleted_at" => 0]);
        
        //$query = StudyEnroll::find()->andWhere(["user_id" => Yii::$app->user->id]);
        $dataProvider = new ActiveDataProvider(["query" => $query]);
        return $this->render("join",["dataProvider" => $dataProvider]);
    }
    
    
    public function actionPartake()
    {
        return $this->render("partake");
    }
    
    /**
     * 删除入组数据 （ 暂定）
     * @return type
     * @throws BadRequestHttpException
     */
    public function actionEnrolldelete(){
        
        if(!isset($_GET["id"])){
            throw new BadRequestHttpException("参数有误");
        }
        
        $enroll = Enroll::findOne(["id" => $_GET["id"], "deleted_at" => 0]);
        if(empty($enroll)){
            throw new BadRequestHttpException("数据已被删除或不存在");
        }
        $enroll->deleted_at = time();
        if($enroll->save() === false){
            throw new BadRequestHttpException("删除失败");
        }
        return $this->redirect(["site/join"]);
    }
    
    /**
     * 测试
     * @return type
     */
    public function actionUpload1()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                // 文件上传成功
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
    
     //webUploader上传    
     public function actionUpload()    {
         try {            
             Yii::$app->response->format = Response::FORMAT_JSON; 
             $model = new Upload();
             $info = $model->upImage();
             if ($info && is_array($info)) {                
                 return $info;            
                 
             } else {
                 return ['code' => 1, 'msg' => 'error'];            
                 
             }        
             
        } catch (\Exception $e) {            
            return ['code' => 1, 'msg' => $e->getMessage()];        
            
        }    
        
    }

}
