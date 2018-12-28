<?php

namespace Home\Controller;
use Home\Common\HomeController;

class ServerController extends HomeController{
    /**
     * 2018/12/23
     * 14:26
     * anthor liu
     * 回访订单首页
     */
    Public function index(){
        $order = D('Order');
        $where['delete'] = 1;
        $where['orderstatus'] = 3;
        if($_GET['stat_date'] and !$_GET['stop_date']) $where['ordercreatetime'] = ['egt',strtotime($_GET['stat_date'])];
        if(!$_GET['stat_date'] and $_GET['stop_date']) $where['ordercreatetime'] = ['elt',strtotime($_GET['stop_date'])];
        if($_GET['stat_date'] and $_GET['stop_date']) $where['ordercreatetime'] = ['between',[strtotime($_GET['stat_date']),strtotime($_GET['stop_date'])]];
//        if($_GET['paytype']) $where['paytype'] = $_GET['paytype'];
//        if($_GET['payform']) $where['payform'] = $_GET['payform'];
//        if($_GET['orderstatus']) $where['orderstatus'] = $_GET['orderstatus'];
        if($_GET['server_status'] == 1) $where['server_status'] = 1;
        if($_GET['server_status'] == 2) $where['server_status'] = ['neq',1];
        if($_GET['word']){
            $word = '%'.trim($_GET['word']).'%';
            $where['desc|goods_de|server_note'] =array('like',$word);
        }
        //获取统计数据
        if($_GET['day']){
            if($_GET['day'] == 'history'){
                $where['delete'] = 1;
            }else{
                $where['ordercreatetime'] = $order->where_s($_GET['day']);
            }
        }

        $count = $order
            ->alias('o')
            ->join('__SERVERNOTE__ as s ON o.orderid = s.oid','left')
            ->where($where)
            ->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $list = $order
            ->alias('o')
            ->join('__SERVERNOTE__ as s ON o.orderid = s.oid','left')
            ->where($where)
            ->order('orderid desc')
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();

        $customer = M('Customer')->select();
        $admin = M('Admin')->select();
        foreach ($list as $v) {
            foreach ($customer as $vv){
                if($v['cid'] == $vv['cid']){
                    $v['customer_name'] = $vv['name'];
                    $v['customer_phone'] = $vv['phone'];
                    break;
                }
            }
            foreach ($admin as $vvv){
                if($vvv['id'] == $v['saleid']){
                    $v['nickname'] = $vvv['nickname'];
                    break;
                }
            }
            $v['paynow'] = $v['orderprice'];
            $v['chengben'] = $v['serverfee'] + $v['courierfee'];
            $v['realfee'] = $v['refunds'] + $v['pay'] - $v['courierfee'];
            $info[] = $v;
        }
//        //获取本月00:00时间戳
//        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
//        //获取上月00:00时间戳
//        $beginlastmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
//        //获取上月23:59时间戳
//        $endlastmonth=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
//        foreach ($info as $v){
//            if($v['ordercreatetime'] > $beginThismonth){
//                $infotoday[] = $v;
//            }else if($v['ordercreatetime'] < $endlastmonth and $v['ordercreatetime'] > $beginlastmonth){
//                $infoyestoday[] = $v;
//            }else{
//                $infot[] = $v;
//            }
//        }
        //获取统计数据
        $statistical = $order->statistical();
        $this->assign('statistical', $statistical);
        $this->assign('info', $info);
//        $this->assign('infotoday', $infotoday);
//        $this->assign('infoyestoday', $infoyestoday);
//        $this->assign('infot', $infot);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->display();
    }

    /**
     * 2018/12/23
     * 15:47
     * anthor liu
     * 客户回访
     */
    Public function server(){
        $servernote = M('Servernote');
        if(IS_POST){
            $order = M('Order');
            $server['server_note'] = $_POST['server_note'];
            $server['oid'] = $_POST['orderid'];
            $nid = $_POST['s_nid'];
            $server['create_time_note'] = time();
            if($nid == 'no'){
                $ser_res = $servernote->add($server);
                $or_res = $order->where(['orderid'=>$server['oid']])->setInc('server_status');
            }else{
                $server['nid'] = $nid;
                $ser_res = $servernote->save($server);
                $or_res = true;
            }
            if($ser_res){
                if($or_res){
                    $this->ajaxReturn(['statu' => 200, 'msg' => '记录保存成功']);
                }else{
                    $this->ajaxReturn(['statu' => 202, 'msg' => '回访状态保存失败']);
                }
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => '回访记录保存失败，请重试']);
            }

        }else{
            $data['oid'] = $_GET['orderid'];
            $ser_res = $servernote->where(['oid'=>$data['oid']])->find();
            if($ser_res){
                $this->assign('info',$ser_res);
            }else{
                $info['nid'] = 'no';
                $this->assign('info',$info);
            }
            $data['customer_name'] = $_GET['customer_name'];
            $data['customer_phone'] = $_GET['customer_phone'];
            $this->assign('data',$data);
            $this->display();
        }
    }
}