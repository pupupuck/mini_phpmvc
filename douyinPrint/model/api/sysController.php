<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
// contraller处理权限，model处理数据
class sysController extends baseController
{
    public function __construct()
    {
        $this->model = new sysModel();
        /*
		if (ACTION != 'index') {
            if (!$this->isLogin()) {
                $this->response       = new response();
                $this->response->err  = 1;
                $this->response->msg  = '尚未登录!';
                $this->response->data = [];
                $this->jsonView($this->response);
            }
        }
		*/
    }

    /** 
    *  用户登录
    *
    */
    public function info()
    {
        $this->info = $this->model->info();
        $this->jsonView($this->info);
    }


}
