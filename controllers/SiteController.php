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
        $count = count(Yii::$app->request->post('CreateForm', []));
        $models = new CreateForm();
        
        for($i = 1; $i < $count; $i++){
            $models[] = new CreateForm();
        }
        //$model->load($_REQUEST);
        
        
        if(\yii\base\Model::loadMultiple($models, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($models)){
            $models->imageFile = UploadedFile::getInstance($models, 'imageFile');

            if ($models->upload() === false) {
                // 文件上传成功
                throw new \yii\web\BadRequestHttpException(Yii::t("app", "添加失败"));
            }
        }

        return $this->render('index', compact('models'));
    }

}
