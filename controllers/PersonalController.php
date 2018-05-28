<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use app\components\WebBaseController;
use app\models\UserModel;
use Yii;

class PersonalController extends WebBaseController
{
    public function actionIndex()
    {
        $user = UserModel::findOne(["id" => Yii::$app->user->id]);
        return $this->render("index", compact("user"));
    }
}