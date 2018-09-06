<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/25
 * Time: 0:03
 */

namespace Comment\Controller;


use Rice\Core\Controller;
use Rice\Core\Core;

class Comment extends Controller
{
    /*
     * 商品评论信息
     */
    public function goodComment(){

        $goodid = $this->getRequest('goodid');

        $comment = Core::instance('\Comment\Model\Comment');
        $commentData = $comment->getComment($goodid);

        echo json_encode($commentData);
    }
    /*
     * 获取商品所有的评论信息
     */
    public function goodComments(){
        $goodid = $this->getRequest('goodid');
        $comment = Core::instance('\Comment\Model\Comment');
        $commentData = $comment->getComments($goodid);

        echo json_encode($commentData);
    }
}