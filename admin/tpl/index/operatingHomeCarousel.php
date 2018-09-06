<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/2/3
 * Time: 21:36
 */
require_once ROOT_PATH . "/admin/Tpl/Public/header.php";
    global $dcache;
    $homeCarousel = $dcache->getVal('homeCarousel');
?>

<table class="sui-table table-zebra">
    <thead>
    <tr>
        <th>id</th>
        <th>图片地址</th>
        <th>商品页id</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php

    foreach($homeCarousel as $k=>$v){
        ?>
        <tr>
            <td><?php echo $v['homeInfoId'];?></td>
            <td><?php echo $v['imgs'];?></td>
            <td><?php echo $v['detailid'];?></td>
            <td>
                <a href="updateHomeCarousel?id=<?php echo $v['homeInfoId'];?>"><button class="sui-btn btn-bordered btn-danger">编辑</button></a>
                <a href="deleteHomeCarousel?id=<?php echo $v['homeInfoId'];?>"><button class="sui-btn btn-bordered btn-danger">删除</button></a>
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

