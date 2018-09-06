<?php
/*
 * author:DMF
 */
header("Content-type: text/html; charset=utf-8");
define('ROOT_PATH',__DIR__);
define('CORE_PATH',ROOT_PATH.'/Core/');
define('CACHES_PATH',ROOT_PATH.'/Caches/');
define('CONF_PATH',ROOT_PATH.'/Conf/');
define('DEBUG',true);
session_start();

//加载引导程序
require_once('./Rice/Bootstarp.php');

//执行路由转发，对象创建
\Rice\Core\Core::run();

