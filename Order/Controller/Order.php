<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/3
 * Time: 18:24
 */

namespace Order\Controller;

use Rice\Core\Controller;
use Rice\Core\Core;

class Order extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * 详细的订单
     */
    public function detailGoods(){
        $order = Core::instance('\Order\Model\Order');
        $infos = Core::get('Infos');
        var_dump($infos->get('userid'));
        $userid = $infos->get('userid');
        $goodid = $this->getRequest('goodid');

        $goods = $order->getGoods($goodid);

        //var_dump($goods);
        //处理自己的上传路劲
        $imgs = explode(',',$goods[0]['imgUrl']);
        foreach($imgs as $k=>$v){
            if(substr(ltrim($v),0,1)!='h'){
                //var_dump(substr($v,0,1));
                $imgs[$k] = $v;
            }
        }
        $goods[0]['imgUrl'] = implode(',',$imgs);

        $this->assign('goods',$goods);
        $address = $order->getAddress($userid);
        $this->assign('address',$address);

        $this->display();
    }

    /*
     * 添加详细的订单的数据
     */
    public function addDetailGoods(){
        $order = Core::instance('\Order\Model\Order');
        $infos = Core::get('Infos');
        var_dump($infos->get('userid'));
        $data = array(
            'userid'=>$infos->get('userid'),
            'goodid'=>$this->getRequest('goodid'),
            'goodnum'=>$this->getRequest('goodnum'),
            'price'=>$this->getRequest('price'),
            'addressid'=>$this->getRequest('addressid'),
            'name'=>$this->getRequest('name'),
            'imgs'=>$this->getRequest('imgs')
        );
        $info = $order->addDetailGoods($data);
        if(!$info){
            return false;
        }
        header('Location: /home/index/person');
    }

    /*
     * 支付页面
     */
    public function payment(){
        $infos = Core::get('Infos');
        $infos->get('userid');
        $detailid = $this->getRequest('detailid');
        $this->assign('detailid',$detailid);

        if(isAjax()){
            $payStyle = $this->getRequest('payStyle');
            echo json_encode($this->addOrder($payStyle));

            return;
        }
        $this->display();
    }
    /*
     * 取消支付
     */
    public function deletePayment(){
        $infos = Core::get('Infos');
        $userid = $infos->get('userid');
        $detailid = $this->getRequest('detailid');
        $order = Core::instance('\Order\Model\Order');
        $info = $order->deletePayment($userid,$detailid);
        if(!$info){
            header('Location: /order/order/pendingPayment');
            return false;
        }
        header('Location: /order/order/pendingPayment');
        return true;
    }

    /*
     * 添加订单
     */
    public function addOrder($payStyle){

        $infos = Core::get('Infos');
        $userid = $infos->get('userid');
        $detailid = $this->getRequest('detailid');
        $order = Core::instance('\Order\Model\Order');

        $info = $order->addOrder($userid,$payStyle,$detailid);
        if(empty($info)){
            return false;
        }
        return true;
    }
    /*
     * 更新订单
     */
    public function updateOrder(){

    }

    /*
     * 待付款信息
     */
    public function pendingPayment(){

        $infos = Core::get('Infos');
        $userid = $infos->get('userid');
        $order = Core::instance('\Order\Model\Order');
        $pendingPayment = $order->getPendingPayment($userid);
        //var_dump($pendingPayment);
        foreach($pendingPayment as $k=>$v){
            $goods = $order->getGoods($v['goodid']);
            $pendingPayment[$k]['goods'] = $goods;
        }

        //var_dump($pendingPayment);

        $this->assign('pendingPayment',$pendingPayment);
        $address = $order->getAddress($userid);
        $this->assign('address',$address);


        $this->display();
    }

    /*
     * 待发货信息
     */
    public function pendingDelivery(){

        $infos = Core::get('Infos');
        $userid = $infos->get('userid');
        $order = Core::instance('\Order\Model\Order');

        $pendingDelivery = $order->getPendingStatus($userid,1);

        foreach($pendingDelivery as $k=>$v){
            $detailids = explode(',',$v['detailids']);
            foreach($detailids as $kk=>$vv){

                $pendingDelivery[$k]['detailgoods'][] = $order->getOnePendingPayment($vv,2);
            }
        }

        $this->assign('pendingDelivery',$pendingDelivery);
        $this->display();
    }
    /*
     * 确认发货
     */
    public function addPendingDelivery(){

        $infos = Core::get('Infos');
        $userid = $infos->get('userid');
        $orderid = $this->getRequest('orderid');
        $order = Core::instance('\Order\Model\Order');
        $infos = $order->updateOrder($userid,$orderid,2);
        if(empty($infos)){
            return false;
        }
        header('Location: /home/index/person');
        return true;
    }
    /*
     * 待收货信息页面
     */
    public function pendingDelivery2(){
        $infos = Core::get('Infos');
        $userid = $infos->get('userid');
        $order = Core::instance('\Order\Model\Order');

        $pendingDelivery2 = $order->getPendingStatus($userid,2);

        foreach($pendingDelivery2 as $k=>$v){
            $detailids = explode(',',$v['detailids']);
            foreach($detailids as $kk=>$vv){

                $pendingDelivery2[$k]['detailgoods'][] = $order->getOnePendingPayment($vv,2);
            }
        }

        $this->assign('pendingDelivery2',$pendingDelivery2);
        $this->display();
    }
    /*
     * 确认收货
     */
    public function addPendingDelivery2(){

        $infos = Core::get('Infos');
        $userid = $infos->get('userid');
        $orderid = $this->getRequest('orderid');
        $order = Core::instance('\Order\Model\Order');
        $infos = $order->updateOrder($userid,$orderid,3);
        if(empty($infos)){
            return false;
        }
        header('Location: /home/index/person');
        return true;
    }
    /*
     * 待评价
     */
    public function toBeEvaluated(){
        $infos = Core::get('Infos');
        $userid = $infos->get('userid');
        $order = Core::instance('\Order\Model\Order');

        $toBeEvaluated = $order->getPendingStatus($userid,3);

        foreach($toBeEvaluated as $k=>$v){
            $detailids = explode(',',$v['detailids']);
            foreach($detailids as $kk=>$vv){

                $toBeEvaluated[$k]['detailgoods'][] = $order->getOnePendingPayment($vv,2);
            }
        }

        $this->assign('toBeEvaluated',$toBeEvaluated);
        $this->display();
    }
    /*
     * 添加评价
     */
    public function addToBeEvaluated(){

        $infos = Core::get('Infos');
        $userid = $infos->get('userid');
        $order = Core::instance('\Order\Model\Order');

        $orderid =$this->getRequest('orderid');

        if($this->getRequest('post')){
            $data = array(
                'comments'=>$this->getRequest('comments'),
                'fileUrls'=>$this->getRequest('fileUrls'),
                'goodid'=>$this->getRequest('goodid')
            );

            $info = $order->addComments($userid,$data);
            if(!empty($info)){
                $this->successComments($orderid);
            }

            header('Location: /home/index/person');
            return;
        }


        $toBeEvaluated = $order->getPendingStatus($userid,3);

        foreach($toBeEvaluated as $k=>$v){
            $detailids = explode(',',$v['detailids']);
            foreach($detailids as $kk=>$vv){

                $toBeEvaluated['detailgoods'][] = $order->getOnePendingPayment($vv,2);
            }
        }

        $this->assign('orderid',$orderid);
        $this->assign('toBeEvaluated',$toBeEvaluated);

        $this->display();
    }
    /*
     * 评论成功，订单评论完成
     */
    public function successComments($orderid){
        $infos = Core::get('Infos');
        $userid = $infos->get('userid');
        $order = Core::instance('\Order\Model\Order');
        $info = $order->updateOrder($userid,$orderid,4);

        if(empty($info)){
            return false;
        }
        return true;
    }
}