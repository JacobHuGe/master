<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人中心</title>

	<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link href="../css/personal/style.css"  rel="stylesheet">
	
	<script src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/swiper-2.1.min.js"></script>
</head>
<body class="person">
	<div class="banner">
		<div class="banner-wrap">
			<img src="images/person1.jpg" alt="">
			<span>请叫我白富美</span>
		</div>
	</div>
	<div class="bg"></div>
	<div class="mid">		
			<div class="mid-top">
				<div class="mid-top-wrap">
				<span class="left"><a href="myorder.html"><img src="images/p_nav01.png" alt="">我的订单</a></span>
				<span class="right"><a href="myorder.html">查看全部订单<img src="images/p_nav02.png" alt=""></a></span>
				</div>
			</div>
			<div class="mid-main">				
				<div><a href="myorder.html"><img src="images/p_nav1.png" alt=""><span>待付款</span></a></div>
				<div><a href="myorder.html"><img src="images/p_nav2.png" alt=""><span>待发货</span></a></div>
				<div><a href="myorder.html"><img src="images/p_nav3.png" alt=""><span>待收货</span></a></div>
				<div><a href="myorder.html"><img src="images/p_nav4.png" alt=""><span>待评价</span></a></div>				
			</div>		
	</div>
	<div class="bg"></div>
	<div class="list">
		<ul>
			<li>
				<div><a href="p_collect.html"><img src="images/p_nav11.png" alt="" class="left"><span>个人收藏</span><img src="images/p_nav02.png" alt="" class="right"></a></div>
			</li>
			<li>
				<div><a href="rule.html"><img src="images/p_nav12.png" alt="" class="left"><span>拍卖规则</span><img src="images/p_nav02.png" alt="" class="right"></a></div>
			</li>
			<li>
				<div><a href="no_address.html"><img src="images/p_nav13.png" alt="" class="left"><span>收货地址</span><img src="images/p_nav02.png" alt="" class="right"></a></div>
			</li>
		</ul>
	</div>





        <footer>
            <div><a href="<?= yii\helpers\Url::to(["default/index"])?>"><img src="../image/default/index/home.png" alt=""><span class="now">首页</span></a></div>
            <?php if(!Yii::$app->user->isGuest):?>
            <div><a href="collect.html"><img src="../image/default/index/collection.png" alt=""> <span>创建</span></a></div>
            <?php endif; ?>
            <div><a href="<?= yii\helpers\Url::to(["personal/index"])?>"><img src="../image/default/index/personal.png" alt=""> <span>个人中心</span></a></div>
        </footer>
</body>
</html>