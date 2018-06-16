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

    <body class="activity">
        <div class="tab-news" id="tab-news">
            <div class="tab-news-hd tab-hd-index">
                <ul class="fix">
                    <li class="ons"><a href="<?= Url::to(["site/index"]) ?>">新创建</a></li>
                    <li class="on">发起的</a></li>
                    <li class="ons"><a href="<?= Url::to(["site/partake"]) ?>">参与的</a></li>
                </ul>
            </div>
        </div>
        
        <?php foreach ($dataProvider->models as $model): ?>
            <!--$model->download->img_url-->

            <div class="wrap">
                <a href="activity_details.html" class="wrap1">
                    <div class="right">
                        <h1><?= $model->name ?></h1>
                        <p style="width: 500px"><span class="span4">发起时间：<?= date("Y-m-d H:i:s", $model->created_at) ?></span> 累计：0</p>
                        <div>
                            <span class="span1"><img src="images/time1.png" alt=""></span>
                            <span class="span2"><img src="images/time2.png" alt="">浙江日安美术馆</span>
                            <span class="span3"><i>29</i>报名</span>
                        </div>
                    </div>
                </a>
            </div>

        <?php endforeach; ?>

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
