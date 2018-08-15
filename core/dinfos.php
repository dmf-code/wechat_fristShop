<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/3
 * Time: 17:20
 */

namespace core;


class dinfos
{
    private $vars;

    public function __construct()
    {
        $this->vars = array('userid'=>$_SESSION['userid'],'nickname'=>'DMF','headimgurl'=>'http://wx.qlogo.cn/mmopen/vi_32/geERgu7eveXJygcDxAnwiaKT1aoQ6ibppU8CXAtogtlAm4zUylkxhW5rCw90zIveOCwX7Thricnib05ajSmV2YrWIQ/0');
    }

    public function setInfo($key,$value){
        $this->vars[$key] = $value;
    }

    public function getInfo($key){
        $value = $this->vars[$key];
        if(empty($value)){
            return false;
        }
        return $value;
    }

}