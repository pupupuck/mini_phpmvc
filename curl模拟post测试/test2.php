<?php

$url_page = "http://2.taobao.com/credit/credit.htm?userId=43432324";  //ip138������iframe���¼��ص���ҳ  http://1111.ip138.com/ic.asp
$user_agent = "Mozilla/4.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.47 Safari/536.11";
$proxy = "192.168.1.4:808";    //�˴�Ϊ���������IP��PORT��ʹ�ñ�������

$string = curl_string($url_page,$user_agent,$proxy);

echo $string;
echo $string;


function curl_string ($url,$user_agent,$proxy){
$ch = curl_init();
curl_setopt ($ch, CURLOPT_PROXY, $proxy);
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_HTTPHEADER, array('CLIENT-IP:111.111.111.110', 'X-FORWARDED-FOR:111.111.111.110'));  //�˴����Ը�Ϊ�����IP
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt ($ch, CURLOPT_TIMEOUT, 120);
curl_setopt ($ch, CURLOPT_REFERER, "http://s.taobao.com/");  //ҳ����Դα��

$result = curl_exec ($ch);
curl_close($ch);
return $result;
}


function post($url,$cont){
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);

curl_setopt ($ch, CURLOPT_POST, 1); // post����
curl_setopt ($ch, CURLOPT_POSTFIELDS, "ie=UTF-8&wd=curl_setopt");  //post����

curl_setopt ($ch, CURLOPT_REFERER, "http://s.taobao.com/");  //ҳ����Դ
curl_setopt ($ch, CURLOPT_USERAGENT, $user_agent); //UA

// curl_setopt ($ch, CURLOPT_HTTPHEADER, array('CLIENT-IP:111.111.111.110', 'X-FORWARDED-FOR:111.111.111.110'));  //����ͷ��Ϣ���˴����Ը�Ϊ�����IP

curl_setopt ($ch, CURLOPT_HEADER, 1); //�趨�Ƿ����ҳ������
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); //�趨�Ƿ���ʾͷ��Ϣ
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1); // ���������������HTTPͷ��һ���ַ���
curl_setopt ($ch, CURLOPT_TIMEOUT, 120);  // �ȴ��������������
curl_setopt ($ch, CURLOPT_COOKIE, "ie=UTF-8&wd=curl_setopt"); // ����һ������HTTP cookie��ͷ���ӡ�



$result = curl_exec ($ch);
curl_close($ch);
return $result;
}




