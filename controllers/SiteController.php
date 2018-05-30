<?php

namespace app\controllers;

use app\components\WebBaseController;
use app\models\site\CreateForm;
use Yii;
use yii\web\UploadedFile;

class SiteController extends WebBaseController
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new CreateForm();
        //$model->load($_REQUEST);
       
        
        if(Yii::$app->request->post()){
            if($model->save()){
                return $this->render('index', compact('model'));
                //return $this->redirect(['view', 'id' => $model->id]);
             }
        }
        
        return $this->render('index', compact('model'));
    }


}
