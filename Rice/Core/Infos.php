<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/3/3
 * Time: 17:20
 */

namespace Rice\Core;


class Infos
{
    private $vars;

    /**
     * @param mixed $vars
     */
    public function set($key, $item)
    {

        if (!isset($this->vars[$key]) && is_string($key)) {
            $this->vars[$key] = $item;
            $this->{$key} = $item;
        }

        return $this->{$key};
    }

    public function get($key) {

        //个人设置
        if (isset($this->vars[$key])) {
            return $this->vars[$key];
        }
        //session
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

}