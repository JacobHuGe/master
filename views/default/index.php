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
    <div style="padding-bottom: 48px;" >
        <div class="invite-detail-title"> <?= $model->name?></div>
        <div class='invite-banner-content'>
            <img src='../images/pic_article.jpg' />
        </div>
        <div class="invite-detail-content">
            <p><?= $model->content?></p>
            <ul>
                <li><img src='../images/ban2.jpg' /></li>
                <li><img src='../images/ban2.jpg' /></li>
                <li><img src='../images/ban2.jpg' /></li>
                <li><img src='../images/ban2.jpg' /></li>
            </ul>
        </div>
        <div class="weui-cells__title">信息更新</div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>发布者的内容更新2……</p>
                    <p style="font-size: 13px; color: #666;" >2018-04-21</p>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>发布者的内容更新1……</p>
                    <p style="font-size: 13px; color: #666;" >2018-04-21</p>
                </div>
            </div>
        </div>
        <div class="weui-cells__title">报名动态：目前累计<span style='color: #ff2500;font-weight: 500;margin-left: 8px;' >42</span></div>
        <div class="weui-cells">
            <div class="weui-cell" style="align-items: flex-start;" >
                <div class="weui-cell__hd"><img src="/images/avatar.jpg" alt="" style="width:48px;margin-right:12px;display:block"></div>
                <div class="weui-cell__bd">
                    <p style="font-size: 13px; color: #333;margin: 4px 0;" ><span style="display: inline-block;width: 160px">四姑娘山远足</span> <span style="margin-left: 20px;">&times;1</span></p>
                    <p style='font-size: 13px;color: #666;margin: 4px 0;' >张三/…1234/——</p>
                    <p style='font-size: 13px;color: #666;' >2018/04/20/</p>
                </div>
            </div>
            <div class="weui-cell" style="align-items: flex-start;" >
                <div class="weui-cell__hd"><img src="/images/avatar.jpg" alt="" style="width:48px;margin-right:12px;display:block"></div>
                <div class="weui-cell__bd">
                    <p style="font-size: 13px; color: #333;margin: 4px 0;" ><span style="display: inline-block;width: 160px">四姑娘山远足</span> <span style="margin-left: 20px;">&times;1</span></p>
                    <p style="font-size: 13px; color: #333;margin: 4px 0;" ><span style="display: inline-block;width: 160px">嘉峪关-敦煌自驾</span> <span style="margin-left: 20px;">&times;2</span></p>
                    <p style='font-size: 13px;color: #666;margin: 4px 0;' >张三/…1234/——</p>
                    <p style='font-size: 13px;color: #666;' >2018/04/20/</p>
                </div>
            </div>
            <div class="weui-cell" style="align-items: flex-start;" >
                <div class="weui-cell__hd"><img src="/images/avatar.jpg" alt="" style="width:48px;margin-right:12px;display:block"></div>
                <div class="weui-cell__bd">
                    <p style="font-size: 13px; color: #333;margin: 4px 0;" ><span style="display: inline-block;width: 160px">四姑娘山远足</span> <span style="margin-left: 20px;">&times;1</span></p>
                    <p style='font-size: 13px;color: #666;margin: 4px 0;' >张三/…1234/——</p>
                    <p style='font-size: 13px;color: #666;' >2018/04/20/</p>
                </div>
            </div>
        </div>
    </div>
    <div class='invite-footer'>
        <a  style="width: 150px;background-color: #269f42;color: #fff;" data-action >更多操作</a>
        <a style='flex: 1;' href="<?= yii\helpers\Url::to(["default/apply"])."?id=".$model["id"] ?>" style="width: 94px;background-color: #269f42;color: #fff;" >我要报名</a>
        <a style="width: 150px;background-color: #38b8ff;color: #fff;">分享</a>
    </div>
    <script>
        $(function(){
            $(document).on('click', '[data-action]', function(){
                weui.actionSheet([
                    {
                        label: '修改设置',
                        onClick: function () {
                            console.log('修改设置');
                        }
                    },{
                        label: '报名启止',
                        onClick: function () {
                            console.log('报名启止');
                        }
                    },{
                        label: '数据统计',
                        onClick: function () {
                            window.location.href='<?= yii\helpers\Url::to(["default/count"])?>'
                        }
                    },{
                        label: '发起者说',
                        onClick: function () {
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