<?php

$G['db'] = [
  'host' => '127.0.0.1', 
  'port' => '3306',
  'dbname' => 'douyinprint',
  'username' => 'root',
  'password' => 'Chen888888',
];

/*$G['db'] = [
  'host' => '47.110.155.87', 
  'port' => '13306',
  'dbname' => 'dy',
  'username' => 'dy',
  'password' => 'dy888888',
];*/

$G['web'] = [
    'title' => '网站标题',
    'keywords' => '网站关键词',
    'description' => '关键词描述',
];

$G['sys'] = [
    'timezone' => 'Asia/Shanghai', // 设定用于所有日期时间函数的默认时区.
    'starttime' => microtime(true), // 用于调试的时间记录
    'debug' => '1',// 0 不报错,正常运行模式; 1报告所有错误; 
];

$G['log'] = [];
