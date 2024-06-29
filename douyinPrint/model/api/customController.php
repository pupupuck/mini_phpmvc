<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class customController extends baseController
{
    public function __construct()
    {
        $this->model = new customModel();	
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
     * 查询是否存在
     *
     */
    public function get_one()
    {
        $this->get_one = $this->model->get_one();
        $this->jsonView($this->get_one);
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
     * 添加
     *
     */
    public function add1()
    {
        $this->add1 = $this->model->add1();
        $this->jsonView($this->add1);
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
     *  编辑
     *
     */
    public function edit_name()
    {
        $this->edit = $this->model->edit_name();
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
