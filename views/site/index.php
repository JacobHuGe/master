<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<!DOCTYPE html>
<html lang="en">
    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>

    <head>
        <meta charset="UTF-8">

        <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link href="../css/site/style.css"  rel="stylesheet">

    </head>

    <body id="index">
        <div class="tab-news" id="tab-news">
            <div class="tab-news-hd tab-hd-index">
                <ul class="fix">
                    <li class="on">新创建</li>
                    <li class=""><a href="<?= yii\helpers\Url::to(["site/launch"])?>">我发起的</a></li>
                    <li class=""><a href="<?= yii\helpers\Url::to(["site/partake"])?>">我参与的</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="form-bottom">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                <?= $form->field($model, 'name', ['inputOptions' => ['placeholder' => '在此设一个标题', 'class' => 'form-username form-control']])->textInput(['autofocus' => true])->label(false) ?>
                <?= $form->field($model, 'content', ['inputOptions' => ['placeholder' => '简要的文字描述', 'class' => 'form-username form-control']])->textarea(['autofocus' => true])->label(false) ?>

                <?= $form->field($model, 'imageFile')->fileInput(); ?>
                <div>
                    <div class="form">
                        <h4>报名设置</h4>
                    </div>
                    <div>
                        <span>配资金信息●/○:  <?= $form->field($model, 'currency')->dropDownList(['1' => '￥', '2' => '$', '3' => '€', '4' => '￡'])->label(false); ?></span>
                    </div>
                    <div>
                        <p>点[+]创建一个或多个报名项 <input type='button' class='btnAdd' value='[+]'/></p>
                        <div id="father">
                            <fieldset>
                                <!--<legend>报名项</legend><input type='button' class='btnDel' value='删除' onclick = "$(this).parent().remove();"/>-->

                                <p>项目名称： <?= $form->field($model, 'study_name', ['inputOptions' => ['placeholder' => '简要的文字描述', 'class' => 'form-username form-control']])->textInput(['autofocus' => true])->label(false) ?></p>
                                <p>项目单价： <?= $form->field($model, 'price', ['inputOptions' => ['placeholder' => '简要的文字描述', 'class' => 'form-username form-control']])->textInput(['autofocus' => true])->label(false) ?></p>
                                <p>数量限制： <?= $form->field($model, 'number', ['inputOptions' => ['placeholder' => '简要的文字描述', 'class' => 'form-username form-control']])->textInput(['autofocus' => true])->label(false) ?></p>

                            </fieldset>
                        </div>
                    </div>

                    <div>
                        <span>报名信息的登记规则:  ✓</span>
                    </div>

                    <?= $form->field($model, 'rule')->checkboxList(['is_show_name' => '姓名昵称', 'is_show_phone' => '联系方式', 'is_show_leave' => '备注留言']) ?>
                    
                    <?php // $form->field($model, 'rule')->checkboxList($items, $is_show_data)->label(false) ?>

                    <p>截止时间： <?= $form->field($model, 'end_at', ['inputOptions' => ['placeholder' => '不设则无自动截止', 'class' => 'form-username form-control']])->textInput(['autofocus' => true])->label(false) ?></p>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </body>
</html>

<script>
//    var blockNum = 10;
//
//    $(document).ready(function () {
//        var parentDom = $('#father'), oriDom = parentDom.children(":first");
//        $('.btnAdd').click(function () {
//            var clLength = parentDom.children().length;
//            if (blockNum > clLength) {
//                var nowDom = oriDom.clone();
//                nowDom.children(":first").text('报名项');
//                parentDom.append(nowDom);
//            }
//            else
//                return false;
//        });
//        $('.btnSub').click(function () {
//
//            var nameUser = [];
//            $('.testName').each(function (index) {
//                nameUser[index] = $(this).val();
//            }); // 获取所有文本框
//
//            var nameUser1 = [];
//            $('.test').each(function (index) {
//                nameUser1[index] = $(this).val();
//            }); // 获取所有文本框
//
//            $('.conform').submit();
//        });
//    });

</script>

<!--<script type="text/javascript">
    function getVal() {
        var newAdd = document.getElementById('newAdd').value;
        document.getElementById('txtVal').innerHTML += newAdd;
    }
</script>-->


<!--<script>
    window.onload = function () {
        var oBtn = document.getElementById('btn');
        oBtn.onclick = function () {
            var oInp = document.createElement('input');
            oInp.type = 'txet';
            document.body.appendChild(oInp);
        };
    };
</script>-->
</head>
<!--
<body>
    <input type="button" id="btn" value="click me" />
</body>-->
