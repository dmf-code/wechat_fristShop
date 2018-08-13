<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/12
 * Time: 17:25
 */

    require_once ROOT_PATH . '/home/tpl/public/header.php';
?>
<style>
    html,body{background-color: #55ce02;}
</style>
<div class="weui-flex">
    <div class="weui-flex__item" style="text-align: center;margin: 10% auto;">
        <img src="../../../static/public/imgs/avatar.jpg" alt="" style="border-radius: 0.5em;">
        <h3 style="margin: 12px 0;">欢迎来到DMF的微信商城</h3>
        <p>好消息，本商城的代码可以在github开源啦！</p>
    </div>
</div>

<div class="weui-footer weui-footer_fixed-bottom">
    <p class="weui-footer__text">Copyright © 2017-<?php echo date('Y');?> DMF</p>
</div>

<?php
    require_once ROOT_PATH.'/home/tpl/public/footer.php';
?>
