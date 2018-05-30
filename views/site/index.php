<?php

use app\helpers\FileHelper;
use yii\bootstrap\Alert;
use yii\helpers\Html;
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
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <?= $form->field($model, 'log')->fileInput() ?>

                            </div>
                            <hr class="hr"/>
                        </div>
                        <div class="row">
                        </div>
                    </div>        
                </div>
                
                 <input type="submit" class="btn btn-success" value="提交">
                
                <?php
                ActiveForm::end();
                ?>
        </div>
    </body>
</html>