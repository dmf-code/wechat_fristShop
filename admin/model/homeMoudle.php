<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/2/19
 * Time: 15:15
 */

namespace admin\model;


class homeMoudle
{

    /*
     * 添加水果模块
     */
    public function addMoudle($data){

        $db = \core\db::getInstance();
        $sql = "INSERT INTO `wx_shop_home_moudle` (
                  `name`,`recommend`
                ) VALUES (
                  :name,:recommend
                )";
        $info = $db->query($sql)
                    ->bind(array(
                        'name'=>$data['name'],
                        'recommend'=>$data['recommend']
                    ))
                    ->execute();

        if(!$info){
            return false;
        }

        return true;
    }
    /*
     * 获取水果模块
     */
    public function getMoudle(){

        $db = \core\db::getInstance();
        $sql = "SELECT `name`,`recommend` FROM `wx_shop_home_moudle`";
        $data = $db->query($sql)
                    ->fecthAll();
        $sql = "SELECT `id`,`name`,`imgUrl` FROM `wx_shop_goods`
                WHERE `id`=:id ";
        foreach($data as $k=>$v){
            $goodListId = explode(',',$v['recommend']);
            $data['goods'] = array();
            foreach($goodListId as $kk=>$vv){
                $good = $db->query($sql)
                    ->bind(array(
                        'id'=>$vv
                    ))
                    ->fetch();
                $data['goods'].array_push($good);
            }
        }

        return $data;
    }

    /*
     * 获取水果模块列表
     */
    public function getMoudleList(){
        $db = \core\db::getInstance();
        $sql = "SELECT `moudleid`,`name`,`recommend`,`status` FROM `wx_shop_home_moudle`";
        $info = $db->query($sql)
                    ->fetchAll();
        if(!$info){
            return false;
        }
        return $info;
    }
}