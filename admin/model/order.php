<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/5/5
 * Time: 12:50
 */

namespace admin\model;


class order
{
    /*
     * 获取订单列表
     */
    public function getOrderList(){

        $db = \core\db::getInstance();

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
        $db = \core\db::getInstance();
        if($status<2){
            $status++;
        }else{
            header('Location: http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingOrderList');
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
        header('Location: http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingOrderList');
    }
}