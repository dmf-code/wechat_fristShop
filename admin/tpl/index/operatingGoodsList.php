<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/13
 * Time: 14:35
 */
require_once ROOT_PATH . "/admin/Tpl/Public/header.php";
    global $dcache;
    $goods = $dcache->getVal('goods');
    $pSum = $dcache->getVal('pSum');
    $page = $dcache->getVal('page');
    $offset = $dcache->getVal('offset');
?>

<table class="sui-table table-zebra">
    <thead>
    <tr>
        <th>id</th>
        <th>名字</th>
        <th>价格</th>
        <th>净重</th>
        <th>品牌</th>
        <th>产地</th>
        <th>水果类型</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php

        foreach($goods as $k=>$v){
    ?>
    <tr>
        <td><?php echo $v['id'];?></td>
        <td><?php echo $v['name'];?></td>
        <td><?php echo $v['price'];?></td>
        <td><?php echo $v['netWeight'];?></td>
        <td><?php echo $v['brand'];?></td>
        <td><?php echo $v['madeIn'];?></td>
        <td><?php echo $v['fruitType'];?></td>
        <td>
            <a href="updateGoods?id=<?php echo $v['id'];?>"><button class="sui-btn btn-bordered btn-danger">编辑</button></a>
            <a href="deleteGoods?id=<?php echo $v['id'];?>"><button class="sui-btn btn-bordered btn-danger">删除</button></a>
        </td>
    </tr>
    <?php
    }
    ?>

    </tbody>
</table>
    <div class="sui-pagination" style="text-align: center;">
        <ul>
            <li class="prev <?php echo $page-1<0?'disabled':''; ?>"><a href="operatingGoodsList?page=<?php echo $page-1<0?$page:$page-1; ?>">«</a></li>
            <?php
                $max = $pSum/$offset+($pSum%$offset>0?1:0);
                for($i=0;$i<$max;++$i) {
                    if ($i == $page) {
                        ?>
                        <li class="active"><a href="operatingGoodsList?page=<?php echo $i; ?>"><?php echo $i+1; ?></a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li><a href="operatingGoodsList?page=<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
                        <?php
                    }
                }
            ?>
            <li class="next <?php echo $page+1>=$pSum/$offset?'disabled':''; ?>"><a href="operatingGoodsList?page=<?php echo $page+1>=$pSum/$offset?$page:$page+1; ?>">»</a></li>
        </ul>
    </div>
<?php
    require_once ROOT_PATH . "/admin/Tpl/Public/footer.php";
?>
