<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/25
 * Time: 11:57
 */

namespace Comment\Model;


use Rice\Core\Db;

class Comment
{
    /*
     * 获取单条评论
     */
    public function getComment($goodid){
        $db = Db::getInstance();
        $sql = "
                SELECT
                        `commentid`,`goodid`,`userid`,`headimgurl`,
                        `nickname`,`content`,
                        `commentGoodsUrl`,`createTime`,`status`
                FROM
                        `wx_shop_comment`
                WHERE
                        `goodid`=:goodid
                ";
        $info = $db->query($sql)
                    ->bind(array(
                        'goodid'=>$goodid
                    ))
                    ->fetch();
        if(empty($info)){
            return false;
        }
        return $info;
    }
    /*
     * 获取该商品所有评论
     */
    public function getComments($goodid){
        $db = Db::getInstance();
        $sql = "
                SELECT
                        `commentid`,`goodid`,`userid`,`headimgurl`,
                        `commentGoodsUrl`,`createTime`,`status`
                FROM
                        `wx_shop_comment`
                WHERE
                        `goodid`=:goodid
                ";
        $info = $db->query($sql)
            ->bind(array(
                'goodid'=>$goodid
            ))
            ->fetchAll();
        if(empty($info)){
            return false;
        }
        return $info;
    }

}