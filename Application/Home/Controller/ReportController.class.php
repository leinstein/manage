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
        //where条件
        //时间搜索订单  关键词搜索客户
//        if($_GET['stat_date'] and !$_GET['stop_date']) $where_order['ordercreatetime'] = ['egt',strtotime($_GET['stat_date'])];
//        if(!$_GET['stat_date'] and $_GET['stop_date']) $where_order['ordercreatetime'] = ['elt',strtotime($_GET['stop_date'])];
//        if($_GET['stat_date'] and $_GET['stop_date']) $where_order['ordercreatetime'] = ['between',[strtotime($_GET['stat_date']),strtotime($_GET['stop_date'])]];
//        if($_GET['name']){
//            $word = '%'.trim($_GET['name']).'%';
//            $where['username|nickname|mobile'] =array('like',$word);
//        }
        //获取统计数据
//        $where_order['delete'] = 1;
//        if($_GET['month']){
//            if($_GET['month'] == 'history'){
//                $where_order['delete'] = 1;
//            }else if($_GET['month'] == 'lastmonth'){
//                $where_order['ordercreatetime'] = $order->where_report('lastmonth');
//            }else if($_GET['month'] == 'month'){
//                $where_order['ordercreatetime'] = $order->where_report('month');
//            }
//        }
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
        //$this->assign('buyrate_rate',$buyrate_rate);
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
        $customer = D('Customer');
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
        $this->display();
    }

}