<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/11
 * Time: 22:39
 */
    require_once ROOT_PATH . '/home/Tpl/Public/Header.php';
    $cache = \Rice\Core\Core::get('Cache');
    $infos = $cache->info;
?>
<link rel="stylesheet" href="../../../static/home/css/categoryList.css">
<div class="weui-panel weui-panel_access">
    <div class="weui-panel__hd">
        <ul class="weui-flex d-tags">
                <li class="weui-flex__item">
                    <span>综合</span>
                </li>
                <li class="weui-flex__item">
                    <span>销量</span>
                </li>
                <li class="weui-flex__item">
                    <span>价格<i class="triangle-up"></i></span>
                </li>
        </ul>
    </div>
</div>

<div class="weui-cells">
    <?php
        if(empty($infos))
            echo '<h1>暂无该分类商品。</h1>';
        foreach($infos as $k=>$v) {
            ?>

            <a class="weui-cell weui-cell_access" href="/home/detail/total?id=<?php echo $v['id']; ?>">
                <div class="weui-cell__bd">
                    <div class="weui-cell__hd d-lists">
                        <img src="<?php echo explode(',',$v['imgUrl'])[0]; ?>">
                        <div>
                            <p class="d-lists-title"><?php echo $v['name'];?></p>
                            <span class="d-lists-num">月售：XXX</span>
                            <span class="d-lists-money">￥：<?php echo $v['price'];?></span>
                            <span class="d-lists-other">免运费</span>
                        </div>
                    </div>
                </div>
            </a>
    <?php
        }
    ?>
</div>

<?php require_once ROOT_PATH . '/home/Tpl/Public/Footer.php'; ?>
