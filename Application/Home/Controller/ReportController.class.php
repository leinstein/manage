<?php
namespace Home\Controller;
use Home\Common\HomeController;

class ReportController extends HomeController {
    /**
     * 2018/12/12
     * 9:26
     * anthor liu
     * 统计
     */
    Public function index(){
        $this->display();
    }

    /**
     * 2018/12/12
     * 9:28
     * anthor liu
     * 默认系统首页统计
     */
    Public function statistics_index(){
        $this->display('Index/welcome');
    }


}