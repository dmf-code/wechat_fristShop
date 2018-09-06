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
    $orderid = $cache->orderid;

?>
<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="../../../static/public/webuploader/css/webuploader.css">
<link rel="stylesheet" type="text/css" href="../../../static/image-upload/style.css" />
<!--引入JS-->
<script type="text/javascript" src="../../../static/public/webuploader/dist/webuploader.js"></script>
<body ontouchstart="">
<form id="myForm" method="post">
    <input type="hidden" name="orderid" value="<?php echo $orderid; ?>">
    <?php
        foreach($toBeEvaluated['detailgoods'] as $k=>$v){
            ?>
                    <div class="weui-cells weui-cells_form">
                        <input type="hidden" name="goodid" value="<?php echo $v['goodid'];?>">
                            <div class="weui-cell">
                                <div style="height: 8em;width: 8em;">
                                    <img style="height:inherit;line-height:inherit;" src="<?php echo $v['imgs'];?>" alt="<?php echo $v['name'];?>">
                                </div>
                                <h3 style="height: 8em;margin-top: 1em;"><?php echo $v['name'];?></h3>
                            </div>
                            <div class="weui-cells__title">商品留言</div>
                            <div class="weui-cell">
                                <div class="weui-cell__bd">
                                    <textarea class="weui-textarea" placeholder="请输入" rows="3" name="comments"></textarea>
                                    <div class="weui-textarea-counter"><span>0</span>/200</div>
                                </div>
                            </div>

                            <div class="weui-cells__title">商品图片</div>
                            <div class="weui-cell">
                                <div class="weui-cell__bd">

                                    <div id="wrapper">
                                        <div id="container">
                                            <!--头部，相册选择和格式选择-->

                                            <div id="uploader">
                                                <div class="queueList">
                                                    <div id="dndArea" class="placeholder">
                                                        <div id="filePicker"></div>
                                                        <p>或将照片拖到这里，单次最多可选300张</p>
                                                    </div>
                                                </div>
                                                <div class="statusBar" style="display:none;">
                                                    <div class="progress">
                                                        <span class="text">0%</span>
                                                        <span class="percentage"></span>
                                                    </div><div class="info"></div>
                                                    <div class="btns">
                                                        <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>
            <?php
        }
    ?>
    <input type="hidden" name="post" value="1">
    <a href="javascript:document.getElementById('myForm').submit();" class="weui-btn weui-btn_primary">提交评论</a>
</form>


<audio controls="controls" style="display: none;"></audio>
</body>

<script src="../../../static/image-upload/upload.js"></script>

<?php
    include ROOT_PATH . '/order/Tpl/public/footer.php';
?>
