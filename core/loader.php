<?php

namespace core;

class loader{

    public static function start(){

        spl_autoload_register('\core\loader::autoload');
    }

    //类自动加载
    public static function autoload($class){
        #echo $class;
        //注意要置换这里面的反斜杠，因为linux上面只接受斜杠
        //echo '<br/>'.$class.'<br/>';
        $fileUrl = ROOT_PATH.'/'.str_replace('\\','/',$class).'.php';
        #echo $fileUrl;
        if(file_exists($fileUrl)){
            require_once $fileUrl;
        }else{
            throw new \Exception('不存在'.$fileUrl.'类文件。');
        }

    }

    /*
     *获取实例函数
     *
     */


}