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
        $order = D('Order');
        $backlog = M('Backlog');
        $aim = M('Aim');
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
        //今日待办任务数
        $map['do_time'] = $order->today();
        $backlog_count = $backlog->where($map)->where(['uid'=>$id])->count();
        $info=$admin->field('last_login_time,img_big')->where(['id'=>$id])->find();
        //目标进度
        $this_month = date('Y',time()) . '-' .date('m',time());
        $aims = $aim->where(['userid'=>$_SESSION['userid'],'month'=>$this_month])->find();
        if($aims){
            $star = mktime(0,0,0,date('m'),1,date('Y'));
            $end = time();
            $map['delete'] = 1;
            $map['orderstatus'] = ['neq',4];
            $map['ordercreatetime'] = ['between',[$star,$end]];
            $aim_this_month['complete'] = $order->where($map)->sum('orderprice');
            $aim_this_month['avg'] = round($aim_this_month['complete'] / $aims['aim'] , 3) * 100 . '%';
            $aim_this_month['aim'] = $aims['aim'];
        }else{
            $aim_this_month['aim'] = 'aim';
        }


//        $this->assign('time',date('Y-m-d H:i:s',$info['last_login_time']));
        $this->assign('avatar',$info['img_big']);
        $this->assign('backlog_count',$backlog_count);
        $this->assign('aim_this_month',$aim_this_month);
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
        $userid = $_SESSION['userid'];
        if($_SESSION['username'] != 'admin') $where_user['saleid'] = $userid;
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
        $customer_info = $customer->where($map_c)->where($where_user)->select();
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

        //总订单数/订单总金额/退单率/退单金额率
        $report = $order->return_rate_avg();

        $this->assign('customer_stati',$customer_stati);
        $this->assign('order_stati',$order_stati);
        $this->assign('order_rank',$order_rank);
        $this->assign('buyrate',$buyrate);
        $this->assign('lastmonth_day_amount',$lastmonth_day_amount);
        $this->assign('lastmonth_day_customer',$lastmonth_day_customer);
        $this->assign('month_day',$month_day);
        $this->assign('month_day_customer',$month_day_customer);
        $this->assign('report',$report);
        $this->display('welcome');
    }
}