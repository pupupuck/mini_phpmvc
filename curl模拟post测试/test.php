<?php
require_once("Curl_Manager.php");

$manager = new Curl_Manager();

$manager->set_action('gg', 'http://localhost/curl/post.php', 'http://willko.iteye.com/');//���ö�����(��������, ������Ӧurl����Դreferer)

$manager->open()->get('gg'); //��һ�����󣬽���get����

echo $manager->body(); // ��ñ���
echo $manager->header(); // ��ñ�ͷ(��Ҫ�Լ�����)
