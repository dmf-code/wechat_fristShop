<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/13
 * Time: 14:35
 */
require_once ROOT_PATH . "/admin/Tpl/Public/header.php";
    global $dcache;
    $good = $dcache->getVal('good');

?>
<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="../../../static/public/webuploader/css/webuploader.css">
<link rel="stylesheet" type="text/css" href="../../../static/image-upload/style.css" />
<!--引入JS-->
<script type="text/javascript" src="../../../static/public/webuploader/dist/webuploader.js"></script>
<style>
    #goods-form {padding: 1.5em;}
    .tr-form {padding: 0.2em;}
    .tr-form span {width: 16em;}
</style>

<form id="goods-form" action="updateGoods" class="sui-form form-horizontal" novalidate="novalidate">
    <input type="hidden" name="cbImgs" value="<?php echo $good['imgUrl'].','.$good['introductionImgs'];?>">
    <div class="control-group tr-form">
        <span>商品名：</span>
        <div class="controls">
            <input type="text" name="name" placeholder="商品名" class="input-xlarge" value="<?php echo $good['name'];?>">
        </div>
    </div>
    <div class="control-group tr-form">
        <span>商品种类：</span>
        <div class="controls">
            <span class="sui-dropdown dropdown-bordered">
                <span class="dropdown-inner">

                </span>
            </span>
        </div>
    </div>


    <div class="control-group tr-form">
        <span>商品价格：</span>
        <div class="controls">
            <input type="text" name="price" placeholder="商品价格" class="input-xlarge" value="<?php echo $good['price'];?>">
        </div>
    </div>

    <label class="radio-pretty inline checked">
        <input type="radio" checked="checked" name="imgType" value="1"><span>商品轮播图片</span>
    </label>
    <label class="radio-pretty inline">
        <input type="radio" name="imgType" value="2"><span>商品介绍图片</span>
    </label>
    (图片上传要按步骤上传成功后再操作)
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

    <div class="control-group tr-form">
        <span>净重：</span>
        <div class="controls">
            <input type="text" name="netWeight" placeholder="商品净重" class="input-xlarge" value="<?php echo $good['netWeight'];?>">
        </div>
    </div>
    <div class="control-group tr-form">
        <span>包装：</span>
        <div class="controls">
            <input type="text" name="packaging" placeholder="商品包装" class="input-xlarge" value="<?php echo $good['packaging'];?>">
        </div>
    </div>
    <div class="control-group tr-form">
        <span>单果重量：</span>
        <div class="controls">
            <input type="text" name="singleFruitWeight" placeholder="单果重量" class="input-xlarge" value="<?php echo $good['singleFruitWeight'];?>">
        </div>
    </div>
    <div class="control-group tr-form">
        <span>商标：</span>
        <div class="controls">
            <input type="text" name="brand" placeholder="商品商标" class="input-xlarge" value="<?php echo $good['brand'];?>">
        </div>
    </div>
    <div class="control-group tr-form">
        <span>产地：</span>
        <div class="controls">
            <input type="text" name="madeIn" placeholder="商品产地" class="input-xlarge" value="<?php echo $good['madeIn'];?>">
        </div>
    </div>
    <div class="control-group tr-form">
        <span>种类：</span>
        <div class="controls">
            <input type="text" name="fruitType" placeholder="商品种类" class="input-xlarge" value="<?php echo $good['fruitType'];?>">
        </div>
    </div>
    <div class="control-group tr-form">
        <span>厂家名：</span>
        <div class="controls">
            <input type="text" name="factoryName" placeholder="厂家名" class="input-xlarge" value="<?php echo $good['factoryName'];?>">
        </div>
    </div>
    <div class="control-group tr-form">
        <span>厂家地址：</span>
        <div class="controls">
            <input type="text" name="factoryAddr" placeholder="厂家地址" class="input-xlarge" value="<?php echo $good['factoryAddr'];?>">
        </div>
    </div>
    <div class="control-group tr-form">
        <span>厂家联系方式：</span>
        <div class="controls">
            <input type="text" name="factoryPhone" placeholder="联系方式" class="input-xlarge" value="<?php echo $good['factoryPhone'];?>">
        </div>
    </div>
    <div class="control-group tr-form">
        <span>保质期：</span>
        <div class="controls">
            <input type="text" name="qualityGuaranteePeriod" placeholder="保质期" class="input-xlarge" value="<?php echo $good['qualityGuaranteePeriod'];?>">
        </div>
    </div>
    <input type="hidden" name="post" value="1">
    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
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
            },
            price:{
                required:true
            },
            netWeight:{
                required:true,
            },
            packaging:{
                required:true,
                minlength: 1,
                maxlength: 10
            },
            singleFruitWeight:{
                required:true,
                minlength: 1,
                maxlength: 10
            },
            brand:{
                required:true,
                minlength: 1,
                maxlength: 10
            },
            madeIn:{
                required:true,
                minlength: 1,
                maxlength: 10
            },
            fruitType:{
                required:true,
                minlength: 1,
                maxlength: 10
            },
            factoryName:{
                required:true,
                minlength: 1,
                maxlength: 25
            },
            factoryAddr:{
                required:true,
                minlength: 1,
                maxlength: 25
            },
            factoryPhone:{
                required:true,
                minlength: 11,
                maxlength: 11
            },
            qualityGuaranteePeriod:{
                required:true,
                minlength: 1,
                maxlength: 10
            }
        },
        messages: {
            name: ["亲，商品名不能为空哟","亲，商品名不能超过20个字"],
            price:["亲，商品价格不能为空哟"],
            netWeight:["亲，商品的净重量不能为空哟"],
            packaging:["亲，包装方式不能为空哟","亲，长度不能超过10个字哟"],
            singleFruitWeight:["亲，单果重量必填哟","亲，长度不能超过10个字哟"],
            brand:["亲，商标必填哟","亲，长度不能超过10个字哟"],
            madeIn:["亲，产地必填哟","亲，长度不能超过10个字哟"],
            fruitType:["亲，水果种类必填哟","亲，长度不能超过10个字哟"],
            factoryName:["亲，厂家名必填哟","亲，长度不能超过25个字哟"],
            factoryAddr:["亲，厂家地址必填哟","亲，长度不能超过25个字哟"],
            factoryPhone:["亲，厂家电话必填哟","亲，长度只能11个字哟"],
            qualityGuaranteePeriod:["亲，保质期必填哟","亲，长度不能超过10个字哟"]
        },
        success: function() {
            return true;
        }
    });

    $(function(){
        $(':input[name=imgType]').click(function () {
            $(':input[name=imgType]').removeAttr('checked');
            $(this).attr('checked','checked');
            console.log($(':input[name=imgType][checked]').val());
        });
    });


    $(function () {
        $.ajax({
            url:'/fruitShop/index.php/admin/index/getCategoryList',
            dataType:'json',
            error:function(xhr,err){
                console.log('ajax失败！');
                console.log(xhr);
                console.log(err);
            },
            success:function(data){
                console.log('ajax成功！');
                console.log(data);
                var mlength = data.length;
                var mycategoryid = <?php echo $good['categoryid'];?>;
                var htmlCode;
                for(var i=0;i<mlength;++i){
                    if(mycategoryid == data[i].categoryid){
                        htmlCode ="<input type=hidden name=category value="+data[i].categoryid+">" +
                            "<a role=button data-toggle=dropdown class=dropdown-toggle>" +
                            "<i class=caret></i>" +
                            data[i].name +
                            "</a>";
                        break;
                    }
                }
                 htmlCode+="<ul id=category role=menu aria-labelledby=drop1 class=sui-dropdown-menu>";
                for(var i=0;i<mlength;++i){
                    if(i==0){
                        htmlCode += "<li  role=presentation class=active><a class=lia data-id="+data[i].categoryid+" role=menuitem tabindex=-1>"+data[i].name+"</a></li>";
                    }else{
                        htmlCode += "<li role=presentation><a class=lia data-id="+data[i].categoryid+" role=menuitem tabindex=-1>"+data[i].name+"</a></li>";
                    }
                }
                htmlCode += "</ul>";
                $('.dropdown-inner').html(htmlCode);
                $('.dropdown-inner .lia').click(function(){
                    var mId = $(this).data('id'),mName = $(this).html();
                    $(':input[name=category]').val(mId);
                    $('a.dropdown-toggle').html("<i class=caret></i>" + mName);
                });
            }
        });

    });


</script>

<script src="../../../static/image-upload/upload.js"></script>
<?php
require_once ROOT_PATH . "/admin/Tpl/Public/footer.php";
?>