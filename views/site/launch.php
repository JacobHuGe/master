<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
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
                    <li class=""><a href="<?= Url::to(["site/index"])?>">新创建</a></li>
                    <li class="on">我发起的</a></li>
                    <li class=""><a href="<?= Url::to(["site/partake"])?>">我参与的</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
                 <?php foreach($dataProvider->models as $model):?>
               <a href="new_detail.html" class="wrap">
		<div class="wrap1">
			<h1><?= $model->name ?></h1>
                        <?php  var_dump($fileTransportPath);die; // var_Dump(dirname(dirname(__DIR__)).$model->download->img_url);die; ?>
                        <img src="<?= "@runtime".$model->download->img_url ?>" alt="">
                            <p>关键词：清明上河图；疑点；任务复活；</p>
                            <div class="read-more">
                                <span>阅读全文</span>
                                <img src="images/news_more.png" alt="">
                            </div>
                            <span class="time">今天11：00</span>
                    </div>
                   </a>
           
            <?php endforeach;?>
            
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
