<?php

$url_page = "http://2.taobao.com/credit/credit.htm?userId=43432324";  //ip138核心是iframe重新加载的网页  http://1111.ip138.com/ic.asp
$user_agent = "Mozilla/4.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.47 Safari/536.11";
$proxy = "192.168.1.4:808";    //此处为代理服务器IP和PORT，使用本机调试

$string = curl_string($url_page,$user_agent,$proxy);

echo $string;
echo $string;


function curl_string ($url,$user_agent,$proxy){
$ch = curl_init();
curl_setopt ($ch, CURLOPT_PROXY, $proxy);
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_HTTPHEADER, array('CLIENT-IP:111.111.111.110', 'X-FORWARDED-FOR:111.111.111.110'));  //此处可以改为任意假IP
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt ($ch, CURLOPT_TIMEOUT, 120);
curl_setopt ($ch, CURLOPT_REFERER, "http://s.taobao.com/");  //页面来源伪造

$result = curl_exec ($ch);
curl_close($ch);
return $result;
}


function post($url,$cont){
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);

curl_setopt ($ch, CURLOPT_POST, 1); // post请求
curl_setopt ($ch, CURLOPT_POSTFIELDS, "ie=UTF-8&wd=curl_setopt");  //post内容

curl_setopt ($ch, CURLOPT_REFERER, "http://s.taobao.com/");  //页面来源
curl_setopt ($ch, CURLOPT_USERAGENT, $user_agent); //UA

// curl_setopt ($ch, CURLOPT_HTTPHEADER, array('CLIENT-IP:111.111.111.110', 'X-FORWARDED-FOR:111.111.111.110'));  //设置头信息，此处可以改为任意假IP

curl_setopt ($ch, CURLOPT_HEADER, 1); //设定是否输出页面内容
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); //设定是否显示头信息
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1); // 服务器会把它当做HTTP头的一部分发送
curl_setopt ($ch, CURLOPT_TIMEOUT, 120);  // 等待最大延续多少秒
curl_setopt ($ch, CURLOPT_COOKIE, "ie=UTF-8&wd=curl_setopt"); // 传递一个包含HTTP cookie的头连接。



$result = curl_exec ($ch);
curl_close($ch);
return $result;
}




