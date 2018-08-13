<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/2/3
 * Time: 21:36
 */
require_once ROOT_PATH . "/admin/tpl/public/header.php";
?>

<style>
    #category-form{
        padding: 0.5em;
    }
</style>

<form id="category-form" action="addHomeMoudle" method="post" class="sui-form form-horizontal sui-validate">


    <div class="control-group">
        模块名:
        <div class="controls">
            <input type="text" name="name">
        </div>
    </div>

    <div class="control-group">
        商品推荐id:
        <div class="controls">
            <input class="input-xlarge" type="text" name="recommend">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <input type="hidden" name="post" value="1">
            <button type="submit" class="sui-btn btn-primary">提交</button>
        </div>
    </div>
</form>


<?php
require_once ROOT_PATH . "/admin/tpl/public/footer.php";
?>