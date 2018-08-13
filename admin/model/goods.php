<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/13
 * Time: 14:37
 */

namespace admin\model;


class goods
{
    //添加商品
    public function addGoods($good){
        $db = \core\db::getInstance();
        $sql = 'INSERT INTO `wx_shop_goods` (
                `name`,`categoryid`,`imgUrl`,`introductionImgs`,`price`,`netWeight`,`packaging`,`singleFruitWeight`,
                `brand`,`madeIn`,`fruitType`,`factoryName`,`factoryAddr`,`factoryPhone`,
                `qualityGuaranteePeriod`
              )VALUES (
                :name,:categoryid,:imgUrl,:introductionImgs,:price,:netWeight,:packaging,:singleFruitWeight,
                :brand,:madeIn,:fruitType,:factoryName,:factoryAddr,:factoryPhone,
                :qualityGuaranteePeriod
              )';
        $info = $db->query($sql)
                ->bind(array(
                            'name'=>$good['name'],
                            'categoryid'=>$good['categoryid'],
                            'price'=>$good['price'],
                            'imgUrl'=>$good['imgs'],
                            'introductionImgs'=>$good['introductionImgs'],
                            'netWeight'=>$good['netWeight'],
                            'packaging'=>$good['packaging'],
                            'singleFruitWeight'=>$good['singleFruitWeight'],
                            'brand'=>$good['brand'],
                            'madeIn'=>$good['madeIn'],
                            'fruitType'=>$good['fruitType'],
                            'factoryName'=>$good['factoryName'],
                            'factoryAddr'=>$good['factoryAddr'],
                            'factoryPhone'=>$good['factoryPhone'],
                            'qualityGuaranteePeriod'=>$good['qualityGuaranteePeriod']
                 ))
                 ->execute();
        if(!$info){
            return false;
        }
        return true;
    }

    //删除商品
    public function deleteGoods($goodid){
        $db = \core\db::getInstance();
        $sql = 'UPDATE
                    `wx_shop_goods`
                SET
                    `status`=0
                WHERE
                    `id`=:id
                ';
        $info = $db->query($sql)
            ->bind(array(
                'id'=>$goodid
            ))
            ->execute();
        if(!$info){
            return false;
        }
        return true;
    }

    /*
     * 获取商品
     */
    public function getGood($goodid){
        $db = \core\db::getInstance();
        $sql = "SELECT
                    `name`,`categoryid`,`imgUrl`,`introductionImgs`,`price`,`netWeight`,`packaging`,`singleFruitWeight`,
                    `brand`,`madeIn`,`fruitType`,`factoryName`,`factoryAddr`,`factoryPhone`,
                    `qualityGuaranteePeriod`
                FROM
                    `wx_shop_goods`
                WHERE
                    `id`=:id
                ";

        $good = $db->query($sql)
                    ->bind(array(
                        'id'=>$goodid
                    ))
                    ->fetch();
        if(empty($good)){
            return false;
        }
        return $good;
    }
    /*
     * 获取商品列表
        page  分页
        offset    偏移量
    */
    public function getGoodsList($page=0,$offset=10){

        $db = \core\db::getInstance();

        $sql = "SELECT `id`,`name`,`price`,`netWeight`,`brand`,`madeIn`,`fruitType`
               FROM `wx_shop_goods`
               WHERE `status`=1
              LIMIT ".$page*$offset." , $offset ";

        $info = $db->query($sql)
                    ->fetchAll();

        if(!$info){
            return false;
        }

        return $info;
    }

    /*
     * 获取所有的列数
     */
    public function getCount($table){
        $db = \core\db::getInstance();

        $sql = "SELECT COUNT(*) as cnt FROM `".$table."` WHERE `status`=1 ";

        $info = $db->query($sql)
            ->fetch();
        return $info['cnt'];
    }

}