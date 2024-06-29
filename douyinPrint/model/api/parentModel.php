<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class parentModel extends baseModel
{
    public $db;
    public $response;
    public function __construct()
    {
        $this->db = self::dbhConnect();
        $this->response = new response();
      
    }
    public function __destruct()
    {
        // 数据库关闭
        $this->db = null;
    }




}