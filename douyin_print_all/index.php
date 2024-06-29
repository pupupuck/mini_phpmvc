<?php
//2022.0710 完善mvc 抖音打印，松耦合，模块化，省去了mvc的controller，可能class的函数直接暴露在外面，不过小项目简单第一
//print_r($_SERVER);
//exit;
global $G; // 全局唯一大数组，记录config和传值
require 'config.php'; //单独文件可以被php修改生成配置
header("Content-type: text/html; charset=utf-8"); // 页面初始化,必须在任何输出之前调用header()
header("Content-Language: zh-CN");
header("Access-Control-Allow-Origin:*"); // 允许跨域请求
date_default_timezone_set('Asia/Shanghai');

define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR); //PATH 约定路径后面一律带斜杠/ ，指向当前执行的PHP脚本所在的目录
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME'])); // http://网址/子文件夹/  //注意nginx的兼容性

define('KEY', $G['sys']['key']); // secret_key rc4，md5也用
define('DEBUG', true); //是否调试模式
error_reporting(DEBUG ? E_ALL : 0);
set_exception_handler('sys::_exit'); // 异常捕获，接管所有异常，最终exit
spl_autoload_register('sys::autoload'); //定义类的自动加载目录
// session_save_path(CACHE_PATH . '_session'); // 可手工T下线
session_start(); // 定义常量,最常用的

// 程序入口
sys::run();

// 系统函数，必须用到的，初始化，异常处理，过滤
class sys
{

    // 程序入口函数run
    public static function run()
    {

        router::get_url(); // 先解析，定义了常量MODEL,ACTION,MA,验证签名，解析加密
        router::filter(); // 过滤POST危险字符,没有过滤GET

        $model_file = BASE_PATH . 'model'. DIRECTORY_SEPARATOR . MODEL . '.model.php';
        //print_r($model_file);
        if (!is_file($model_file)) {
            throw new Exception('类文件不存在model_file!', 404);
        }

        // 先载入一个Model
        include $model_file;
        $classModel = MODEL . 'Model';
        $obj        = new $classModel(); //实例化,
        if (!method_exists($obj, ACTION)) {
            throw new Exception('类方法不存在ACTION!', 404);
        }
        $obj->{ACTION}(); //{$var}括起来表示要当成变量处理，这里指方法,出口,没有使用call_user_func_array()调用和传值
    }

    // 自动加载  spl_autoload_register('sys::autoload');
    public static function autoload($class)
    {
        $class      = trim($class, '\\'); //去除\
        $class_file = str_replace('\\', '/', $class) . '.class.php'; //获取类的路径文件名
        $class_file = BASE_PATH . 'lib'. DIRECTORY_SEPARATOR . $class_file;
        if (is_file($class_file)) {
            include $class_file;
            return;
        } else {
            throw new Exception('类文件不存在class_file!', 404);
        }
    }

    // 致命错误，程序无法继续,顶层的异常处理
    public static function _exit($exception)
    {
        // 加一个debug判断
        if (DEBUG && $exception->getMessage() != 1) {
            $response      = (object) []; //空对象
            $response->msg = $exception->getMessage();
            $response->err = $exception->getCode();
            //$response->file = $exception->getFile();
            $response->line = $exception->getLine();
            baseModel::json_view($response);
        } else {
            $response      = (object) []; //空对象
            $response->msg = '警告！非法请求，已记录日志！';
            $response->err = 1;
            baseModel::json_view($response);
        }
    }

}

// 简单路由， model/action 全局常量定义了mvc，没使用类思想
class router
{

    public static function get_url()
    {

        // url解析只有GET，用来传网址，不传数据，重要的用POST
        $arr = explode('/', trim($_SERVER['PATH_INFO'], '/')); //至少返回1个空元素
        //print_r($arr);
        if (count($arr) == 1) {
            $model  = empty($arr[0]) ? 'index' : $arr[0]; //至少返回1个空元素
            $action = empty($_GET['action']) ? 'index' : $_GET['action'];
        }
        if (count($arr) == 2) {
            $model  = $arr[0];
            $action = $arr[1];
        }

        define('MODEL', $model);
        define('ACTION', $action);
        define('MA', MODEL . '/' . ACTION); // 当前页面,等级权限设计用到

        //sign验证,如果POST不为空就验证，为空就不验证, GET不需要验证（登录等，重要的都用post）
        if (!empty($_POST)) {

            $query = $_POST;

            //检测时间,秒，客户端的心跳包更新时间戳，这里检测是10分钟
            if (!empty($query['timestamp'])) {
                if ($query['timestamp'] < $_SERVER['REQUEST_TIME'] - 10 * 60 || $query['timestamp'] > $_SERVER['REQUEST_TIME'] + 10 * 60) {
                    throw new Exception('请求已过期,请重新登录！', 401);
                }
            }

            if (!empty($query['sign'])) {
                unset($query['sign']);
            }

            if (!empty($query['encrypt_data'])) {
                $query['encrypt_data'] = rawurlencode($query['encrypt_data']); //服务器默认解码url一次，再给还原回去
            }

            if (!fun::verify_sign($query, $_POST['sign'])) {
                throw new Exception('签名验证失败！', 401); //401验证令牌 ，403验证用户级别权限，404检查资源是否存在
            }
        }

        //rc4自动解密POST，encrypt_data是rc4加密后再urlencode后的文本，有个小bug，用rawurlencode解决
        if (!empty($_POST['encrypt_data'])) {
            $data2 = rawurldecode($_POST['encrypt_data']);
            $data2 = fun::rc4($data2, KEY);
            $arr2  = explode('&', $data2);
            foreach ($arr2 as $val) {
                $arr3 = explode('=', $val, 2); //有时存在多个等号=
                if (!empty($arr3[1])) {
                    $_POST["$arr3[0]"] = $arr3[1];
                }
            }
        }
    }

    // 过滤字符串,有时会同时存在get和post，和数组 http://localhost/mvc/index.php?c=article&mid=11&state[]=complete&state[]=hangup&st[]=hhh
    public static function filter(&$data = array())
    {
        //如果post不为空，post自动运行urldecode结果<+~>，get不自动运行，结果decode &amp;lt;+~&amp;
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
                }
            }
        }
    }

}

// 祖宗Model，和数据相关
class baseModel
{

    //函数和变量，实例化后引用不同，类方法带括号this->fun(),类成员没有括号this->db，如果db又是一个类，就可以连用this->db->res
    //对象"new创建完成"后第一个被"自动调用"的方法
    public $db;
    public $response;
    public function __construct()
    {
        $this->db       = self::db_connect();
        $this->response = new response();
    }
    public function __destruct()
    {
        // 数据库关闭
        $this->db = null;
    }

    //  主数据库链接，// _exit自动捕获错误，连接错误报1049
    public static function db_connect()
    {
        global $G;
        set_time_limit(60); // php脚本的最大执行时间，默认60秒
        $arr = array(
            PDO::ATTR_TIMEOUT    => 60, // 秒，sql超时时间
            PDO::ATTR_PERSISTENT => true, //持久性链接
        );
        $dsn = 'mysql:host=' . $G['db']['host'] . ';port=' . $G['db']['port'] . ';dbname=' . $G['db']['dbname'];
        $db  = new PDO($dsn, $G['db']['username'], $G['db']['password'], $arr);
        $db->query('SET NAMES utf8mb4');
        //$dbh -> query('set interactive_timeout=24*3600');
        unset($G);
        return $db;
    }

    // JSON格式化并返回数据
    public static function json_view($data = '')
    {
        if (ACTION == __FUNCTION__) {
            throw new Exception(__FUNCTION__ . ':禁止访问此方法: ' . __FUNCTION__);
        }
        echo json_encode($data, 320); //256=中文不转为unicode,64=不转义反斜杠, 320=全部.  448=64+128+256 64即不转换\ 128 不转换\n \r \t之类的空白 256中文输出
        exit(); // 显示后截断输出
    }

}

// 函数返回值打包成统一格式，致命错误也用此格式,//encrypt_data作为arr里的一个特殊字符串成员（一维数组），一起签名
class response
{
    //类变量初始化的值必须是常数
    public $err       = 1; // 0成功、大于1错误
    public $msg       = '状态描述信息';
    public $data_num  = 0; // 总数,用于分页方便
    public $data      = []; //数据类型限定为对象或数组
    public $timestamp = 0; //sign签名用到，因为二维数组，所以没有污染data放在data里
    public $sign      = 0; //对data里面的数据签名
}

// 公共函数
class fun
{
    // 时间戳转成时长,收费时用到
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
    

    //rc4加解密，没有编码，调用第二次就是解密，http二次加密，防止中间人攻击
    public static function rc4($data, $pwd)
    {
        $cipher      = '';
        $key[]       = "";
        $box[]       = "";
        $pwd_length  = strlen($pwd);
        $data_length = strlen($data);
        for ($i = 0; $i < 256; $i++) {
            $key[$i] = ord($pwd[$i % $pwd_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j       = ($j + $box[$i] + $key[$i]) % 256;
            $tmp     = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $data_length; $i++) {
            $a       = ($a + 1) % 256;
            $j       = ($j + $box[$a]) % 256;
            $tmp     = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $k       = $box[(($box[$a] + $box[$j]) % 256)];
            $cipher .= chr(ord($data[$i]) ^ $k);
        }
        return $cipher;
    }

    //如果是二维，先对a[1][2]数组的sign值赋值给a[1]，这就变成了一维，再sign
    public static function sign($arr)
    {

        //先把二维变成一维
        $arr1 = [];
        foreach ($arr as $k => $v) {
            if(is_array($v)) {
                $arr1[$k] = self::sign1($v); 
            }
        }
        
        //判断为空来确定以前的维数
        if(empty($arr1)){
            $arr1 = $arr;
        }
        $arr1['timestamp'] = $_SERVER['REQUEST_TIME']; //没有污染data

        //print_r($arr1); 
        $str = self::sign1($arr1); //已经变成了一维  
        return $str;
        
    }

    //一维数组签名，返回sign
    public static function sign1($arr)
    {

        //注意，key为数字时排序和易ascii不通用，所以key不能用数字.把数字id换成字母
        ksort($arr,2); //默认升序abc用key排序,2 = SORT_STRING - 把每一项作为字符串来处理。

        $str = '';
        foreach ($arr as $k => $v) {
            $str = $str . '&' . $k . '=' . $v;
        }
        //print_r($str);
        $str = strtoupper(KEY . $str . KEY);
        $str = strtoupper(md5($str)); //整体大写后签名，签名结果也要大写
        return $str;
    }

    //一维的
    public static function verify_sign($query, $sign)
    {
        //加密数据再上一阶段处理，放入data里
        ksort($query,2); //默认升序abc用key排序,2 = SORT_STRING - 把每一项作为字符串来处理。

        $str = '';
        foreach ($query as $k => $v) {
            $str = $str . '&' . $k . '=' . $v;
        }
        $str = strtoupper(KEY . $str . KEY);
        $str = strtoupper(md5($str)); //整体大写后签名，签名结果也要大写
        //exit($str);
        if ($str == $sign) {
            return true;
        } else {
            return false;
        }

    }

    //数组的key变成str，不用数字，因为排序和易通讯问题,呼应上面的sign1($arr)
    public static function key2str($arr)
    {
        //随机5位
        $str0      = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";    
        $arr2 = [];
        foreach ($arr as $k => $v) {
            $str2 = substr(str_shuffle($str0), mt_rand(0, strlen($str0) - 6), 5);
            $arr2[$str2] = $v;
        }
        return $arr2;
    }



}
unset($G);
exit();
