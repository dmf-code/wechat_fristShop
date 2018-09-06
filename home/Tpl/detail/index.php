
<!-- 轮播图 -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php
            $imgs = explode(',',$good['imgUrl']);
            foreach($imgs as $k=>&$v) {
                ?>
                <div class="swiper-slide">
                    <img src="<?php echo $v; ?>" alt=""></div>
                <?php
            }
        ?>
    </div>
    <!-- 如果需要分页器 -->
    <div class="swiper-pagination"></div>
</div>

<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <span class="ui-yen ">
                <i class="price-symbol">¥</i>
                <span class="price"><?php echo $good['price'];?></span>
            </span>
            <span class="icon-text" data-spm-anchor-id="a222m.7628550/B.0.i5">
                卖家促销
            </span>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <span class="postage">满88包邮(10kg内)</span>
        </div>
        <span class="sales" data-spm-anchor-id="a222m.7628550/B.0.i7">月销量 10412件</span>
    </div>
</div>

<div class="weui-cells">
    <a style="color: #000000" href="javascript:;" class="open-popup" data-target="#half">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>产品参数</p>
        </div>
        <div class="weui-cell__ft"><img style="height: 2em;width: 2em;" src="../../../static/public/imgs/if_Three_dots_2202238.svg" alt=""></div>
    </div>
    </a>
</div>

<div class="weui-cells" style="bottom: 2em;"></div>


<div id="half" style="z-index:100000;" class="weui-popup__container popup-bottom">
    <div class="weui-popup__overlay"></div>
    <div class="weui-popup__modal" style="height: 40%;">
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>净含量</p>
                </div>
                <div class="weui-cell__ft"><?php echo $good['netWeight'];?>g</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>包装方式</p>
                </div>
                <div class="weui-cell__ft"><?php echo $good['packaging'];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>单果重量</p>
                </div>
                <div class="weui-cell__ft"><?php echo $good['singleFruitWeight'];?>g</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>品牌</p>
                </div>
                <div class="weui-cell__ft"><?php echo $good['brand'];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>产地</p>
                </div>
                <div class="weui-cell__ft"><?php echo $good['madeIn'];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>水果种类</p>
                </div>
                <div class="weui-cell__ft"><?php echo $good['fruitType'];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>厂名</p>
                </div>
                <div class="weui-cell__ft"><?php echo $good['factoryName'];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>厂址</p>
                </div>
                <div class="weui-cell__ft"><?php echo $good['factoryAddr'];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>厂家联系方式</p>
                </div>
                <div class="weui-cell__ft"><?php echo $good['factoryPhone'];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>保质期</p>
                </div>
                <div class="weui-cell__ft"><?php echo $good['qualityGuaranteePeriod'];?></div>
            </div>
        </div>
    </div>
</div>


