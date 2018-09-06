<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/25
 * Time: 21:11
 */
    include ROOT_PATH . '/order/Tpl/public/header.php';
    $cache = Rice\Core\Core::get('Cache');
    $pendingPayment = $cache->pendingPayment;
    $address = $cache->address;
    //var_dump($pendingPayment);
?>

<body ontouchstart="">

    <?php
        if(empty($pendingPayment)){
            echo "<h2>暂无待付款商品</h2>";
        }
    ?>

    <?php
        //var_dump($pendingPayment);
        foreach($pendingPayment as $k=>$v) {
            //var_dump($v);
            echo '<div class="weui-cells weui-cells_form"  style="margin-bottom: 1em;">';
            foreach ($v['goods'] as $kk => $vv) {
                ?>
                <div class="weui-cell">
                    <div style="height: 8em;width: 8em;">
                        <img style="height:inherit;line-height:inherit;"
                             src="<?php echo explode(',', $vv['imgUrl'])[0]; ?>"
                             alt="<?php echo $vv['name']; ?>">
                    </div>
                    <h3 style="height: 8em;margin-top: 1em;"><?php echo $vv['name']; ?></h3>
                </div>
                <div class="weui-cell">
                    价格：<span id="price"><?php echo $vv['price']; ?></span> RMB
                </div>
                <div class="weui-cell">
                    <div class="weui-count">
                        购买数量：<?php echo $v['goodnum']; ?>
                        <input class="weui-count__number" type="hidden" name="goodnum"
                               value="<?php echo $v['goodnum']; ?>">
                    </div>
                </div>
                <div class="weui-cell">
                    <span class="weui-flex__item">金额：<?php echo $vv['price']*100*$v['goodnum']/100;?></span>
                    <span class="weui-flex__item" style="text-align: right;">
                        <a style="padding:0.25em;border: 1px solid #777777;margin-right: 1em;" class="weui-btn_default" href="deletePayment?detailid=<?php echo $v['detailid'];?>">取消订单</a>
                        <a style="padding:0.25em;border: 1px solid #777777;margin-right: 1em;" class="weui-btn_default" href="payment?detailid=<?php echo $v['detailid'];?>">付款</a>
                    </span>

                </div>
                <?php
            }
            echo "</div>";
        }
    ?>


<audio controls="controls" style="display: none;"></audio></body>

<?php
    include ROOT_PATH . '/order/Tpl/public/footer.php';
?>
