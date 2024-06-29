<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class customModel extends parentModel
{


	
    /**
     * 获取所有列表
     *
     */
    public function get_list()
    {
//$_POST = $_GET;
		$nick = empty($_POST['nick']) ? " " : $_POST['nick'];
		$name = empty($_POST['name']) ? " " : $_POST['name'];
      $id = empty($_POST['id']) ? " " : $_POST['id'];
      $sec_uid = empty($_POST['sec_uid']) ? " " : $_POST['sec_uid'];
		$limit = empty($_POST['limit']) ? "10" : $_POST['limit'];
		
		
        $sql = "SELECT * FROM custom order by nick limit $limit";
		
		if (!empty($_POST['do']) && $_POST['do'] == 'nick_name') { //点击查询时，删除，时用到
			$sql = "select * from custom where nick like '%" . $nick . "%' or name like '%" . $name . "%' or id = '" . $id . "' order by nick  limit $limit";
		}
		if (!empty($_POST['do']) && $_POST['do'] == 'nick') { //唯一值，查询数据库_昵称，时用到
			$sql = "select * from custom where nick = '" . $nick . "'  limit $limit";
		}
		if (!empty($_POST['do']) && $_POST['do'] == 'sec_uid') { // 真正的唯一值，以后就用它，只返回1条，如有多余的，以后修复删掉
			$sql = "select * from custom where sec_uid = '" . $sec_uid . "'  limit $limit";
		}
		
        $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ok  = $res->execute();
        if (!$ok) {
            //0条也=ok
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
            $this->response->msg  = '获取数据成功!';
            $this->response->data = $arr;
          $this->response->data_num = count($arr);
            return $this->response;
        }
    }

  
    /**
     * 获取一个
     *
     */
    public function get_one()
    {
//$_POST = $_GET;
		$nick = empty($_POST['nick']) ? " " : $_POST['nick'];
		$name = empty($_POST['name']) ? " " : $_POST['name'];
        $sec_uid = empty($_POST['sec_uid']) ? " " : $_POST['sec_uid'];
		$limit = empty($_POST['limit']) ? "20" : $_POST['limit'];
		
		
		if (!empty($_POST['do']) && $_POST['do'] == 'nick') { //唯一值，查询数据库_昵称，时用到
			$sql = "select * from custom where nick = '" . $nick . "'  limit $limit";
		}
		if (!empty($_POST['do']) && $_POST['do'] == 'sec_uid') { // 真正的唯一值，以后就用它，只返回1条，如有多余的，以后修复删掉
			$sql = "select * from custom where sec_uid = '" . $sec_uid . "' limit 1";
		}
		
        $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ok  = $res->execute();
         if (!$ok) {  //0条也=ok
            throw new Exception('数据库语句错误: ' . $sql);
            }else{
             $arr = $res->fetchAll(PDO::FETCH_ASSOC);
          }
      
         if (!empty($arr)) { //发现sec_uid
            $this->response->err  = 0;
            $this->response->msg  = '获取sec_uid数据成功!';
            $this->response->data = $arr;
           $this->response->data_num = count($arr);
            return $this->response;
        }
      
      $this->response->err  = 1;
      $this->response->msg  = '数据为空!';
      $this->response->data = [];
      $this->response->data_num = 0;
      return $this->response;

    }
	
  
  
    /**
     *  添加
     *
     */
    public function add()
    {
        //$_POST = $_GET;
		if (empty($_POST['nick']) || empty($_POST['sec_uid'])) {
            $this->response->err  = 1;
            $this->response->msg  = '参数错误！nick和sec_uid不能为空！';
          $this->response->data[] = 0;
         $this->response->data_num = 0;
            return $this->response;
        }

        $nick         = empty($_POST['nick']) ? '' : $_POST['nick'];
		$name         = empty($_POST['name']) ? '' : $_POST['name'];
		$num     =      empty($_POST['num']) ? 1 : $_POST['num'];
        $sec_uid     =  empty($_POST['sec_uid']) ? '' : $_POST['sec_uid'];
		 $stock       = empty($_POST['stock']) ? '' : $_POST['stock'];
         $goods_num   = empty($_POST['goods_num']) ? 0 : $_POST['goods_num'];
         $price       = empty($_POST['price']) ? 0 : $_POST['price']; 
        $price       = is_numeric($price) ? $price : 0;
         $remark       = empty($_POST['remark']) ? '' : $_POST['remark'];
		 $last_time  = $_SERVER['REQUEST_TIME'];
         $join_time  = $_SERVER['REQUEST_TIME'];
      $manage    = $_SESSION['user']['id']; 
		
      // 是否存在，避免重复，sec_uid
         $sql = "select id from custom where sec_uid = '" . $sec_uid . "'";
		 $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ok = $res->execute();
      if (!$ok) {  //0条也=ok
            throw new Exception('数据库语句错误: ' . $sql);
             }else{
             $arr = $res->fetchAll(PDO::FETCH_ASSOC);
           }
      if (!empty($arr)) {
           $this->response->err  = 1;
            $this->response->msg  = '重复sec_uid，添加失败!';
          $this->response->data[] = 0;
          $this->response->data_num = 0;
            return $this->response;
        }
      
      //新人添加不改manage
		 // http://127.0.0.1/douyinPrint/api/custom/add/?nick=yyy&name=hhhh&uid=999&sec_uid=kkkkk&stock=100-10
        $sql = "INSERT IGNORE INTO custom(nick,name,num,sec_uid,stock,join_time,last_time) VALUES ('$nick','$name',$num,'$sec_uid','$stock',$join_time,$last_time)";
        $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ok = $res->execute();
         if (!$ok) {  //0条也=ok
            throw new Exception('数据库语句错误: ' . $sql);
             }else{
            $last_id =  $this->db->lastInsertId();
           }
        
        if ($last_id < 1) {
            $this->response->err  = 1;
            $this->response->msg  = '添加custom失败!';
           $this->response->data[] = $last_id;
           $this->response->data_num = 0;
            return $this->response;
        } 
      
      if ($goods_num == 0) { //编号为空表示：1不打印纯修改，2纯添加新人，3测试打印
            $this->response->err  = 0;
            $this->response->msg  = '添加custom成功!';
           $this->response->data[] = $last_id;
           $this->response->data_num = 1;
            return $this->response;
        }
      
          // 添加订单
          $sql = "INSERT IGNORE INTO goods_order(custom_id,goods_num,price,order_time,remark,manage) VALUES ($last_id,$goods_num,$price,$join_time,'$remark',$manage)";
           $count = $this->db->exec($sql); // 返回受影响行数，没有则返回0
          if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '添加custom成功!添加goods_order失败!';
            $this->response->data[] = $last_id;
           $this->response->data_num = 1;
            return $this->response;
          } else {
            $this->response->err    = 0;
            $this->response->msg    = '添加custom成功!添加goods_order成功!';
            $this->response->data[] = $last_id;
           $this->response->data_num = 1;
            return $this->response;
        } 
          
    }


    /**
     *  编辑，update主要更新次数
     *
     */
    public function edit()
    {
        
		if (empty($_POST['id'])) {
            $this->response->err  = 1;
            $this->response->msg  = '参数错误！id不能为空！';
            $this->response->data = [];
          $this->response->data_num = 0;
            return $this->response;
        }

        $id = $_POST['id'];
		$nick         = empty($_POST['nick']) ? 'nick=nick' : "nick='".$_POST['nick']."'";
		$name         = empty($_POST['name']) ? 'name=name' : "name='".$_POST['name']."'";
		$num =          empty($_POST['num']) ? 'num=num' : "num=".$_POST['num'];
        $sec_uid =      empty($_POST['sec_uid']) ? 'sec_uid=sec_uid' : "sec_uid='".$_POST['sec_uid']."'";
		$stock       =  empty($_POST['stock']) ? 'stock=stock' : "stock='".$_POST['stock']."'";
		$order_time  = $_SERVER['REQUEST_TIME'];
		$last_time  = $_SERVER['REQUEST_TIME'];
      $manage    =  $_SESSION['user']['id'];
      
         $goods_num       = empty($_POST['goods_num']) ? 0 : $_POST['goods_num'];
         $price       = empty($_POST['price']) ? 0 : $_POST['price'];
         $price       = is_numeric($price) ? $price : 0;
         $remark       = empty($_POST['remark']) ? '' : $_POST['remark'];
      
      
      //这里不应该添加manage，前台修改不算？  另起一个函数吧
      // http://127.0.0.1/douyinPrint/api/custom/edit/?id=110&nick=yyy&name=hhhh&uid=999&sec_uid=kkkkk
        //$sql = "UPDATE custom SET $nick,$name,$num,$uid,$sec_uid WHERE id = $id";
		$sql = "UPDATE custom SET $nick,$name,$num,$sec_uid,$stock,last_time=$last_time WHERE id = $id";
		//echo $sql;
        $count = $this->db->exec($sql); //返回受此语句影响的行数
        if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '修改custom影响0行!';
			$this->response->data_num = $count;
            return $this->response;
        }
           
      if ( $goods_num == 0) {  //正常时不为空，用编号是空区分前后台 ，编号为空表示：1打印测试，2不打印纯修改
            $this->response->err  = 0;
            $this->response->msg  = '修改custom成功!';
			$this->response->data_num = $count;
            return $this->response;
        }
         
            // 添加订单，修改时不会添加订单，上面已拦截
          $sql = "INSERT IGNORE INTO goods_order(custom_id,goods_num,price,order_time,remark,manage) VALUES ($id,$goods_num,$price,$order_time,'$remark',$manage)";
           $count = $this->db->exec($sql);
          if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '修改custom成功!添加goods_order失败!';
            return $this->response;
          } else {
            $this->response->err    = 0;
            $this->response->msg    = '修改custom成功!添加goods_order成功!';
			$this->response->data_num =  $count;
            return $this->response;
        }   
		
        
    }

  
  
   /**
     *  编辑, 前台修改收件人和库位号，也要加manage
     *
     */
    public function edit_name()
    {
        
		if (empty($_POST['id'])) {
            $this->response->err  = 1;
            $this->response->msg  = '参数错误！id不能为空！';
          $this->response->data_num = 0;
            return $this->response;
        }

        $id = $_POST['id'];
		$nick         = empty($_POST['nick']) ? 'nick=nick' : "nick='".$_POST['nick']."'";
		$name         = empty($_POST['name']) ? 'name=name' : "name='".$_POST['name']."'";
		$num =          empty($_POST['num']) ? 'num=num' : "num=".$_POST['num'];
        $sec_uid =      empty($_POST['sec_uid']) ? 'sec_uid=sec_uid' : "sec_uid='".$_POST['sec_uid']."'";
		$stock       =  empty($_POST['stock']) ? 'stock=stock' : "stock='".$_POST['stock']."'";
		$order_time  = $_SERVER['REQUEST_TIME'];
		$last_time  = $_SERVER['REQUEST_TIME'];
      $manage    =  $_SESSION['user']['id'];
      
      
        //$sql = "UPDATE custom SET $nick,$name,$num,$uid,$sec_uid WHERE id = $id";
		$sql = "UPDATE custom SET $nick,$name,$num,$sec_uid,$stock,last_time=$last_time,manage=$manage WHERE id = $id";
		//echo $sql;
        $count = $this->db->exec($sql);
        if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '修改custom失败!';
			$this->response->data_num = $count;
            return $this->response;
        } else{ 
            $this->response->err  = 0;
            $this->response->msg  = '修改custom成功!';
			$this->response->data_num = $count;
            return $this->response;
        }

    }
  
  
    /**
     *  删除
     *
     */
    public function del()
    {
        if (empty($_POST['id'])) {
            $this->response->err  = 1;
            $this->response->msg  = '参数错误！id不能为空！';
			$this->response->data_num = 0;
            return $this->response;
        }
        $id    = $_POST['id'];
        $sql   = "DELETE FROM custom WHERE id = $id";
        $count = $this->db->exec($sql);
        if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '删除失败!';
			$this->response->data_num = $count;
            return $this->response;
        } else {
            $this->response->err  = 0;
            $this->response->msg  = '删除成功!';
			$this->response->data_num = $count;
            return $this->response;
        }
    }

}
