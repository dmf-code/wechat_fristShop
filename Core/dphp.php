<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2017/12/20
 * Time: 13:08
 */

namespace core;


class dphp
{
    //类映射
    private static $_map = array();
    //实例化对象
    private static $_instance = array();

    public function __construct()
    {
    }

    static public function run(){
        //加载文件
        \core\loader::start();

        //设置全局变量
        self::setGlobal();

        //路由转发
        \core\dispatcher::dispatch();

        //创建类对象
        \core\dphp::exec();

        //路由检测和反射
        route::check();
    }
    static public function setGlobal(){
        //全局模板变量
        $GLOBALS['dcache'] = \core\dphp::instance('\core\cache');
        //全局信息变量
        $GLOBALS['dinfos'] = \core\dphp::instance('\core\dinfos');
    }
    //创建当前的类
    static public function exec(){
        $class = MODULE_NAME.'\\controller\\'.CONTROLLER_NAME;
//        echo '<br/>';
//        echo $class;
//        echo '<br/>';
//        echo '准备创建控制器了';
//        echo '<br/>';
//        检测是否存在当前的类
//        var_dump(class_exists($class));
//        echo '<br/>';
        if(class_exists($class)) {

            self::$_instance[md5($class)] = new $class();
            //echo '创建控制器了';
        }
    }

    //取得对象实例
    static public function instance($class,$method=''){
        $identify = md5($class.$method);
        if(!isset(self::$_instance[$identify])){
            if(class_exists($class)){
                $o = new $class();
                if(!empty($method) && method_exists($o,$method)){
                    self::$_instance[$identify] = call_user_func(array(&$o,$method));
                }else{
                    self::$_instance[$identify] = $o;
                }
            }else{
                //错误处理 do something
                die('无法取得实例化对象！');
            }
        }

        return self::$_instance[$identify];
    }
}