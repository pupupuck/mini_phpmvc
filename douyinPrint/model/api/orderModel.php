<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class orderModel extends parentModel
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
      
      //$_POST = $_GET;
		$nick2 = empty($_POST['nick2']) ? ' ' : $_POST['nick2'];
		$name2 = empty($_POST['name2']) ? ' ' : $_POST['name2'];
        $id2 = empty($_POST['id2']) ? ' ' : $_POST['id2'];
       $page = empty($_POST['page']) ? '0' : $_POST['page'];
      $limit = empty($_POST['limit']) ? '25' : $_POST['limit'];
      $page = $page * $limit;
		
		// 都要联合查询
      $nick_name_sql = empty($_POST['nick_name']) ? ' ' : " (custom.nick like '%" . $_POST['nick_name'] . "%' or  custom.name like '%" . $_POST['nick_name'] . "%' or  custom.id = '" . $_POST['nick_name'] . "') and ";
		$remark_sql  = empty($_POST['remark']) ? ' ' : " goods_order.remark like '" . $_POST['remark'] . "%' and ";
		$goods_num_sql  = empty($_POST['goods_num']) ? ' ' : " goods_order.goods_num='" . $_POST['goods_num'] . "' and ";
		$stock_sql  = empty($_POST['stock']) ? ' ' : " custom.stock='" . $_POST['stock'] . "' and ";
        $time_sql  = empty($_POST['time1']) ? ' ' : " goods_order.order_time > ".$_POST['time1']." and  goods_order.order_time < ".$_POST['time2']." and ";
		
      //后面会覆盖前面,曾出现过因数据问题，默认0，造成搜索结果出错，联合查询id位0
        //$sql    = "select custom.*,goods_order.*,1 as order_num from custom,goods_order where custom.id = goods_order.custom_id and " . $nick_name_sql . $goods_num_sql . $stock_sql . $remark_sql . $time_sql . " order by goods_order.order_time  limit " . $page . "," . $limit; 
      $sql    = "select custom.*,goods_order.*,user.username as manage_name from user,custom,goods_order where custom.id = goods_order.custom_id and goods_order.manage = user.id and " . $nick_name_sql . $goods_num_sql . $stock_sql . $remark_sql . $time_sql . " order by goods_order.order_time desc  limit " . $page . "," . $limit; 
        
      $sql = substr_replace($sql,'',strripos($sql,'and'),3); //删掉最后一个and
		
		
		// 下面是特殊情况
		if (!empty($_POST['do']) && $_POST['do'] == 'nick_name') { 
			$sql = "select custom.*,goods_order.*,1 as order_num from custom,goods_order where custom.id = goods_order.custom_id and (custom.nick like '%" . $nick2 . "%' or  custom.name like '%" . $name2 . "%' or  custom.id = '" . $id2 . "') order by goods_order.order_time desc  limit $limit";
		}
		if (!empty($_POST['do']) && $_POST['do'] == 'last_order') { 
			$sql = "select custom.*,goods_order.*,1 as order_num from custom,goods_order where custom.id = goods_order.custom_id  order by goods_order.order_time desc limit $limit";
		}
		if (!empty($_POST['do']) && $_POST['do'] == 'custom_top_30day') { 
          $time1 = $_SERVER['REQUEST_TIME'] - 30*24*60*60;
			$sql = "select custom.*,goods_order.*,count(goods_order.custom_id) as order_num from custom,goods_order where custom.id = goods_order.custom_id  and order_time >= $time1 GROUP BY goods_order.custom_id  order by order_num  limit $limit";
		}
        if (!empty($_POST['do']) && $_POST['do'] == 'custom_top_7day') { 
		$time1 = $_SERVER['REQUEST_TIME'] - 7*24*60*60;
          $sql = "select custom.*,goods_order.*,count(goods_order.custom_id) as order_num from custom,goods_order where custom.id = goods_order.custom_id and order_time >= $time1 GROUP BY goods_order.custom_id  order by order_num  limit $limit";
		}
      if (!empty($_POST['do']) && $_POST['do'] == 'remark_24h') { 
		$time1 = $_SERVER['REQUEST_TIME'] - 1*24*60*60;
          $sql = "select custom.*,goods_order.*,1 as order_num from custom,goods_order where custom.id = goods_order.custom_id and order_time >= $time1  and goods_order.remark like '包邮' order by goods_order.order_time limit 300";
		}
      if (!empty($_POST['do']) && $_POST['do'] == 'remark_48h') { 
		$time1 = $_SERVER['REQUEST_TIME'] - 2*24*60*60;
          $sql = "select custom.*,goods_order.*,1 as order_num from custom,goods_order where custom.id = goods_order.custom_id and order_time >= $time1 and goods_order.remark like '包邮' order by goods_order.order_time  limit 500";
		}
      if (!empty($_POST['do']) && $_POST['do'] == 'remark_72h') { 
		$time1 = $_SERVER['REQUEST_TIME'] - 3*24*60*60;
          $sql = "select custom.*,goods_order.*,1 as order_num from custom,goods_order where custom.id = goods_order.custom_id and goods_order.order_time >= $time1  and goods_order.remark like '包邮' order by goods_order.order_time  limit 500";
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
            //$this->response->msg  = '数据为空!';
           $this->response->msg  = $sql;
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
		if (empty($_POST['custom_id']) || empty($_POST['goods_num'])) {
            $this->response->err  = 1;
            $this->response->msg  = '参数错误！custom_id和goods_num不能为空！';
            $this->response->data = [];
         $this->response->data_num = 0;
            return $this->response;
        }

        $custom_id         = empty($_POST['custom_id']) ? '' : $_POST['custom_id'];
		$goods_num         = empty($_POST['goods_num']) ? '' : $_POST['goods_num'];
		$price =      empty($_POST['price']) ? 0 : $_POST['price'];
		 $remark       = empty($_POST['remark']) ? '' : $_POST['remark'];
		 $order_time  = $_SERVER['REQUEST_TIME'];
        $manage    = $_SESSION['user']['id']; 

		 
		 // http://127.0.0.1/douyinPrint/api/custom/add/?nick=yyy&name=hhhh&uid=999&sec_uid=kkkkk&stock=100-10
        $sql = "INSERT IGNORE INTO goods_order(custom_id,goods_num,price,order_time,remark,manage) VALUES ('$custom_id','$goods_num',$price,'$order_time','$remark',$manage)";
        //$sql = "REPLACE INTO order_info($keys) VALUES $values2";  //存在则更新（删后插入），不存在则插入，效率比update高，先删除再添加 id会变
        $count = $this->db->exec($sql); // 返回受影响行数，没有则返回0
        if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '添加失败!';
            return $this->response;
        } else {
            $this->response->err    = 0;
            $this->response->msg    = '添加成功!';
            $this->response->data[] = $count;
			$this->response->data_num =  $count;
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
          $this->response->data_num = 0;
            return $this->response;
        }

        $id = $_POST['id'];
		$custom_id         = empty($_POST['custom_id']) ? 'custom_id=custom_id' : "custom_id='".$_POST['custom_id']."'";
		$goods_num         = empty($_POST['goods_num']) ? 'goods_num=goods_num' : "goods_num='".$_POST['goods_num']."'";
		$price =          empty($_POST['price']) ? 'price=price' : "price=".$_POST['price'];
        $remark =      empty($_POST['remark']) ? 'remark=remark' : "remark='".$_POST['remark']."'";

        // http://127.0.0.1/douyinPrint/api/custom/edit/?id=110&nick=yyy&name=hhhh&uid=999&sec_uid=kkkkk
        //$sql = "UPDATE custom SET $nick,$name,$num,$uid,$sec_uid WHERE id = $id";
		$sql = "UPDATE goods_order SET $custom_id,$goods_num,$price,$remark WHERE id = $id";
		//echo $sql;
        $count = $this->db->exec($sql);
        if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '修改失败!';
			$this->response->data[] = $count;
			$this->response->data_num = $count;
            return $this->response;
        } else {
            $this->response->err  = 0;
            $this->response->msg  = '修改成功!';
            $this->response->data[] = $count;
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
        $sql   = "DELETE FROM goods_order WHERE id = $id";
       if (!empty($_POST['do']) && $_POST['do'] == 'del_30') { 
		$del_time  = $_SERVER['REQUEST_TIME'] - 30*24*60*60;
         $sql   = "DELETE FROM goods_order WHERE order_time < $del_time";
		}
      $count = $this->db->exec($sql);
        if ($count == 0) {
            $this->response->err  = 1;
            $this->response->msg  = '删除失败!';
          $this->response->data[] = $del_time;
			$this->response->data_num = $count;
            return $this->response;
        } else {
            $this->response->err  = 0;
            $this->response->msg  = '删除成功!';
          $this->response->data[] = $del_time;
			$this->response->data_num = $count;
            return $this->response;
        }
    }

}
