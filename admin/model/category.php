<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/2/3
 * Time: 23:04
 */

namespace admin\model;

class category
{
    /*
     * 增加商品标签
     */
    public function addCategory($category){
        $db = \core\db::getInstance();
        $sql = 'INSERT INTO `wx_shop_category` (
                  `name`,`img`,`status`
                )VALUES (
                  :name,:img,:status
                )';
        $info = $db->query($sql)
                    ->bind(array(
                        'name'=>$category['name'],
                        'img'=>$category['img'],
                        'status'=>1
                    ))
                    ->execute();

        if(!$info){
            return false;
        }
        return true;
    }
    /*
     * 获取商品标签
     */
    public function getCategoryList(){
        $db = \core\db::getInstance();
        $sql = 'SELECT `categoryid`,`name`,`status`
                FROM `wx_shop_category`
                WHERE `status`=1';
        $info = $db->query($sql)
                    ->fetchAll();
        if(!$info){
            return false;
        }
        return $info;
    }

    /*
     * 更新商品标签
     */
    public function updateCategory($category){
        $db = \core\db::getInstance();
        $sql = 'UPDATE
                    `wx_shop_category`
                SET
                    `img`=:img,`name`=:name,
                    `status`=:status
                WHERE `categoryid`=:categoryid ';

        $info = $db->query($sql)
                    ->bind(array(
                        'img'=>$category['img'],
                        'name'=>$category['name'],
                        'status'=>$category['status'],
                        'categoryid'=>$category['categoryid']
                    ))
            ->execute();
        if(!$info){
            return false;
        }
        return $info;
    }

    /*
     * 删除商品标签
     */
    public function deleteCategory($id){

        $db = \core\db::getInstance();
        $sql = "UPDATE `wx_shop_category`
                SET `status`=0
                WHERE `categoryid`=:id";
        $info = $db->query($sql)
                ->bind(array(
                    'id'=>$id
                ))
                ->execute();
        if(!$info){
            return false;
        }
        return true;
    }
}