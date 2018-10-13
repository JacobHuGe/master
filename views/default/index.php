<?php
use app\models\StudyEnroll;
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
    <div style="padding-bottom: 48px;" >
        <div class="invite-detail-title" style="font-weight:bold; font-size:16px"> <?= $model->name?></div>
        <div class='invite-banner-content'>
            <?php if(!empty($imgUrl)):?>
            <img style="height: 240px " src='<?= Yii::$app->request->getHostInfo()?>/<?= $imgUrl[0]?>' />
            <?php else: ?>
                <img src='../images/ban2.jpg' />
            <?php endif;?>
        </div>
        <div class="invite-detail-content">
            <p><?= $model->content?></p>
            <ul>
                <?php foreach($imgUrl as $url):?>
                <li><img height="60px" style="width: 160px" src='<?= Yii::$app->request->getHostInfo()?>/<?= $url ?>' /></li>
<!--                <li><img src='../images/ban2.jpg' /></li>
                <li><img src='../images/ban2.jpg' /></li>
                <li><img src='../images/ban2.jpg' /></li>-->
                <?php endforeach; ?>
            </ul>   
        </div>
        <div class="weui-cells__title">信息更新</div>
        <div class="weui-cells">
            <?php foreach($descriptions as $description):?>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p><?= $description->content ?></p>
                    <p style="font-size: 13px; color: #666;" ><?= date("Y-m-d", $description->created_at)?></p>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div class="weui-cells__title">报名动态：目前累计<span style='color: #ff2500;font-weight: 500;margin-left: 8px;' ><?= $enrollCount ?></span></div>
        <div class="weui-cells">
            <?php foreach($enrollInfos as $info): ?>
            <?php $enrollInfo = \app\models\Enroll::findOne(["title_id" => $model->id, "user_id" => $info["user_id"]])?>
            <?php if(!empty($enrollInfo)):?>
                <div class="weui-cell" style="align-items: flex-start;" >
                    <!--<div class="weui-cell__hd"><img src="/images/avatar.jpg" alt="" style="width:48px;margin-right:12px;display:block"></div>-->
                    <div class="weui-cell__bd" style="margin: 0 0 0 20px">
                        <?php foreach(StudyEnroll::find()->andWhere(["user_id" => $info["user_id"], "title_id" =>  $model->id])->all() as $userInfo):  ?>
                            <p style="font-size: 13px; color: #333;margin: 4px 0;" ><span style="display: inline-block;width: 160px"><?= $userInfo->study->name ?></span> <span style="margin-left: 20px;">&times;<?= $userInfo->num ?></span></p>
                        <?php endforeach;?>
                        
                        <p style='font-size: 13px;color: #666;margin: 4px 0;' ><?= $enrollInfo->name ?>/<?= $enrollInfo->mobile ?></p>
                        <p style='font-size: 13px;color: #666;' ><?= date("Y-m-d", $enrollInfo->created_at)?></p>
                    </div>
                </div>
            <?php endif; ?>
            <?php endforeach;?>
        </div>
    </div>
    <div class='invite-footer'>
        <a  style="width: 80px;background-color: #269f42;color: #fff;" data-action >更多操作</a>
        <span data-id="<?= $model->id ?>"></span>
        <a style='flex: 1;' href="<?= Url::to(["default/apply"])."?id=".$model["id"] ?>" style="width: 94px;background-color: #269f42;color: #fff;" >我要报名</a>
        <a style="width: 80px;background-color: #38b8ff;color: #fff;">分享</a>
    </div>
    <script>
        $(function(){
            $(document).on('click', '[data-action]', function(){
                var id = $(this).siblings('[data-id]').data('id');
                weui.actionSheet([
                    {
                        label: '修改设置',
                        onClick: function () {
                            window.location.href='<?= Url::to(["site/title-update"])?>?id='+id;
                            console.log('修改设置');
                        }
                    },
//                        {
//                        label: '报名启止',
//                        onClick: function () {
//                            console.log('报名启止');
//                        }
//                    },
                        {
                        label: '数据统计',
                        onClick: function () {
                            window.location.href='<?= Url::to(["default/colligate-count"])?>?id='+id;
                        }
                    },{
                        label: '发起者说',
                        onClick: function () {
                            window.location.href='<?= Url::to(["site/title-update"])?>?id='+id;
                            console.log('发起者说');
                        }
                    },{
                        label: '转发标记',
                        onClick: function () {
                            console.log('转发标记');
                        }
                    },{
                        label: '使用示例',
                        onClick: function () {
                            console.log('使用示例');
                        }
                    }
                ])
            })
        })
    </script>
</body>
</html>