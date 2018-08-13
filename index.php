<?php
/*
 * author:DMF
 */
header("Content-type: text/html; charset=utf-8");
define('ROOT_PATH',__DIR__);
define('CORE_PATH',ROOT_PATH.'/core/');
define('CACHES_PATH',ROOT_PATH.'/caches/');
define('CONF_PATH',ROOT_PATH.'/conf/');
define('DEBUG',true);
session_start();

//判断是否第一次接入
if(!empty($_GET["echostr"])){
    require_once 'core/signature.php';
    $signature = new \core\signature();
    $signature->valid();
}

require_once  'core/common.php';
require_once 'core/loader.php';
require_once 'core/util.php';
require_once 'core/dphp.php';
require_once 'core/dinfos.php';

//执行路由转发，对象创建
\core\dphp::run();

//$vars->token = \core\util::getAccessToken();
//
//#var_dump($vars->token);
//#var_dump('1111111');
//#var_dump($vars);
//
//$logic = new \core\logic();
//$url = 'http://wx.dmf95.cn/oauth2.php';
//$menu = array("button"=>array(
//             array(
//                 "type"=>"click",
//                  "name"=>"优惠活动",
//                  "key"=>"perferentialActivities"
//                ),
//              array(
//                  "type"=>"click",
//                  "name"=>"汽车维修常识",
//                  "key"=>"carKnowlegde"
//                ),
//              array(
//                  "type"=>"view",
//                  "name"=>"个人中心",
//                  "key"=>"personal",
//                  "url"=>"https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$vars->appid."&redirect_uri=".$url."&response_type=code&scope=snsapi_userinfo&state=personal#wechat_redirect"
//                )
//            ));

#$info = $logic->menu('delete');
#var_dump($info);
#$info = $logic->menu('select');
#var_dump($info);
#echo '<br/>';
#$json = \core\util::json_encode($menu);
#var_dump($json);
#echo '<br/>';
#$info = $logic->menu('create',$json);
#var_dump($info);
