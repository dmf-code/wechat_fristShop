<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/13
 * Time: 21:48
 */

namespace order\controller;


use core\controller;

class buyNow extends controller
{
    public function index(){
        $model = \core\dphp::instance('\order\model\buyNow');
        $goods = $model->goods(9);
        $this->assign('goods',$goods);
//        $goodsDetail = $model->goodsDetail(1);
//        $this->assign('goodsDetail',$goodsDetail);
        $buynow = $model->buynow(1);
        $this->assign('buynow',$buynow);
        $this->display();
    }

    public function success(){
        $model = \core\dphp::instance('\order\model\buyNow');
        $goods = $model->goods(9);
        $this->assign('goods',$goods);
        $this->display();
    }
    public function fail(){

        $this->display();
    }

    public function buynow(){
        try{
            $redis = \core\dphp::instance('\core\redis');
        }catch(\RedisException $e){
            echo $e->getMessage();
        }

        $buyLen = $redis->llen('fruitshop_buynow');
        $buynowNum = $redis->get('fruitshop_buynow_num');

        $userid = time();
        $buynowid = '1';

        if($buyLen<$buynowNum){

                $redis->rPush('fruitshop_buynow',
                    json_encode(array(
                        'openid'=>$userid,
                        'buynowid'=>$buynowid,
                        'status'=>0)));


            header('Location: http://wx.dmf95.cn/fruitShop/index.php/order/buyNow/success');
        }else{
            header('Location: http://wx.dmf95.cn/fruitShop/index.php/order/buyNow/fail');
        }
    }
}