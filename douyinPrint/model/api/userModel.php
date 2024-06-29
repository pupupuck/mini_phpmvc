<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class userModel extends parentModel
{
	
    /** 
    *  用户登录
    *
    */
    public function login()
    {
        //echo $_POST['username'];
		//echo $_POST['password'];
		$_POST['username'] = empty($_POST['username']) ? $_GET['username'] : $_POST['username'];
		$_POST['password'] = empty($_POST['password']) ? $_GET['password'] : $_POST['password'];
		//$_POST = $_GET;
		if (empty($_POST['username']) || empty($_POST['password'])) {
            //throw new Exception('用户名或密码不能为空');
            $this->response->err  = 1;
            $this->response->msg  = '用户名或密码不能为空!';
            $this->response->data = [];
           $this->response->data_num = 0;
            return $this->response;
        }
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
      $soft_ver = empty($_POST['soft_ver']) ? '0' : $_POST['soft_ver'];
      $update_ver = empty($_POST['update_ver']) ? '0' : $_POST['update_ver'];
      $last_time  = $_SERVER['REQUEST_TIME'];
      
		//http://127.0.0.1/douyinPrint/user/login?username=admin&password=123
        $sql    = "select * from user where username = '$username' AND password = '$password' limit 0,1"; // 加个单引号就好了
     // $sql    = "select sys.*,user.* from user,sys where user.username = '$username' AND user.password = '$password' AND sys.id = 1 limit 0,1"; // 加个单引号就好了

        $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)); 
        $ok  = $res->execute();
        if (!$ok) { //0条也=ok
            throw new Exception('数据库语句错误: ' . $sql);
        } else {
            $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        }
        if (empty($arr)) {
            $this->response->err  = 1;
            $this->response->msg  = '用户名或密码错误!';
            $this->response->data = [];
          $this->response->data_num = 0;
            return $this->response;
        } else {
            $_SESSION['user'] = $arr[0]; //session_commit(); 将session写入到文件，不阻塞
		
          $id       = $_SESSION['user']['id'];
          $sql = "UPDATE user SET soft_ver= '" . $soft_ver . "',update_ver= '" . $update_ver . "',last_time= '" . $last_time . "' WHERE id = " . $id;
          $count = $this->db->exec($sql);
          
            $this->response->err  = 0;
            $this->response->msg  = '登录成功!';
            $this->response->data = $arr;
          $this->response->data_num = count($arr);
            return $this->response;
        }
    }

// 修改密码
    public function change_password()
    {
        if (empty($_POST['password']) ) {
            //sys::msg('ERROR::密码输入有误，密码长度在6-16位之间'. __FUNCTION__);
           $this->response->err  = 1;
            $this->response->msg  = '错误，密码长度在6-16位之间!';
           $this->response->data_num = 0;
            return $this->response;
        }
//print_r($_SESSION["user"]);
        $id       = $_SESSION['user']['id']; 
        $password = sha1($_POST['password']);

  $sql = "UPDATE user SET password= '" . $password . "' WHERE id = " . $id;
		//echo $id;
        $count = $this->db->exec($sql);
        if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '修改密码失败!';
			$this->response->data_num = $count;
            return $this->response;
        } 

        $this->response->err  = 0;
            $this->response->msg  = '修改密码成功!';
			$this->response->data_num = $count;
            return $this->response;

}
  }