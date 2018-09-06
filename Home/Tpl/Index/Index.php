<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/3
 * Time: 15:42
 */
    $cache = \Rice\Core\Core::get('Cache');
    $carouseList = $cache->carouseList;
    $moudleList = $cache->moudleList;
?>

<!-- 搜索框 -->
<div class="weui-search-bar" id="searchBar">
    <form class="weui-search-bar__form">
        <div class="weui-search-bar__box">
            <i class="weui-icon-search"></i>
            <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required="">
            <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
        </div>
        <label class="weui-search-bar__label" id="searchText">
            <i class="weui-icon-search"></i>
            <span>搜索</span>
        </label>
    </form>
    <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
</div>
<!-- 轮播图 -->

<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php
            foreach($carouseList as $k=>$v) {
                ?>
                <div class="swiper-slide">
                    <a href="/home/detail/total?id=<?php echo $v['detailid'];?>">
                    <img style="width: 100%;height: 100%;" src="<?php echo $v['imgs'];?>" alt="">
                    </a>
                </div>
                <?php
            }
        ?>
    </div>
    <!-- 如果需要分页器 -->
    <div class="swiper-pagination"></div>
</div>

<?php
    foreach($moudleList as $k=>$v) {
        ?>
        <div class="weui-panel weui-panel_access">
            <div class="weui-panel__hd"><?php echo $v['name'];?></div>
            <div class="weui-panel__bd">

                <?php
                    $size = count($v['goods']);

                    for($i=0;$i<$size;$i+=2) {
                        ?>
                        <div class="weui-flex">

                            <div class="weui-flex__item">
                                <a href="/home/detail/total?id=<?php echo $v['goods'][$i]['id'];?>">
                                    <div class="placeholder mydiv">
                                        <img src="<?php echo explode(',',$v['goods'][$i]['imgUrl'])[0];?>" alt="">
                                    </div>
                                    <p class="p-text"><?php echo $v['goods'][$i]['name'];?></p>
                                </a>
                            </div>

                            <?php
                            if($size>=$i+2) {
                                ?>
                                <div class="weui-flex__item">
                                    <a href="/home/detail/total?id=<?php echo $v['goods'][$i+1]['id']; ?>">
                                        <div class="placeholder mydiv">
                                            <img src="<?php echo explode(',',$v['goods'][$i+1]['imgUrl'])[0]; ?>"
                                                 alt="">
                                        </div>
                                        <p class="p-text"><?php echo $v['goods'][$i+1]['name']; ?></p>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                        <?php
                    }
                ?>

            </div>
        </div>
        <?php
    }
?>


<div style="margin-bottom: 5.5em;"></div>
