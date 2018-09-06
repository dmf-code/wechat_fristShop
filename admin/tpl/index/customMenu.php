<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/13
 * Time: 13:21
 */
require_once ROOT_PATH . "/admin/Tpl/Public/header.php";
?>

<form method="post" id="form-msg" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
    <div class="control-group">
        <div class="controls">
            <button id="addButton" type="button" class="sui-btn btn-large">添加菜单</button>
        </div>
    </div>
    <hr/>
    <table id="addMenu">

    </table>

    <div class="control-group">
        <label  class="control-label"></label>
        <label  class="control-label"></label>
        <div class="controls">
            <button data-action="createMenu" type="submit" class="sui-btn btn-primary mySubmit">创建菜单</button>
        </div>
        <label  class="control-label"></label>
        <label  class="control-label"></label>
        <label  class="control-label"></label>
        <label  class="control-label"></label>
        <div class="controls">
            <button data-action="deleteMenu" type="submit" class="sui-btn btn-primary mySubmit">删除菜单</button>
        </div>
    </div>
</form>

<script>
    var data =
    {
        'menu':
        {
            'button':[
                {
                    'name':'',
                    "sub_button": [ ]
                }
            ]
        }
    };
    //绑定按钮事件来创建
    $('#addButton').click(function(){
        $('#addMenu').addMenu('addMenu',data);
    });
    //获取动态数据
    $(function () {
        $.ajax({
            url:"getData",
            async:true,
            dataType:'json',
            error:function(xhr,err){
                console.log('ajax失败！');
                console.log(xhr);
                console.log(err);
            },
            success:function(data){
                console.log('ajax成功！');
                console.log(data);

                if(data.menu){
                    $('#addMenu').addMenu('addMenu',data);
                }
            }
        });
    });
    //绑定form表单的action方法
    $('.mySubmit').click(function(){
        $('#form-msg').attr('action',$(this).data('action'));
    });

</script>


<?php
require_once ROOT_PATH . "/admin/Tpl/Public/footer.php";
?>