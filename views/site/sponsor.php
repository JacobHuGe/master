<?php
use app\models\Title;
use yii\helpers\Url;
use yii\widgets\LinkPager;

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
        <div class="weui-tab">
            <div class="weui-navbar">
                <div class="weui-navbar__item">
                    <a href='<?= Url::to(["site/index"]) ?>' class='invite-nav-btn' >我新建</a>
                </div>
                <div class="weui-navbar__item weui-bar__item_on">
                    <a href="<?= Url::to(["site/sponsor"]) ?>" class='invite-nav-btn' >我发起</a>
                </div>
                <div class="weui-navbar__item">
                    <a href="<?= Url::to(["site/join"]) ?>" class='invite-nav-btn' >我参与</a>
                </div>
            </div>

            <div class="weui-tab__panel">
                <!--<div class="weui-cells__title">最近</div>-->
                <?php foreach ($dataProvider as $model): ?>
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p><a href="<?= Url::to(["default/index"]) ?>?title=<?= $model->id ?>"><?= mb_substr(Yii::t("app", $model->name), 0, 15, "utf-8") . "..." ?></a> </p>
                                <p class='invite-cell-light'>
                                    <span style='display: inline-block;width: 50%'>发布：<?= Date("Y-m-d", $model->created_at) ?></span>
                                    <span style='display: inline-block;margin-left: 24px;' >累计：28</span>
                                </p>
                                <p style='font-size: 14px;' >
                                    
                                    <?php if ($model->enroll_state == Title::ENROLL_STATE_COMDUCT): ?>
                                        <span style='display: inline-block;width: 50%;color: #6CE26C;' >[  报名进行中 ]</span>
                                    <?php elseif ($model->enroll_state == Title::ENROLL_STATE_STOP) : ?>
                                        <span style='display: inline-block;width: 50%;color: #ff2500;' >[ 报名已中止 ]</span>
                                    <?php else : ?>
                                        
                                        <span style='display: inline-block;width: 50%;color: #ff2500;' >[ 报名已删除 ]</span>
                                    <?php endif; ?>

                                    <a data-action style='display: inline-block;margin-left: 24px;color: #1b99e8;'>[ 更多操作 ]</a>
                                    <span data-id="<?= $model->id ?>"></span>
                                    <!--<span class="data-id" value="" data-id=""></span>-->
                                </p>
                            </div>
                        </div>
                    </div>
                    
                <?php endforeach; ?>
                <?php
                echo LinkPager::widget([
                    'pagination' => $pages,
                    'nextPageLabel' => '下一页', 
                    'prevPageLabel' => '上一页', 
                    'maxButtonCount' => 5,
                    'options' => ['class' => 'm-pagination']
                ])
                ?>
                <!--                <div class="weui-cells">
                                    <div class="weui-cell">
                                        <div class="weui-cell__bd">
                                            <p>标题文字...</p>
                                            <p class='invite-cell-light'>
                                                <span style='display: inline-block;width: 50%'>发布：2018-04-12</span>
                                                <span style='display: inline-block;margin-left: 24px;' >累计：28</span>    
                                            </p>
                                            <p style='font-size: 14px;' >
                                                <span style='display: inline-block;width: 50%;color: #6CE26C;' >[ 报名进行中 ]</span>
                                                <a data-action style='display: inline-block;margin-left: 24px;color: #1b99e8;'>[ 更多操作 ]</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="weui-cells__title">一周前的</div>
                                <div class="weui-cells">
                                    <div class="weui-cell">
                                        <div class="weui-cell__bd">
                                            <p>标题文字...</p>
                                            <p class='invite-cell-light'>
                                                <span style='display: inline-block;width: 50%'>发布：2018-04-12</span>
                                                <span style='display: inline-block;margin-left: 24px;' >累计：28</span>    
                                            </p>
                                            <p style='font-size: 14px;' >
                                                <span style='display: inline-block;width: 50%;color: #ff2500;' >[ 报名已中止 ]</span>
                                                <a data-action style='display: inline-block;margin-left: 24px;color: #1b99e8;'>[ 更多操作 ]</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="weui-cells__title">一个月前的</div>
                                <div class="weui-cells">
                                    <div class="weui-cell">
                                        <div class="weui-cell__bd">
                                            <p>标题文字...</p>
                                            <p class='invite-cell-light'>
                                                <span style='display: inline-block;width: 50%'>发布：2018-04-12</span>
                                                <span style='display: inline-block;margin-left: 24px;' >累计：28</span>    
                                            </p>
                                            <p style='font-size: 14px;' >
                                                <span style='display: inline-block;width: 50%;color: #ff2500;' >[ 报名已中止 ]</span>
                                                <a data-action style='display: inline-block;margin-left: 24px;color: #1b99e8;'>[ 更多操作 ]</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>-->
            </div>
        </div>
        <script>
            $(function () {
                $(document).on('click', '[data-action]', function () {
                    var id = $(this).siblings('[data-id]').data('id');
                    weui.actionSheet([
                        {
                            label: '修改',
                            onClick: function () {
                                window.location.href='<?= Url::to(["site/title-update"]) ?>?id='+id;
                                console.log('修改');
                            }
                        }, {
                            label: '复制',
                            onClick: function () {
                                console.log('复制');
                            }
                        }, {
                            label: '分享',
                            onClick: function () {
                                console.log('分享');
                            }
                        }, {
                            
                            label: '删除',
                            onClick: function (
                                    ) {
                                window.location.href='<?= Url::to(["site/title-delete"]) ?>?id='+id;
                                //console.log('删除');
                            }
                        }
                    ])
                })
            })
        </script>
    </body>
</html>