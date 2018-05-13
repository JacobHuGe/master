<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class WebBaseController extends Controller
{
    /**
     * 在程序执行之前，对访问的方法进行权限验证.
     * @param Action $action
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        //如果未登录，则直接返回
        if(Yii::$app->user->isGuest){
            return $this->goHome();
        }
        //获取路径
        $path = Yii::$app->request->pathInfo;

        //忽略列表
        if (in_array($path, $this->ignoreList)) {
            return true;
        }

        if (Yii::$app->user->can($path)) {
            return true;
        } else {
            throw new ForbiddenHttpException(Yii::t('app', 'message 401'));
        }
    }
}
