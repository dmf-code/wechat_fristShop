<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/3
 * Time: 17:02
 */
    require_once ROOT_PATH . '/Home/Tpl/Public/Header.php';
    $cache = \Rice\Core\Core::get('Cache');
    $good = $cache->good;
    $comments = $cache->comments;
?>
<link rel="stylesheet" href="../../../static/home/css/detail.css">

<!-- 容器 -->
<div class="weui-tab">
    <div class="weui-navbar">
        <a class="weui-navbar__item weui-bar__item--on" href="#tab1">
            基本信息
        </a>
        <a class="weui-navbar__item" href="#tab2">
            商品详情
        </a>
        <a class="weui-navbar__item" href="#tab3">
            评价
        </a>
    </div>

    <div class="weui-tab__bd">
        <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
            <?php require_once ROOT_PATH . '/Home/Tpl/Detail/Index.php';?>
            <div style="margin-bottom: 2em;"></div>
        </div>
        <div id="tab2" class="weui-tab__bd-item">
            <?php require_once ROOT_PATH . '/Home/Tpl/Detail/Detail.php';?>
            <div style="margin-bottom: 2em;"></div>
        </div>
        <div id="tab3" class="weui-tab__bd-item">
            <?php require_once ROOT_PATH . '/Home/Tpl/Detail/Comments.php';?>
            <div style="margin-bottom: 2em;"></div>
        </div>
    </div>

    <div class="weui-tabbar" style="height: 2em;">
        <div class="weui-tabbar__item">
            <a href="javascript:;" class="weui-btn weui-btn_primary" style="border-radius: 0;">加入购物车</a>
        </div>
        <div class="weui-tabbar__item">
            <a href="/order/order/detailGoods?goodid=<?php echo $good['id']; ?>" class="weui-btn weui-btn_warn" style="border-radius: 0;">立即购买</a>
        </div>
    </div>

</div>

<?php require_once ROOT_PATH . '/home/Tpl/Public/Footer.php';?>
<script src='../../../Static/home/js/detail.js'></script>