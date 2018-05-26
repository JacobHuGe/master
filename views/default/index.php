<?php
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>日安</title>

        <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link href="../css/default/index/swiper-3.3.1.min.css"  rel="stylesheet">
        <link href="../css/default/index/style.css"  rel="stylesheet">

        <script src="../js/default/index/jquery.js"></script>
        <script type="text/javascript" src="../js/default/index/swiper-2.1.min.js"></script>

    </head>


    <body id="index">
        <!-- 焦点图 -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><a href="special_all.html"><img src="../image/default/index/1.jpg" alt=""></a></div>
                <div class="swiper-slide"><a href="special_all.html"><img src="../image/default/index/scroll1.jpg" alt=""></a></div>
                <div class="swiper-slide"><a href="special_all.html"><img src="../image/default/index/1.jpg" alt=""></a></div>
            </div>

            <!--  焦点图按钮 -->
            <div class="pagination">             
                <span class="swiper-pagination-switch"></span>
                <span class="swiper-pagination-switch"></span>
                <span class="swiper-pagination-switch"></span>
                <span class="swiper-pagination-switch swiper-visible-switch swiper-active-switch"></span>
                <span class="swiper-pagination-switch"></span>
                <span class="swiper-pagination-switch"></span>
            </div>
        </div>
        <?php if(!Yii::$app->user->isGuest):?>
        <!-- 导航 -->
        <nav class="flex">

            <div class="nav1">
                <a href="">
                    <div class="nav1_img"><img src="../image/default/index/nav1.png" alt=""></div>
                    <p>专场拍卖</p>
                </a>
            </div>

            <div class="nav2">
                <a href="news.html">
                    <div class="nav2_img"><img src="../image/default/index/nav2.png" alt=""></div>
                    <p>资讯</p>
                </a>
            </div>

            <div class="nav3">
                <a href="activity.html">
                    <div class="nav3_img"><img src="../image/default/index/nav3.png" alt=""></div>
                    <p>线下</p>
                </a>
            </div>

        </nav>
        <?php endif; ?>
        <!-- 内容 -->
        <!-- 1 -->
        <a href="special_all.html" class="single"> 
            <div class="left">
                <img src="../image/default/index/2.jpg" alt="">
            </div>
            <div class="right">
                <h1>昌化石专场</h1>
                <p>开拍时间:<span>2016/7/2 19:30</span></p>
                <p>结束时间:<span>2016/7/14 22:00</span></p>
                <div class="end_wrap wrap">
                    <div><p>竞拍结束</p></div>
                    <div><p>围观 4045</p></div>
                    <div><p>出价 98</p></div>
                </div>
            </div>
        </a>
        <!-- 2 -->
        <a href="special_all.html" class="single">
            <div class="right">
                <h1>古今可用专场</h1>
                <p>开拍时间:<span>2016/7/9 9:00</span></p>
                <p>结束时间:<span>2016/7/30 19:30</span></p>
                <div class="end_wrap wrap">
                    <div><p>竞拍结束</p></div>
                    <div><p>围观 13024</p></div>
                    <div><p>出价 98</p></div>
                </div>
            </div>
            <div class="left">
                <img src="../image/default/index/3.jpg" alt="">
            </div>
        </a>
        <!-- 3 -->
        <a href="special_all.html" class="single">
            <div class="left">
                <img src="../image/default/index/4.jpg" alt="">
            </div>
            <div class="right">
                <h1>书画专场</h1>
                <p>开拍时间:<span>2016/7/28 19:30</span></p>
                <p>结束时间:<span>2016/8/14 22:00</span></p>
                <div class="begin_wrap wrap">
                    <div><p>竞拍开始</p></div>
                    <div><p>围观 41</p></div>
                    <div><p>出价 98</p></div>
                </div>
            </div>
        </a>
        <!-- 4 -->
        <a href="special_all.html" class="single">
            <div class="right">
                <h1>印石专场</h1>
                <p>开拍时间:<span>2016/7/26 19:30</span></p>
                <p>结束时间:<span>2016/8/14 22:00</span></p>
                <div class="end_wrap wrap">
                    <div><p>竞拍结束</p></div>
                    <div><p>围观 4045</p></div>
                    <div><p>出价 98</p></div>
                </div>
            </div>
            <div class="left">
                <img src="../image/default/index/5.jpg" alt="">
            </div>
        </a>
        <!-- 5 -->
        <a href="special_all.html" class="single">
            <div class="left">
                <img src="../image/default/index/6.jpg" alt="">
            </div>
            <div class="right">
                <h1>海外回流文玩品专场</h1>
                <p>开拍时间:<span>2016/7/24 19:30</span></p>
                <p>结束时间:<span>2016/8/14 22:00</span></p>
                <div class="begin_wrap wrap">
                    <div><p>竞拍开始</p></div>
                    <div><p>围观 41</p></div>
                    <div><p>出价 98</p></div>
                </div>
            </div>
        </a>
        <!-- 6 -->
        <a href="special_all.html" class="single">
            <div class="right">
                <h1>当代书画专场</h1>
                <p>开拍时间:<span>2016/7/2 19:30</span></p>
                <p>结束时间:<span>2016/7/14 22:00</span></p>
                <div class="end_wrap wrap">
                    <div><p>竞拍结束</p></div>
                    <div><p>围观 4045</p></div>
                    <div><p>出价 98</p></div>
                </div>
            </div>
            <div class="left">
                <img src="../image/default/index/7.jpg" alt="">
            </div>
            <</a>
        <!-- 7 -->
        <a href="special_all.html" class="single">
            <div class="left">
                <img src="../image/default/index/8.jpg" alt="">
            </div>
            <div class="right">

                <h1>吴山在线玉雕专场</h1>
                <p>开拍时间:<span>2016/7/24 19:30</span></p>
                <p>结束时间:<span>2016/8/14 22:00</span></p>
                <div class="end_wrap wrap">
                    <div><p>竞拍开始</p></div>
                    <div><p>围观 41</p></div>
                    <div><p>出价 98</p></div>
                </div>

            </div>
        </a>
        <!-- 8 -->
        <a href="special_all.html" class="single">
            <div class="right">
                <h1>当代寿山石雕刻大师精品专场</h1>
                <p>开拍时间:<span>2016/7/2 19:30</span></p>
                <p>结束时间:<span>2016/7/14 22:00</span></p>
                <div class="begin_wrap wrap">
                    <div><p>竞拍结束</p></div>
                    <div><p>围观 4045</p></div>
                    <div><p>出价 98</p></div>
                </div>
            </div>
            <div class="left">
                <img src="../image/default/index/9.jpg" alt="">
            </div>
        </a>
        <!-- 9 -->
        <a href="special_all.html" class="single">
            <div class="left">
                <img src="../image/default/index/10.jpg" alt="">
            </div>
            <div class="right">
                <h1>中青年实力派艺师紫砂专场</h1>
                <p>开拍时间:<span>2016/7/2 19:30</span></p>
                <p>结束时间:<span>2016/7/14 22:00</span></p>
                <div class="begin_wrap wrap">
                    <div><p>竞拍开始</p></div>
                    <div><p>围观 6311</p></div>
                    <div><p>出价 98</p></div>
                </div>
            </div>
        </a>
        <!-- 10 -->
        <a href="special_all.html" class="single">
            <div class="right">
                <h1>珠宝专场</h1>
                <p>开拍时间:<span>2016/7/2 19:30</span></p>
                <p>结束时间:<span>2016/7/14 22:00</span></p>
                <div class="begin_wrap wrap">
                    <div><p>竞拍结束</p></div>
                    <div><p>围观 4045</p></div>
                    <div><p>出价 98</p></div>
                </div>
            </div>
            <div class="left">
                <img src="../image/default/index/11.jpg" alt="">
            </div>
        </a>



        <footer>
            <div><a href="<?= yii\helpers\Url::to(["default/index"])?>"><img src="../image/default/index/home.png" alt=""><span class="now">首页</span></a></div>
            <?php if(!Yii::$app->user->isGuest):?>
            <div><a href="collect.html"><img src="../image/default/index/collection.png" alt=""> <span>创建</span></a></div>
            <?php endif; ?>
            <div><a href="<?= yii\helpers\Url::to(["personal/index"])?>"><img src="../image/default/index/personal.png" alt=""> <span>个人中心</span></a></div>
        </footer>

        <!-- js -->
        <script>
            $(document).ready(function (e) {            //初始化焦点图

                var mySwiper = new Swiper('.swiper-container', {
                    pagination: '.pagination',
                    loop: true,
                    autoplay: 2000,
                    paginationClickable: true,
                    onSlideChangeStart: function () {
                        //回调函数
                    }
                });

            });
        </script>  

    </body>
</html>