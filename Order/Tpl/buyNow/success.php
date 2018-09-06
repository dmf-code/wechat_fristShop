<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/18
 * Time: 12:48
 */
    require_once 'order/tpl/public/header.php';
    global $dcache;
    $tpl_goods = $dcache->getVal('goods');
?>
<style>
    .d-content {width: 100%;height:100%;background-color: #d8af14;}
    .d-content p {margin 1em 0;width:100%;font-size: 3em;text-align: center;color: #4869d8;}
    .d-content div {width: 100%;height: 50%;margin: 2em auto;text-align: center;}
    .d-content div img {width: 80%;height: 100%;background-size: 100% 100%;border-radius: 2em;}
</style>

    <div class="d-content">
        <p>恭喜您，秒杀成功！</p>
        <div>

            <img src="<?php echo explode(',',$tpl_goods['imgUrl'])[0]?>" alt="">
        </div>
        <a class="weui-btn weui-btn_primary weui-footer_fixed-bottom" href="/fruitShop/index.php/home/index/home">返回商城首页</a>
    </div>

<?php
    require_once 'order/tpl/public/footer.php';
?>
