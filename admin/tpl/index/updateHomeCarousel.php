<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/2/3
 * Time: 21:36
 */
require_once ROOT_PATH . "/admin/tpl/public/header.php";
    global $dcache;
    $homeCarousel = $dcache->getVal('homeCarousel')[0];

?>
<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="../../../static/public/webuploader/css/webuploader.css">
<link rel="stylesheet" type="text/css" href="../../../static/image-upload/style.css" />
<!--引入JS-->
<script type="text/javascript" src="../../../static/public/webuploader/dist/webuploader.js"></script>

<style>
    #category-form{
        padding: 0.5em;
    }
</style>

<form id="category-form" action="updateHomeCarousel" method="post" class="sui-form form-horizontal sui-validate">

    <input type="hidden" name="cbImgs" value="<?php echo $homeCarousel['imgs'];?>">
    <div class="control-group">
        商品id:
        <div class="controls">
            <input type="text" name="detailid" value="<?php echo $homeCarousel['detailid'];?>">
        </div>
    </div>

    <div class="control-group">
        状态:
        <div class="controls">
            <input type="text" name="status" value="<?php echo $homeCarousel['status'];?>">

        </div>
    </div>

    轮播图片：
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

    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <input type="hidden" name="post" value="1">
            <input type="hidden" name="id" value="<?php echo $homeCarousel['homeInfoId'];?>">
            <button type="submit" class="sui-btn btn-primary">提交</button>
        </div>
    </div>
</form>

<script src="../../../static/image-upload/upload.js"></script>

<?php
require_once ROOT_PATH . "/admin/tpl/public/footer.php";
?>