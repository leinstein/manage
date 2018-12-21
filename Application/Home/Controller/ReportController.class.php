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

    /**
     * 2018/12/12
     * 11:45
     * anthor liu
     * 销售排行榜
     */
    Public function rank(){
        $admin = M('Admin');
        $order = D('Order');
        $role  = M('Role');
        $customer = M('Customer');
        //where条件
        //时间搜索订单  关键词搜索客户
        if($_GET['stat_date'] and !$_GET['stop_date']) $where_order['ordercreatetime'] = ['egt',strtotime($_GET['stat_date'])];
        if(!$_GET['stat_date'] and $_GET['stop_date']) $where_order['ordercreatetime'] = ['elt',strtotime($_GET['stop_date'])];
        if($_GET['stat_date'] and $_GET['stop_date']) $where_order['ordercreatetime'] = ['between',[strtotime($_GET['stat_date']),strtotime($_GET['stop_date'])]];
        if($_GET['name']){
            $word = '%'.trim($_GET['name']).'%';
            $where['username|nickname|mobile'] =array('like',$word);
        }
        //获取统计数据
        $where_order['delete'] = 1;
        if($_GET['month']){
            if($_GET['month'] == 'history'){
                $where_order['delete'] = 1;
            }else if($_GET['month'] == 'lastmonth'){
                $where_order['ordercreatetime'] = $order->where_report('lastmonth');
            }else if($_GET['month'] == 'month'){
                $where_order['ordercreatetime'] = $order->where_report('month');
            }
        }
        //初始化默认数据
        if(!$_GET['stat_date'] and !$_GET['stop_date'] and !$_GET['month']) $where_order['ordercreatetime'] = $order->where_report('month');
        $map['pid'] = array('gt',1);
        $role_info_ids = $role->where($map)->field('id')->select();
        foreach ($role_info_ids as $k=>$v){
            $role_ids[] = $v['id'];
        }
        $role_ids = implode(',',$role_ids);
        $where['role_id'] = ['in',$role_ids];
        //获取做业绩的人员/分页
        $count = $admin->where($where)->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $admin_info = $admin->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();
        //$admin_info = $admin->where($ids)->select();
        $order_info = $order->where($where_order)->select();
        //统计销售人员订单/客户/销售额
        foreach ($admin_info as $v){
            foreach ($order_info as $vv){
                if($vv['saleid'] == $v['id']){
                    if($vv['orderstatus'] != 4){
                        $v['order_rate'] += 1;
                        $v['order_total_amount'] += $vv['orderprice'];
                        if(!in_array($vv['cid'],$v['customer_ids'])){
                            $v['customer_ids'][] = $vv['cid'];
                            $v['customer_count'] ++;
                        }

                    }
                    //退单数/退单金额
                    if($vv['orderstatus'] == 4){
                        $v['order_tui_rate'] += 1;
                        $v['order_total_tui_amount'] += $vv['orderprice'];
                    }

                }
            }
            //订单均价
            $v['order_average'] = round($v['order_total_amount'] / $v['order_rate'],2);
            //退单率
            $v['order_tui_average'] = round($v['order_tui_rate']  / ($v['order_rate'] + $v['order_tui_rate']),4)*100 . "%";
            //客户均价
            $v['order_customer_average'] = round($v['order_total_amount'] / $v['customer_count'],2);
            //复购率
            $cids = implode(',',$v['customer_ids']);
            if($cids){
                $m['cid'] = ['in',$cids];
            }
            $m['buyrate'] = ['gt',1];
            $customer_info_count = $customer->where($m)->count();
            $v['buying_rate'] = round($customer_info_count / $v['customer_count'],4)*100 . "%";
            $info[] = $v;
        }
        //排名
        foreach($info as $vvv){
            $sort[] = $vvv["order_total_amount"];
        }
        array_multisort($sort,SORT_DESC,$info);
        //排名排序
        $i=$page->firstRow + 1;
        foreach ($info as $v){
            $v['sort_amount'] = $i;
            $i++;
            $info_sort[] = $v;
        }
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->assign('info',$info_sort);
        $this->display();
    }

    /**
     * 2018/12/13
     * 11:49
     * anthor liu
     * 复购率
     */
    Public function buyingrate(){
        $admin = M('Admin');
        $order = D('Order');
        $role  = M('Role');
        $customer = D('Customer');
        $map['pid'] = array('gt',1);
        $role_info_ids = $role->where($map)->field('id')->select();
        foreach ($role_info_ids as $k=>$v){
            $role_ids[] = $v['id'];
        }
        $role_ids = implode(',',$role_ids);
        $where['role_id'] = ['in',$role_ids];
        //获取做业绩的人员/分页
        $count = $admin->where($where)->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $admin_info = $admin->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();

        //复购率
        $map_c['delete'] = 1;
        $map_c['buyrate'] = ['gt',0];
        $customer_info = $customer->where($map_c)->select();
        //获取总体复购率
        $buyrate = $customer->report_rate($customer_info);
        //统计销售人员订单/客户/销售额
        foreach ($admin_info as $v){
            foreach ($customer_info as $vv){
                if($vv['saleid'] == $v['id']){
                    if($vv['orderstatus'] != 4){
                        $v['customer_people'][] = $vv;
                    }
                }
            }
            $v['buyrate'] = $customer->report_rate($v['customer_people']);
            unset($v['customer_people']);
            $info[] = $v;
        }

        //排名
        foreach($info as $vvv){
            $sort[] = $vvv["buyrate"]['rate']['one'];
        }
        array_multisort($sort,SORT_DESC,$info);
        //排名排序
        $i=$page->firstRow + 1;
        foreach ($info as $v){
            $v['sort_rate'] = $i;
            $i++;
            $info_sort[] = $v;
        }

        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->assign('info',$info_sort);
        $this->assign('buyrate',$buyrate);
        $this->display();
    }

    /**
     * 2018/12/14
     * 11:34
     * anthor liu
     * 退单率
     */
    Public function return_rate(){
        $admin = M('Admin');
        $order = D('Order');
        $role  = M('Role');
//        $customer = D('Customer');
        //where条件
        //时间搜索订单  关键词搜索客户
        if($_GET['stat_date'] and !$_GET['stop_date']) $where_order['ordercreatetime'] = ['egt',strtotime($_GET['stat_date'])];
        if(!$_GET['stat_date'] and $_GET['stop_date']) $where_order['ordercreatetime'] = ['elt',strtotime($_GET['stop_date'])];
        if($_GET['stat_date'] and $_GET['stop_date']) $where_order['ordercreatetime'] = ['between',[strtotime($_GET['stat_date']),strtotime($_GET['stop_date'])]];
        if($_GET['name']){
            $word = '%'.trim($_GET['name']).'%';
            $where['username|nickname|mobile'] =array('like',$word);
        }
        //获取统计数据
        $where_order['delete'] = 1;
        if($_GET['month']){
            if($_GET['month'] == 'history'){
                $where_order['delete'] = 1;
            }else if($_GET['month'] == 'lastmonth'){
                $where_order['ordercreatetime'] = $order->where_report('lastmonth');
            }else if($_GET['month'] == 'month'){
                $where_order['ordercreatetime'] = $order->where_report('month');
            }
        }

        //总订单数/订单总金额/退单率/退单金额率
        $report = $order->return_rate_avg();

        //初始化默认数据
        if(!$_GET['stat_date'] and !$_GET['stop_date'] and !$_GET['month']) $where_order['ordercreatetime'] = $order->where_report('month');
        $map['pid'] = array('gt',1);
        $role_info_ids = $role->where($map)->field('id')->select();
        foreach ($role_info_ids as $k=>$v){
            $role_ids[] = $v['id'];
        }
        $role_ids = implode(',',$role_ids);
        $where['role_id'] = ['in',$role_ids];
        //获取做业绩的人员/分页
        $count = $admin->where($where)->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $admin_info = $admin->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();

        //退单率
        $order_info = $order->where($where_order)->select();
        //统计销售人员订单/客户/销售额
        foreach ($admin_info as $v){
            foreach ($order_info as $vv){
                if($vv['saleid'] == $v['id']){
//                    if($vv['orderstatus'] != 4){
                    $v['order_rate'] += 1;
                    $v['order_total_amount'] += $vv['orderprice'];
                    if(!in_array($vv['cid'],$v['customer_ids'])){
                        $v['customer_ids'][] = $vv['cid'];
                        $v['customer_count'] ++;
                    }

//                    }
                    //退单数/退单金额
                    if($vv['orderstatus'] == 4){
                        $v['order_tui_rate'] += 1;
                        $v['order_total_tui_amount'] += $vv['orderprice'];
                    }

                }
            }
            //退单率
            $v['order_tui_average'] = round($v['order_tui_rate']  / $v['order_rate'],4)*100 . "%";
            //退单金额率
            $v['order_tui_funds_average'] = round($v['order_total_tui_amount']  / $v['order_total_amount'],4)*100 . "%";
//            //客户均价
//            $v['order_customer_average'] = round($v['order_total_amount'] / $v['customer_count'],2);
//            //复购率
//            $cids = implode(',',$v['customer_ids']);
//            if($cids){
//                $m['cid'] = ['in',$cids];
//            }
//            $m['buyrate'] = ['gt',1];
//            $customer_info_count = $customer->where($m)->count();
//            $v['buying_rate'] = round($customer_info_count / $v['customer_count'],4)*100 . "%";
            $info[] = $v;
        }

        //排名
        foreach($info as $vvv){
            $sort[] = $vvv['order_tui_average'];
        }
        array_multisort($sort,SORT_DESC,$info);
        //排名排序
        $i=$page->firstRow + 1;
        foreach ($info as $v){
            $v['sort_rate'] = $i;
            $i++;
            $info_sort[] = $v;
        }

        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->assign('info',$info_sort);
        $this->assign('report',$report);
        $this->display();
    }

    /**
     * 2018/12/16
     * 8:57
     * anthor liu
     * 分组统计
     */
    Public function team(){
        $admin = M('Admin');
        $order = D('Order');
        $customer = M('Customer');
        $group = M('Group');

        //where条件
        //时间搜索订单  关键词搜索客户
        $where = 1;
        if($_GET['stat_date'] and !$_GET['stop_date']) $where_order['ordercreatetime'] = ['egt',strtotime($_GET['stat_date'])];
        if(!$_GET['stat_date'] and $_GET['stop_date']) $where_order['ordercreatetime'] = ['elt',strtotime($_GET['stop_date'])];
        if($_GET['stat_date'] and $_GET['stop_date']) $where_order['ordercreatetime'] = ['between',[strtotime($_GET['stat_date']),strtotime($_GET['stop_date'])]];
//        if($_GET['name']){
//            $word = '%'.trim($_GET['name']).'%';
//            $where['username|nickname|mobile'] =array('like',$word);
//        }

        //获取统计数据
        $where_order['delete'] = 1;
        if($_GET['month']){
            if($_GET['month'] == 'history'){
                $where_order['delete'] = 1;
            }else if($_GET['month'] == 'lastmonth'){
                $where_order['ordercreatetime'] = $order->where_report('lastmonth');
            }else if($_GET['month'] == 'month'){
                $where_order['ordercreatetime'] = $order->where_report('month');
            }
        }

        $group_info = $group->where(['issale'=>'是'])->select();
        $admin_info = $admin->select();
        //初始化默认数据
        if(!$_GET['stat_date'] and !$_GET['stop_date'] and !$_GET['month']) $where_order['ordercreatetime'] = $order->where_report('month');
        $order_info = $order->where($where_order)->select();
        foreach ($group_info as $v){
            //获取分组组员
            foreach ($admin_info as $vv){
                if($vv['group_id'] == $v['group_id']){
                    $v['team'][] = $vv;
                }
            }
            //统计小组业绩
            $c = [];
            foreach ($v['team'] as $vvv){
                foreach ($order_info as $vvvv){
                    if($vvvv['saleid'] == $vvv['id']){
                        if($vvvv['orderstatus'] != 4){
                            $vvv['order_rate'] += 1;
                            $vvv['order_total_amount'] += $vvvv['orderprice'];
                            if(!in_array($vvvv['cid'],$vvv['customer_ids'])){
                                $vvv['customer_ids'][] = $vvvv['cid'];
                                $vvv['customer_count'] ++;
                            }

                        }
                        //退单数/退单金额
                        if($vvvv['orderstatus'] == 4){
                            $vvv['order_tui_rate'] += 1;
                            $vvv['order_total_tui_amount'] += $vvvv['orderprice'];
                        }

                    }
                }
                $c['order_rate'] += $vvv['order_rate'];
                $c['customer_count'] += $vvv['customer_count'];
                $c['order_total_amount'] += $vvv['order_total_amount'];
                $c['order_tui_rate'] += $vvv['order_tui_rate'];
                $c['order_total_tui_amount'] += $vvv['order_total_tui_amount'];
            }
            //订单均价
            $c['order_average'] = round($c['order_total_amount'] / $c['order_rate'],2);
            //退单率
            $c['order_tui_average'] = round($c['order_tui_rate']  / ($c['order_rate'] + $c['order_tui_rate']),4)*100 . "%";
            //退单金额率
            $c['order_tui_funds_average'] = round($c['order_total_tui_amount']  / ($c['order_total_amount'] + $vvv['order_total_tui_amount']),4)*100 . "%";
            //客户均价
            $c['order_customer_average'] = round($c['order_total_amount'] / $c['customer_count'],2);
            //复购率
            $cids = implode(',',$c['customer_ids']);
            if($cids){
                $m['cid'] = ['in',$cids];
            }
            $m['buyrate'] = ['gt',1];
            $customer_info_count = $customer->where($m)->count();
            $c['buying_rate'] = round($customer_info_count / $c['customer_count'],4)*100 . "%";
            $c['group_people'] = count($v['team']);
            $c['group_people_avg'] = round($c['order_total_amount'] / $c['group_people'],2);
            unset($v['team']);
            $v['funds'] = $c;
            $grooup_list[] = $v;
        }
        //总业绩
        foreach ($grooup_list as $y){
            $group_sum['amount'] += $y['funds']['order_total_amount'];
            $group_sum['group_p'] += $y['funds']['group_people'];
            $group_sum['tui_amount'] += $y['funds']['order_total_tui_amount'];
            $group_sum['customer'] += $y['funds']['customer_count'];
            $group_sum['order_count'] += $y['funds']['order_rate'];
            $group_sum['order_tui_count'] += $y['funds']['order_tui_rate'];
        }
        //总平均业绩
        $group_sum['amount_avg'] = round($group_sum['amount'] / $group_sum['customer'],2);
        //总退单率
        $group_sum['order_tui_avg'] = round($group_sum['order_tui_count']  / ($group_sum['order_count'] + $group_sum['order_tui_count']),4)*100 . "%";
        //总退单金额率
        $group_sum['order_tui_amount_avg'] = round($group_sum['tui_amount']  / ($group_sum['amount'] + $group_sum['tui_amount']),4)*100 . "%";
        //小组业绩占比
        foreach ($grooup_list as $z){
            $z['funds']['group_funds_avg'] = round($z['funds']['order_total_amount'] / $group_sum['amount'],4)*100 . '%';
            $info[] = $z;
        }
        //本月/上月/历史
        $group_month = $order->group_month();
        $group_lastmonth = $order->group_lastmonth();
        $group_history = $order->group_histort();
        //上月-天   本月-天  年-月
        $info_lastmonth_day = D('Order')->group_lastmonth_day();

        $info_lastmonth_day = json_encode($info_lastmonth_day);

        $info_month_day = D('Order')->group_month_day();

        $info_month_day = json_encode($info_month_day);

        $info_year_month = D('Order')->group_year();
        $info_year_month = json_encode($info_year_month);

        //排名
        foreach($info as $n){
            $sort[] = $n['funds']["order_total_amount"];
        }
        array_multisort($sort,SORT_DESC,$info);

        $this->assign('info',$info);
        $this->assign('group_sum',$group_sum);
        $this->assign('group_month',$group_month);
        $this->assign('group_lastmonth',$group_lastmonth);
        $this->assign('info_month_day',$info_month_day);
        $this->assign('info_lastmonth_day',$info_lastmonth_day);
        $this->assign('info_year_month',$info_year_month);
        $this->assign('group_history',$group_history);
        $this->display();
    }

    /**
     * 2018/12/18
     * 8:46
     * anthor liu
     * 消费排行榜100名
     */
    Public function consume(){
        $admin = M('Admin');
        $order = D('Order');
        $role  = M('Role');
        $customer = M('Customer');
        $address = M('Address');
        //where条件
        //时间搜索订单  关键词搜索客户
        if($_GET['stat_date'] and !$_GET['stop_date']) $where_order['ordercreatetime'] = ['egt',strtotime($_GET['stat_date'])];
        if(!$_GET['stat_date'] and $_GET['stop_date']) $where_order['ordercreatetime'] = ['elt',strtotime($_GET['stop_date'])];
        if($_GET['stat_date'] and $_GET['stop_date']) $where_order['ordercreatetime'] = ['between',[strtotime($_GET['stat_date']),strtotime($_GET['stop_date'])]];
        if($_GET['name']){
            $word = '%'.trim($_GET['name']).'%';
            $where['name|note|phone|c_weixin|a_role|a_weixin'] =array('like',$word);
        }
        //获取统计数据
        if($_GET['month']){
            if($_GET['month'] == 'history'){
                $where_order = 1;
            }else if($_GET['month'] == 'lastmonth'){
                $where_order['ordercreatetime'] = $order->where_report('lastmonth');
            }else if($_GET['month'] == 'month'){
                $where_order['ordercreatetime'] = $order->where_report('month');
            }
        }
        //初始化默认数据


        if(!$_GET['stat_date'] and !$_GET['stop_date'] and !$_GET['month']) $where_order['ordercreatetime'] = $order->where_report('month');
        //分页
//        $count = $customer->where($where)->count();//满足条件的数量
        $count = 10;
        $page  = new \Think\Page($count, 25);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $Order_info = $order
            ->alias('od')
            ->join('__CUSTOMER__ as cs ON cs.cid = od.cid','left')
            ->field('*,sum(od.orderprice) as totalorder,sum(buyrate) as rate,cs.address_id as addr')
            ->where('orderstatus < 4')
            ->where('od.delete = 1')
            ->where($where_order)
            ->group('od.cid')
            ->order('totalorder desc')
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();
        //排名排序
        //销售，销售组
        $admin_info = $admin
            ->alias('a')
            ->join('__GROUP__ as g ON g.group_id = a.group_id','left')
            ->field('a.nickname,a.id,g.group_name')
            ->where('g.issale = "是"')
            ->select();
        $i=$page->firstRow + 1;
        foreach ($Order_info as $v){
            $v['area'] = $address->where(['addressid'=>$v['addr']])->find();
            $v['p_area'] = $v['area']['province'].' '.$v['area']['city'];
            $v['order_avg'] = round($v['totalorder'] / $v['rate'],2);
            foreach ($admin_info as $vv){
                if($vv['id'] == $v['saleid']){
                    $v['nickname'] = $vv['nickname'];
                    $v['group_name'] = $vv['group_name'];
                }
            }
            $v['sort_rate'] = $i;
            $i++;
            $info_sort[] = $v;
        }

        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->assign('info',$info_sort);
        $this->display();
    }

}