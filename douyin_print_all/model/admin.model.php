<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class adminModel extends baseModel
{

/**
 *  列表
 *
 */

    public function get_card()
    {
//$_POST = $_GET;

        $card_num = empty($_POST['card_num']) ? ' ' : " card_num = '" . $_POST['card_num'] . "' and ";
        $dur_time = empty($_POST['dur_time']) ? ' ' : " dur_time = " . $_POST['dur_time'] . " and ";
        $user_id  = empty($_POST['user_id']) ? ' ' : " user_id = " . $_POST['user_id'] . "  and ";

        if($dur_time == ' '){
            $this->response->err = 1;
            $this->response->msg = '非法请求!';
            $this->json_view($this->response);
        }
        $limit = empty($_POST['limit']) ? "25" : $_POST['limit'];
        $page  = empty($_POST['page']) ? '0' : $_POST['page'];
        $page  = $page * $limit;

        $sql = "SELECT * FROM card where " . $card_num . $dur_time . $user_id . "limit $page,$limit";
        $sql = substr_replace($sql, '', strripos($sql, 'and'), 3);

        $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ok  = $res->execute();
        if (!$ok) {
            //0条也=ok
            throw new Exception('数据库语句错误: ' . $sql, 1049);
        } else {
            $arr = $res->fetchAll(PDO::FETCH_ASSOC);
            $arr = fun::key2str($arr);
        }
        if (!empty($arr)) {
            //二维的arr
            $this->response->err       = 0;
            $this->response->msg       = '获取数据成功!';
            $this->response->data      = $arr;
            $this->response->data_num  = count($arr);
            $this->response->timestamp = $_SERVER['REQUEST_TIME']; // 不污染data，二维数组
            $this->response->sign      = fun::sign($arr);
            $this->json_view($this->response);
        } else {
            $this->response->err = 1;
            $this->response->msg = '获取数据失败!';
            $this->json_view($this->response);
        }
    }




/**
 *  卡号添加: 管理员
 *
 */
    public function add_card()
    {

        if (!empty($_GET['chenjing'])) {
            //临时生成7天，30天，3个月，12个月
            $value    = '';
            $card     = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
            $pwd      = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
            $dur_time = $_GET['chenjing'] * 24 * 3600;
            //取随机32位字符串
            for ($i = 1; $i <= 100; $i++) {
                $card_num = substr(str_shuffle($card), mt_rand(0, strlen($card) - 33), 32);
                $password = substr(str_shuffle($card), mt_rand(0, strlen($card) - 17), 16);
                $value    = $value . "('$card_num',$dur_time,'$password'),";
            }
            $value = rtrim($value, ',');

            //创建100条
            $sql   = "INSERT IGNORE INTO card(card_num,dur_time,password) VALUES $value ";
            $count = $this->db->exec($sql); // 返回受影响行数，没有则返回0
            if ($count == 0) {
                $this->response->err = 1;
                $this->response->msg = '创建失败!';
                $this->json_view($this->response);
            } else {
                $this->response->err = 0;
                $this->response->msg = '创建成功!';
                $this->json_view($this->response);
            }
        }
    }

}
