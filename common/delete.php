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

preg_match_all('#http://wx.dmf95.cn/fruitShop/(.*)#',$_POST['path'],$file);

$filePath = ROOT_PATH.'/'.$file[1][0];

if(file_exists($filePath)){
    if(unlink($filePath)){
        echo json_encode('删除图片成功');
    }else{
        echo json_encode('删除图片失败');
    }
}

