<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/2/3
 * Time: 21:36
 */
require_once ROOT_PATH . "/admin/tpl/public/header.php";
    global $dcache;
    $moudleList = $dcache->getVal('moudleList');
?>

<table class="sui-table table-zebra">
    <thead>
    <tr>
        <th>id</th>
        <th>名字</th>
        <th>推荐</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php

    foreach($moudleList as $k=>$v){
        ?>
        <tr>
            <td><?php echo $v['moudleid'];?></td>
            <td><?php echo $v['name'];?></td>
            <td><?php echo $v['recommend'];?></td>
            <td><?php echo $v['status'];?></td>
            <td>
                <a href=""><button class="sui-btn btn-bordered btn-danger">编辑</button></a>
                <a href=""><button class="sui-btn btn-bordered btn-danger">删除</button></a>
            </td>
        </tr>
        <?php
    }
    ?>

    </tbody>
</table>



<?php
    require_once ROOT_PATH."/admin/tpl/public/footer.php";
?>

