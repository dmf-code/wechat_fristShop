<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2017/12/20
 * Time: 16:09
 */

namespace Admin\Controller;


use Rice\Core\Controller;
use Rice\Core\Core;
use Rice\Core\Db;

class Index extends Controller
{
    private $tid;
    public function __construct()
    {
        parent::__construct();
        $this->tid = empty($this->getRequest('tid'))?null:$this->getRequest('tid');
    }

    public function admin(){

        $this->display('index');
    }

    //获取已创建的自定义菜单信息
    public function getData(){

        $wxlogic = Core::instance('\Rice\Core\WxLogic');
        $json = $wxlogic->menu('select');
        echo $json;
    }

    //微信自定义菜单
    public function customMenu(){

        $this->display();
    }

    //创建自定义菜单
    public function createMenu(){

        $menu = array("button"=>array());
        $data = $this->getRequest('menu');
        foreach($data['name'] as $k=>$v){
            $menu['button'][$k] = array('name'=>$v,'key'=>$data['key'][$k],'url'=>$data['url'][$k]);
            $subMenu = $this->getRequest('childmenu'.$data['time'][$k]);
            $menu['button'][$k]['type'] = $data['type'][$k];
            if(!empty($subMenu)){
                foreach($subMenu as $kk=>$vv){
                    $menu['button'][$k]['sub_button'][] = array(
                        'type'=>'click',
                        'name'=>$vv,
                        'key'=>md5($vv)
                    );
                }
            }
        }
        //var_dump($menu);
        $wxlogic = Core::instance('\Rice\Core\WxLogic');
        $wxlogic->menu('delete');
        $json = $wxlogic->menu('create',\core\util::json_encode($menu));

        $this->dispatchJump($json,$json,'admin');
    }

    //删除自定义菜单
    public function deleteMenu(){
        $wxlogic = Core::instance('\core\wxLogic');
        $json = $wxlogic->menu('delete');
        $error = null;
        if(@$json->errcode!==0){
            $error = '错误代码编号：'.@$json->errcode.'\n'.'错误信息：'.@$json->errmsg;
        }
        $this->dispatchJump('信息提交成功！',$error,'admin');
    }

    //添加商品
    public function addGoods(){

        if($this->getRequest('post')==1){
            $imgs = $this->getRequest('fileUrls');

            $good = array(
                'name'=>$this->getRequest('name'),
                'categoryid'=>$this->getRequest('category'),
                'price'=>$this->getRequest('price'),
                'imgs'=>empty($imgs[1])?'':implode($imgs[1]),
                'introductionImgs'=>empty($imgs[2])?'':implode($imgs[2]),
                'netWeight'=>$this->getRequest('netWeight'),
                'packaging'=>$this->getRequest('packaging'),
                'singleFruitWeight'=>$this->getRequest('singleFruitWeight'),
                'brand'=>$this->getRequest('brand'),
                'madeIn'=>$this->getRequest('madeIn'),
                'fruitType'=>$this->getRequest('fruitType'),
                'factoryName'=>$this->getRequest('factoryName'),
                'factoryAddr'=>$this->getRequest('factoryAddr'),
                'factoryPhone'=>$this->getRequest('factoryPhone'),
                'qualityGuaranteePeriod'=>$this->getRequest('qualityGuaranteePeriod'),
            );
            $model = Core::instance('admin\model\goods');
            $info = $model->addGoods($good);
            if(!$info){
                die('数据添加失败！');
            }
            //成功跳转函数
            $this->dispatchJump('商品添加成功！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/admin');
            return;
        }
        $this->display('addGoods',$this->tid);
    }

    //更新商品
    public function updateGoods(){
        $goodid = $this->getRequest('id');
        $goods = Core::instance('\admin\model\goods');
//        if($this->getRequest('post')==1){
//
//        }

        $good = $goods->getGood($goodid);

        $this->assign('good',$good);
        $this->display();
    }

    //删除商品
    public function deleteGoods(){
        $goodid = $this->getRequest('id');
        $goods = Core::instance('\admin\model\goods');
        $info = $goods->deleteGoods($goodid);
        if(!$info){
            $this->dispatchJump('删除失败',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingGoodsList');
        }else{
            $this->dispatchJump('删除成功',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingGoodsList');
        }
    }

    //获取商品列表
    public function operatingGoodsList($page=0,$offset=10){

        if(!empty($this->getRequest('page'))){
            $page = $this->getRequest('page');
        }

        $model = Core::instance('\admin\model\goods');
        $goods = $model->getGoodsList($page,$offset);
        $pSum = $model->getCount('wx_shop_goods');

        if(!$goods){
            die('获取商品列表失败！');
        }

        $this->assign('goods',$goods);
        $this->assign('pSum',$pSum);
        $this->assign('page',$page);
        $this->assign('offset',$offset);

        $this->display('operatingGoodsList',$page);
    }

    //添加商品种类
    public function addCategory(){
        if($this->getRequest('post')==1){
            $imgs = $this->getRequest('fileUrls');
            //var_dump($imgs);
            //var_dump($_POST['fileUrls']);
            //die;
            $category = array(
                'name'=>$this->getRequest('name'),
                'img'=>empty($imgs)?'':implode(',',$imgs)
            );
            $model = Core::instance('\admin\model\category');
            $info = $model->addCategory($category);
            if(!$info){
                $this->dispatchJump('水果标签数据添加失败！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/admin?tid=3');
                return;
            }
            $this->dispatchJump('水果分类添加成功！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/admin?tid=3');

            return;
        }
        $this->display('addCategory');
    }

    //更新商品种类
    public function updateCategory(){

        if($this->getRequest('post')==1){
            $imgs = $this->getRequest('fileUrls');

            $category = array(
                'name'=>$this->getRequest('name'),
                'img'=>empty($imgs)?'':implode(',',$imgs),
                'categoryid'=>$this->getRequest('id'),
                'status'=>$this->getRequest('status')
            );
            $model = Core::instance('\admin\model\category');
            $info = $model->updateCategory($category);
            if(!$info){
                $this->dispatchJump('水果标签数据更新失败！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/updateCategory?id='.$category['categoryid']);
                return;
            }
            $this->dispatchJump('水果分类更新成功！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingCategoryList');

            return;
        }
        $categoryid = $this->getRequest('id');

        $category = $this->getCategory($categoryid);

        $this->assign('category',$category);
        $this->display();
    }

    //获取商品种类
    public function getCategory($categoryid){
        $db = Db::getInstance();
        $sql = "SELECT
                      `categoryid`,`img`,`name`,`status`
                FROM
                      `wx_shop_category`
                WHERE
                      `categoryid`=:categoryid
                ";
        $info = $db->query($sql)
                    ->bind(array(
                        'categoryid'=>$categoryid
                    ))
                    ->fetch();
        if(empty($info)){
            return false;
        }
        return $info;
    }

    //删除商品种类
    public function deleteCategory(){
        $id = $this->getRequest('id');
        $category = Core::instance('\admin\model\category');
        $info = $category->deleteCategory($id);
        if(!$info){
            $this->dispatchJump('删除商品标签失败！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingCategoryList');
        }else{
            $this->dispatchJump('删除商品标签成功！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingCategoryList');
        }
		
    }

    //获取商品种类列表
    public function operatingCategoryList(){
        $category = Core::instance('\admin\model\category');
        $info = $category->getCategoryList();
        if(!$info){
            return false;
        }

        $this->assign('categorys',$info);
        $this->display();
    }

    //获取商品种类列表api
    public function getCategoryList(){
        $category = Core::instance('\admin\model\category');
        $info = $category->getCategoryList();
        if(!$info){
            return false;
        }
        echo json_encode($info);

        return $info;
    }

    /*
     * 前端首页轮播图操作
     */
    public function addHomeCarousel(){

        if($this->getRequest('post')==1){
            $data['detailid'] = $this->getRequest('detailid');
            $imgs = $this->getRequest('fileUrls');
            if(!empty($imgs)) {
                $data['imgs'] = implode(',', $imgs);
            }else{
                $data['imgs'] = '';
            }
            $homeInfo = Core::instance('\admin\model\homeInfo');
            $info = $homeInfo->addImgs($data);
            if(!$info){
                $this->dispatchJump('添加失败！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingHomeCarousel');
            }else{
                $this->dispatchJump('添加成功！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingHomeCarousel');
            }
            return;
        }

        $this->display();
    }

    /*
  * 前端首页轮播图更新操作
  */
    public function updateHomeCarousel(){

        $homeInfoId = $this->getRequest('id');
        if($this->getRequest('post')==1){
            $data['detailid'] = $this->getRequest('detailid');
            $imgs = $this->getRequest('fileUrls');
            if(!empty($imgs)) {
                $data['imgs'] = implode(',', $imgs);
            }else{
                $data['imgs'] = '';
            }

            $data['homeInfoId'] = $homeInfoId;
            $homeInfo = Core::instance('\admin\model\homeInfo');
            $info = $homeInfo->updateHomeCarousel($data);

            if(!$info){
                $this->dispatchJump('添加失败！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/updateHomeCarousel?id='.$homeInfoId);

            }else{
                $this->dispatchJump('添加成功！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingHomeCarousel');
            }
            return;
        }
        $homeInfo = Core::instance('\admin\model\homeInfo');
        $homeCarousel = $homeInfo->getHomeCarousel($homeInfoId);
        $this->assign('homeCarousel',$homeCarousel);

        $this->display();
    }

    /*
     * 前端首页轮播图删除操作
     */
    public function deleteHomeCarousel(){
        $homeInfoId = $this->getRequest('id');
        $homeInfo = Core::instance('\admin\model\homeInfo');
        $info = $homeInfo->deleteHomeCarousel($homeInfoId);
        if(empty($info)){
            $this->dispatchJump('删除失败',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingHomeCarousel');
            return;
        }
        $this->dispatchJump('删除成功',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/operatingHomeCarousel');
    }

    /*
     * 前端首页模块添加
     */
    public function addHomeMoudle(){

        if($this->getRequest('post')==1){

            $data = array(
                'name'=>$this->getRequest('name'),
                'recommend'=>$this->getRequest('recommend')
            );
            $homeMoudle = Core::instance('\admin\model\homeMoudle');
            $info = $homeMoudle->addMoudle($data);
            if(!$info){
                $this->dispatchJump('模块添加失败！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/addHomeMoudle');
            }else{
             $this->dispatchJump('模块添加成功！',null,'http://wx.dmf95.cn/fruitShop/index.php/admin/index/addHomeMoudle');
            }
            return;
        }

        $this->display();

    }


    /*
         * 首页轮播图列表
         */
    public function operatingHomeCarousel(){

        $homeInfo = Core::instance('\Admin\Model\HomeInfo');

        $homeCarousel = $homeInfo->getHomeCarousel();

        $this->assign('homeCarousel',$homeCarousel);

        $this->display();
    }

    /*
     * 首页模块列表
     */
    public function operatingMoudleList(){

        $homeMoudle = Core::instance('\Admin\Model\HomeMoudle');

        $moudleList = $homeMoudle->getMoudleList();

        $this->assign('moudleList',$moudleList);

        $this->display();
    }

    /*
     * 获取订单列表
     */
    public function operatingOrderList(){

        $order = Core::instance('\admin\model\order');

        $orderList = $order->getOrderList();

        $this->assign('orderList',$orderList);

        $this->display();
    }

    /*
     * 更新订单
     */
    public function updateOrder(){
        $order = Core::instance('\admin\model\order');
        $orderid = $this->getRequest('id');
        $status = $this->getRequest('status');
        $order->updateOrder($orderid,$status);

    }
}

