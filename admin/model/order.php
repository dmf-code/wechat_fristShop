<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/5/5
 * Time: 12:50
 */

namespace Admin\Model;


use Rice\Core\Db;

class Order
{
    /*
     * 获取订单列表
     */
    public function getOrderList(){

        $db = Db::getInstance();

        $sql = "SELECT * FROM `wx_shop_order`";

        $infos = $db->query($sql)
                    ->fetchAll();

        //var_dump($infos);
        return $infos;

    }

    /*
     * 更新订单状态
     */
    public function updateOrder($orderid,$status){
        $db = Db::getInstance();
        if($status<2){
            $status++;
        }else{
            header('Location: /admin/index/operatingOrderList');
            return;
        }
        $sql = "UPDATE `wx_shop_order`
                SET
                    status = :status
                WHERE
                    orderid = :orderid
                ";

        $db->query($sql)
            ->bind(array('status'=>$status,'orderid'=>$orderid))
            ->execute();
        header('Location: /admin/index/operatingOrderList');
    }
}