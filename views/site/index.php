<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJs(" 
//点击添加按钮 
$('body').find('a.add-column').click(function(){ 
//更新页面的元素 
//1.按照原页面的结构添加一个新的字段 
var html = \"<tr>\" + 
\"<th scope='row'>\"+(index+1)+\"</th>\" + 
\"<td><div class='form-group field-settings-\"+index+\"-name required'>\" + 
\"<input type='text' id='settings-\"+index+\"-name' class='form-control' name='Settings[\"+index+\"][ name ]'>\" + 
\"<div class='help-block'></div>\" + 
\"</div></td>\" + 
\"<td><div class='form-group field-settings-\"+index+\"-value required'>\" + 
\"<input type='text' id='settings-\"+index+\"-value' class='form-control' name='Settings[\"+index+\"][ content ]'>\" + 
\"<div class='help-block'></div>\" + 
\"</div></td>\" + 
\"<td><a class='add-column' href='javascript:;'>添加</a></td>\" + 
\"</tr>\"; 
//将拼接好的表单结构加入到tbody中 
$('table.table-striped').find('tbody').append(html); 
//2.然后加入新的字段的验证信息，这里可以参考表单自动生成的那部分JS然后copy下来改改就行了，这样子可以保证新添加的字段和之前的字段的验证规则是一模一样的(客户端验证) 
$('#my-form').yiiActiveForm('add', { 
\"id\": \"settings-\"+index+\"-name\", 
\"name\": \"[\"+index+\"]name\", 
\"container\": \".field-settings-\"+index+\"-name\", 
\"input\": \"#settings-\"+index+\"-name\", 
\"validate\": function (attribute, value, messages, deferred, \$form) { 
yii.validation.required(value, messages, {\"message\": \"Name cannot be blank.\"}); 
yii.validation.string(value, messages, { 
\"message\": \"Name must be a string.\", 
\"max\": 25, 
\"tooLong\": \"Name should contain at most 25 characters.\", 
\"skipOnEmpty\": 1 
}); 
} 
}); 
$('#my-form').yiiActiveForm('add',{ 
\"id\": \"settings-\"+index+\"-value\", 
\"name\": \"[\"+index+\"]content\", 
\"container\": \".field-settings-\"+index+\"-value\", 
\"input\": \"#settings-\"+index+\"-value\", 
\"validate\": function (attribute, value, messages, deferred, \$form) { 
yii.validation.required(value, messages, {\"message\": \"Value cannot be blank.\"}); 
yii.validation.string(value, messages, { 
\"message\": \"Value must be a string.\", 
\"max\": 25, 
\"tooLong\": \"Value should contain at most 25 characters.\", 
\"skipOnEmpty\": 1 
}); 
} 
}); 
console.log(index); 
index++; 
});", \yii\web\View::POS_END, 'dysc');

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

                <?= $form->field($model, 'name', ['inputOptions' => ['placeholder' => '在此设一个标题', 'class' => 'form-username form-control']])->textInput(['autofocus' => true])->label(false) ?>
                <?= $form->field($model, 'content', ['inputOptions' => ['placeholder' => '简要的文字描述', 'class' => 'form-username form-control']])->textarea(['autofocus' => true])->label(false) ?>

                <?= $form->field($model, 'imageFile')->fileInput(); ?>


                <div>
                    <div class="form">
                        <h3>报名设置</h3>
                    </div>
                    <div>
                        <span>配资金信息●/○:  <?= $form->field($model, 'currency')->dropDownList(['1' => '￥', '2' => '$', '3' => '€', '4' => '￡'])->label(false); ?></span>
                    </div>
                    <div>
                        <p>点[+]创建一个或多个报名项 <span onclick="copyText()">[+]</span></p>
                        <div id="addTable">
<!--                            <table>
                                <tr><td>项目名称：</td><td></td></tr>
                                <tr><td>项目单价：</td><td></td></tr>
                                <tr><td>数量限制：</td><td></td></tr>
                            </table>-->

                            <table class="table table-striped">
                                <thead> 
                                    <tr> 
                                        <th>#</th> 
                                        <th>Name</th> 
                                        <th>Value</th> 
                                        <th><?= Yii::t('yii', 'action') ?></th> 
                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php foreach ($model as $index => $setting): ?> 
                                        <tr> 
                                            <th scope="row"><?= ($index + 1) ?></th> 
                                            <td><?= $form->field($model, "[$index]name")->label(false) ?></td> 
                                            <td><?= $form->field($model, "[$index]content")->label(false) ?></td> 
                                            <td><?= Html::a("添加", 'javascript:;', ['class' => 'add-column']) ?></td>
                                        </tr> 
                                    <?php endforeach; ?> 
                                </tbody> 
                            </table> 

                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>


                <?php ActiveForm::end() ?>
            </div>
    </body>
</html>

<script>
    function copyText()
    {
        document.getElementById("addTable").value = document.getElementById("field1").value;
    }

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
