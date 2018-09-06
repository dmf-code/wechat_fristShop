<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/11
 * Time: 14:46
 */

namespace Order\Model;


use Rice\Core\Db;

class Order
{
    /*
     * 获取商品信息
     */
    public function getGoods($goodid){
        $db = Db::getInstance();
        $sql = "SELECT `id`,`name`,`imgUrl`,`price`
                FROM `wx_shop_goods`
                WHERE `id`=:goodid
                ";
        if(is_array($goodid)){
            foreach($goodid as $k=>$v){

                $info[] = $db->query($sql)
                    ->bind(array(
                        'goodid'=>$goodid
                    ))
                    ->fetch();
            }
        }else{

            $info[] = $db->query($sql)
                ->bind(array(
                    'goodid'=>$goodid
                ))
                ->fetch();
        }

        if(!$info){
            return false;
        }
        return $info;
    }

    /*
     * 添加详细商品信息
     */
    public function addDetailGoods($data){

        $db = Db::getInstance();
        $sql = "INSERT INTO `wx_shop_order_detail` (
                  `userid`,`goodid`,`goodnum`,`price`,
                  `addressid`,`name`,`imgs`,`createtime`,
                  `status`
                ) VALUES (
                  :userid,:goodid,:goodnum,:price,
                  :addressid,:name,:imgs,:createtime,
                  1
                )
                ";
        $info = $db->query($sql)
                    ->bind(array(
                        'userid'=>$data['userid'],
                        'goodid'=>$data['goodid'],
                        'goodnum'=>$data['goodnum'],
                        'price'=>$data['price'],
                        'addressid'=>$data['addressid'],
                        'name'=>$data['name'],
                        'imgs'=>$data['imgs'],
                        'createtime'=>date('Y-m-d H:i:s',time())
                    ))
                    ->execute();
        if(!$info){
            return false;
        }
        return true;
    }

    /*
     * 更新商品信息
     */
    public function updateDetailGoods($data){
        $db = Db::getInstance();
        $sql = "UPDATE
                    `wx_shop_order_detail`
                SET
                    `price`=:price,
                    `createtime`=:createtime
                WHERE
                    (`detailid`=:detailid AND `status`=1)
                ";

        $info = $db->query($sql)
                    ->bind(array(
                        'price'=>$data['price'],
                        'createtime'=>$data['createtime'],
                        'detailid'=>$data['detailid']
                    ))
                    ->execute();
        if(empty($info)){
            return false;
        }
        return true;
    }
    /*
     * 更新detailGoods status
     */
    public function updateDetailGoodsStatus($data){
        $db = Db::getInstance();
        $sql = "UPDATE
                    `wx_shop_order_detail`
                SET
                    `status`=2
                WHERE
                    (`detailid`=:detailid AND `userid`=:userid)
                ";

        $info = $db->query($sql)
                    ->bind(array(
                        'detailid'=>$data['detailid'],
                        'userid'=>$data['userid']
                    ))
                    ->execute();
        if(empty($info)){
            return false;
        }
        return true;
    }

    /*
     * 获取用户收货地址
     */
    public function getAddress($userid){
        $db = Db::getInstance();
        $sql = "SELECT `addressid`,`name`,`mobile`,`province`,
                        `city`,`area`,`zipCode`,`detailAddress`
               FROM `wx_shop_address`
               WHERE (`userid`=:userid AND `default_address`=1)
               ";
        $info = $db->query($sql)
                    ->bind(array(
                        'userid'=>$userid
                    ))
                    ->fetch();
        if(!$info){
            $sql = "SELECT `addressid`,`name`,`mobile`,`province`,
                        `city`,`area`,`zipCode`,`detailAddress`
               FROM `wx_shop_address`
               WHERE `userid`=:userid
               ";
            $info = $db->query($sql)
                        ->bind(array(
                            'userid'=>$userid
                        ))
                        ->fetch();
        }

        return $info;
    }

    /*
     * 添加订单物品
     */
    public function addOrder($userid,$payStyle,$detailid=null){
        $db = Db::getInstance();
        //var_dump($userid);
        $pendingPayments = $this->getPendingPayment($userid);

        $amount = 0.0;
        $detailids = '';
        $addressid = '';

        if(empty($detailid)) {
            foreach ($pendingPayments as $k => $v) {
                $amount += (100.0 * $v['price'] * $v['goodnum']);
                $detailids .= $v['detailid'];
            }
            $amount /= 100;
        }else{
            $addressid = $pendingPayments[0]['addressid'];
            $good = $this->getOnePendingPayment($detailid);
            $amount = ($good['price']*100*$good['goodnum'])/100;
            $detailids = $detailid;
        }

        $sql = "
                INSERT INTO `wx_shop_order`
                (
                  `userid`,`addressid`,`amount`,`status`,
                  `detailids`,`payStyle`,`createtime`,`updatetime`
                )VALUES (
                  :userid,:addressid,:amount,:status,
                  :detailids,:payStyle,:createtime,:updatetime
                )
                ";

        $info = $db->query($sql)
                    ->bind(array(
                        'userid'=>$userid,
                        'addressid'=>$addressid,
                        'amount'=>$amount,
                        'status'=>1,
                        'detailids'=>$detailids,
                        'payStyle'=>$payStyle,
                        'createtime'=>date('Y-m-d H:i:s',time()),
                        'updatetime'=>date('Y-m-d H:i:s',time())
                    ))
                    ->execute();
        //var_dump($info);
        if(empty($info)){
            return false;
        }

        $info = $this->updateDetailGoodsStatus(array('detailid'=>$detailid,'userid'=>$userid));

        if(empty($info)){
            return false;
        }
        return true;
    }

    /*
     * 更新订单信息
     */
    public function updateOrder($userid,$orderid,$status){
        $db = Db::getInstance();
        $sql = "UPDATE
                    `wx_shop_order`
                SET
                    `status`=:status
                WHERE
                    `userid`=:userid AND
                    `orderid`=:orderid
                ";
        $info = $db->query($sql)
                    ->bind(array(
                        'userid'=>$userid,
                        'orderid'=>$orderid,
                        'status'=>$status
                    ))
                    ->execute();
        if(empty($info)){
            return false;
        }
        return true;
    }

    /*
     * 获取单个待付款信息
     */
    public function getOnePendingPayment($detailid,$status=1){
        $db = Db::getInstance();
        $sql = "SELECT
                    `detailid`,`userid`,`goodid`,`addressid`,
                    `goodnum`,`price`,`name`,`imgs`,`createtime`,
                    `overtime`
                FROM
                    `wx_shop_order_detail`
                WHERE
                    (`detailid`=:detailid AND `status`=:status)
                ";

        #echo '<br/>'.($sql).'<br/>';
        #echo '<br/>'.$detailid.' '.$status.'<br/>';
        $info = $db->query($sql)
            ->bind(array(
                'detailid'=>$detailid,
                'status'=>$status
            ))
            ->fetch();

        if($status==2){
            return $info;
        }
        if(empty($info)){
            return false;
        }
        if(strtotime($info['createtime'])+$info['overtime']<time()){
            $goods = $this->getGoods($info['goodid'])[0];

            if(empty($goods)){
                return false;
            }

            //判断信息是否改变
            if(($info['price']*100)!=($goods['price']*100)){
                $info['price'] = $goods['price'];
                $info['createtime'] = time();
                $flag = $this->updateDetailGoods($info);
                if(empty($flag)){
                    return false;
                }
            }

        }

        return $info;
    }

    /*
     * 获取待付款商品
     */
    public function getPendingPayment($userid){
        $db = Db::getInstance();
        $sql = "SELECT
                    `detailid`,`userid`,`goodid`,`addressid`,
                    `goodnum`,`price`,`createtime`,`overtime`
                FROM
                    `wx_shop_order_detail`
                WHERE
                    (`userid`=:userid AND `status`=:status)
                ";

        $info = $db->query($sql)
                    ->bind(array(
                        'userid'=>$userid,
                        'status'=>1
                    ))
                    ->fetchAll();
        if(empty($info)){
            return false;
        }
        return $info;
    }

    /*
     * 取消付款
     */
    public function deletePayment($userid,$detailid){
        $db = Db::getInstance();
        $sql = "UPDATE
                    `wx_shop_order_detail`
                SET
                    `status`=0
                WHERE
                    (`userid`=:userid AND `detailid`=:detailid)
               ";
        $info = $db->query($sql)
            ->bind(array(
                'userid'=>$userid,
                'detailid'=>$detailid
            ))
            ->execute();
        if(empty($info)){
            return false;
        }
        return true;
    }

    /*
     * 获取付款后信息
     * 1-待发货
     * 2-待收货
     * 3-待评价
     */
    public function getPendingStatus($userid,$status){
        $db = Db::getInstance();
        $sql = "SELECT
                    `orderid`,`userid`,`addressid`,`detailids`,
                    `payStyle`
                FROM
                    `wx_shop_order`
                WHERE
                    (`userid`=:userid AND `status`=:status)
                ";
        $info = $db->query($sql)
            ->bind(array(
                'userid'=>$userid,
                'status'=>$status
            ))
            ->fetchAll();
        if(empty($info)){
            return false;
        }
        return $info;
    }

    /*
     * 获取用户信息
     */
    public function getUserInfo($userid){
        $db = Db::getInstance();
        $sql = "SELECT
                    `nickname`,`headimgurl`
                FROM
                    `wx_web_userinfo`
                ";
        $info = $db->query($sql)
                    ->fetch();
        if(empty($info)){
            return false;
        }
        return $info;
    }

    /*
     * 提交评论
     */
    public function addComments($userid,$data){
        $db = Db::getInstance();
        $userinfo = $this->getUserInfo($userid);
        //var_dump($userinfo);
        $sql = "INSERT INTO
                    `wx_shop_comment`
                    (
                      `goodid`,`userid`,`headimgurl`,
                      `commentGoodsUrl`,`nickname`,`content`,
                      `createtime`,`status`
                    )VALUES (
                      :goodid,:userid,:headimgurl,
                      :commentGoodsUrl,:nickname,:content,
                      CURRENT_TIMESTAMP ,1
                    )
                ";
        if(empty($data['fileUrls'])){
            $data['fileUrls'] = "";
        }else{
            $data['fileUrls'] = implode(',',$data['fileUrls']);
        }
        $info = $db->query($sql)
                    ->bind(array(
                        'goodid'=>$data['goodid'],
                        'userid'=>$userid,
                        'headimgurl'=>$userinfo['headimgurl'],
                        'commentGoodsUrl'=>$data['fileUrls'],
                        'nickname'=>$userinfo['nickname'],
                        'content'=>empty($data['comments'])?'商品不错':$data['comments']
                    ))
                    ->execute();
        if(empty($info)){
            return false;
        }
        return true;
    }
}