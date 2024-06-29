<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class cardModel extends baseModel
{
    
    /**
     *  需要登录
     *
     */
    public function __construct()
    {
        parent::__construct(); //子类定义了构造函数，则不会自动调用父构造函数了。需要手动调用
        if (empty($_SESSION['user'])) {
            $this->response->err = 1;
            $this->response->msg = '用户未登录，请登录!';
            $this->json_view($this->response);
        }
    }
        
   
    /**
     *  卡号验证: card_num
     *
     */
    public function check_card()
    {

        if (empty($_POST['card_num'])) {
            $this->response->err = 1;
            $this->response->msg = '验证失败，卡号不能为空!';
            $this->json_view($this->response);
        }

        $card_num = $_POST['card_num'];
        //$origin_uid       = $_POST['origin_uid'];
        //$buyin_account_id = $_POST['buyin_account_id'];

        $sql = "select dur_time from card where card_num = '$card_num' and used_time = 0 limit 0,1"; // 加个单引号就好了
        $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ok  = $res->execute();
        if (!$ok) {
            //0条也=ok
            throw new Exception('数据库语句错误', 1049);
        } else {
            $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        }

        if (!empty($arr)) {
            $this->response->err  = 0;
            $this->response->msg  = '验证成功，卡号有效!';
            $this->response->data = $arr[0]['dur_time'];
            $this->json_view($this->response);
        } else {
            $this->response->err = 1;
            $this->response->msg = '验证失败，卡号无效!';
            $this->json_view($this->response);
        }

    }

    /**
     *  卡号充值: card_num，password，origin_uid，buyin_account_id
     *
     */
    public function recharge()
    {

        if (empty($_POST['card_num']) || empty($_POST['password'])) {
            $this->response->err = 1;
            $this->response->msg = '充值失败，卡号密码不能为空!';
            $this->json_view($this->response);
        }

        $card_num = $_POST['card_num'];
        $password = $_POST['password'];
        $used_time = $_SERVER['REQUEST_TIME'];
        $user_id   = $_SESSION['user']['id'];


        $sql = "select id,dur_time from card where card_num = '$card_num' and password = '$password' and used_time = 0 limit 0,1"; // 注意单引号
        //$sql = "select id,dur_time from card where 'card_num' = '$card_num' and 'password' = '$password' and 'used_time' = 0 "; 
        $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ok  = $res->execute();
        if (!$ok) {
            //0条也=ok
            throw new Exception('数据库语句错误', 1049);
        } else {
            $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        }
        // 数据为空
        if (empty($arr)) {
            $this->response->err = 1;
            $this->response->msg = '充值失败，账号密码或卡号有误!';
            $this->json_view($this->response);
        }

        $dur_time = $arr[0]['dur_time'];
        $id = $arr[0]['id'];

        //不为空，sql已验证过条件，这里标记卡号已使用
        $sql = "UPDATE `card` SET `user_id` = $user_id,`used_time` = $used_time WHERE `id` = $id ";
        //echo $sql;
        $count = $this->db->exec($sql); //受影响行数
        if ($count == 0) {
            $this->response->err = 1;
            $this->response->msg = '充值失败，卡号更新失败!';
            $this->json_view($this->response);
        }

        //写入user到期时间
        $sql = "UPDATE user SET end_time = end_time+$dur_time WHERE id = $user_id";
        //echo $sql;
        $count = $this->db->exec($sql); //受影响行数
        if ($count == 0) {
            $this->response->err = 1;
            $this->response->msg = '充值失败，时间更新失败!';
            $this->json_view($this->response);
        } else {
            $arr = [];
            $arr[0]                      = array('dur_time' => "$dur_time");
            $arr = fun::key2str($arr);
            $this->response->err      = 0;
            $this->response->msg      = '充值成功!';
            $this->response->data     = $arr;
            $this->response->data_num = count($arr);
            $this->response->timestamp = $_SERVER['REQUEST_TIME'];
            $this->response->sign     = fun::sign($arr);
            $this->json_view($this->response);
        }

    }



}
