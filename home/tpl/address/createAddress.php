<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/4
 * Time: 12:23
 */

require_once ROOT_PATH . '/home/tpl/public/header.php';
    /*
     * 数据库信息
     */
    global $dcache;
    $address = $dcache->getVal('address');

?>

<body ontouchstart>


<header style="text-align: center;">
    <h1 style="color: #0BB20C;">新增收货地址</h1>
</header>
<form id="myform" method="post">
    <input type="hidden" name="addressid" value="<?php echo $address['addressid'];?>">
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">收货人名字</label></div>
            <div class="weui-cell__bd">
                <input id="name" name="name" value="<?php echo $address['name'];?>" class="weui-input" type="text" placeholder="请输入收货人名字">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">手机号码</label></div>
            <div class="weui-cell__bd">
                <input id="tel" name="mobile" value="<?php echo $address['mobile'];?>" class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入手机号码">
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><label for="home-city" class="weui-label">省、市、区</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="address" value="<?php echo $address['address'];?>" id="city-picker" type="text" readonly="">
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">邮政编码</label></div>
            <div class="weui-cell__bd">
                <input id="zipCode" name="zipCode" value="<?php echo $address['zipCode'];?>" class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入邮政编码">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">详细地址</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <textarea id="detailAddress" name="detailAddress" class="weui-textarea" placeholder="请输入详细地址" rows="3"></textarea>
            </div>
        </div>
    </div>

    <div class="weui-tabbar" style="height: 2em;">
        <div class="weui-tabbar__item">
            <a class="weui-btn weui-btn_warn" href="javascript:" id="showTooltips">保存</a>
        </div>
    </div>

    <input type="hidden" name="post" value="<?php echo empty($address['post'])?1:$address['post'];?>">
</form>

<audio controls="controls" style="display: none;"></audio>

</body>

<?php
    require_once ROOT_PATH . '/home/tpl/public/footer.php';
?>

<script>
    (function($) {
        $("#showTooltips").click(function () {
            var name = $('#name').val();
            var tel = $('#tel').val();
            var address = $('#city-picker').val();
            var zipCode = $('#zipCode').val();
            var detailAddress = $('#detailAddress').val();
            if (!name) $.toptip('请输入收货人名字');
            else if (!tel || !/1[3|4|5|7|8]\d{9}/.test(tel)) $.toptip('请输入手机号');
            else if (!address) $.toptip('请输入省、市、区');
            else if (!zipCode || !/\d{6}/.test(zipCode)) $.toptip('请输入六位邮政编码');
            else if (!detailAddress) $.toptip('请输入详细地址');
            else $.toptip('提交成功', 'success'),$('#myform').submit();
        });
    })(jQuery);
</script>
<script>
    $(function(){
        $('#detailAddress').val("<?php echo $address['detailAddress'];?>");
    });
</script>
<link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type="text/javascript" src="//g.alicdn.com/msui/sm/0.6.2/js/sm-city-picker.min.js" charset="utf-8"></script>
<script>
    (function($){
        $("#city-picker").cityPicker({
            toolbarTemplate: '<header class="bar bar-nav">\
            <button class="button button-link pull-right close-picker">确定</button>\
            <h1 class="title">选择收货地址</h1>\
            </header>'
        });
    })(Zepto);

</script>