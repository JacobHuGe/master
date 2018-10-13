<?php

use yii\helpers\Url;
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
        <script type="text/javascript" src="../js/zepto.min.js" ></script>
        <script type="text/javascript" src="https://res.wx.qq.com/open/libs/weuijs/1.1.3/weui.min.js"></script>
        <title>index</title>
    </head>
    <body>
        <div class="weui-tab">
            <div class="weui-navbar">
                <div class="weui-navbar__item weui-bar__item_on">
                    <a href='<?= Url::to(["site/index"]) ?>' class='invite-nav-btn' >我新建</a>
                </div>
                <div class="weui-navbar__item">
                    <a href="<?= Url::to(["site/sponsor"]) ?>" class='invite-nav-btn' >我发起</a>
                </div>
                <div class="weui-navbar__item">
                    <a href="<?= Url::to(["site/join"]) ?>" class='invite-nav-btn' >我参与</a>
                </div>
            </div>

            <div class="weui-tab__panel">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                    <div class="weui-cells__title">基础设置</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <!--<div class="weui-cell__hd"><label class="weui-label">主题</label></div>-->
                            <div class="weui-cell__bd">
                                 <?= $form->field($model, 'name', ['inputOptions' => ['placeholder' => '请再次输入标题', 'class' => 'weui-input']])->textInput(['autofocus' => true])->label(false) ?>
                                <!--<input class="weui-input" placeholder="请再次输入标题"/>-->
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <?= $form->field($model, 'content', ['inputOptions' => ['placeholder' => '请在此简要描述',"rows" => 3,  'class' => 'weui-textarea']])->textarea(['autofocus' => true])->label(false) ?>
                                <!--<textarea class="weui-textarea" placeholder="请在此简要描述" rows="3"></textarea>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">图片上传</label>
                            <div class="col-lg-5">
                            <?=
                            $form->field($model, 'imageFile')->widget('manks\FileInput', [
                              'clientOptions' => [
                                'pick' => [
                                  'multiple' => true,
                                ],
                              ],
                            ])->label(false)
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">报名设置</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell weui-cell_switch">
                            <div class="weui-cell__bd">配资金信息：</div>
                            <div class="weui-cell__ft">
                                <input class="weui-switch" data-pickfunding type="checkbox"/>
                            </div>
                        </div>
                        <div class="weui-cell weui-cell_select weui-cell_select-after" data-type style='display: none;' >
                            <div class="weui-cell__hd">
                                <label for="" class="weui-label">币种</label>
                            </div>
                            <div class="weui-cell__bd">
                                <?php echo $form->field($model, 'currency', ["inputOptions" => ["class" => "weui-select" ]])->dropDownList(['1' => 'RMB ¥', '2' => 'USD ＄', '3' => 'EUR €', '4' => 'GBP ￡'], ["class" => 'weui-select'])->label(false); ?>
<!--                                <select class="weui-select" name="select1">
                                    <option selected="" value="1">RMB ¥</option>
                                    <option value="2">USD ＄</option>
                                    <option value="3">EUR €</option>
                                    <option value="4">GBP ￡</option>
                                </select>-->
                            </div>
                        </div>
                    </div>
                    <div data-fundings >
                        <div data-fundingitem >
                            <?php foreach ($studys as $study):?>
                            <div class="weui-cells__title">
                                报名项
                            </div>
                            <div class="weui-cells weui-cells_form">
                                
                                <div class="weui-cell">
                                    <div class="weui-cell__hd"><label class="weui-label">项目名称：</label></div>
                                    <div class="weui-cell__bd">
                                        <?= $form->field($study, 'name', ['inputOptions' => ['placeholder' => '请输入项目名称', 'class' => 'weui-input']])->textInput(['autofocus' => true])->label(false) ?>
                                        <!--<input class="weui-input" placeholder="请输入项目名称" value="<?= $study->name ?>" readonly="readonly"/>-->
                                    </div>
                                </div>
                                <div class="weui-cell">
                                    <div class="weui-cell__hd"><label class="weui-label">项目单价：</label></div>
                                    <div class="weui-cell__bd">
                                        <?= $form->field($study, 'price', ['inputOptions' => ['placeholder' => '请输入项目单价', 'class' => 'weui-input']])->textInput(['autofocus' => true])->label(false) ?>
                                        <!--<input class="weui-input" placeholder="请输入项目单价" value="<?= $study->price ?>" readonly="readonly"/>-->
                                    </div>
                                </div>
                                <div class="weui-cell">
                                    <div class="weui-cell__hd"><label class="weui-label">数量限制：</label></div>
                                    <div class="weui-cell__bd">
                                        <?=  $form->field($study, 'number', ['inputOptions' => ['placeholder' => '请输入数量限制', 'class' => 'weui-input']])->textInput(['autofocus' => true])->label(false) ?>
                                        <!--<input class="weui-input" placeholder="请输入数量限制" value="<?= $study->number ?>" readonly="readonly"/>-->
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="weui-cells__title">报名信息的登记规则</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell weui-cell_switch">
                            <div class="weui-cell__bd">姓名昵称全显：</div>
                            <div class="weui-cell__ft">
                                <?= $form->field($model, 'is_show_name')->checkboxList(['1' => '姓名昵称'],['itemOptions'=>['class'=>'weui-switch']]); ?>
                                
                                <!--<input class="weui-switch" data-pickfunding1 type="checkbox"/>-->
                            </div>
                        </div>
                        <div class="weui-cell weui-cell_switch">
                            <div class="weui-cell__bd">联系方式半显：</div>
                            <div class="weui-cell__ft">
                                <?= $form->field($model, 'is_show_phone')->checkboxList([ '1' => '联系方式'],['itemOptions'=>['class'=>'weui-switch']]) ?>
                                <!--<input class="weui-switch" data-pickfunding1 type="checkbox"/>-->
                            </div>
                        </div>
                        <div class="weui-cell weui-cell_switch">
                            <div class="weui-cell__bd">备注留言半显：</div>
                            <div class="weui-cell__ft">
                                <?= $form->field($model, 'is_show_leave')->checkboxList([ '1' => '备注留言'],['itemOptions'=>['class'=>'weui-switch']]) ?>
                                <!--<input class="weui-switch" data-pickfunding1 type="checkbox"/>-->
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label for="" class="weui-label">截 止 时 间：</label></div>
                            <div class="weui-cell__bd">
                                
                                <?= $form->field($model, 'end_at', ['inputOptions' => ['placeholder' => '不设则无自动截止（注:2018-01-01）', 'class' => 'weui-input']])->textInput(['autofocus' => true])->label(false) ?>

                                <!--<input class="weui-input" type="date" value=""/>-->
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <button class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">提交发布</button>
                    </div>
                 <?php ActiveForm::end() ?>
            </div>
        </div>
        <script>
            $(function () {
                $('[data-pickfunding]').change(function (e) {
                    $('[data-type]').css('display', e.target.checked ? 'flex' : 'none');
                })

                var blockNum = 10;
                $(document).on('click', '[data-fundingaction]', function () {
                    var action = $(this).data('fundingaction');
                    var _index = $(this).parents('[data-fundingitem]').index();
                    var parentDom = $('[data-fundings]'), oriDom = parentDom.children(":first");
                    if (action === 'delete') {
                        
                        var clLength = parentDom.children().length;
                        if (blockNum > clLength) {
                            var nowDom = oriDom.clone();
                            nowDom.children(":first").text('报名项');
                            parentDom.append(nowDom);
                        }
                        else
                            return false;
                        
//                        if ($('[data-fundings]').find('[data-fundingitem]').length < 2) {
//                            $(this).parents('[data-fundingitem]').replaceWith(_template())
//                        } else {
//                            $(this).parents('[data-fundingitem]').remove();
//                        }
                    } else {

                        var clLength = parentDom.children().length;
                        if (blockNum > clLength) {
                            var nowDom = oriDom.clone();
                            //$('[data-fundings]').replaceWith(_new);
                            nowDom.children(":first").text("报名项");
                            parentDom.append(nowDom);
                        }
                        else
                            return false;
                        
//                        var _chil = $('[data-fundings]').find('[data-fundingitem]');
//                        var _new = $('<div data-fundings></div>');
//                        for (var i = 0; i < _chil.length; i++) {
//                            _new.append(_chil[i]);
//                            if (i === _index) {
//                                _new.append(_template());
//                            }
//                        }
//
//                        $('[data-fundings]').replaceWith(_new);
                    }
                })
            })
        </script>
    </body>
</html>
