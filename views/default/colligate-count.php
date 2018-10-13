<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/1.1.3/weui.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <script type="text/javascript" src="../js/zepto.min.js" ></script>
    <script type="text/javascript" src="https://res.wx.qq.com/open/libs/weuijs/1.1.3/weui.min.js"></script>
    <!-- <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://as.alipayobjects.com/g/component/fastclick/1.0.6/fastclick.js"></script>
    <script>
        if ('addEventListener' in document) {
            document.addEventListener('DOMContentLoaded', function() {
                FastClick.attach(document.body);
            }, false);
        }
        if(!window.Promise) {
            document.writeln('<script src="https://as.alipayobjects.com/g/component/es6-promise/3.2.2/es6-promise.min.js"'+'>'+'<'+'/'+'script>');
        }
    </script> -->
    <title>index</title>
</head>
<body>
    <div class="invite-detail-title" style="font-size: 16px;border-bottom: 1px solid #e5e5e5;line-height: 40px;"><?= $titleData->name ?></div>
    <div class="weui-cells__title">
        <a style="margin:0 8px" href='<?= Url::to(["default/colligate-count", "id" => $_REQUEST["id"]]) ?>' class='invite-nav-btn' >综合统计</a><a style="margin:0 8px" href='<?= Url::to(["default/subitem-count", "id" => $_REQUEST["id"]]) ?>' class='invite-nav-btn' >分项统计</a>
    </div>
    <div class="weui-cells">
        <div class="weui-cell" style='justify-content: space-between;'>
            <p>累计数量：<span style="color: #ff2500;font-weight: 600;"><?= $num ?></span></p>
            <p>累计金额：<span style="color: #ff2500;font-weight: 600;">￥<?= $price ?></span></p>
        </div>
        <?php foreach($enrollInfo as $info): ?>
        
        <div class="weui-cell" style="align-items: flex-start;" >
            <div class="weui-cell__hd"><img src="/images/avatar.jpg" alt="" style="width:48px;margin-right:12px;display:block"></div>
            
            <div class="weui-cell__bd">
                <?php foreach($info->studyEnroll as $studyEnroll): ?>
                <p style="font-size: 13px; color: #333;margin: 4px 0;" ><span style="display: inline-block;width: 160px"><?= $studyEnroll->study->name ?></span> <span style="margin-left: 14px;">&times;<?= $studyEnroll->num ?></span><span style="margin-left: 8px">[ 标注 ]</span></p>
                <?php endforeach; ?>
                <p style='font-size: 13px;color: #666;margin: 4px 0;' ><?= $info->name ?> - <?= $info->mobile ?></p>
            </div>
            <?php endforeach; ?>
        </div>
       
<!--        <div class="weui-cell" style="align-items: flex-start;" >
            <div class="weui-cell__hd"><img src="/images/avatar.jpg" alt="" style="width:48px;margin-right:12px;display:block"></div>
            <div class="weui-cell__bd">
                <p style="font-size: 13px; color: #333;margin: 4px 0;" ><span style="display: inline-block;width: 160px">四姑娘山远足</span> <span style="margin-left: 14px;">&times;1</span><span style="margin-left: 8px">[ 标注 ]</span></p>
                <p style="font-size: 13px; color: #333;margin: 4px 0;" ><span style="display: inline-block;width: 160px">嘉峪关-敦煌自驾</span> <span style="margin-left: 14px;">&times;2</span></p>
                <p style='font-size: 13px;color: #666;margin: 4px 0;' >张三/…1234/——</p>
            </div>
        </div>-->
         
    </div>
<!--    <div class="weui-cells__title">分项统计</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <p>额济纳旗自驾</p>
        </div>
        <div class="weui-cell" style='justify-content: space-between;'>
            <p>累计数量：<span style="color: #ff2500;font-weight: 600;">42</span></p>
            <p>累计金额：<span style="color: #ff2500;font-weight: 600;">￥4,200.00</span></p>
        </div>
        <div class="weui-cell" style="align-items: flex-start;" >
            <div class="weui-cell__hd"><img src="../images/avatar.jpg" alt="" style="width:48px;margin-right:12px;display:block"></div>
            <div class="weui-cell__bd">
                <p style="font-size: 13px; color: #333;margin: 4px 0;" ><span style="display: inline-block;width: 160px">四姑娘山远足</span> <span style="margin-left: 14px;">&times;1</span><span style="margin-left: 8px">[ 标注 ]</span></p>
                <p style='font-size: 13px;color: #666;margin: 4px 0;' >张三/…1234/——</p>
            </div>
        </div>
        <div class="weui-cell">
            <p>四姑娘山远足</p>
        </div>
        <div class="weui-cell" style='justify-content: space-between;'>
            <p>累计数量：<span style="color: #ff2500;font-weight: 600;">42</span></p>
            <p>累计金额：<span style="color: #ff2500;font-weight: 600;">￥4,200.00</span></p>
        </div>
        <div class="weui-cell" style="align-items: flex-start;" >
            <div class="weui-cell__hd"><img src="/images/avatar.jpg" alt="" style="width:48px;margin-right:12px;display:block"></div>
            <div class="weui-cell__bd">
                <p style="font-size: 13px; color: #333;margin: 4px 0;" ><span style="display: inline-block;width: 160px">四姑娘山远足</span> <span style="margin-left: 16px;">&times;1</span><span style="margin-left: 8px">[ 标注 ]</span></p>
                <p style='font-size: 13px;color: #666;margin: 4px 0;' >张三/…1234/——</p>
            </div>
        </div>
    </div>-->
</body>
</html>