<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/4
 * Time: 14:17
 */

namespace Home\Controller;


use Rice\Core\Controller;
use Rice\Core\Core;

class Address extends Controller
{
    //地址管理
    public function showAddress(){
        $infos = Core::get('Infos');
        $address = Core::instance('\Home\Model\Address');
        $addressList = $address->getAddressList($infos->get('userid'));

        $this->assign('addressList',$addressList);

        $this->display();
    }
    //创建收货地址
    public function createAddress(){

        $post = $this->getRequest('post');
        $infos = Core::get('Infos');
        if($post==1){//创建收货地址

            $address = explode(' ',$this->getRequest('address'));
            $data = array(
                'userid'=>$infos->get('userid'),
                'name'=>$this->getRequest('name'),
                'mobile'=>$this->getRequest('mobile'),
                'province'=>empty($address[0])?'':$address[0],
                'city'=>empty($address[1])?'':$address[1],
                'area'=>empty($address[2])?'':$address[2],
                'street'=>'',
                'zipCode'=>$this->getRequest('zipCode'),
                'detailAddress'=>$this->getRequest('detailAddress'),
                'default_address'=>0,
                'status'=>1
            );

            $address = Core::instance('\Home\Model\Address');
            $info = $address->createAddress($data);
//            if(!$info) {
//                dispatchJump('添加地址失败！', '', 'http://wx.dmf95.cn/fruitShop/index.php/home/address/createAddress');
//            }else{
//               dispatchJump('添加地址成功！','','http://wx.dmf95.cn/fruitShop/index.php/home/address/showAddress');
//            }
            header('Location: '.'/home/address/showAddress');
            return;
        }
        else if($post==2){//编辑收货地址

            $data = array(
                'addressid'=>$this->getRequest('addressid'),
                'name'=>$this->getRequest('name'),
                'mobile'=>$this->getRequest('mobile'),
                'address'=>$this->getRequest('address'),
                'zipCode'=>$this->getRequest('zipCode'),
                'detailAddress'=>$this->getRequest('detailAddress'),
                'post'=>3
            );
            $this->assign('address',$data);
        }else if($post==3){//修改收货地址
            $address = explode(' ',$this->getRequest('address'));

            $data = array(
                'userid'=>$infos->get('userid'),
                'addressid'=>$this->getRequest('addressid'),
                'name'=>$this->getRequest('name'),
                'mobile'=>$this->getRequest('mobile'),
                'province'=>empty($address[0])?'':$address[0],
                'city'=>empty($address[1])?'':$address[1],
                'area'=>empty($address[2])?'':$address[2],
                'zipCode'=>$this->getRequest('zipCode'),
                'detailAddress'=>$this->getRequest('detailAddress')
            );
            $address = Core::instance('\home\model\address');
            $info = $address->updateAddress($data);

            header('Location: '.'/home/address/showAddress');
            return;
        }

        $this->display();
    }
    //删除收货地址
    public function delAddress(){
        $addressid = $this->getRequest('addressid');
        $address = Core::instance('\home\model\address');
        $info = $address->delAddress($addressid);
        header('Location: '.'/home/address/showAddress');
        return;
    }

    //修改默认地址
    public function updateDefault(){
        $infos = Core::get('Infos');
        $data = array(
            'userid'=>$infos->get('userid'),
            'addressid'=>$this->getRequest('addressid')
        );
        $address = Core::instance('\home\model\address');
        $info = $address->updateDefault($data);

        header('Location: '.'/home/address/showAddress');
    }
}