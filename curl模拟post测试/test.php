<?php
require_once("Curl_Manager.php");

$manager = new Curl_Manager();

$manager->set_action('gg', 'http://localhost/curl/post.php', 'http://willko.iteye.com/');//设置动作，(动作名称, 动作对应url，来源referer)

$manager->open()->get('gg'); //打开一个请求，进行get操作

echo $manager->body(); // 获得报文
echo $manager->header(); // 获得报头(需要自己解析)
