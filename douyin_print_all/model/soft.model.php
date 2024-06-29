<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class softModel extends baseModel
{

    /**
     *  心跳包
     *
     */
    public function heartbeat()
    {
        //print_r(Get_class_methods ('userModel'));

        $sql = "select * from soft where 1";
        $res = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ok  = $res->execute();
        if (!$ok) {
            //0条也=ok
            throw new Exception('数据库语句错误', 1049);
        } else {
            $arr = $res->fetchAll(PDO::FETCH_ASSOC);
            $arr = fun::key2str($arr);
        }

        if (!empty($arr)) {
            //二维的arr
            $this->response->err       = 0;
            $this->response->msg       = '获取心跳成功!';
            $this->response->data      = $arr;
            $this->response->data_num  = count($arr);
            $this->response->timestamp = $_SERVER['REQUEST_TIME']; // 不污染data，二维数组
            $this->response->sign      = fun::sign($arr);
            $this->json_view($this->response);
        } else {
            $this->response->err = 1;
            $this->response->msg = '获取心跳失败!';
            $this->json_view($this->response);
        }

    }

}
