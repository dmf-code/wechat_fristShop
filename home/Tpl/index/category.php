<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/2
 * Time: 15:53
 */

require_once ROOT_PATH . '/Home/Tpl/Public/Header.php';
    $cache = \Rice\Core\Core::get('Cache');
    $items = $cache->index;
?>
    <link rel="stylesheet" href="../../../Static/home/css/home.css">
<style>
    #category-header{font-size:3.5em;width:100%;height:4em;line-height:4em;text-align:center;background-image: url('../../../static/public/imgs/fruitBg.jpg');background-size: 100% 100%;}
</style>

    <div class="weui-flex">
        <div class="weui-flex__item">
            <div id="category-header">
                <span>新&nbsp;&nbsp;鲜&nbsp;&nbsp;水&nbsp;&nbsp;果</span>
            </div>
        </div>
    </div>
    <div id="category-content">
        <?php
            $cnt = 0;
            foreach($items as $k=>$v) {
                $cnt++;
        ?>
            <?php
                if($k%3==0)
                echo '<div class="weui-flex">';
                ?>
                        <div class="weui-flex__item">
                            <a href="/Home/CategoryList/Index?id=<?php echo $v['categoryid']; ?>">
                                <div class="placeholder mydiv">
                                    <img src="<?php echo $v['img']; ?>" alt="<?php echo $v['name']; ?>">
                                </div>
                                <p class="p-text"><?php echo $v['name']; ?></p>
                            </a>
                        </div>
            <?php
                if($cnt==3) {
                    echo '</div>';
                    $cnt=0;
                }
                ?>
        <?php
            }
            if($cnt!=0) {
                while (3-$cnt != 0) {
                    echo '<div class="weui-flex__item"></div>';
                    $cnt++;
                }
                echo '</div>';
            }
        ?>
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
<?php
require_once ROOT_PATH . '/Home/Tpl/Public/Footer.php';
?>