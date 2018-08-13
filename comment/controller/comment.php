<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/25
 * Time: 0:03
 */

namespace comment\controller;


class comment extends \core\controller
{
    /*
     * 商品评论信息
     */
    public function goodComment(){
        global $dinfos;
        $goodid = $this->getRequest('goodid');

        $comment = \core\dphp::instance('\comment\model\comment');
        $commentData = $comment->getComment($goodid);

        echo json_encode($commentData);
    }
    /*
     * 获取商品所有的评论信息
     */
    public function goodComments(){
        $goodid = $this->getRequest('goodid');
        $comment = \core\dphp::instance('\comment\model\comment');
        $commentData = $comment->getComments($goodid);

        echo json_encode($commentData);
    }
}