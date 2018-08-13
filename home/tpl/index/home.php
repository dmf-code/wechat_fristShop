<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2017/12/29
 * Time: 15:58
 */

    require_once ROOT_PATH . '/home/tpl/public/header.php';
?>
<link rel="stylesheet" href="../../../static/home/css/home.css">

<html>
    <body ontouchstart>
            <!-- 容器 -->
            <!--                    content-->
            <div class="weui-tab">
                <div class="weui-tab__bd">
                    <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
                        <?php require_once ROOT_PATH . '/home/tpl/index/tab1.php' ?>
                    </div>
                </div>

                <!--                底部tabbar-->
                <div class="weui-tabbar" style="position: fixed;">
                    <a href="home" class="weui-tabbar__item">
                        <div class="weui-tabbar__icon">
                            <img src="../../../static/public/imgs/if_Home_2202277.svg" alt="">
                        </div>
                        <p class="weui-tabbar__label">首页</p>
                    </a>
                    <a href="category" class="weui-tabbar__item">
                        <div class="weui-tabbar__icon">
                            <img src="../../../static/public/imgs/if_Document_2202270.svg" alt="">
                        </div>
                        <p class="weui-tabbar__label">分类</p>
                    </a>
                    <a href="person" class="weui-tabbar__item">
                        <div class="weui-tabbar__icon">
                            <img src="../../../static/public/imgs/if_Account_2202250.svg" alt="">
                        </div>
                        <p class="weui-tabbar__label">我的</p>
                    </a>
                </div>

            </div>
    </body>
</html>

<?php
    require_once ROOT_PATH.'/home/tpl/public/footer.php';
?>
<script src='../../../static/home/js/home.js'></script>