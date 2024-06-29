<?php
//获取当前文件所在的绝对目录
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR); //PATH后面一律带/   D:\phpStudy\WWW\mvc\
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));  // http://网址/子文件夹/  //注意nginx的兼容性

//echo BASE_URL;
//扫描文件夹
$arr = scandir(BASE_PATH);

//显示
//echo " <pre>";
//print_r($arr);
echo '<hr style="width:1200px;margin:50 auto;margin-top:150px;"><div style="width:980px;margin:50 auto;">';
$i = 1;
foreach ($arr as $k => $v) {
    if (strpos($v, '.') !== 0) {
        echo $i . '. <a href=' . BASE_URL . $v . '>' . $v . '</a><p>';
        $i += 1;
    }
}
echo '</div>';
