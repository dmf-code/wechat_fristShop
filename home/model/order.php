<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/24
 * Time: 23:24
 */

namespace home\model;


class order
{
    /*
     * 待付款
     */
    public function pendingPayment($userid){
        $db = \core\db::getInstance();
        $sql = "SELECT
                      count(*) as cnt
                FROM
                      `wx_shop_order_detail`
                WHERE
                      (`userid` = :userid AND `status`=1)
                ";
        $info = $db->query($sql)
                    ->bind(array(
                        'userid'=>$userid
                    ))
                    ->fetch();

        return $info['cnt'];
    }
    /*
     * 代发货状态
     */
    public function getOrderStatus($userid,$status){
        $db = \core\db::getInstance();
        $sql = "SELECT
                      count(*) as cnt
                FROM
                      `wx_shop_order`
                WHERE
                      (`userid` = :userid AND `status`=:status)
                ";
        $info = $db->query($sql)
            ->bind(array(
                'userid'=>$userid,
                'status'=>$status
            ))
            ->fetch();
        //var_dump($info['cnt']);
        return $info['cnt'];
    }

}