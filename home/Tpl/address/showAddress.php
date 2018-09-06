<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/4
 * Time: 12:23
 */

require_once ROOT_PATH . '/home/Tpl/Public/Header.php';
?>
    <style>
        .bar-nav {
            top: 0;
        }
        .bar {

            right: 0;
            left: 0;
            z-index: 10;
            height: 2.2rem;
            padding-right: 0.5rem;
            padding-left: 0.5rem;
            background-color: #f7f7f8;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }
        .bar .button-nav.pull-left {
            margin-left: -0.25rem;
        }
        .bar .button.pull-left {
            margin-right: 0.5rem;
        }
        .bar .button-link {
            top: 0;
            padding: 0;
            font-size: 0.8rem;
            line-height: 2.2rem;
            height: 2.2rem;
            color: #0894ec;
            border: 0;
        }
        .bar .button {
            position: relative;
            z-index: 20;
            margin-top: 0;
            font-weight: 400;
        }
        .button {
            border: 1px solid #0894ec;
            color: #0894ec;
            text-decoration: none;
            text-align: center;
            display: block;
            border-radius: 0.25rem;
            line-height: 1.25rem;
            box-sizing: border-box;
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            appearance: none;
            background: none;
            padding: 0 0.5rem;
            margin: 0;
            height: 1.35rem;
            white-space: nowrap;
            position: relative;
            text-overflow: ellipsis;
            font-size: 0.7rem;
            font-family: inherit;
            cursor: pointer;
        }
        .pull-left {
            float: left;
        }
        .bar .button .icon {
            padding: 0;
        }
        .bar .icon {
            position: relative;
            z-index: 20;
            padding: .5rem .1rem;
            font-size: 1rem;
            line-height: 1.2rem;
        }
        .icon {
            font-family: "iconfont-sm" !important;
            font-style: normal;
            display: inline-block;
            vertical-align: middle;
            background-size: 100% auto;
            background-position: center;
            -webkit-font-smoothing: antialiased;
            -webkit-text-stroke-width: 0.2px;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
    <header class="bar bar-nav">
        <a class="button button-link button-nav pull-left back" href="/home/index/person">
            <返回
        </a>
        <h1 class="title" style="text-align: center;">收货地址</h1>
    </header>
<?php
    /*
     * 数据库信息
     */
    $cache = \Rice\Core\Core::get('Cache');
    $addressList = $cache->addressList;
    if(empty($addressList)){
        echo '<h2 style="text-align: center;width: 100%;">暂无收货地址</h2>';
    }
?>

<?php
    foreach($addressList as $k=>$v) {
        ?>

        <form id="<?php echo 'form'.$k;?>" method="post" style="margin: 0.5em;padding: 0.5em;">
            <input type="hidden" name="addressid" value="<?php echo $v['addressid'];?>">
            <input type="hidden" name="name" value="<?php echo $v['name'];?>">
            <input type="hidden" name="mobile" value="<?php echo $v['mobile'];?>">
            <input type="hidden" name="address" value="<?php echo $v['province'].' '.$v['city'].' '.$v['area'];?>">
            <input type="hidden" name="zipCode" value="<?php echo $v['zipCode'];?>">
            <input type="hidden" name="detailAddress" value="<?php echo $v['detailAddress'];?>">
            <input type="hidden" name="post" value="2">
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <div class="weui-cells weui-cells_checkbox">
                        <label class="weui-cell weui-check__label" data-id="<?php echo 'form'.$k;?>" for="<?php echo 's'.$k.$k;?>">
                            <div class="weui-cell__hd">
                                <input type="checkbox" name="checkbox1" class="weui-check" id="<?php echo 's'.$k.$k;?>" <?php if($v['default_address']==1)echo 'checked=checked';?>>
                                <i class="weui-icon-checked"></i>
                            </div>
                            <div class="weui-cell__bd">
                                <p>默认地址</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="weui-flex">
                <div class="weui-flex__item">
                    <p><span style="float: left;"><?php echo $v['name'];?></span><span style="float: right;"><?php echo $v['mobile'];?></span></p>
                    <div style="clear: both;"></div>
                    <p><?php echo $v['province'].'-'.$v['city'].'-'.$v['area'].'-'.$v['detailAddress'];?></p>
                </div>
            </div>

            <div class="weui-flex">
                <div class="weui-flex__item">
                    <div class="weui-cells">
                        <a data-id="<?php echo 'form'.$k;?>" class="edit weui-btn btn_mini  weui-btn_plain-default">编辑</a>
                    </div>
                </div>
                <div style="width: 2em;"></div>
                <div class="weui-flex__item">
                    <div class="weui-cells">
                        <a href="delAddress?addressid=<?php echo $v['addressid']; ?>" class="weui-btn btn_mini  weui-btn_plain-default">删除</a>
                    </div>
                </div>
            </div>

        </form>
        <?php
    }
?>

<div style="margin: 4em 0;"></div>


<div class="weui-footer_fixed-bottom" style="margin: 0;padding: 0;">
    <div class="weui-tabbar__item">
        <a href="/home/address/createAddress" class="weui-btn weui-btn_warn">新增收货地址</a>
    </div>
</div>

<?php
    require_once ROOT_PATH . '/home/Tpl/Public/Footer.php';
?>
<script>
    $(function () {
        $('a.edit').click(function () {
            var id = $(this).data('id');
            $('#'+id).attr('action','createAddress');
            $('#'+id).submit();
        });
        $('label.weui-check__label').click(function () {
            $('input.weui-check').removeAttr('checked');
            var id = $(this).data('id');
            $('#'+id).attr('action','updateDefault');
            $('#'+id).submit();
        });
    });
</script>