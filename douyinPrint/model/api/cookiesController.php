<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
// contraller处理权限，model处理数据
class cookiesController extends baseController
{
    public function __construct()
    {
        $this->model = new cookiesModel();

    }

    /** 
    *  获取
    *
    */
    public function get_user_list()
    {
        $this->data = $this->model->get_user_list();
        $this->jsonView($this->data);
    }
  
      /** 
    *  获取
    *
    */
    public function get_cookies()
    {
        $this->data = $this->model->get_cookies();
        $this->jsonView($this->data);
    }
  
    /** 
    *  更新
    *
    */
    public function update()
    {
        $this->data = $this->model->update();
        $this->jsonView($this->data);
    }


}
