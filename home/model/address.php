<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/5
 * Time: 21:44
 */

namespace home\model;


class address
{
    /*
     * 创建收货地址
     */
    public function createAddress($data){

        $db = \core\db::getInstance();
        $sql = "INSERT INTO `wx_shop_address` (
                  `userid`,`name`,`mobile`,`province`,
                  `city`,`area`,`street`,`zipCode`,
                  `detailAddress`,`default_address`,`status`
                ) VALUES(
                  :userid,:name,:mobile,:province,
                  :city,:area,:street,:zipCode,
                  :detailAddress,:default_address,:status
                )";
        $info = $db->query($sql)
                    ->bind($data)
                    ->execute();
        if(!$info){
            return false;
        }
        return true;
    }
    /*
     * 获取收货地址列表
     */
    public function getAddressList($userid){

        $db = \core\db::getInstance();
        $sql = "SELECT `addressid`,`name`,`mobile`,`province`,
                  `city`,`area`,`street`,`zipCode`,
                  `detailAddress`,`default_address`,`status`
                FROM `wx_shop_address`
                WHERE (`userid`=:userid AND `status`=1)
                ";
        $info = $db->query($sql)
                    ->bind(array(
                        'userid'=>$userid
                    ))
                    ->fetchAll();
        if(!$info){
            return false;
        }
        return $info;
    }

    /*
     * 删除收货地址
     */
    public function delAddress($addressid){
        $db = \core\db::getInstance();
        $sql = "UPDATE `wx_shop_address`
                SET `status`=0
                WHERE `addressid`=:address
                ";
        $info = $db->query($sql)
                    ->bind(array(
                        'address'=>$addressid
                    ))
                    ->execute();
        if(!$info){
            return false;
        }
        return true;
    }

    /*
     * 修改收货地址
     */
    public function updateAddress($data){
        $db = \core\db::getInstance();
        $sql = "UPDATE `wx_shop_address`
                SET `name`=:name,`province`=:province,`city`=:city,
                    `area`=:area,`mobile`=:mobile,`zipCode`=:zipCode,
                    `detailAddress`=:detailAddress
                WHERE (`userid`=:userid AND `addressid`=:addressid)
                ";
        $info = $db->query($sql)
                    ->bind($data)
                    ->execute();
        if(!$info){
            return false;
        }
        return true;
    }

    /*
     * 更新默认收货地址
     */
    public function updateDefault($data){
        $db = \core\db::getInstance();
        var_dump($data);
        /*
         * 查找默认收货地址
         */
        $sql = "SELECT `addressid`
                FROM `wx_shop_address`
                WHERE (`userid`=:userid AND `default_address`=1)
                ";
        $info = $db->query($sql)
                    ->bind(array(
                        'userid'=>$data['userid']
                    ))
                    ->fetch();
        /*
         * 存在默认则将其删除
         */
        if($info){
            $sql = "UPDATE `wx_shop_address`
                SET `default_address`=0
                WHERE (`userid`=:userid AND `addressid`=:addressid)
                ";
            $info = $db->query($sql)
                ->bind(array(
                    'userid'=>$data['userid'],
                    'addressid'=>$info['addressid']
                ))
                ->execute();
            if(!$info){
                return false;
            }
        }
        /*
         * 更新最新默认地址
         */
        $sql = "UPDATE `wx_shop_address`
                SET `default_address`=1
                WHERE (`userid`=:userid AND `addressid`=:addressid)
                ";
        $info = $db->query($sql)
                    ->bind($data)
                    ->execute();
        if(!$info){
            return false;
        }
        return true;
    }

}