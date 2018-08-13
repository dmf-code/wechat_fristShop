<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2017/12/20
 * Time: 15:28
 */

?>
<html>
<head>
        <title>微信商城后台</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../../static/public/css/sui.min.css">
        <link rel="stylesheet" href="../../../static/public/css/public.css">
        <script src="../../../static/public/js/jquery-3.2.1.min.js"></script>
        <script src="../../../static/public/js/sui.min.js"></script>
        <script src="../../../static/public/js/extend.js?time=<?php echo time(); ?>"></script>
</head>
<style>
        body{overflow-x: hidden;}
</style>

<body>
<div class="sui-row-fluid">
        <!-- header start -->
        <div class="sui-navbar">
                <div class="navbar-inner">
                        <div class="sui-container">
                                <a href="#" class="sui-brand">
                                        <i class="sui-icon icon-tb-shop"></i>
                                        微信商城后台
                                </a>
                        </div>
                </div>
        </div>
        <!-- header end -->
</div>

<div class="sui-row-fluid">

        <div class="span2 white">
                <ul class="sui-nav nav-list font-center font1-5">
                        <li><a href="admin">首页</a></li>
                        <li><a href="addHomeCarousel">商城首页轮播图</a></li>
                        <li><a href="operatingHomeCarousel">商城首页轮播图列表</a></li>
                        <li><a href="addHomeMoudle">商城首页模块</a></li>
                        <li><a href="operatingMoudleList">商城首页模块列表</a></li>
                        <li><a href="customMenu">微信自定义菜单</a></li>
                        <li><a href="addGoods">添加商品</a></li>
                        <li><a href="operatingGoodsList">商品列表</a></li>
                        <li><a href="addCategory">添加水果分类</a></li>
                        <li><a href="operatingCategoryList">水果分类列表</a></li>
                        <li><a href="operatingOrderList">订单列表</a></li>
                </ul>
        </div>

        <div class="span10 white">
                <div id="content">