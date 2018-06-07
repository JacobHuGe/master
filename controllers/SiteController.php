<?php

namespace app\controllers;

use app\components\WebBaseController;
use app\models\site\CreateForm;
use Yii;
use yii\web\UploadedFile;

class SiteController extends WebBaseController {

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $model = new CreateForm();
        //$model->load($_REQUEST);
        if( Yii::$app->request->post()){
            var_Dump($_REQUEST);die;
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->upload() === false) {
                // 文件上传成功
                throw new \yii\web\BadRequestHttpException(Yii::t("app", "添加失败"));
            }
        }

        return $this->render('index', compact('model'));
    }

}
