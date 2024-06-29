<?php

class CURL
{
  var $cookie_file;  // 设置Cookie文件保存路径及文件名
  function __construct()
  {
    $this->cookie_file = CACHE_PATH ."/cookie_".md5(CACHE_PATH).".txt";
  }

  function vlogin($url,$data){ // 模拟登录获取Cookie函数
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0); // 使用自动跳转,1=登陆成功后会跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 0); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
    curl_setopt($curl, CURLOPT_COOKIEJAR, $this->cookie_file); // 存放Cookie信息的文件名称,连接结束后保存cookie信息的文件
    curl_setopt($curl, CURLOPT_COOKIEFILE, $this->cookie_file); // 读取上面所储存的Cookie信息
    curl_setopt($curl, CURLOPT_TIMEOUT, 60); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回,1或ture返回的内容作为变量储存，而不是直接输出
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
      echo 'CURL Errno'.curl_error($curl);
    }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据
  }

  function vget($url){ // 模拟获取内容函数
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0); // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 0); // 自动设置Referer
    curl_setopt($curl, CURLOPT_HTTPGET, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_COOKIEFILE, $this->cookie_file); // 读取上面所储存的Cookie信息
    curl_setopt($curl, CURLOPT_TIMEOUT, 60); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
      echo 'CURL Errno'.curl_error($curl);
    }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据
  }

  function vpost($url,$data){ // 模拟提交数据函数
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0); // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 0); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
    curl_setopt($curl, CURLOPT_COOKIEFILE, $this->cookie_file); // 读取上面所储存的Cookie信息
    curl_setopt($curl, CURLOPT_TIMEOUT, 60); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
      echo 'CURL Errno'.curl_error($curl);
    }
    curl_close($curl); // 关键CURL会话
    return $tmpInfo; // 返回数据
  }
  function delcookie($cookie_file){ // 删除Cookie函数
    @unlink($cookie_file); // 执行删除
  }
}