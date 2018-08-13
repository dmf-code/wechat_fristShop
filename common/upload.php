<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/1/15
 * Time: 22:34
 */

// Make sure file is not cached (as it happens for example on iOS devices)
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
define('ROOT_PATH',dirname(__DIR__));
//echo ROOT_PATH.'<br/>';
$streamData = isset($GLOBALS['HTTP_RAW_POST_DATA'])? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
if(empty($streamData)){
    $streamData = file_get_contents('php://input');
}
if(empty($streamData)){
    die('上传数据不能为空！');
}
$postfix = explode('.',$_GET['name']);

$mdate = date('Y-m-d',time());

$pMkdir = ROOT_PATH.'/static/upload/'.$mdate;

if(!file_exists($pMkdir)){
    mkdir($pMkdir);
    chmod($pMkdir,0777);
}

$picName =md5(time().$postfix[0]).'.'.$postfix[1];
$picPath = $pMkdir.'/'.$picName;
$httpPicPath = 'fruitShop/static/upload/'.$mdate.'/'.$picName;
file_put_contents($picPath,$streamData);
//echo date('Y-m-d',time()).'/'.$picName;
//echo $httpPicPath.'<br/>';
$ip='118.89.20.107';
$port='6379';
$type = $_GET['uType'];

//    $redis = new Redis();
//    $info = $redis->pconnect($ip,$port,1);
//    if(!$info){
//        die('redis连接失败');
//    }
//
//    $title = 'fruitshop_upload_pic_'.$type;
//
//    $imgs = $redis->get($title);
//
//    if(!empty($imgs)){
//        $imgs = $imgs . ','.$httpPicPath;
//        $redis->set($title,$imgs);
//    }else{
//        $redis->set($title,$httpPicPath);
//    }
echo json_encode($httpPicPath);