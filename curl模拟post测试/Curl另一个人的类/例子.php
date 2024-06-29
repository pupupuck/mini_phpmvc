<?php
require 'Curl.php';
use \Curl\Curl;
 
//GET请求
$curl = new Curl();
$curl->get('
 
//POST请求
$curl = new Curl();
$curl->post('http://www.example.com/login/', array(
    'username' => 'myusername',
    'password' => 'mypassword',));
 
//带参数
$curl = new Curl();
$curl->setBasicAuthentication('username', 'password');
$curl->setUserAgent('');$curl->setReferrer('');
$curl->setHeader('X-Requested-With', 'XMLHttpRequest');
$curl->setCookie('key', 'value');
$curl->get(' 
if ($curl->error) {
    echo 'Error: ' . $curl->error_code . ': ' . $curl->error_message;
}else {
    echo $curl->response;
}
var_dump($curl->request_headers);
var_dump($curl->response_headers);