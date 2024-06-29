<?php


 //$username = 'soutu';  //小号id
 //$baseurl='http://tradecard.wangwang.taobao.com/tradecard/buyer/chatCard.htm?signmode=im&loginId=cntaobaodb184298990&uid=cntaobao' . urlencode(iconv('UTF-8', 'gbk//TRANSLIT', $username)) . '&gid=&self=0&type=0&ver=8.00.34C&edition=0&cssname=default';
 
 
/* 直接伪造ip和来源，ip138其实也是成功的，iframe重新加载的网页后就不成功了
$ch = curl_init(); 
$url = "http://1111.ip138.com/ic.asp"; 
$header = array( 
'CLIENT-IP:58.68.44.61', 
'X-FORWARDED-FOR:58.68.44.61', 
'REMOTE_ADDR:58.68.44.61',
); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); 
curl_setopt($ch, CURLOPT_REFERER, "http://www.jb51.net/ ");
$page_content = curl_exec($ch); 
curl_close($ch); 
echo $page_content; 
*/




  //通过代理伪造ip和来源，淘宝不成功，很多网站可以成功，主要是通过代理方式达到修改REMOTE_ADDR的目的
error_reporting(0);

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
$url_page = "http://2.taobao.com/credit/credit.htm?userId=43432324";  //ip138核心是iframe重新加载的网页  http://1111.ip138.com/ic.asp
$user_agent = "Mozilla/4.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.47 Safari/536.11";
$proxy = "192.168.1.4:808";    //此处为代理服务器IP和PORT，使用本机调试

$string = curl_string($url_page,$user_agent,$proxy);

echo $string;

?>
















