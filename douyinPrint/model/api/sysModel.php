<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class sysModel extends parentModel
{
	
    /** 
    *  用户登录
    *
    */
    public function info()
    {
        //http://47.88.0.184/?m=api&c=sys&a=info
        $sql    = "select * from sys where id = 1 limit 0,1"; // 加个单引号就好了

        $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)); 
        $ok  = $res->execute();
        if (!$ok) { //0条也=ok
            throw new Exception('数据库语句错误: ' . $sql);
        } else {
            $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        }
        if (empty($arr)) {
            $this->response->err  = 1;
            $this->response->msg  = '获取数据为空!';
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



}