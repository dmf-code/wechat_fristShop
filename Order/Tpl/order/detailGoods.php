<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/11
 * Time: 22:51
 */
    require_once ROOT_PATH . '/order/Tpl/public/header.php';
    $cache = \Rice\Core\Core::get('Cache');
    $goods = $cache->goods;
    $address = $cache->address;

?>
<form id="myForm" action="addDetailGoods" method="post">
    <input type="hidden" name="goodid" value="<?php echo $goods[0]['id'];?>">
    <input type="hidden" name="price" value="<?php echo $goods[0]['price'];?>">
    <input type="hidden" name="addressid" value="<?php echo $address['addressid'];?>">
    <div class="weui-tab">
    <div class="weui-tabbar__item">

        <div class="weui-cells">
            <div class="weui-cell" style="color: #000000;">
                收货地址
            </div>
            <div href="javascript:void(0);" class="weui-cell">
                <div style="width: 100%;">
                    <p>
                        <span style="float: left;">收货人名字：<?php echo $address['name'];?></span>
                        <span style="float: right;">电话：<?php echo $address['mobile'];?></span>
                    </p>
                    <div style="clear: both;"></div>
                    <p  style="text-align: left;">
                        邮政编码：<?php echo $address['zipCode'];?>
                    </p>
                    <p  style="text-align: left;">
                        收货地址：<?php echo $address['province'].'-'.$address['city'].'-'.$address['area'].'-'.$address['detailAddress'];?>
                    </p>
                </div>
            </div>

                <a href="/home/address/showAddress" style="width: 100%;" class="weui-cell weui-cell_access weui-cell_link">
                    <div class="weui-cell__bd" style="text-align: left;">地址管理</div>
                    <span class="weui-cell__ft"></span>
                </a>

        </div>


        <?php
            foreach($goods as $k=>$v){
                ?>
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        <div class="weui-cells">
                            <div class="weui-cell">
                                <div style="height: 8em;width: 8em;">
                                    <input type="hidden" name="imgs" value="<?php echo explode(',',$v['imgUrl'])[0];?>">
                                    <input type="hidden" name="name" value="<?php echo $v['name'];?>">
                                    <img style="height:inherit;line-height:inherit;" src="<?php echo explode(',',$v['imgUrl'])[0];?>" alt="<?php echo $v['name'];?>">
                                </div>
                                <h3 style="height: 8em;margin-top: 1em;"><?php echo $v['name'];?></h3>
                            </div>
                            <div class="weui-cell">
                                价格：<span id="price"><?php echo $v['price'];?></span> RMB
                            </div>
                            <div class="weui-cell">
                                <div class="weui-count">
                                    购买数量：
                                    <a class="weui-count__btn weui-count__decrease"></a>
                                    <input class="weui-count__number" type="number" name="goodnum" value="1">
                                    <a class="weui-count__btn weui-count__increase"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>

    </div>
</div>

    <div class="weui-tabbar weui-flex">

            <div class="weui-flex__item">
                应付金额：<span id="moneny"></span>
            </div>
            <div class="weui-flex__item">
                <a href="javascript:document.getElementById('myForm').submit();" class="weui-btn weui-btn_warn">立即付款</a>
            </div>

    </div>
</form>
<?php
    require_once ROOT_PATH . '/order/Tpl/public/footer.php';
?>
<script>

    function changeTwoDecimal_f(x) {
        var f_x = parseFloat(x);
        if (isNaN(f_x)) {
            alert('function:changeTwoDecimal->parameter error');
            return false;
        }
        var f_x = Math.round(x * 100) / 100;
        var s_x = f_x.toString();
        var pos_decimal = s_x.indexOf('.');
        if (pos_decimal < 0) {
            pos_decimal = s_x.length;
            s_x += '.';
        }
        while (s_x.length <= pos_decimal + 2) {
            s_x += '0';
        }
        return s_x;
    }

    $(function(){
        var $input = $(':input[name=goodnum]');
        var number = parseInt($input.val() || "0");
        var price = $('#price').html();
        var moneny = changeTwoDecimal_f(Math.round(parseFloat(price*100*number))/100);
        $('#moneny').html(moneny);
    });

    var MAX = 99, MIN = 1;
    $('.weui-count__decrease').click(function (e) {
        var $input = $(e.currentTarget).parent().find('.weui-count__number');
        var number = parseInt($input.val() || "0") - 1
        if (number < MIN) number = MIN;
        $input.val(number);
        var price = $('#price').html();
        var moneny = changeTwoDecimal_f(Math.round(parseFloat(price*100*number))/100);
        $('#moneny').html(moneny);
    })
    $('.weui-count__increase').click(function (e) {
        var $input = $(e.currentTarget).parent().find('.weui-count__number');
        var number = parseInt($input.val() || "0") + 1
        if (number > MAX) number = MAX;
        $input.val(number);
        var price = $('#price').html();
        var moneny = changeTwoDecimal_f(Math.round(parseFloat(price*100*number))/100);
        $('#moneny').html(moneny);
    })

</script>
