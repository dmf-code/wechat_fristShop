<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/7
 * Time: 10:12
 */

namespace home\model;


class common
{
    /*
     * 保存UserInfo
     */
    public function saveUserInfo($info){
        $db = \core\db::getInstance();
        $sql = 'SELECT id
                FROM `wx_web_userinfo`
                WHERE `openid`=:openid;';
        $data =$db->query($sql)
                    ->bind(array(
                        'openid'=>$info->openid
                    ))
                    ->fetch();
        if($data){
            return $data['id'];
        }
        $sql = 'INSERT INTO `wx_web_userinfo` (
                  `openid`,`nickname`,
                  `sex`,`province`,`city`,
                  `country`,`headimgurl`
                )VALUES(
                  :openid,:nickname,
                  :sex,:province,:city,
                  :country,:headimgurl
                )';
        $data = $db->query($sql)
                    ->bind(array(
                        'openid'=>$info->openid,
                        'nickname'=>$info->nickname,
                        'sex'=>$info->sex,
                        'province'=>$info->province,
                        'city'=>$info->city,
                        'country'=>$info->country,
                        'headimgurl'=>$info->headimgurl
                    ))
                    ->execute();

        if($data){
            return true;
        }
        return $db->getLastId();
    }
    /*
     * 获取userInfo
     */
    public function getUserInfo($userid){

        $sql = 'SELECT
                `id`,`nickname`,`sex`,
                `province`,`city`,`country`,
                `headimgurl`
                FROM `wx_web_userinfo`
                WHERE `id`=:userid';
        $db = \core\db::getInstance();
        $info = $db->query($sql)
                    ->bind(array(
                        'userid'=>$userid
                    ))
                    ->fetch();
        if(!$info){
            return false;
        }
        return $info;
    }

    /*
     * 获取分类列表信息
     */
    public function getCategoryList(){
        $db = \core\db::getInstance();
        $sql = "SELECT `categoryid`,`name`,`img`
                FROM `wx_shop_category`
                WHERE `status`=1
                ;";
        $info = $db->query($sql)
                    ->fetchAll();
        if(!$info){
            return false;
        }
        return $info;
    }

    /*
     * 获取水果分类的简略信息
     */
    public function getCategoryGoodsList($id){
        $db = \core\db::getInstance();
        $sql = "SELECT `id`,`name`,`imgUrl`,`price`
                FROM `wx_shop_goods`
                WHERE `categoryid`=:categoryid AND `status` = 1
                ";
        $info = $db->query($sql)
                    ->bind(array(
                        'categoryid'=>$id
                    ))
                    ->fetchAll();
        if(!$info){
            return false;
        }
        return $info;
    }
    /*
     * 获取水果详细信息
     */
    public function getGood($id){

        $db = \core\db::getInstance();

        $sql = "SELECT `id`,`name`,`imgUrl`,`introductionImgs`,`price`,`netWeight`,`packaging`,
                `singleFruitWeight`,`brand`,`madeIn`,`fruitType`,`factoryName`,
                `factoryAddr`,`factoryPhone`,`qualityGuaranteePeriod`,`categoryid`
                FROM `wx_shop_goods`
                WHERE `id`=:id;
                ";
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

    /*
     * 获取首页轮播图信息
     */
    public function getHomeCarouse(){
        $db = \core\db::getInstance();
        $sql = "SELECT
                      `homeInfoId`,`imgs`,`detailid`
                FROM
                      `wx_shop_home_info`
                WHERE
                      `status`=1
                ";
        $info = $db->query($sql)
                    ->fetchAll();
        if(!$info){
            return false;
        }
        return $info;
    }

    /*
     * 获取水果模块
     */
    public function getHomeMoudle(){

        $db = \core\db::getInstance();
        $sql = "SELECT `name`,`recommend` FROM `wx_shop_home_moudle`";
        $data = $db->query($sql)
            ->fetchAll();
        $sql = "SELECT `id`,`name`,`imgUrl` FROM `wx_shop_goods`
                WHERE `id`=:id ";
        foreach($data as $k=>$v){
            $goodListId = explode(',',$v['recommend']);
            $data[$k]['goods'] = array();
            foreach($goodListId as $kk=>$vv){
                $good = $db->query($sql)
                    ->bind(array(
                        'id'=>$vv
                    ))
                    ->fetch();

                $data[$k]['goods'][] = $good;
            }
        }

        return $data;
    }

    /*
     * 获取收货地址
     */
    public function getAddress($userid){
        $db = \core\db::getInstance();
        $sql = "SELECT `addressid`,`userid`,`name`,`mobile`,`province`,
                `city`,`area`,`street`,`zipCode`,`detailAddress`
                FROM `wx_shop_address`
                WHERE `userid`=:userid;";

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
     * 获取评论信息
     */
    public function getComments($userid,$goodid,$limit,$len=10){
        $db = \core\db::getInstance();
        $sql = "SELECT
                    `commentid`,`goodid`,`headimgurl`,
                    `commentGoodsUrl`,`nickname`,`content`,
                    `createtime`
                FROM
                    `wx_shop_comment`
                WHERE
                    `goodid`=:goodid AND
                    `status`= 1
                LIMIT $limit,$len
                ";
        $infos = $db->query($sql)
                    ->bind(array(
                        'goodid'=>$goodid
                    ))
                    ->fetchAll();

        if(empty($infos)){
            return false;
        }
        if(isAjax()){
            echo json_encode($infos);
            return;
        }
        return $infos;
    }

}