<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/11
 * Time: 22:37
 */

namespace Home\Controller;


use Rice\Core\Controller;
use Rice\Core\Core;

class CategoryList extends Controller
{
    //分类列表
    public function index(){
        $id = $this->getRequest('id');
        $common = Core::instance('\Home\Model\Common');
        $info = $common->getCategoryGoodsList($id);
        if(!$info){
            #die('获取数据失败');
        }

        $this->assign('info',$info);
        $this->display();
    }
}