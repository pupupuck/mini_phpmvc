<?php
//2022.01.25 拼多多直播互动数据，最后一版是dy.qudd.cn
global $G; // 全局唯一大数组，记录基本配置和传值
require 'config.php';

// 定义常量,最常用的
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR); //PATH后面一律带斜杠/   BASE_PATH = /Volumes/DATA/www/ping.qudd.cn/,  $_SERVER['DOCUMENT_ROOT'] = /Volumes/DATA/www
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] .'/'. str_replace($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR, '',__DIR__)); // http://localhost/qudd.cn 修正了造成nginx的错误
define('STATIC_URL', BASE_URL . '/static');
define('FRAMEWORK_PATH', BASE_PATH . 'framework' . DIRECTORY_SEPARATOR);
define('CACHE_PATH', FRAMEWORK_PATH . '_cache' . DIRECTORY_SEPARATOR);
define('LIB_PATH', FRAMEWORK_PATH . 'lib' . DIRECTORY_SEPARATOR); 

define('DEBUG', $G['sys']['debug']); //是否调试模式

//这里应该放在一个app的配置文件里，如在model中有个config
// web标题，baseController类里只可静态赋值
/* define('TITLE', $G['web']['title']);
define('KEYWORDS', $G['web']['keywords']);
define('DESCRIPTION', $G['web']['description']);
 */


// 页面初始化,必须在任何输出之前调用header()
header("Content-type: text/html; charset=utf-8");
header("Content-Language: zh-CN");
header("Access-Control-Allow-Origin:*"); // 允许跨域请求
date_default_timezone_set($G['sys']['timezone']);
error_reporting(DEBUG ? E_ALL : 0); //0禁用错误报告; 1报告所有错误，在config.php中配置
set_exception_handler('sys::_exit'); // 异常捕获，接管所有异常后最终exit，为什么要接管所有异常？cms模式需要拦截网页错误，api模式不需要拦截错误？
// session_save_path(STATIC_PATH . '_session'); // 可手工T下线
session_start();

// 祖宗函数，系统初始化和结束，异常处理，路由，都集成在里面，contraller处理权限，model处理数据
class sys
{

    // 程序入口函数（页末调用），加载过程就是MCA过程 /index.php?m=home&c=down&a=view
    public static function init()
    {

        // 过滤非法字符
        fun::filterAll();

       /*  // 此处是mca简单路由,是http不是https
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		
        $mca = str_replace(BASE_URL, '', $url);  // 去掉前面，得到/m/c/a/index.php?a=100
		$mca = strpos($mca, '?') ? strstr($mca, '?', true) : $mca; // 有问号，取左边为mca，右边为参数
		$mca = strpos($mca, '.') ? dirname($mca) : $mca; // 有点号，则取路径，删掉index.php得到/m/c/a/
		$mca = strtr($mca, '\\', '/'); // 可能需要替换斜杠// 再删首尾斜杠
        $mca = trim($mca, '/'); 
		
        $arr = explode('/', $mca);// 下面三种情况，缺省优先级不同，=0时呢,环境不同arr空值不同
        if (count($arr) == 1) {
            if($arr[0] != ''){
			list($_GET['m']) = $arr; }
        }
        if (count($arr) == 2) {
            list($_GET['m'], $_GET['c']) = $arr;
        }
        if (count($arr) == 3) {
            list($_GET['m'], $_GET['c'], $_GET['a']) = $arr;
        } */
        
		// 补齐默认，/目录权重大于&权重
        $_GET['m'] = empty($_GET['m']) ? 'api' : $_GET['m']; //model 默认为home
        $_GET['c'] = empty($_GET['c']) ? 'index' : $_GET['c']; 
        $_GET['a'] = empty($_GET['a']) ? 'index' : $_GET['a']; 
		
        define('MODEL', $_GET['m']); //定义常量，很多地方需要调用
        define('CONTROLLER', $_GET['c']);
        define('ACTION', $_GET['a']);
        define('MODEL_PATH', BASE_PATH . 'model' . DIRECTORY_SEPARATOR . MODEL . DIRECTORY_SEPARATOR);
        define('VIEW_PATH', BASE_PATH . 'static' . DIRECTORY_SEPARATOR . MODEL . DIRECTORY_SEPARATOR);
        define('VIEW_URL', STATIC_URL . '/' . MODEL);
        define('MCA', MODEL . '/' . CONTROLLER . '/' . ACTION); // 在判断当前页面时用得到
        //echo MCA;
        // 先载入Model，一个公共的parentModel，一个controllerModel，没有实例化，如有必要还可以加载一个子配置cfg.php
        $parentModelFile     = MODEL_PATH . 'parentModel.php';
        $controllerModelFile = MODEL_PATH . CONTROLLER . 'Model.php';
        if (!is_file($parentModelFile)) {
            throw new Exception('文件不存在: ' . $parentModelFile, 404);
        }
        if (!is_file($controllerModelFile)) {
            throw new Exception('文件不存在: ' . $controllerModelFile, 404);
        }
        include $parentModelFile;
        include $controllerModelFile;

        // 载入Controller，实例化并执行action方法
        $controllerName = CONTROLLER . 'Controller'; //子Controller类名,命名约定：类名=文件名
        $controllerFile = MODEL_PATH . $controllerName . '.php';
        if (!is_file($controllerFile)) {
            throw new Exception('文件不存在: ' . $controllerFile, 404);
        }
        include $controllerFile;
        if (!class_exists($controllerName, false)) {
            throw new Exception('类名不存在: ' . $controllerName);
        }
        $controller = new $controllerName();
        if (!method_exists($controller, ACTION)) {
            throw new Exception('方法不存在: ' . $controllerName);
        }
        $controller->{ACTION}(); //{$var}括起来表示要当成变量处理，这里指方法,出口
    }

    // 致命错误，程序无法继续,拦截并退出
    public static function _exit($exception)
    {
        // !=1不是预期对象而是打印数组
        if ($exception->getMessage() != 1) {

            // 代码未完成,如果不想让客户看到DEBUG消息，可以根据错误代码决定是否向用户展示，如0-100=预留，100-200=用户可见，200+，404，500=内部服务器
            DEBUG && print_r('<pre>');
            DEBUG && print_r('<br><b>异常消息: </b>' . $exception->getMessage());
            DEBUG && print_r('<br><b>错误代码: </b>' . $exception->getCode());
            DEBUG && print_r('<br><b>文件路径: </b>' . $exception->getFile());
            DEBUG && print_r('<br><b>错误行号: </b>' . $exception->getLine());
        }
		//print_r($exception); 超详细错误消息
		//打印日志信息，本函数尾部就是程序出口，等于exit？
        sys::log(); 
		//exit();
    }

    // 日志消息,DEBUG模式才可见， sys::log(1,'埋点起始');,为空则输出
    public static function log($do = 0, $str = '')
    {
		if (DEBUG) {
            global $G;
            switch ($do) {
                case 1: //开始埋点
                    $G['time1']   = microtime(true);
                    $G['memory1'] = memory_get_usage();
                    break;

                case 2: // 添加日志
                    $time = sprintf('%.3f', microtime(true) - $G['time1']);
                    //$time = sprintf("%05d", $time);
                    $memory = sprintf('%.3f', (memory_get_usage() - $G['memory1']) / 1024);
                    //$memory = sprintf("%05d", $memory);
                    $G['log'][] = array('time' => $time, 'memory' => $memory, 'str' => $str);
                    break;

                default:
                    //echo '<pre>';
                    if (!empty($G['log'])) {
                        foreach ($G['log'] as $k => $v) {
                            echo sprintf("%02d", $k) . ': ' . $v['time'] . '秒，  ' . $v['memory'] . 'KB，  ' . $v['str'] . '<br>';
                        }
                    }
                    //echo '<br><br><br><b>总耗内存：</b>' . round(memory_get_usage() / 1024, 3) . ' KB';
                    //echo '<p><b>总耗时间：</b>' . round(microtime(1) - $G['sys']['starttime'], 3) . ' 秒';
                    break;
            }
            unset($G);
        }
    }

    // 自动跳转(可以设定停留的时间秒数)
    public static function gotoUrl($url = '#', $msg = '', $time = '0')
    {
        echo "<font color=red>$msg</font>";
        echo "<br/><a href='$url'>点击转到</a>";
        echo "<br/>页面将在{$time}秒之后自动跳转.";
        header("refresh:$time;url=$url");
        exit;
    }

    // 跳转mca，瞬间跳转，不需要延时功能,格式 m/c/a,可以带参数
    public static function gotoMCA($mca = '')
    {
        ob_start(); 
        $mca = ltrim($mca, '/'); // 删首斜杠
        $url = BASE_URL . '/' . $mca;
        echo "<br/><a href='{$url}'>点击转到: {$url}</a>";
        header("refresh:0;url={$url}");
        exit;
    }
}


// 公共函数
class fun
{

    // 时间戳转成时长
    public static function time2lang($t, $v = 'd:h:i-s')
    {
        $y                     = intval($t / 86400 / 365);
        $m                     = intval($t % (2592000 * 12) / 2592000);
        $d                     = intval($t % (86400 * 30) / 86400);
        $h                     = intval($t % (3600 * 24) / 3600);
        $i                     = intval($t % (60 * 60) / 60);
        $s                     = intval($t % 60);
        stristr($v, 'y') && $v = str_ireplace('y', $y, $v);
        stristr($v, 'm') && $v = str_ireplace('m', $m, $v);
        stristr($v, 'd') && $v = str_ireplace('d', $d, $v);
        stristr($v, 'h') && $v = str_ireplace('h', $h, $v);
        stristr($v, 'i') && $v = str_ireplace('i', $i, $v);
        stristr($v, 's') && $v = str_ireplace('s', $s, $v);
        return $v;
    }

    // 获取13位时间戳
    public static function getTimestamp()
    {
        list($t1, $t2) = explode(' ', microtime());
        return sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    // 用户名隐藏
    public function string_cut($v)
    {
        $strlen   = mb_strlen($v, 'utf-8');
        $firstStr = mb_substr($v, 0, 1, 'utf-8');
        $lastStr  = mb_substr($v, -1, 1, 'utf-8');
        return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($v, 'utf-8') - 1) : $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
    }

    // 过滤字符串,这可能不严谨，有时会同时存在get和post， http://localhost/mvc/index.php?c=article&mid=11&state[]=complete&state[]=hangup&st[]=hhh
    public static function filterAll(&$data = array())
    {
        //如果get不为空
        if (!empty($_GET) && is_array($data)) {
            if (empty($data)) {
                $data = &$_GET;
            }
            foreach ($data as &$val) {
                if (is_array($val)) {
                    self::filterAll($val);
                } else {
                    $val                           = htmlspecialchars(trim($val), ENT_QUOTES); //删首尾空，转义 & " ' < > 5个为&gt;等
                    get_magic_quotes_gpc() || $val = addslashes($val); // 添加反斜杠 \ ：单引号（'），双引号（"），反斜杠（\），NULL
                    $val                           = strtr($val, '%=<>', '****'); // \0表示ASCII 0x00，ASCII的'<'是%3C，>是%3E;是js的<>,%&=<>，防sql注入' or 1=1;-- s，可能影响html
                }
            }
        }

        //如果post不为空
        if (!empty($_POST) && is_array($data)) {
            if (empty($data)) {
                $data = &$_POST;
            }
            foreach ($data as &$val) {
                if (is_array($val)) {
                    self::filterAll($val);
                } else {
                    $val                           = htmlspecialchars(trim($val), ENT_QUOTES);
                    get_magic_quotes_gpc() || $val = addslashes($val);
                    $val                           = strtr($val, '%=<>', '****');
                }
            }
        }
    }

    // 加载并传值,干吗用的？
    public static function _include($path)
    {
        if (!is_file($path)) {
            throw new Exception('文件不存在: ' . $path);
        }
        global $G; // 模版传参数
        include $path;
    }
}

// 祖宗Controller，和流程相关，加载、显示，注意不可以被url访问到
class baseController
{
    // 加载model,取数据 $this->model
    public $model;
    // web页面元素，类里只可静态赋值
    public $title       = '网页标题';
    public $keywords    = '网页关键词';
    public $description = '网页描述';

    // 加载模板并显示，需要完善缓存
    public function htmlView($header = '', $body = '', $footer = '')
    {
        if (ACTION == __FUNCTION__) {
            throw new Exception('禁止访问此方法: ' . __FUNCTION__);
        }
        global $G;
        $header = empty($header) ? VIEW_PATH . CONTROLLER . '-' . 'header.php' : VIEW_PATH . $header;
        $body   = empty($body) ? VIEW_PATH . CONTROLLER . '-' . ACTION . '.php' : VIEW_PATH . $body;
        $footer = empty($footer) ? VIEW_PATH . CONTROLLER . '-' . 'footer.php' : VIEW_PATH . $footer;

        if (!is_file($header)) {
            throw new Exception('文件不存在: ' . $header);
        } elseif (!is_file($body)) {
            throw new Exception('文件不存在: ' . $body);
        } elseif (!is_file($footer)) {
            throw new Exception('文件不存在: ' . $footer);
        }

        include $header;
        include $body;
        include $footer;

        unset($G);
        // 程序出口,显示后截断输出
        sys::log();
        unset($GLOBALS['G']); //这两个变量范围不同
        exit();
    }

    // JSON格式化并返回数据
    public static function jsonView($data = '')
    {
        if (ACTION == __FUNCTION__) {
            throw new Exception('禁止访问此方法: ' . __FUNCTION__);
        }

        echo json_encode($data, 320); //256=中文不转为unicode,64=不转义反斜杠, 320=全部
        sys::log();
        unset($GLOBALS['G']);
        exit(); // 显示后截断输出,类初始化时可能间接调用
    }

    //用户是否登录
    public static function isLogin()
    {
        if (empty($_SESSION['user']['username'])) {
            return false;
        } else {
            return true;
        }
    }

} // end Controller

// 祖宗Model，和数据库数据相关
class baseModel
{
    //  主数据库链接
    public static function dbhConnect()
    {
        global $G;
        set_time_limit(60); // php脚本的最大执行时间，默认60秒
        $arr = array(
            PDO::ATTR_TIMEOUT    => 60, // 秒，sql超时时间
            PDO::ATTR_PERSISTENT => true, //持久性链接
        );
        $dsn = 'mysql:host=' . $G['db']['host'] . ';port=' . $G['db']['port'] . ';dbname=' . $G['db']['dbname'];
        $dbh = new PDO($dsn, $G['db']['username'], $G['db']['password'], $arr);
        $dbh->query('SET NAMES utf8mb4');
        //$dbh -> query('set interactive_timeout=24*3600');
        unset($G);
        // 自动捕获错误，连接错误报1049
        return $dbh;
    }

}

// 函数返回值打包成统一格式，不包含致命错误，用户可见的错误都用它来传递。可以放在祖宗sys里向下继承
class response
{
    public $err   = 1; // 0成功、大于1错误
    public $msg   = '状态描述信息';
    //public $count = 0; // 总数,用于分页
    public $data  = []; //数据类型限定为对象或数组
}

// 程序入口
sys::init();

// 程序出口
sys::log();
unset($G); 
unset($GLOBALS['G']); //这两个变量范围不同
exit();
