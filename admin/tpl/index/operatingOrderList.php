<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/2/3
 * Time: 21:36
 */
require_once ROOT_PATH . "/admin/Tpl/Public/header.php";
    $cache = \Rice\Core\Core::get('Cache');
    $orderList = $cache->orderList;
?>

<table class="sui-table table-zebra">
    <thead>
    <tr>
        <th>id</th>
        <th>用户id</th>
        <th>地址id</th>
        <th>商品id</th>
        <th>总订单金额</th>
        <th>支付方式</th>
        <th>创建时间</th>
        <th>更新时间</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php

    foreach($orderList as $k=>$v){
        ?>
        <tr>
            <td><?php echo $v['orderid'];?></td>
            <td><?php echo $v['userid'];?></td>
            <td><?php echo $v['addressid'];?></td>
            <td><?php echo $v['amount'];?></td>
            <td><?php echo $v['detailids'];?></td>
            <td><?php echo $v['payStyle'];?></td>
            <td><?php echo $v['createtime'];?></td>
            <td><?php echo $v['updatetime'];?></td>
            <td><?php
                         $status = $v['status'];
                switch($status){
                    case 1:
                        echo '待发货';
                        break;
                    case 2:
                        echo '待收货';
                        break;
                    case 3:
                        echo '待评价';
                        break;
                    case 4:
                        echo '订单完成';
                        break;
                }
                ?></td>
            <td>
                <a href="updateOrder?id=<?php echo $v['orderid'];?>&status=<?php echo$status;?>"><button class="sui-btn btn-bordered btn-danger">下一步</button></a>
<!--                <a href="deleteOrder?id=--><?php //echo $v['orderid'];?><!--"><button class="sui-btn btn-bordered btn-danger">删除</button></a>-->
            </td>
        </tr>
        <?php
    }
    ?>

    </tbody>
</table>



<?php
    require_once ROOT_PATH . "/admin/Tpl/Public/footer.php";
?>

