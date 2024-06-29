<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');
class indexModel extends baseModel
{

    public function index()
    {

        //$data = empty($_GET['data']) ? "kong" : $_GET['data'];
        //echo '<p><p><p>';
        //echo $data;
        //print_r($_POST);
        print_r($_GET);
        

    }

}
