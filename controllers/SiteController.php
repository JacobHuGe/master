<?php

namespace app\controllers;

use app\components\WebBaseController;
use app\models\site\CreateForm;
use app\models\Title;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
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
                throw new BadRequestHttpException(Yii::t("app", "添加失败"));
            }
            $transaction->commit();
            // 文件上传成功
            return $this->redirect(["site/sponsor"]);
        }

        return $this->render('index',["model" => $model]);
    }
    
    public function actionAaa(){
        die("xx");
    }
    public function actionMyAction(){
    if(Yii::$app->request->getIsPost()){
        var_dump(Yii::$app->request->post());
    }
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
        return $this->render('sponsor');
    }
    
    /**
     * 我参与的
     * @return type
     */
    public function actionJoin()
    {
        return $this->render("join");
    }
    
    
    public function actionPartake()
    {
        return $this->render("partake");
    }

}
