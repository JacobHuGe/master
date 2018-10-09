<?php
use yii\widgets\ActiveForm;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">

        <title>信息照片上传</title>

        <link rel="stylesheet" type="text/css" href="/css/base.css">
        <link rel="stylesheet" type="text/css" href="/css/home.css">
		
    </head>
    <body>
        <section class="aui-content">
            <div style="height:20px;"></div>
            <?php $form = ActiveForm::begin(['id' => 'upload',
                'enableAjaxValidation' => false,
                'options' => ['enctype' => 'multipart/form-data']]) ?>
            <div class="aui-content-up">
                    <div class="aui-form-group clear">
                        <label class="aui-label-control">
                            营业执照 <em>*</em>
                            <span>小于5M</span>
                        </label>
                        <div class="aui-form-input">
                            <div class="aui-content-img-box aui-content-full">
                                <div class="aui-photo aui-up-img clear">
                                    <section class="aui-file-up fl">
                                        <img src="/images/up.png" class="add-img">
                                        <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*', "id" => "file", "class" => "file"]) ?>
                                        <!--<input type="file" name="file" id="file" class="file" value="" accept="image/jpg,image/jpeg,image/png,image/bmp" multiple/>-->
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aui-form-group-text">
                        <h3>需要以下材料</h3>
                        <p>营业执照或组织机构代码等生产方《化妆品生产许可证》代生产合同或经销证明国产非特殊用途化妆品食药监查询截图进口化妆品，需提供国务院食药监行政部门备案登记即《进口（非）特殊用途化妆品备案凭证》</p>
                    </div>
            </div>
            <div class="weui-btn-area">
                <button class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">提交发布</button>
            </div>
            <?php ActiveForm::end() ?>
        </section>
        <!-- mask begin -->
        <div class="aui-mask aui-works-mask">
            <div class="aui-mask-content">
                <p class="aui-delete-text">确定要删除你上传的资料？</p>
                <p class="aui-check-text">
                    <span class="aui-delete aui-accept-ok">确定</span>
                    <span class="aui-accept-no">取消</span>
                </p>
            </div>
        </div>
        <!-- mask end -->
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/up.js"></script>
        <script type="text/javascript">
            

            //验证姓名
            function checkna(){

                na=form1.yourname.value;

                if( na.length <1 || na.length >6)

                {

                    divname.innerHTML='<font class="tips_false">长度是1~6个字符</font>';



                }else{

                    divname.innerHTML='<font class="tips_true">输入正确</font>';



                }



            }

            //验证手机号码
            function checkpsd1(){

                na=form1.youphone.value;

                if( na.length <11 || na.length >11)

                {

                    phone.innerHTML='<font class="tips_false">必须是11位的数字</font>';



                }else{

                    phone.innerHTML='<font class="tips_true">输入正确</font>';



                }



            }

            //验证社会统一代码
            function checkpsd2(){

                na=form1.youziz.value;

                if( na.length <18 || na.length >18)

                {

                    zizhi.innerHTML='<font class="tips_false">必须是18位社会信用代码</font>';



                }else{

                    zizhi.innerHTML='<font class="tips_true">输入正确</font>';



                }



            }



        
        </script>
    </body>
</html>
