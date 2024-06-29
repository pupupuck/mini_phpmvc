<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class adminController extends baseController
{
    public function __construct()
    {
        $this->model = new adminModel();
			// 判断登录
			if (!$this->isLogin()) {
                $this->response       = new response();
                $this->response->err  = 1;
                $this->response->msg  = '尚未登录!';
                $this->response->data = [];
                $this->jsonView($this->response);
            }
    }
    
	/**
     * 获取所有列表
     *
     */
    public function get_list()
    {
        $this->get_list = $this->model->get_list();
        $this->jsonView($this->get_list);
    }
	


     /**
     * 添加
     *
     */
    public function add()
    {
        $this->add = $this->model->add();
        $this->jsonView($this->add);
    }

    /**
     *  编辑
     *
     */
    public function edit()
    {
        $this->edit = $this->model->edit();
        $this->jsonView($this->edit);
    }

    /**
     * 删除
     *
     */
    public function del()
    {
        $this->del = $this->model->del();
        $this->jsonView($this->del);
    }
    


}
