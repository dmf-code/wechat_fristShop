<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/2/19
 * Time: 13:32
 */

namespace admin\model;


class homeInfo
{
    public function __construct()
    {
    }
    /*
     * 增加图片
     */
    public function addImgs($data){
        $db = \core\db::getInstance();
        $sql = "INSERT INTO `wx_shop_home_info` (
                  `imgs`,`detailid`
                )VALUES (
                  :imgs,:detailid
                )";
        $info = $db->query($sql)
            ->bind(array(
                'imgs'=>$data['imgs'],
                'detailid'=>$data['detailid']
            ))
            ->execute();

        if(!$info){
            return false;
        }

        return true;

    }

    /*
     * 更新轮播图数据
     */
    public function updateHomeCarousel($data){
        $db = \core\db::getInstance();

        $sql = "UPDATE
                       `wx_shop_home_info`
                SET
                ";
        if(!empty($data['imgs'])){
            $sql .= '`imgs`=:imgs,';
            $values['imgs'] = $data['imgs'];
        }
            $sql .="
                      `detailid`=:detailid
                WHERE
                      `homeInfoId`=:homeInfoId
                ";
        $values['detailid'] = $data['detailid'];
        $values['homeInfoId'] = $data['homeInfoId'];

        $info = $db->query($sql)
                    ->bind($values)
                    ->execute();
        if(empty($info)){
            return false;
        }
        return true;
    }

    /*
     * 删除轮播图数据
     */
    public function deleteHomeCarousel($homeInfoId){
        $db = \core\db::getInstance();

        $sql = "UPDATE
                       `wx_shop_home_info`
                SET
                    `status`=0
                WHERE
                    `homeInfoId`=:homeInfoId
                ";

        $info = $db->query($sql)
            ->bind(array(
                'homeInfoId'=>$homeInfoId
            ))
            ->execute();
        if(empty($info)){
            return false;
        }
        return true;
    }

    /*
     * 轮播图
     */
    public function getHomeCarousel($id=null){

        $db = \core\db::getInstance();
        $sql = "SELECT
                    `homeInfoId`,`imgs`,`detailid`,`status`
                FROM
                    `wx_shop_home_info`
                ";
        $arr = array();
        if(!empty($id)){
            $sql .= ' WHERE `homeInfoId`=:homeInfoId AND `status`=1 ';
            $arr['homeInfoId'] = $id;
        }else{
            $sql .= ' WHERE `status`=1 ';
        }
        $infos = $db->query($sql)
                    ->bind($arr)
                    ->fetchAll();

        if(empty($infos)){
            return false;
        }

        return $infos;
    }

}