<?php
defined('BASE_PATH') || exit('ERROR::禁止访问');
class parentModel extends baseModel
{
    public $db;
    public function __construct()
    {
    }
    public function __destruct()
    {
    }
}
// 可以在顶部使用require
class pddClient
{
    public $serverUrl = "http://open.yangkeduo.com/api/router";
    public $accessToken = ''; // 拼多多后台申请的的clientId

    public $clientId = ''; // 拼多多后台申请的的secret
    public $clientSecret = '';
    public $connectTimeout = 5; //成功链接到服务器前，等待多久后断开
    public $timeout = 10; // 成功链接到服务器后，等待多久后断开

    //参数1：访问的URL，参数2：post数据(不填则为GET)，参数3：提交的$cookies,参数4：是否返回$cookies
    public function curl($url, $post ='', $cookie='', $returnCookie=0)
    {
        //初始化
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, ["content-type: application/json; charset=UTF-8"]);
        curl_setopt($handle, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)'); //浏览器UA
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, 1); //跟踪爬取重定向页面
        curl_setopt($handle, CURLOPT_AUTOREFERER, 1); //当根据Location:重定向时，自动设置header中的Referer:信息
        curl_setopt($handle, CURLOPT_REFERER, "http://www.xxx.com"); //我们就把referer地址伪装为http://www.xxxx.com，用这个检测：$_SERVER['HTTP_REFERER'];
        curl_setopt($handle, CURLOPT_HEADER, $returnCookie); // 把一个头包含在输出中，设置这个选项为一个非零值
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5); //成功链接到服务器前，等待多久后断开，用于服务器当机，反应慢时
        curl_setopt($handle, CURLOPT_TIMEOUT, 10); //成功链接到服务器后，等待多久后断开，用于下载大文件等
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1); //1或ture返回的内容作为变量储存，而不是直接输出
        curl_setopt($handle, CURLOPT_FAILONERROR, false); // 如果成功只将结果返回，不自动输出任何内容。如果失败返回FALSE

            //https 请求
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https") {
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        }
        //post 请求
        if ($post) {
            curl_setopt($handle, CURLOPT_POST, 1); //你想PHP去做一个正规的HTTP POST，设置这个选项为一个非零值
            curl_setopt($handle, CURLOPT_POSTFIELDS, $post);
        }
        if ($cookie) {
            curl_setopt($handle, CURLOPT_COOKIE, $cookie);
        }
        //执行发送请求，返回数据
        $data = curl_exec($handle);

        if (curl_errno($handle)) {
            return curl_error($handle);
        }
        //关闭
        curl_close($handle);
        if ($returnCookie) {
            list($header, $body) = explode("\r\n\r\n", $data, 2);
            preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
            $info['cookie']  = substr($matches[1][0], 1);
            $info['content'] = $body;
            return $info;
        } else {
            return $data;
        }
    }
}


function myException($exception)
{
    echo "<b>异常消息:</b> " , $exception->getMessage();
}

set_exception_handler('myException');
