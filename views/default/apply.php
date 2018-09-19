<?php

use yii\widgets\ActiveForm;
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
    <div class="invite-detail-title" style="font-size: 16px;border-bottom: 1px solid #e5e5e5;line-height: 40px;"><?= $title->name ?> </div>
    <!--<form action="<?php // yii\helpers\Url::to(["default/apply"])?>" method="post">-->
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
        <div class="weui-cells__title">报名项列表</div>
        
        <div class="weui-cells weui-cells_form">
            <?php foreach($dataProvider->models as $model): ?>
            <div class='weui-cell' style='display: block;'>
                <p style="display: flex;justify-content: space-between;width: 100%;" >
                    <span><?= $model->name ?></span>
                    <span style='color: #ff2500;' data-price="<?= $model->price ?>">￥<?= number_format($model->price,2) ?></span>
                </p>
                <?= $form->field($apply, 'title_id')->hiddenInput(["value" => $title->id])->label(false) ?>
                <div style="display: flex;justify-content: space-between;width: 100%;margin-top: 8px;align-items: center;"  >
                    
                    <div style='font-size: 14px;color: #1b99e8;' >已报 <?= $title->enrollNum($title->id, $model->id) ?> / 剩余<span data-max="<?= $title->surplusNum($title->id, $model->id) ?>"><?= $title->surplusNum($title->id, $model->id) ?></span></div>
                    <div data-actions>
                        <a data-action='delete' style='display: inline-block;font-size: 24px;width: 32px;color: #ff2500;text-align: center;' >-</a>
                        <span data-val>0</span>
                        <a data-action='add' style='display: inline-block;font-size: 24px;width: 32px;color: #1b99e8;text-align: center;' >+</a>
                        <?= $form->field($apply, 'study_id[]')->hiddenInput(['value'=> $model->id])->label(false) ?>
                        <?= $form->field($apply, 'num[]')->hiddenInput(['value'=> 0, "id" => $model->id])->label(false) ?>
                        <input value='0' type='hidden' />
                        <span data-id="<?= $model->id ?>"></span>
                    </div>
                </div>
            </div>
            
            <?php endforeach; ?>
            <div class='weui-cell'>
                <p style="display: flex;justify-content: space-between;width: 100%;" >
                    <span>个人金额总计：</span>
                    <span style='color: #ff2500;'>￥ <span data-price-val>0</span></span>
                </p>
            </div>
        </div>
        <div class="weui-cells__title">报名人信息</div>
        <div class="weui-cells weui-cells_form">
            <?php if($title->is_show_name == 1): ?>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">姓名昵称</label></div>
                <div class="weui-cell__bd">
                    <?= $form->field($apply, 'name', ['inputOptions' => ['placeholder' => '请输入姓名昵称', 'class' => 'weui-input']])->textInput(['autofocus' => true])->label(false) ?>
                    <!--<input class="weui-input" placeholder="请输入姓名昵称"/>-->
                </div>
            </div>
            <?php endif; ?>
            <?php if($title->is_show_phone == 1): ?>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">联系方式</label></div>
                <div class="weui-cell__bd">
                    <?= $form->field($apply, 'mobile', ['inputOptions' => ['placeholder' => '请输入联系方式', 'class' => 'weui-input']])->textInput(['autofocus' => true])->label(false) ?>
                    <!--<input class="weui-input" placeholder="请输入联系方式"/>-->
                </div>
            </div>
            <?php endif; ?>
            <?php if($title->is_show_leave == 1): ?>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <?= $form->field($apply, 'remarks', ['inputOptions' => ['placeholder' => '备注留言',"rows" => 3,  'class' => 'weui-textarea']])->textarea(['autofocus' => true])->label(false) ?>
                    <!--<textarea class="weui-textarea" placeholder="备注留言" rows="3"></textarea>-->
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="weui-btn-area">
            <button class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">提交</button>
        </div>
    <?php ActiveForm::end() ?>
    <!--</form>-->
    <script>
        $(function(){
            $('[data-actions]').on('click', '[data-action]', function(){
                var action = $(this).data('action');
                var max = $(this).parent().siblings().find('[data-max]').data('max');
                var price = $(this).parent().parent().siblings().find('[data-price]').data('price');
		var id = $(this).siblings('[data-id]').data('id');
                var totalprice = $('[data-price-val]').text();
                var val = $(this).siblings('input').val();
                
                if( action === 'delete' && val == 0 ){
                    return false;
                }

                if( action === 'add' && val >= max ) {
                    return false;
                }
                
                val = action === 'add' ? parseInt(val) + 1 : parseInt(val) - 1;
                totalprice = action === 'add' ? parseFloat(price) + parseFloat(totalprice) : parseFloat(totalprice) - parseFloat(price);

                $(this).siblings('[data-val]').text(val);
                $('[data-price-val]').text(totalprice);
                //$(this).siblings('[data-price-val]').text(val);
                
                $("#num").val(val);
                $(this).siblings('input').val(val);
            })
        })
    </script>
</body>
</html>