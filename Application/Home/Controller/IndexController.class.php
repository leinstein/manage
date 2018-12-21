<?php
namespace Home\Controller;
use Home\Common\HomeController;

class IndexController extends HomeController {
    /**
     * 2018/11/19
     * 15:04
     * anthor liu
     * 后台首页
     */
    public function index(){
        $id=session('userid');
        $username = session('username');
        $admin=M('Admin');
        if($username !== 'admin'){
            $roleinfo = M('Admin')
                ->alias('m')
                ->join('__ROLE__ as r on m.role_id = r.id')
                ->where(array('m.id'=>$id))
                ->field('r.role_auth_ids,nickname')
                ->find();
            $authids = $roleinfo['role_auth_ids'];
            $authInfo = M('auth')->order('sort desc')->select($authids);
        }else{
            $authInfo = M('auth')->order('sort desc')->select();
        }
        foreach ($authInfo as $k=>$v){
            if($v['auth_level'] == 2){
                $authinfoB[] = $v;
            }else if($v['auth_level'] == 1){
                $authinfoA[] = $v;
            }
        }
        $this->assign('authinfoA',$authinfoA);
        $this->assign('authinfoB',$authinfoB);
        $info=$admin->field('last_login_time,img_big')->where(['id'=>$id])->find();
        $this->assign('time',date('Y-m-d H:i:s',$info['last_login_time']));
        $this->assign('avatar',$info['img_big']);
        $this->assign('id',$id);
        $this->display();
    }

    /**
     * 2018/12/21
     * 10:07
     * anthor liu
     * 首页统计
     */
    public function wel(){
        $customer = D('Customer');
        $order = D('Order');
        //获取排名
        //本月
        $order_createtime_between_month = $order->month();
        $order_rank['month'] = $order->wel_sale_rank($order_createtime_between_month);
        //上月
        $order_createtime_between_lastmonth = $order->lastmonth();
        $order_rank['lastmonth'] = $order->wel_sale_rank($order_createtime_between_lastmonth);
        //历史
        $order_rank['history'] = $order->wel_sale_rank();
        //复购率
        $map_c['delete'] = 1;
        $map_c['buyrate'] = ['gt',0];
        $customer_info = $customer->where($map_c)->select();
        //获取总体复购率
        $buyrate = $customer->report_rate($customer_info);

        //本月按天统计业绩和订单数
        $month_day = D('Order')->month_day_amount();
        $month_day = json_encode($month_day);
        //本月按天统计客户数
        $month_day_customer = D('Order')->month_day_customer();
        $month_day_customer = json_encode($month_day_customer);

        //上月按天统计业绩和订单数
        $lastmonth_day_amount = D('Order')->lastmonth_day_amount();
        $lastmonth_day_amount = json_encode($lastmonth_day_amount);
        //上月按天统计客户数
        $lastmonth_day_customer = D('Order')->lastmonth_day_customer();
        $lastmonth_day_customer = json_encode($lastmonth_day_customer);



        $customer_stati = $customer->statistical();
        $order_stati = $order->statistical();
        $this->assign('customer_stati',$customer_stati);
        $this->assign('order_stati',$order_stati);
        $this->assign('order_rank',$order_rank);
        $this->assign('buyrate',$buyrate);
        $this->assign('lastmonth_day_amount',$lastmonth_day_amount);
        $this->assign('lastmonth_day_customer',$lastmonth_day_customer);
        $this->assign('month_day',$month_day);
        $this->assign('month_day_customer',$month_day_customer);
        $this->display('welcome');
    }
}