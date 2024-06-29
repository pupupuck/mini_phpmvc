<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
// contraller处理权限，model处理数据
class userController extends baseController
{
    public function __construct()
    {
        $this->model = new userModel();

    }

    /** 
    *  用户登录
    *
    */
    public function login()
    {
        $this->user = $this->model->login();
        $this->jsonView($this->user);
    }
  
  /** 
    *  修改密码
    *
    */
    public function change_password()
    {
        $this->user = $this->model->change_password();
        $this->jsonView($this->user);
    }


}
