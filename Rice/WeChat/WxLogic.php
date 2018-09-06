<?php

/*
 * author:DMF
 */

namespace core;


class wxLogic{

    private $config;

    public function __construct()
    {
        $this->config = require_once ROOT_PATH . '/Conf/Wechat.php';
        $this->config['access_token'] = $this->getAccessToken();
    }

    /*
     * 自定义菜单操作
     */
    public function menu($type,$json=null){
        $info = null;
        switch($type){
            case 'create':
                $info = \core\util::curl_require(
                    'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='
                    .$this->config['access_token']
                    ,$json);
                break;
            case 'select':
                $info = \core\util::curl_require(
                    'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='
                    .$this->config['access_token']);
                break;
            case 'delete':
                $info = \core\util::curl_require(
                    'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='
                    .$this->config['access_token']);
                break;
        }
        return $info;
    }

    /*
     * 返回信息处理
     */
    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $msgType = $postObj->MsgType;
            $event = $postObj->Event;
            $eventKey = $postObj->EventKey;
            $time = time();
            $textTpl = "<xml>
                                    <ToUserName><![CDATA[%s]]></ToUserName>
                                    <FromUserName><![CDATA[%s]]></FromUserName>
                                    <CreateTime>%s</CreateTime>
                                    <MsgType><![CDATA[%s]]></MsgType>
                                    <Content><![CDATA[%s]]></Content>
                                    <FuncFlag>0</FuncFlag>
                                    </xml>";
            if($msgType=='event'){
                switch($event){
                    case 'CLICK':

                        if($postObj->EventKey == 'recommend'){
                            $msgType = "text";
                            $contentStr = "今日推荐：奇异果";
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            echo $resultStr;
                        }
                        break;
                    default:
                        break;
                }
            }
            else if(!empty( $keyword ))
            {
                $msgType = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else{
                echo "Input something...";
            }

        }else {
            echo '没数据';
            echo "";
            exit;
        }
    }

    /*
	 * 获取微信公众号内部access_token过时时间
	 */
    public function getEndTime(){
        $sql = 'SELECT `accessToken`,`endTime` FROM `wx_accessToken`;';
        $db = \core\db::getInstance();
        $info = $db->query($sql)
            ->fetch();
        if(!$info){
            return false;
        }
        return $info;
    }
    /*
     * 获取微信公众号网页授权access_token过时时间
     */
    public function getWebEndTime(){
        $sql = 'SELECT `openId`,``accessToken`,`refreshToken`
						,`scope`, `aEndTime` , `rEndTime`
			   FROM `wx_web_accessToken`;';
    }

    /*
     * 请求获取Token
     */
    public function getAccessToken(){

        $time = time();
        $info = self::getEndTime();

        if($time >= $info['endTime']-50){

            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->config['appid'].'&secret='.$this->config['appsecret'];

            $json = \core\util::curl_require($url);

            $info = json_decode($json);

            $db = \core\db::getInstance();

            $endTime = time() + 6500;

            $sql = 'UPDATE
						`wx_accessToken`
					SET
						`accessToken`=:accessToken ,`endTime`=:endTime
					WHERE `id`=0;';

            $info = $db->query($sql)
                ->bind(array(
                    'accessToken'=>$info->access_token,
                    'endTime'=>$endTime
                ))
                ->execute();
        }

        return $info['accessToken'];
    }

    /*
     * 请求网页授权的code
     */
    public function getCode($redirect_uri=null,$state=null){

        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='
            .$this->config['appid']
            .'&redirect_uri='
            .urlencode($redirect_uri)
            .'&response_type=code&scope=snsapi_userinfo&state='
            .'STATE'
            .'#wechat_redirect';

        //执行url微信验证后跳转到$redirect_uri地址
        header('location:'.$url);
    }
    /*
     * 请求网页授权的token
     */
    public function getWebAccessToken($code){

        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='
            .$this->config['appid']
            .'&secret='
            .$this->config['appsecret']
            .'&code='
            .$code
            .'&grant_type=authorization_code';

        $json = \core\util::curl_require($url);
        $info = json_decode($json);

        $this->config['web_access_token'] = $info->access_token;
        $this->config['web_refresh_token'] = $info->refresh_token;
        $this->config['web_openid'] = $info->openid;
        //var_dump($this->config);
    }
    /*
     * 请求网页授权的用户信息
     */
    public function getUserInfo(){

        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='
            .$this->config['web_access_token']
            .'&openid='
            .$this->config['web_openid']
            .'&lang=zh_CN';

        $json = \core\util::curl_require($url);
        //var_dump($json);
        $info = json_decode($json);

        return $info;
    }
}