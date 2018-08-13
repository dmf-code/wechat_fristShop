<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/11
 * Time: 22:37
 */

namespace home\controller;


use core\controller;

class categoryList extends controller
{
    //分类列表
    public function index(){
        $id = $this->getRequest('id');
        $common = \core\dphp::instance('\home\model\common');
        $info = $common->getCategoryGoodsList($id);
        if(!$info){
            #die('获取数据失败');
        }
        $this->assign('info',$info);
        $this->display();
    }
}