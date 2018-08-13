<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/20
 * Time: 18:51
 */
define('ROOT_PATH','/yjdata/www/www/wechat/fruitShop');
require_once ROOT_PATH.'/core/database/driver.php';
$ip='118.89.20.107';
$port='6379';

try{
    $redis = new Redis();
    $redis->pconnect($ip,$port,1);
    $amount = $redis->get('fruitshop_buynow_amount');

}catch(\RedisException $e){
    echo $e->getMessage();
}

    $db = new \core\database\driver();
        $arr = $redis->lRange('fruitshop_buynow',0,10);

        foreach($arr as $k=>$v)
        {
            $v=json_decode($v);

            if($v->status!=0){
                continue;
            }
            do{
                $sql = 'INSERT INTO `wx_shop_order` (
                          `userid`,`addressid`,`amount`,`status`,
                          `expressid`,`expressno`,`createtime`,
                          `updatetime`
                        )VALUES (
                          :userid,:addressid,:amount,:status,
                          :expressid,:expressno,:createtime,
                          :updatetime
                        )';
                $info = $db->query($sql)
                    ->bind(array(
                        'userid'=>$v->openid,
                        'addressid'=>1,
                        'amount'=>$amount,
                        'status'=>0,
                        'expressid'=>1,
                        'expressno'=>'广东',
                        'createtime'=>time(),
                        'updatetime'=>date('Y-m-d H:i:s',time())
                    ))
                    ->execute();
            }while(!$info);

            echo $v->openid.'抢购成功<br>\n';
            $v->status = 1;
            //更新队列数据
            $redis->lset('fruitshop_buynow',$k,json_encode($v));
        }
