<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/17
 * Time: 23:50
 */

namespace order\model;


class buyNow
{
    public function goods($id){
        $db = \core\db::getInstance();
        $sql = 'SELECT
                `id`,`name`,`imgUrl`,`introductionImgs`,`price`,`netWeight`,
                `packaging`,`singleFruitWeight`,`brand`,
                `madeIn`,`fruitType`,`factoryName`,
                `factoryAddr`,`factoryPhone`,
                `qualityGuaranteePeriod`
                FROM `wx_shop_goods`
                WHERE
                 `id` = :id
                ';
        $info = $db->query($sql)
                    ->bind(
                        array(
                            'id'=>$id
                        ))
                    ->fetch();
        if(!$info){
            return false;
        }
        return $info;
    }

    public function goodsDetail($id){
        $db = \core\db::getInstance();
        $sql = 'SELECT
                `imgUrlList`
                FROM `wx_shop_goods_detail`
                WHERE
                `detailid` = :id
                ';
        $info = $db->query($sql)
                    ->bind(array(
                        'id'=>$id
                    ))
                    ->fetch();
        if(!$info){
            return false;
        }
        return $info;
    }

    public function buynow($id){
        $db = \core\db::getInstance();
        $sql = 'SELECT
                `num`,`starttime`,`endtime`,`status`
                FROM `wx_shop_goods_buynow`
                WHERE
                `buynowid` = :id
                ';
        $info = $db->query($sql)
            ->bind(array(
                'id'=>$id
            ))
            ->fetch();
        if(!$info){
            return false;
        }
        return $info;
    }
}