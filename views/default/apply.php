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
    <div class="invite-detail-title" style="font-size: 16px;border-bottom: 1px solid #e5e5e5;line-height: 40px;">额济纳/四姑娘山/嘉峪关户外活动召集令</div>
    <form action="<?= yii\helpers\Url::to(["site/join"])?>">
        <div class="weui-cells__title">报名项列表</div>
        <div class="weui-cells weui-cells_form">
            <div class='weui-cell' style='display: block;'>
                <p style="display: flex;justify-content: space-between;width: 100%;" >
                    <span>额济纳旗自驾</span>
                    <span style='color: #ff2500;' >￥480.00</span>
                </p>
                <div style="display: flex;justify-content: space-between;width: 100%;margin-top: 8px;align-items: center;"  >
                    <div style='font-size: 14px;color: #1b99e8;' >已报16 / 剩余<span data-max="4">4</span></div>
                    <div data-actions>
                        <a data-action='delete' style='display: inline-block;font-size: 24px;width: 32px;color: #ff2500;text-align: center;' >-</a>
                        <span data-val>0</span>
                        <a data-action='add' style='display: inline-block;font-size: 24px;width: 32px;color: #1b99e8;text-align: center;' >+</a>
                        <input value='0' type='hidden' />
                    </div>
                </div>
            </div>
            <div class='weui-cell' style='display: block;'>
                <p style="display: flex;justify-content: space-between;width: 100%;" >
                    <span>四姑娘山远足</span>
                    <span style='color: #ff2500;'>￥1,600.00</span>
                </p>
                <div style="display: flex;justify-content: space-between;width: 100%;margin-top: 8px;align-items: center;"  >
                    <div style='font-size: 14px;color: #1b99e8;' >已报12 / 剩余<span data-max="8">8</span></div>
                    <div data-actions>
                        <a data-action='delete' style='display: inline-block;font-size: 24px;width: 32px;color: #ff2500;text-align: center;' >-</a>
                        <span data-val>0</span>
                        <a data-action='add' style='display: inline-block;font-size: 24px;width: 32px;color: #1b99e8;text-align: center;' >+</a>
                        <input value='0' type='hidden' />
                    </div>
                </div>
            </div>
            <div class='weui-cell'>
                <p style="display: flex;justify-content: space-between;width: 100%;" >
                    <span>个人金额总计：</span>
                    <span style='color: #ff2500;'>￥2,600.00</span>
                </p>
            </div>
        </div>
        <div class="weui-cells__title">报名人信息</div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">姓名昵称</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" placeholder="请输入姓名昵称"/>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">联系方式</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" placeholder="请输入联系方式"/>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" placeholder="备注留言" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="weui-btn-area">
            <button class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">提交</button>
        </div>
    </form>
    <script>
        $(function(){
            $('[data-actions]').on('click', '[data-action]', function(){
                var action = $(this).data('action');
                var max = $(this).parent().siblings().find('[data-max]').data('max');
                var val = $(this).siblings('input').val();
                if( action === 'delete' && val == 0 ){
                    return false;
                }

                if( action === 'add' && val >= max ) {
                    return false;
                }
                val = action === 'add' ? parseInt(val) + 1 : parseInt(val) - 1;
                $(this).siblings('[data-val]').text(val);
                $(this).siblings('input').val(val);
            })
        })
    </script>
</body>
</html>