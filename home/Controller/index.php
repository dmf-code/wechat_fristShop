<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2017/12/18
 * Time: 17:08
 */

namespace Home\Controller;


use Rice\Core\Controller;
use Rice\Core\Core;

class Index extends Controller
{
    //微信逻辑类
    public $wxLogic;
    public function __construct()
    {
        parent::__construct();
        //$this->wxLogic = Core::instance('\Rice\WeChat\WxLogic');
    }
    //默认的微信消息交互函数
    public function index(){
        //接收微信传来的click信息
        //$this->wxLogic->responseMsg();
    }
    //跳转去验证
    public function toGrantAuthorization(){
        $redirect_uri='http://wx.dmf95.cn/fruitShop/index.php/home/index/home';
        $state='state';
        $this->wxLogic->getCode($redirect_uri,$state);

    }
    //首页
    public function home(){

        $code = $this->getRequest('code');

//        if(empty($code)){
//            header('location: http://wx.dmf95.cn/fruitShop/tpl/wxError.html');
//        }
        //$state = $this->getRequest('state');

        $common = Core::instance('\Home\Model\Common');
        //考虑在非微信网页上也可以给别人观看
        if(empty($code)&&empty($_SESSION['userid'])){
            $_SESSION['userid'] = 2;
        }

        if(!empty($code)&&empty($_SESSION['userid'])) {
            $this->wxLogic->getWebAccessToken($code);

            $info = $this->wxLogic->getUserInfo();
            //var_dump($info);
            $userid = $common->saveUserInfo($info);
            $_SESSION['userid'] = $userid;
        }

        //var_dump($_SESSION['userid']);


        $carouseList = $common->getHomeCarouse();
        $moudleList = $common->getHomeMoudle();
        $this->assign('carouseList',$carouseList);
        $this->assign('moudleList',$moudleList);

        $this->display();
    }

    //分类菜单
    public function category(){
        $common = Core::instance('\Home\Model\Common');
        //分类菜单
        $index = $common->getCategoryList();

        $this->assign('index',$index);
        $this->display();
    }

    //about关于我们
    public function about(){

        $this->display();
    }

    //我的
    public function person(){

        $infos = Core::get('Infos');
        $userid = $infos->get('userid');
        $order = Core::instance('\Home\Model\Order');
        /*
         * 模板变量信息
         */
        $common = Core::instance('\Home\Model\Common');
        //var_dump($_SESSION['userid']);
        $userinfo = $common->getUserInfo($_SESSION['userid']);
        $this->assign('userinfo',$userinfo);

        $pendingPayment = $order->pendingPayment($userid);
        $this->assign('pendingPayment',$pendingPayment);
        $pendingDelivery = $order->getOrderStatus($userid,1);
        $this->assign('pengingDelivery',$pendingDelivery);
        $pendingDelivery2 = $order->getOrderStatus($userid,2);
        $this->assign('pengingDelivery2',$pendingDelivery2);
        $toBeEvaluated = $order->getOrderStatus($userid,3);
        $this->assign('toBeEvaluated',$toBeEvaluated);
        $this->display();
    }


}