<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/2/3
 * Time: 21:36
 */
require_once ROOT_PATH . "/admin/tpl/public/header.php";
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

<form id="category-form" action="addCategory" method="post" class="sui-form form-horizontal sui-validate">
    <div class="control-group">
        <span>分类名称：</span>
        <div class="controls">
            <input type="text" name="name" placeholder="分类名称">
        </div>
    </div>

    商品图片：
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
            <input type="hidden" name="uType" value="1">
            <button type="submit" class="sui-btn btn-primary">提交</button>
        </div>
    </div>
</form>

<script>
    $("#goods-form").validate({
        rules: {
            name:{
                required:true,
                minlength: 1,
                maxlength: 20
            }
        },
        messages: {
            name: ["亲，水果分类名不能为空哟","亲，水果分类名不能超过20个字"],
        },
        success: function() {
            return true;
        }
    });
</script>

<script src="../../../static/image-upload/upload.js"></script>

<?php
require_once ROOT_PATH . "/admin/tpl/public/footer.php";
?>