<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class adminModel extends parentModel
{

    /**
     * 获取所有列表
     *
     */
    public function get_list()
    {
            if(!isset($_POST['ver'])){
            $this->response->err  = 1;
            $this->response->msg  = '软件版本过低，请升级!';
            //$this->jsonView($this->response);
            return $this->response;
           }
		
		$nick = empty($_POST['nick']) ? '' : " custom.nick like '%" . $_POST['nick'] . "%' and ";
		$name = empty($_POST['name']) ? '' : " custom.name like '%" . $_POST['name'] . "%' and ";
		$stock = empty($_POST['stock']) ? '' : " custom.stock like '%" . $_POST['stock'] . "%' and ";
		$sec_uid = empty($_POST['sec_uid']) ? '' : " custom.sec_uid like '%" . $_POST['sec_uid'] . "%' and ";
		$id = empty($_POST['id']) ? '' : " custom.id = '" . $_POST['id'] . "' and ";
		$limit = empty($_POST['limit']) ? '25' : $_POST['limit'];
      $page = empty($_POST['page']) ? '0' : $_POST['page'];
      $page = $page * $limit;
      
		$nick2 = empty($_POST['nick2']) ? '' : $_POST['nick2'];
		$name2 = empty($_POST['name2']) ? '' : $_POST['name2'];
      $id2 = empty($_POST['id2']) ? '' : $_POST['id2'];
		
        //$sql = "SELECT * FROM custom order by id desc limit $page,$limit";
		
		$sql = "select custom.*,user.username as manage_name from custom,user where custom.manage = user.id  and " . $nick . $name . $stock . $sec_uid . $id . " order by last_time desc limit $page,$limit";
		//$str_and = strripos($sql,'and');
		$sql = substr_replace($sql,'',strripos($sql,'and'),3);
//echo $sql;
//exit;
      
      
      
		if (!empty($_POST['do']) && $_POST['do'] == 'nick_null') { // 昵称异常
			$sql = "select * from custom where nick = '' or nick is NULL or (nick In (SELECT nick FROM custom GROUP BY nick HAVING Count(*)>1 )) order by nick limit $limit";
		}
		if (!empty($_POST['do']) && $_POST['do'] == 'name_null') { 
			$sql = "select * from custom where name = '' or name is NULL order by last_time  limit $limit";
		}
		if (!empty($_POST['do']) && $_POST['do'] == 'sec_uid_null') { // sec_uid位数小于多少
			$sql = "select * from custom where LENGTH(sec_uid)<=20 order by last_time  limit $limit";
		}
		if (!empty($_POST['do']) && $_POST['do'] == 'stock_null') { 
			$sql = "select * from custom where stock = '' or stock is NULL  order by last_time  limit $limit";
		}
		if (!empty($_POST['do']) && $_POST['do'] == 'last_edit') { 
			$sql = "select * from custom  order by last_time desc limit $limit";
		}
      if (!empty($_POST['do']) && $_POST['do'] == 'last_add') { 
			$sql = "select * from custom  order by id desc limit $limit";
		}
      
      
      if (!empty($_POST['do']) && $_POST['do'] == 'nick_name') { 
			//优先级最高在最后，昵称或收件人
        $sql = "select custom.*,user.username as manage_name from custom,user where  custom.manage = user.id  and (custom.nick like '%" . $nick2 . "%' or  custom.name like '%" . $name2 . "%' or  custom.id = '" . $id2 . "')  order by last_time desc limit $page,$limit";
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
     *  添加
     *
     */
    public function add()
    {
        //$_POST = $_GET;
		if (empty($_POST['nick']) || empty($_POST['sec_uid']) ){
            $this->response->err  = 1;
            $this->response->msg  = '参数错误！nick和sec_uid不能为空！';
            $this->response->data = [];
            return $this->response;
        }

        $nick         = empty($_POST['nick']) ? '' : $_POST['nick'];
		$name         = empty($_POST['name']) ? '' : $_POST['name'];
		$num =      empty($_POST['num']) ? 0 : $_POST['num'];
        $sec_uid = empty($_POST['sec_uid']) ? '' : $_POST['sec_uid'];
		 $stock       = empty($_POST['stock']) ? '' : $_POST['stock'];
		 $join_time  = $_SERVER['REQUEST_TIME'];
		 $last_time  = $_SERVER['REQUEST_TIME'];
      $manage    = $_SESSION['user']['id'];
		 
		 // http://127.0.0.1/douyinPrint/api/custom/add/?nick=yyy&name=hhhh&uid=999&sec_uid=kkkkk&stock=100-10
        $sql = "INSERT IGNORE INTO custom(nick,name,num,sec_uid,stock,join_time,last_time,manage) VALUES ('$nick','$name',$num,'$sec_uid','$stock',$join_time,$last_time,$manage)";		
        //$sql = "REPLACE INTO order_info($keys) VALUES $values2";  //存在则更新（删后插入），不存在则插入，效率比update高
        $count = $this->db->exec($sql); // 返回受影响行数，没有则返回0
        if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '添加失败!';
            return $this->response;
        } else {
            $this->response->err    = 0;
            $this->response->msg    = '添加成功!';
            $this->response->data[] = $count;
            return $this->response;
        }
    }
	

    /**
     *  编辑
     *
     */
    public function edit()
    {
        
		if (empty($_POST['id'])) {
            $this->response->err  = 1;
            $this->response->msg  = '参数错误！id不能为空！';
            $this->response->data = [];
            return $this->response;
        }

        $id = $_POST['id'];
		$nick         = empty($_POST['nick']) ? 'nick=nick' : "nick='".$_POST['nick']."'";
		$name         = empty($_POST['name']) ? 'name=name' : "name='".$_POST['name']."'";
		$num =          empty($_POST['num']) ? 'num=num' : "num=".$_POST['num'];
        $sec_uid =      empty($_POST['sec_uid']) ? 'sec_uid=sec_uid' : "sec_uid='".$_POST['sec_uid']."'";
		$stock       =  empty($_POST['stock']) ? 'stock=stock' : "stock='".$_POST['stock']."'";
		$last_time  = $_SERVER['REQUEST_TIME'];
      //$manage    = $_SESSION['user']['id'];
      $manage    =  "manage=" . $_SESSION['user']['id'];
      
      
        // http://127.0.0.1/douyinPrint/api/custom/edit/?id=110&nick=yyy&name=hhhh&uid=999&sec_uid=kkkkk
        //$sql = "UPDATE custom SET $nick,$name,$num,$uid,$sec_uid WHERE id = $id";
		$sql = "UPDATE custom SET $nick,$name,$num,$sec_uid,$stock,last_time=$last_time,$manage  WHERE id = $id";
		//echo $sql;
        $count = $this->db->exec($sql);
        if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '修改失败!';
            $this->response->data = $sql;
            return $this->response;
        } else {
            $this->response->err  = 0;
            $this->response->msg  = '修改成功!';
            $this->response->data = [];
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
            $this->response->data = [];
            return $this->response;
        }
        $id    = $_POST['id'];
        $sql   = "DELETE FROM custom WHERE id = $id";
        $count = $this->db->exec($sql);
        if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '删除失败!';
            $this->response->data = [];
            return $this->response;
        } else {
            $this->response->err  = 0;
            $this->response->msg  = '删除成功!';
            $this->response->data = [];
            return $this->response;
        }
    }

}
