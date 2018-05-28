<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>日安</title>

        <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link href="../css/site/style.css"  rel="stylesheet">

    </head>

    <body id="index">
        <div class="tab-news" id="tab-news">
            <div class="tab-news-hd tab-hd-index">
                <ul class="fix">
                    <li class="on">新创建</li>
                    <li class="">我发起的</li>
                    <li class="">我参与的</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="form-bottom">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                            "class" => 'login-form',
                ]);
                ?>

                <?= $form->field($model, 'name', ['inputOptions' => ['placeholder' => '请输入用户名', 'class' => 'form-username form-control']])->textInput(['autofocus' => true])->label(false) ?>
                <?= $form->field($model, 'content', ['inputOptions' => ['placeholder' => '请输入手机号', 'class' => 'form-username form-control']])->textInput(['autofocus' => true])->label(false) ?>
                <?= $form->field($model, 'currency', ['inputOptions' => ['placeholder' => '请输入邮箱', 'class' => 'form-username form-control']])->textInput(['autofocus' => true])->label(false) ?>
                <?= $form->field($model, 'log', ['inputOptions' => ['placeholder' => '请设置密码', 'class' => 'form-password form-control']])->passwordInput()->label(false) ?>
                
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

            </div>
        </div>
    </body>
</html>