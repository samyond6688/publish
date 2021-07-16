<?php

namespace App\Admin\Api;


use Illuminate\Support\Facades\Cache;

class Qweixin
{
    protected $corpid = 'ww245fc7dc10e8dc26';
    protected $corpsecret = '70U_eIVwQngUKNdvpqLPG_87sHcSZgrZuVjj3aE7id8';
    protected $agentid = 1000054;
    protected $redirect_uri = 'https://haiwai-admin.3kwan.com/admin';

    const GET_TOKEN = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken';
    const SET_MESSAGE = 'https://qyapi.weixin.qq.com/cgi-bin/message/send';
    const USER_ID = 'https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo';
    const USER_INFO = 'https://qyapi.weixin.qq.com/cgi-bin/user/get';

    public function getToken()
    {
        $access_token = Cache::get('access_token');
        if ($access_token) return $access_token;

        $response = self::curl(self::GET_TOKEN, [
            'corpid' => $this->corpid,
            'corpsecret' => $this->corpsecret,
        ], 0, 1);
        $response && $response = json_decode($response, true);
        if ($response['errcode'] == 0) {
            Cache::put('access_token', $response['access_token'], $response['expires_in'] - rand(10, 20));
        };
        return $response['access_token'] ?: '';
    }

    public function index()
    {
        $uri = urlencode('https://haiwai-admin.3kwan.com/admin'); //授权成功返回地址
//        $uri = urlencode($this->common_url . 'index.php?s=' . $action); //授权成功返回地址
        //下面$url请求授权登录地址,设置的是手动授权
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->corpid . '&redirect_uri=' . $uri . '&response_type=code&scope=snsapi_privateinfo&agentid=' . $this->agentid . '&state=STATE#wechat_redirect';
        header('Location:' . $url);
    }

    public function setmessage($touserid,$content)
    {
        $response = self::curl(self::SET_MESSAGE.'?access_token='.$this->getToken(), urldecode(json_encode([
            'agentid' => $this->agentid,
            'touser' => $touserid,
            'msgtype' => 'text',
            'text' => ['content' => $content],
            'safe' => 0,
            'access_token' => $this->getToken()
        ])), 1, 1);

        $response && $response = json_decode($response, true);
        return $response??[];
    }

    public function getUserId($code, $openId = false)
    {
        $response = self::curl(self::USER_ID, [
            'code' => $code,
            'access_token' => $this->getToken()
        ], 0, 1);
        $response && $response = json_decode($response, true);
        return $response['errcode'] == 0 ? $response['UserId'] : ($openId ? $response['OpenId'] : 0);
    }

    public function getUserInfo($UserId)
    {
        $response = self::curl(self::USER_INFO, [
            'userid' => $UserId,
            'access_token' => $this->getToken()
        ], 0, 1);
        //dump($response);
        $response && $response = json_decode($response, true);
        return $response??[];
    }

    /**
     * @param $url 请求网址
     * @param bool $params 请求参数
     * @param int $ispost 请求方式
     * @param int $https https协议
     * @return bool|mixed
     */
    public static function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }

        if ($ispost) {
            if (is_array($params)) {
                $params = http_build_query($params);
            }

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }


}