<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class userModel extends baseModel
{

    /**
     *  用户登录: username，origin_uid，buyin_account_id
     *
     */
    public function login()
    {
        //print_r(Get_class_methods ('userModel'));
        $join_time = $_SERVER['REQUEST_TIME'];
        $last_time = $_SERVER['REQUEST_TIME'];
        $end_time  = $_SERVER['REQUEST_TIME'] + 7 * 24 * 3600; // 7天试用期

        if (!empty($_POST['origin_uid'])) {
            //origin_uid登录

            $origin_uid       = $_POST['origin_uid'];
            $nickname         = $_POST['nickname'];
            $buyin_account_id = $_POST['buyin_account_id'];

            $sql = "select id,end_time,parent_id,level from user where origin_uid = '$origin_uid' limit 0,1"; // 加个单引号就好了
            $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $ok  = $res->execute();
            if (!$ok) {
                //0条也=ok
                throw new Exception('数据库语句错误', 1049);
            } else {
                $arr = $res->fetchAll(PDO::FETCH_ASSOC);
                
            }

            if (!empty($arr)) {
                $_SESSION['user'] = $arr[0]; //session_commit(); 将session写入到文件，不阻塞,//encrypt_data作为arr里的一个特殊字符串成员，一起签名
                //print_r($_SESSION["user"]);
                $arr = fun::key2str($arr);
                $this->response->err       = 0;
                $this->response->msg       = '登录成功!';
                $this->response->data      = $arr;
                $this->response->data_num  = count($arr);
                $this->response->timestamp = $_SERVER['REQUEST_TIME'];
                $this->response->sign      = fun::sign($arr);
                $this->json_view($this->response);
            } else {
                //不存在则创建
                $sql   = "INSERT IGNORE INTO user(origin_uid,nickname,buyin_account_id,join_time,last_time,end_time) VALUES ($origin_uid,'$nickname','$buyin_account_id',$join_time,$last_time,$end_time)";
                $count = $this->db->exec($sql); // 返回受影响行数，没有则返回0
                if ($count == 0) {
                    $this->response->err = 1;
                    $this->response->msg = '创建失败!';
                    $this->json_view($this->response);
                } else {
                    // 创建数组arr
                    $arr                       = [];
                    $arr[0]                    = array('end_time' => "$end_time", 'parent_id' => 0, 'level' => 0);
                    $_SESSION['user']          = $arr[0];
                    $arr                       = fun::key2str($arr);
                    $this->response->err       = 0;
                    $this->response->msg       = '创建成功!';
                    $this->response->data      = $arr;
                    $this->response->data_num  = count($arr);
                    $this->response->timestamp = $_SERVER['REQUEST_TIME']; // 不污染data，二维数组
                    $this->response->sign      = fun::sign($arr);
                    $this->json_view($this->response);
                }

            }

        }
        if (!empty($_POST['username'])) {
            // username登录

        }

    }

}
