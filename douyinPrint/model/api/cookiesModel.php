<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class cookiesModel extends parentModel
{
  

    /** 
    *  获取
    *
    */
    public function get_user_list()
    {
        
        $sql    = "select * from user where 1"; 
       
       $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)); 
        $ok  = $res->execute();
        if (!$ok) { //0条也=ok
            throw new Exception('数据库语句错误: ' . $sql);
        } else {
            $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        }
        if (empty($arr)) {
            $this->response->err  = 1;
            $this->response->msg  = '数据为空!';
            $this->response->data = [];
          $this->response->data_num = 0;
            return $this->response;
        } else {
		
          $this->response->err  = 0;
            $this->response->msg  = '获取成功!';
            $this->response->data = $arr;
          $this->response->data_num = count($arr);
            return $this->response;
        }
    }

  
    /** 
    *  获取
    *
    */
    public function get_cookies()
    {

		$_POST['user_id'] = empty($_POST['user_id']) ? $id_GET['user_id'] : $_POST['user_id'];
      $user_id = $_POST['user_id'];
      
        $sql    = "select * from cookies where user_id = '$user_id'"; 

        $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)); 
        $ok  = $res->execute();
        if (!$ok) { //0条也=ok
            throw new Exception('数据库语句错误: ' . $sql);
        } else {
            $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        }
        if (empty($arr)) {
            $this->response->err  = 1;
            $this->response->msg  = '获取失败!';
            $this->response->data = [];
          $this->response->data_num = 0;
            return $this->response;
        } else {
          
            $this->response->err  = 0;
            $this->response->msg  = '获取成功!';
            $this->response->data = $arr;
          $this->response->data_num = count($arr);
            return $this->response;
        }
    }
  
  
// 修改密码
    public function update()
    {
        if (empty($_POST['user_id']) ) {
           $this->response->err  = 1;
            $this->response->msg  = 'user_id不能为空!';
           $this->response->data_num = 0;
            return $this->response;
        }
        $user_id       = $_POST['user_id']; 
      // $cookies       = urldecode($_POST['cookies']); 
        $cookies       = $_POST['cookies']; 
      $buyin_username       = $_POST['buyin_username']; 
      
      // 是否存在，避免重复
         $sql = "select user_id from cookies where user_id = '" . $user_id . "'";
		 $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ok = $res->execute();
      if (!$ok) {  //0条也=ok
            throw new Exception('数据库语句错误: ' . $sql);
             }else{
             $arr = $res->fetchAll(PDO::FETCH_ASSOC);
           }
      if (!empty($arr)) {  //存在user_id!
            $sql = "UPDATE cookies SET cookies= '" . $cookies . "',buyin_username= '" . $buyin_username . "' WHERE user_id = " . $user_id;
           $count = $this->db->exec($sql); //返回受此语句影响的行数
           if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '存在user_id，数据相同，无更新!'; // 也可能是成功的
			$this->response->data_num = $count;
            return $this->response;
            }else{ 
             $this->response->err  = 0;
            $this->response->msg  = '存在user_id，更新成功!';
			$this->response->data_num = $count;
            return $this->response;
          }
        }else{ //不存在
      
      $sql = "INSERT IGNORE INTO cookies(user_id,cookies) VALUES ($user_id,'$cookies')";
        $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ok = $res->execute();
         if (!$ok) {  //0条也=ok
            throw new Exception('数据库语句错误: ' . $sql);
             }else{
            $last_id =  $this->db->lastInsertId();
           }
        
        if ($last_id < 1) {
            $this->response->err  = 1;
            $this->response->msg  = '添加user_id失败!';
           $this->response->data[] = $last_id;
           $this->response->data_num = 0;
            return $this->response;
        } else{
         $this->response->err  = 0;
            $this->response->msg  = '添加user_id成功!';
           $this->response->data[] = $last_id;
           $this->response->data_num = 1;
            return $this->response;
        }

      }

}
  }