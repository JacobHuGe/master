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
        <script type="text/javascript" src="https://cdn.bootcss.com/zepto/1.2.0/zepto.min.js" ></script>
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
                    <a href='<?= yii\helpers\Url::to(["site/index"]) ?>' class='invite-nav-btn' >我新建</a>
                </div>
                <div class="weui-navbar__item">
                    <a href="<?= yii\helpers\Url::to(["site/sponsor"]) ?>" class='invite-nav-btn' >我发起</a>
                </div>
                <div class="weui-navbar__item weui-bar__item_on">
                    <a href="<?= yii\helpers\Url::to(["site/join"]) ?>" class='invite-nav-btn' >我参与</a>
                </div>
            </div>

            <div class="weui-tab__panel">
                <!--<div class="weui-cells__title">最近</div>-->
                <?php foreach($dataProvider->models as $model):?>
                <div class="weui-cells">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <p><a href='/html/detail.html' style="color: #333;"><?= $model->study->name ?></a></p>
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
                <?php endforeach; ?>
                <!--<div class="weui-cells__title">一周前的</div>-->
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
                <!--<div class="weui-cells__title">一个月前的</div>-->
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
            </div>
        </div>
        <script>
            $(function () {
                $(document).on('click', '[data-action]', function () {
                    weui.actionSheet([
                        {
                            label: '修改',
                            onClick: function () {
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
                            onClick: function () {
                                console.log('删除');
                            }
                        }
                    ])
                })
            })
        </script>
    </body>
</html>