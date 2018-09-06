<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/3
 * Time: 15:42
 */

require_once ROOT_PATH . '/Home/Tpl/Public/Header.php';
    /*
     * 数据库信息
     */
    $cache = \Rice\Core\Core::get('Cache');
    $person = $cache->userinfo;

    $pendingPayment = $cache->pendingPayment;
    $pendingDelivery = $cache->pengingDelivery;

    $pendingDelivery2 = $cache->pengingDelivery2;

    $toBeEvaluated = $cache->toBeEvaluated;
?>
<link rel="stylesheet" href="../../../static/home/css/home.css">

<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__hd">
            <img style="height: 4em;width: 4em;border-radius:100%;" src="<?php echo $person['headimgurl']; ?>">
        </div>
        <div class="weui-cell__bd" style="text-align: center;">
            <p>用户名：<?php echo $person['nickname'];?></p>
            <p>会员：黄金会员</p>
            <p>积分：0</p>
        </div>
    </div>
</div>
<div class="weui-cells__title">我的订单
    <span style="float: right;">查看全部&gt;</span>
</div>
<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <a href="/order/order/pendingPayment">
                        <div class="area">
                            <?php
                                if(!empty($pendingPayment))
                                echo "<span class='weui-badge' style='position: absolute;'>$pendingPayment</span>";
                            ?>
                            <img src="../../../Static/public/imgs/if_2_-_Cash_Register_2102044.svg" alt="">
                        </div>

                        <p class="weui-tabbar__label">待付款</p>
                    </a>
                </div>
                <div class="weui-flex__item">
                    <a href="/order/order/pendingDelivery">
                        <div class="area">
                            <?php
                            if(!empty($pendingDelivery))
                                echo "<span class='weui-badge' style='position: absolute;'>$pendingDelivery</span>";
                            ?>
                            <img src="../../../Static/public/imgs/if_3_-_Shop_2102064.svg" alt="">
                        </div>
                        <p class="weui-tabbar__label">待发货</p>
                    </a>
                </div>
                <div class="weui-flex__item">
                    <a href="/order/order/pendingDelivery2">
                        <div class="area">
                            <?php
                            if(!empty($pendingDelivery2))
                                echo "<span class='weui-badge' style='position: absolute;'>$pendingDelivery2</span>";
                            ?>
                            <img src="../../../Static/public/imgs/if_23_-_Truck_2102059.svg" alt="">
                        </div>
                        <p class="weui-tabbar__label">待收货</p>
                    </a>
                </div>
                <div class="weui-flex__item">
                    <a href="/order/order/toBeEvaluated">
                        <div class="area">
                            <?php
                            if(!empty($toBeEvaluated))
                                echo "<span class='weui-badge' style='position: absolute;'>$toBeEvaluated</span>";
                            ?>
                            <img src="../../../Static/public/imgs/if_24_-_Comment_2102060.svg" alt="">
                        </div>
                        <p class="weui-tabbar__label">待评价</p>
                    </a>
                </div>
                <div class="weui-flex__item">
                    <a href="#">
                        <div class="area">
                            <img src="../../../Static/public/imgs/if_1_-_Customer_Service_2102045.svg" alt="">
                        </div>
                        <p class="weui-tabbar__label">退款/售后</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="weui-cells__title">个人信息</div>
<div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <div class="weui-panel weui-panel_access">
                <div class="weui-panel__bd">
                    <a href="/home/address/showAddress" class="weui-media-box weui-media-box_appmsg">
                        <div class="weui-media-box__hd">
                            <img class="weui-media-box__thumb" src="../../../static/public/imgs/address.jpg">
                        </div>
                        <div class="weui-media-box__bd">
                            <h4 class="weui-media-box__title">收货地址</h4>
                            <p class="weui-media-box__desc">收货地址管理</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="weui-cells__title">热门活动</div>
<div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <div class="weui-panel weui-panel_access">
                <div class="weui-panel__bd">
                    <a href="/order/buyNow/index" class="weui-media-box weui-media-box_appmsg">
                        <div class="weui-media-box__hd">
                            <img class="weui-media-box__thumb" src="../../../static/public/imgs/buynow.jpg">
                        </div>
                        <div class="weui-media-box__bd">
                            <h4 class="weui-media-box__title">水果秒杀</h4>
                            <p class="weui-media-box__desc">想要便宜的水果吗？赶快行动起来吧！动动手指，一起来秒杀吧！</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>

<div style="margin-bottom: 5.5em;height: 1em;"></div>


<!--                底部tabbar-->
<div class="weui-tabbar" style="position: fixed;">
    <a href="home" class="weui-tabbar__item">
        <div class="weui-tabbar__icon">
            <img src="../../../Static/public/imgs/if_Home_2202277.svg" alt="">
        </div>
        <p class="weui-tabbar__label">首页</p>
    </a>
    <a href="category" class="weui-tabbar__item">
        <div class="weui-tabbar__icon">
            <img src="../../../Static/public/imgs/if_Document_2202270.svg" alt="">
        </div>
        <p class="weui-tabbar__label">分类</p>
    </a>
    <a href="person" class="weui-tabbar__item">
        <div class="weui-tabbar__icon">
            <img src="../../../Static/public/imgs/if_Account_2202250.svg" alt="">
        </div>
        <p class="weui-tabbar__label">我的</p>
    </a>
</div>

