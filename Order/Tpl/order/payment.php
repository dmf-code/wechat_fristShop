<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/27
 * Time: 0:16
 */
    include ROOT_PATH . '/order/Tpl/public/header.php';
    $cache = Rice\Core\Core::get('Cache');
    $detailid = $cache->detailid;
?>

<div class="weui-cells__title">支付方式</div>
<div class="weui-cells weui-cells_radio">
    <label class="weui-cell weui-check__label" for="x11">
        <div class="weui-cell__bd">
            <p><img style="width: 2.5em;height: 2.5em;" src="../../../static/public/imgs/alipay_logo.jpg" alt="alipay"><span style="text-align: center;font-size: 1em;">&nbsp;&nbsp;&nbsp;&nbsp;支付宝</span></p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" class="weui-check" value="alipay" name="radio1" id="x11"  checked="checked">
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="x12">

        <div class="weui-cell__bd">
            <p><img style="width: 2.5em;height: 2.5em;" src="../../../static/public/imgs/wechat_logo.jpg" alt="wechat"><span style="text-align: center;font-size: 1em;">&nbsp;&nbsp;&nbsp;&nbsp;微信</span></p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" value="wechat" class="weui-check" id="x12">
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <a href="javascript:void(0);" class="weui-cell weui-cell_link">
        <div class="weui-cell__bd">添加更多</div>
    </a>
</div>

<a id="payment" href="javascript:;" class="weui-btn weui-btn_warn weui-footer_fixed-bottom">立即付款</a>
<?php
    include ROOT_PATH . '/order/Tpl/public/footer.php';
?>
<script>
    $(function(){
        $('#payment').click(function(){
            var paystyle = $(':input[name=radio1]:checked').val();
            console.log(paystyle);
            $.ajax({
                url:'/order/order/payment',
                data:{
                    'detailid':<?php echo $detailid;?>,
                    'payStyle':paystyle
                },
                dataType:'json',
                error:function(xhr,err){
                    console.log('ajax失败！');
                    console.log(xhr);
                    console.log(err);
                    $.toast("操作失败");
                },
                success:function(data){
                    console.log('success!');
                    $.toast("操作成功");
                    window.location.href = "/home/index/person";
                }
            });
        });
    });
</script>