<?php
namespace Home\Controller;
use Home\Common\HomeController;

class FundsController extends HomeController
{
    Public function index(){
        $order = D('Order');
        $where['delete'] = 1;
        if($_GET['stat_date'] and !$_GET['stop_date']) $where['ordercreatetime'] = ['egt',strtotime($_GET['stat_date'])];
        if(!$_GET['stat_date'] and $_GET['stop_date']) $where['ordercreatetime'] = ['elt',strtotime($_GET['stop_date'])];
        if($_GET['stat_date'] and $_GET['stop_date']) $where['ordercreatetime'] = ['between',[strtotime($_GET['stat_date']),strtotime($_GET['stop_date'])]];
        if($_GET['paytype']) $where['paytype'] = $_GET['paytype'];
        if($_GET['payform']) $where['payform'] = $_GET['payform'];
        if($_GET['orderstatus']) $where['orderstatus'] = $_GET['orderstatus'];
        if($_GET['word']){
            $word = '%'.trim($_GET['word']).'%';
            $where['orderno|desc|couriername|courierlist|goods_de|orderprice|cheapprice|pay|payment|paymentfee'] =array('like',$word);
        }
        //获取统计数据
        if($_GET['day']){
            if($_GET['day'] == 'history'){
                $where['delete'] = 1;
            }else{
                $where['ordercreatetime'] = $order->where_s($_GET['day']);
            }
        }

        $count = $order->where($where)->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $list = $order->where($where)->order('orderid desc')->limit($page->firstRow . ',' . $page->listRows)->select();
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
        //获取今天00:00时间戳
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //昨天结束
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        foreach ($info as $v){
            if($v['ordercreatetime'] > $todaystart){
                $infotoday[] = $v;
            }else if($v['ordercreatetime'] < $endYesterday and $v['ordercreatetime'] > $beginYesterday){
                $infoyestoday[] = $v;
            }else{
                $infot[] = $v;
            }
        }
        //获取统计数据
        $statistical = $order->statistical();
        //权限按钮
        $role = M('Role')->where(['id'=>$_SESSION['roleid']])->find();
        $role_ac = $role['role_auth_ac'];
        $action_name = get_action_name($role_ac);
        $this->assign([
            'statistical'=> $statistical,
            'infotoday'=> $infotoday,
            'infoyestoday'=> $infoyestoday,
            'infot'=> $infot,
            'count'=> $count,
            'page'=> $show,
            'firstRow'=> $page->firstRow,
            'role_ac'=> $role_ac,
            'action_name'=>$action_name
        ]);
//        $this->assign('statistical', $statistical);
//        $this->assign('infotoday', $infotoday);
//        $this->assign('infoyestoday', $infoyestoday);
//        $this->assign('infot', $infot);
//        $this->assign('count', $count);
//        $this->assign('page', $show);
//        $this->assign('firstRow', $page->firstRow);
        $this->display();
    }

    /**
     * 2018/12/5
     * 10:45
     * anthor liu
     * 修改订单
     */
    Public function update_order(){
        if(IS_POST){
            $data['orderid'] = $_POST['orderid'];
            $data['refunds'] = $_POST['refunds'];
            $data['serverfee'] = $_POST['serverfee'];
            $data['orderstatus'] = $_POST['orderstatus'];
            $data['desc'] = $_POST['desc'];
            //签单时间
            $data['reciivingtime'] = time();
            if(M('Order')->save($data)){
                $this->ajaxReturn(['statu' => 200, 'msg' => '修改订单成功']);
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => '修改订单失败']);
            }
        }else{
            $orderid = $_GET['orderid'];
            $order = M('Order')->where(['orderid'=>$orderid])->find();
            $customer = M('Customer')->where(['cid'=>$order['cid']])->find();
            $address = M('Address')->where(['addressid'=>$order['address_id']])->find();
            $this->assign('name',$customer['name']);
            $this->assign('order',$order);
            $this->assign('phone',$customer['phone']);
            $this->assign('address',$address['province'].$address['city'].$address['area'].$address['address']);
            $this->display();
        }
    }
}