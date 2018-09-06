<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/25
 * Time: 21:11
 */
    include ROOT_PATH . '/order/Tpl/public/header.php';
    $cache = \Rice\Core\Core::get('Cache');
    $toBeEvaluated = $cache->toBeEvaluated;

?>

<body ontouchstart="">

<?php
        if(empty($toBeEvaluated)){
            echo "<h2>暂无待评价商品</h2>";
        }
    ?>

<?php
foreach($toBeEvaluated as $k=>$v) {
    echo '<div class="weui-cells weui-cells_form"  style="margin-bottom: 1em;">';
    foreach ($v['detailgoods'] as $kk => $vv) {
        ?>
        <div class="weui-cell">
            <div style="height: 8em;width: 8em;">
                <img style="height:inherit;line-height:inherit;"
                     src="<?php echo $vv['imgs']; ?>">
            </div>
            <h3 style="height: 8em;margin-top: 1em;"><?php echo $vv['name']; ?></h3>
        </div>
        <div class="weui-cell">
            价格：<?php echo $vv['price']; ?> RMB
        </div>

        <div class="weui-cell">
                购买数量：<?php echo $vv['goodnum']; ?>
        </div>

        <div class="weui-cell">
            <span class="weui-flex__item">付款金额：<?php echo $vv['price']*100*$vv['goodnum']/100;?></span>
            <span class="weui-flex__item" style="text-align: right;">
                        <a style="padding:0.25em;border: 1px solid #777777;margin-right: 1em;" class="weui-btn_default" href="addToBeEvaluated?orderid=<?php echo $v['orderid'];?>">现在评价</a>
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
