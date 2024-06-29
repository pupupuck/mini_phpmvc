<?php
header("Content-type: text/html; charset=utf-8");
echo "<br><br><br><br><br>";
echo $_SERVER['HTTP_USER_AGENT']."	UA。<br>";
echo "<br><br><br><br><br>";
echo $_SERVER['REQUEST_METHOD']."	返回访问页面使用的请求方法（例如 POST）。<br>"; 
echo $_SERVER['REQUEST_TIME']."	返回请求开始时的时间戳（例如 1577687494）。<br>"; 
echo $_SERVER['QUERY_STRING']."	返回查询字符串，如果是通过查询字符串访问此页面。<br>"; 
echo $_SERVER['HTTP_ACCEPT']."	返回来自当前请求的请求头。<br>"; 
echo $_SERVER['HTTP_ACCEPT_CHARSET']."	返回来自当前请求的 Accept_Charset 头（ 例如 utf-8,ISO-8859-1）";
echo $_SERVER['HTTP_HOST']."	返回来自当前请求的 Host 头。<br>"; 
echo $_SERVER['HTTP_REFERER']."	返回当前页面的完整 URL（不可靠，因为不是所有用户代理都支持）。<br>"; 