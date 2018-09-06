<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/13
 * Time: 21:52
 */
    require_once ROOT_PATH . '/order/Tpl/public/header.php';
    global $dcache;
    $tpl_goods = $dcache->getVal('goods');

//    $tpl_goods_detail = $dcache->getVal('goodsDetail');
    $tpl_goods_buynow = $dcache->getVal('buynow');
?>
<style>
    body,html{margin: 0;padding: 0;}
    body {background-color: #fff74f;}
    .d-body p{text-align: center;}
    .d-header {font-size: 2.5em;margin: 0.5em auto;text-align: center;}
    .d-header p {width:100%;}
    .d-content {width:100%;margin: 1em 0;display: inline-flex;}
    .d-left {flex:1;padding: 0.5em;}
    .d-left img{width: 100%;height: 12em;background-size: 100% 100%;}
    .d-right {flex:2;padding: 1em;}
    .d-right p {padding: 0.5em 0;}
    .d-detail {width:100%;margin: 1.5em 0;display: block;}
    .d-detail p {font-size: 1.5em;border-bottom: 1px solid #b1b1b1;}

    .d-lists {list-style: none;width: 100%;margin: 1.4em 0;}
    .d-lists li{width: 90%;margin: 0 auto;}
    .d-lists li img{width: 100%;background-size: 100% 100%;padding: 0;}
</style>

    <header class="d-header weui-flex">
        <p>水果秒杀</p>
    </header>
    <div class="page__bd">

        <div class="weui-flex">
            <div class="weui-flex__item d-content">
                <div class="d-left">
                    <img src="<?php echo $tpl_goods['imgUrl'];?>" alt="秒杀">
                </div>
                <div class="d-right">
                    <p>秒杀价：<?php echo $tpl_goods['price']; ?> RMB</p>
                    <p>原价：<?php echo $tpl_goods['price']; ?> RMB</p>
                    <p>数量：<?php echo $tpl_goods_buynow['num'] ?>（每人只能抢一个）</p>
                    <p>活动时间：<?php echo $tpl_goods_buynow['starttime'].
                            ' -- '. $tpl_goods_buynow['endtime'];?></p>
                </div>
            </div>
        </div>
        <div class="weui-flex">
            <div class="weui-flex__item">
                <a href="/fruitShop/index.php/order/buyNow/buynow" class="weui-btn weui-btn_primary">抢购</a>
            </div>
        </div>
    </div>
    <div class="weui-flex d-detail">
        <p>商品介绍</p>
        <ul class="d-lists">
            <?php

                $lists = explode(',',$tpl_goods['introductionImgs']);
                //var_dump($lists);
                foreach($lists as $k=>$v){
                    echo '<li><img src='.$v.' alt=""></li>';
                }
            ?>
        </ul>
    </div>

<div class="weui-footer weui-footer_fixed-bottom">
    <p class="weui-footer__text">Copyright © 2017-<?php echo date('Y');?> Design By DMF</p>
</div>

<?php
    require_once ROOT_PATH . '/order/Tpl/public/footer.php';
?>
