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
    <div class="weui-navbar__item weui-bar__item_on">
        <a href='/html/index.html' class='invite-nav-btn' >我新建</a>
    </div>
    <div class="weui-navbar__item">
        <a href="/html/sponsor.html" class='invite-nav-btn' >我发起</a>
    </div>
    <div class="weui-navbar__item">
        <a href="/html/join.html" class='invite-nav-btn' >我参与</a>
    </div>
</div>

        <div class="weui-tab__panel">

            <form action="<?= Yii::$app->urlManager->createUrl(["site/index"])?>" method= "post">
                
                <div class="weui-cells__title">基础设置</div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">主题</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="name" placeholder="请输入主题"/>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <textarea class="weui-textarea" placeholder="简要描述" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-uploader">
                            <div class="weui-uploader__hd">
                                <p class="weui-uploader__title">附加图片</p>
                            </div>
                            <div class="weui-uploader__bd">
                                <div class="weui-uploader__input-box">
                                    <input id="uploaderInput" class="weui-uploader__input" type="file" accept="image/*" multiple />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui-cells__title">报名设置</div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell weui-cell_switch">
                        <div class="weui-cell__bd">配资金信息</div>
                        <div class="weui-cell__ft">
                            <input class="weui-switch" data-pickfunding type="checkbox"/>
                        </div>
                    </div>
                    <div class="weui-cell weui-cell_select weui-cell_select-after" data-type style='display: none;' >
                        <div class="weui-cell__hd">
                            <label for="" class="weui-label">币种</label>
                        </div>
                        <div class="weui-cell__bd">
                            <select class="weui-select" name="select1">
                                <option selected="" value="1">¥</option>
                                <option value="2">＄</option>
                                <option value="3">€</option>
                                <option value="4">￡</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div data-fundings >
                    <div data-fundingitem >
                        <div class="weui-cells__title">
                            报名项
                            <a class='invite-fundings-btn' data-fundingaction='delete' style="color: #ff2500;" >[ 删除 ]</a> 
                            <a class='invite-fundings-btn' data-fundingaction='add' >[ 添加 ]</a>
                        </div>
                        <div class="weui-cells weui-cells_form">
                            <div class="weui-cell">
                                <div class="weui-cell__hd"><label class="weui-label">项目名称</label></div>
                                <div class="weui-cell__bd">
                                    <input class="weui-input" placeholder="请输入项目名称"/>
                                </div>
                            </div>
                            <div class="weui-cell">
                                <div class="weui-cell__hd"><label class="weui-label">项目单价</label></div>
                                <div class="weui-cell__bd">
                                    <input class="weui-input" placeholder="请输入项目单价"/>
                                </div>
                            </div>
                            <div class="weui-cell">
                                <div class="weui-cell__hd"><label class="weui-label">数量限制</label></div>
                                <div class="weui-cell__bd">
                                    <input class="weui-input" placeholder="请输入数量限制"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui-cells__title">报名信息的登记规则</div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell weui-cell_switch">
                        <div class="weui-cell__bd">姓名昵称全显</div>
                        <div class="weui-cell__ft">
                            <input class="weui-switch" data-pickfunding type="checkbox"/>
                        </div>
                    </div>
                    <div class="weui-cell weui-cell_switch">
                        <div class="weui-cell__bd">联系方式半显</div>
                        <div class="weui-cell__ft">
                            <input class="weui-switch" data-pickfunding type="checkbox"/>
                        </div>
                    </div>
                    <div class="weui-cell weui-cell_switch">
                        <div class="weui-cell__bd">备注留言半显</div>
                        <div class="weui-cell__ft">
                            <input class="weui-switch" data-pickfunding type="checkbox"/>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label for="" class="weui-label">截止时间</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="date" value=""/>
                        </div>
                    </div>
                </div>
                <div class="weui-btn-area">
                    <input type="submit" class="weui-btn weui-btn_primary" id="submit" value ="提交发布"/>
                    <!--<submit class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">提交发布</submit>-->
                    <!--<button class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">提交发布</button>-->
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function(){
            $('[data-pickfunding]').change(function(e){
                $('[data-type]').css('display', e.target.checked ? 'flex' : 'none');
            })

            function _template(){
                var template = "<div data-fundingitem >" + "\n";
                template += '<div class="weui-cells__title">' + '\n';
                template += '报名项' + '\n';
                template += '<a class="invite-fundings-btn" data-fundingaction="delete" style="color: #ff2500;" >[ 删除 ]</a>' + '\n';
                template += '<a class="invite-fundings-btn" data-fundingaction="add" >[ 添加 ]</a>' + '\n';
                template += '</div>' + '\n';
                template += '<div class="weui-cells weui-cells_form">' + '\n';
                template += '<div class="weui-cell">' + '\n';
                template += '<div class="weui-cell__hd"><label class="weui-label">项目名称</label></div>' + '\n';
                template += '<div class="weui-cell__bd">' + '\n';
                template += '<input class="weui-input" placeholder="请输入项目名称"/>' + '\n';
                template += '</div> \n </div> \n';
                template += '<div class="weui-cell">' + '\n';
                template += '<div class="weui-cell__hd"><label class="weui-label">项目单价</label></div>' + '\n';
                template += '<div class="weui-cell__bd">' + '\n';
                template += '<input class="weui-input" placeholder="请输入项目单价"/>' + '\n';
                template += '</div> \n </div> \n';
                template += '<div class="weui-cell">' + '\n';
                template += '<div class="weui-cell__hd"><label class="weui-label">数量限制</label></div>' + '\n';
                template += '<div class="weui-cell__bd">' + '\n';
                template += '<input class="weui-input" placeholder="请输入数量限制"/>' + '\n';
                template += '</div> \n </div> \n </div> \n </div> \n';

                return $(template);
            }

            $(document).on('click', '[data-fundingaction]', function(){
                var action = $(this).data('fundingaction');
                var _index = $(this).parents('[data-fundingitem]').index();

                if(action === 'delete'){
                    if( $('[data-fundings]').find('[data-fundingitem]').length < 2){
                        $(this).parents('[data-fundingitem]').replaceWith(_template())
                    } else {
                        $(this).parents('[data-fundingitem]').remove();
                    }
                } else {
                    var _chil = $('[data-fundings]').find('[data-fundingitem]');
                    var _new = $('<div data-fundings></div>');
                    for( var i = 0; i < _chil.length; i++ ) {
                        _new.append(_chil[i]);
                        if( i === _index ){
                            _new.append(_template());
                        }
                    }

                    $('[data-fundings]').replaceWith(_new);
                }
            })
        })
    </script>
</body>
</html>
