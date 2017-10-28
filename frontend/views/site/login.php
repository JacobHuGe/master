<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Home</title>
        <!-- Custom Theme files -->
        <link href="css/site/login/style.css" rel="stylesheet" type="text/css" media="all"/>

        <!--Google Fonts-->
        <!--Google Fonts-->
    </head>
    <body>
        <div class="login">
            <div class="login-top">
                <h1>LOGIN</h1>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="forgot">
                    <?= Html::a(Yii::t("app", "忘记密码？"), ['site/request-password-reset']) ?>
                    <?= Html::submitButton(Yii::t("app", '登录'), ['name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>


            </div>
            <div class="login-bottom">
                <h3><?= Yii::t("app", 'WELCOME LANDING'); ?></h3>
            </div>
        </div>	

    </body>
</html>