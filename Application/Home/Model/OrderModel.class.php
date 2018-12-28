<?php

namespace Home\Model;
use Think\Model;

class OrderModel extends Model
{
    /**
     * 2018/12/4
     * 15:21
     * @return mixed
     * anthor liu
     * 按日期统计数据
     */
    Public function statistical(){
        $order = M('Order');
        $where['orderstatus'] =['neq',4]; //不计算退单
        $where['delete'] = 1; //删除的订单不计算
        $userid = $_SESSION['userid'];
        if($userid != 1) $where['saleid'] = $userid;
        //获取今天00:00时间戳
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        //获取今天24:00时间戳
        $todayend = strtotime(date('Y-m-d'.'00:00:00',time()+3600*24));
        //where条件
        $today['ordercreatetime'] = ['between',[$todaystart,$todayend]];
        //获取今天添加订单数
        $statistical_info[] = $order
            ->field('count(orderid) as today,sum(orderprice) as today_order')
            ->where($today)
            ->where($where)
            ->find();

        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //获取昨天24:00时间戳
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        //统计昨天订单
        $yesterday['ordercreatetime'] = ['between',[$beginYesterday,$endYesterday]];
        //获取昨天添加订单数
        $statistical_info[] = $order
            ->field('count(orderid) as yesterday,sum(orderprice) as yesterday_order')
            ->where($yesterday)
            ->where($where)
            ->find();

        //获取本周00:00时间戳
        $startthisweek=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
        //获取本周23:59时间戳
        $endToday=mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));
        //统计本周订单
        $weekday['ordercreatetime'] = ['between',[$startthisweek,$endToday]];
        //获取本周添加订单数
        $statistical_info[] = $order
            ->field('count(orderid) as weekday,sum(orderprice) as week_order')
            ->where($weekday)
            ->where($where)
            ->find();

        //获取上周00:00时间戳
        $beginLastweek=mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
        //获取上周23:59时间戳
        $endLastweek=mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
        //统计上周订单
        $lastweek['ordercreatetime'] = ['between',[$beginLastweek,$endLastweek]];
        //获取上周添加订单数
        $statistical_info[] = $order
            ->field('count(orderid) as lastweek,sum(orderprice) as lastweek_order')
            ->where($lastweek)
            ->where($where)
            ->find();

        //获取本月00:00时间戳
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        //获取本月23:59时间戳
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        //统计本月注册的订单
        $month['ordercreatetime'] = ['between',[$beginThismonth,$endThismonth]];
        //获取本月添加订单数
        $statistical_info[] = $order
            ->field('count(orderid) as month,sum(orderprice) as month_order')
            ->where($month)
            ->where($where)
            ->find();

        //获取上月00:00时间戳
        $beginlastmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        //获取上月23:59时间戳
        $endlastmonth=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
        //统计上月订单
        $lastmonth['ordercreatetime'] = ['between',[$beginlastmonth,$endlastmonth]];
        //获取上月添加订单数
        $statistical_info[] = $order
            ->field('count(orderid) as lastmonth,sum(orderprice) as lastmonth_order')
            ->where($lastmonth)
            ->where($where)
            ->find();

        //获取今年00:00时间戳
        $beginthisyear=mktime(0,0,0,1,1,date('Y'));
        //获取今年23:59时间戳
        $endthisyear=mktime(23,59,59,12,31,date('Y'));
        //统计今年订单
        $year['ordercreatetime'] = ['between',[$beginthisyear,$endthisyear]];
        //获取今年添加订单数
        $statistical_info[] = $order
            ->field('count(orderid) as year,sum(orderprice) as year_order')
            ->where($year)
            ->where($where)
            ->find();

        //历史订单数
        $statistical_info[] = $order
            ->field('count(orderid) as history,sum(orderprice) as history_order')
            ->where($where)
            ->find();

        $statistical = [];
        foreach ($statistical_info as $v){
            $statistical = array_merge($statistical,$v);
        }
        $statistical['today_order'] = isset($statistical['today_order']) ? $statistical['today_order'] : '0000';
        $statistical['yesterday_order'] = isset($statistical['yesterday_order']) ? $statistical['yesterday_order'] : '0000';
        $statistical['week_order'] = isset($statistical['week_order']) ? $statistical['week_order'] : '0000';
        $statistical['lastweek_order'] = isset($statistical['lastweek_order']) ? $statistical['lastweek_order'] : '0000';
        $statistical['month_order'] = isset($statistical['month_order']) ? $statistical['month_order'] : '0000';
        $statistical['lastmonth_order'] = isset($statistical['lastmonth_order']) ? $statistical['lastmonth_order'] : '0000';
        $statistical['year_order'] = isset($statistical['year_order']) ? $statistical['year_order'] : '0000';
        $statistical['history_order'] = isset($statistical['history_order']) ? $statistical['history_order'] : '0000';

        return $statistical;
    }

    /**
     * @param $day
     * 2018/12/18
     * 10:47
     *
     * @return array
     * anthor liu
     * 组装where条件
     */
    Public function where_s($day){
        switch ($day)
        {
            case 'today':
                $where = $this->today();
                break;
            case 'yestoday':
                $where = $this->yestoday();
                break;
            case 'weekday':
                $where = $this->weekday();
                break;
            case 'lastweek':
                $where = $this->lastweek();
                break;
            case 'month':
                $where = $this->month();
                break;
            case 'lastmonth':
                $where = $this->lastmonth();
                break;
            case 'year':
                $where = $this->year();
                break;
            case 'yesterdayprev':
                $where = $this->yesterdayprev();
                break;
            default:
        }
        return $where;
    }

    /**
     * @param $month
     * 2018/12/13
     * 9:10
     * @return array
     * anthor liu
     * 组装between条件
     */
    Public function where_report($month){
        switch ($month)
        {
            case 'month':
                $where = $this->month();
                break;
            case 'lastmonth':
                $where = $this->lastmonth();
                break;
            default:
        }
        return $where;
    }

    /**
     * 2018/12/4
     * 15:22
     * anthor liu
     * 今日数据
     */
    Public function today(){
        //获取今天00:00时间戳
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        //获取今天24:00时间戳
        $todayend = strtotime(date('Y-m-d'.'00:00:00',time()+3600*24));
        //where条件
        $today = ['between',[$todaystart,$todayend]];
        return $today;
    }

    /**
     * 2018/12/4
     * 16:01
     * @return array
     * anthor liu
     * 昨日数据
     */
    Public function yestoday(){
        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //获取昨天24:00时间戳
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        //统计昨天订单
        $yesterday = ['between',[$beginYesterday,$endYesterday]];
        return $yesterday;
    }

    /**
     * 2018/12/8
     * 15:23
     * @return array
     * anthor liu
     * 昨天以前
     */
    Public function yesterdayprev(){
        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //统计昨天以前
        $yesterdayprev = ['lt',$beginYesterday];
        return $yesterdayprev;
    }

    /**
     * 2018/12/4
     * 16:05
     * anthor liu
     * 本周数据
     */
    Public function weekday(){
        //获取本周00:00时间戳
        $startthisweek=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
        //获取本周23:59时间戳
        $endToday=mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));
        //统计本周订单
        $weekday = ['between',[$startthisweek,$endToday]];
        return $weekday;
    }

    /**
     * 2018/12/4
     * 16:05
     * anthor liu
     * 上周数据
     */
    Public function lastweek(){
        //获取上周00:00时间戳
        $beginLastweek=mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
        //获取上周23:59时间戳
        $endLastweek=mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
        //统计上周订单
        $lastweek = ['between',[$beginLastweek,$endLastweek]];
        return $lastweek;
    }

    /**
     * 2018/12/4
     * 16:06
     * anthor liu
     * 本月数据
     */
    Public function month(){
        //获取本月00:00时间戳
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        //获取本月23:59时间戳
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        //统计本月注册的订单
        $month = ['between',[$beginThismonth,$endThismonth]];
        return $month;
    }

    /**
     * 2018/12/4
     * 16:06
     * anthor liu
     * 上月数据
     */
    Public function lastmonth(){
        //获取上月00:00时间戳
        $beginlastmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        //获取上月23:59时间戳
        $endlastmonth=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
        //统计上月订单
        $lastmonth = ['between',[$beginlastmonth,$endlastmonth]];
        return $lastmonth;
    }

    /**
     * 2018/12/4
     * 16:07
     * anthor liu
     * 今年数据
     */
    Public function year(){
        //获取今年00:00时间戳
        $beginthisyear=mktime(0,0,0,1,1,date('Y'));
        //获取今年23:59时间戳
        $endthisyear=mktime(23,59,59,12,31,date('Y'));
        //统计今年订单
        $year = ['between',[$beginthisyear,$endthisyear]];
        return $year;
    }

    /**
     * 2018/12/15
     * 15:38
     * @return array
     * anthor liu
     * 退单率，退单数，退单金额...
     */
    Public function return_rate_avg(){
        $order = D('Order');
        //本月退单率/历史退单率/上月退单率
        $history['orderstatus']  = 4;
        $history['delete'] = $month_where['delete'] = $lastmonth_where['delete'] = $history_t['delete'] = 1;
        //如果是销售
        $userid = $_SESSION['userid'];
        if($_SESSION['username'] != 'admin'){
            $history['saleid'] = $history_t['saleid'] = $userid;
            $month_where['saleid'] = $userid;
            $lastmonth_where['saleid'] = $userid;
        }
        $order_history = $order->where($history)->select();
        //获取本月00:00时间戳
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        //获取本月23:59时间戳
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        //获取上月00:00时间戳
        $beginlastmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        //获取上月23:59时间戳
        $endlastmonth=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
        $report = [];
        foreach ($order_history as $z){
            $report['history']['chargeback'] += 1;
            $report['history']['refunds'] += $z['orderprice'];
            if($z['ordercreatetime'] >= $beginThismonth and $z['ordercreatetime'] <= $endThismonth){
                $report['month']['chargeback'] += 1;
                $report['month']['refunds'] += $z['orderprice'];
            }
            if($z['ordercreatetime'] >= $beginlastmonth and $z['ordercreatetime'] <= $endlastmonth){
                $report['lastmonth']['chargeback'] += 1;
                $report['lastmonth']['refunds'] += $z['orderprice'];
            }
        }
        $report['history']['refunds'] = isset($report['history']['refunds']) ? $report['history']['refunds'] : '0';
        $report['history']['chargeback'] = isset($report['history']['chargeback'])  ? $report['history']['chargeback'] : '0';
        $report['month']['refunds'] = isset($report['month']['refunds']) ? $report['month']['refunds'] : '0';
        $report['month']['chargeback'] = isset($report['month']['chargeback'])  ? $report['month']['chargeback'] : '0';
        $report['lastmonth']['refunds'] = isset($report['lastmonth']['refunds']) ? $report['lastmonth']['refunds'] : '0';
        $report['lastmonth']['chargeback'] = isset($report['lastmonth']['chargeback'])  ? $report['lastmonth']['chargeback'] : '0';
        //本月总订单数/本月订单总金额/本月退单率/本月退单金额率
        $month_where['ordercreatetime'] = $order->where_report('month');
        $report['month']['sum']         = $order->where($month_where)->count();
        $report['month']['amount']      = $order->where($month_where)->sum('orderprice');
        $report['month']['amount']      = isset($report['month']['amount']) ? $report['month']['amount'] : '0000';
        $report['month']['avg']         = round($report['month']['chargeback'] / $report['month']['sum'],3)*100 . '%';
        $report['month']['amount_avg']         = round($report['month']['refunds'] / $report['month']['amount'],3)*100 . '%';
        //上月总订单数/上月订单总金额/上月退单率/上月退单金额率
        $lastmonth_where['ordercreatetime'] = $order->where_report('lastmonth');
        $report['lastmonth']['sum'] = $order->where($lastmonth_where)->count();
        $report['lastmonth']['amount'] = $order->where($lastmonth_where)->sum('orderprice');
        $report['lastmonth']['amount']      = isset($report['lastmonth']['amount']) ? $report['lastmonth']['amount'] : '0000';
        $report['lastmonth']['avg']         = round($report['lastmonth']['chargeback'] / $report['lastmonth']['sum'],3)*100 . '%';
        $report['lastmonth']['amount_avg']         = round($report['lastmonth']['refunds'] / $report['lastmonth']['amount'],3)*100 . '%';
        //历史总订单数/历史订单总金额/历史退单率/历史退单金额率
        $report['history']['sum'] = $order->where($history_t)->count();
        $report['history']['amount'] = $order->where($history_t)->sum('orderprice');
        $report['history']['amount'] = isset($report['history']['amount']) ? $report['history']['amount'] : '0000';
        $report['history']['avg']         = round($report['history']['chargeback'] / $report['history']['sum'],3)*100 . '%';
        $report['history']['amount_avg']         = round($report['history']['refunds'] / $report['history']['amount'],3)*100 . '%';
        //实际订单
        $report['month']['real_order'] = $report['month']['sum'] - $report['month']['chargeback'];
        $report['month']['real_amount'] = $report['month']['amount'] - $report['month']['refunds'];
        $report['lastmonth']['real_order'] = $report['lastmonth']['sum'] - $report['lastmonth']['chargeback'];
        $report['lastmonth']['real_amount'] = $report['lastmonth']['amount'] - $report['lastmonth']['refunds'];
        $report['history']['real_order'] = $report['history']['sum'] - $report['history']['chargeback'];
        $report['history']['real_amount'] = $report['history']['amount'] - $report['history']['refunds'];
        return $report;
    }

    /**
     * 2018/12/17
     * 17:07
     * anthor liu
     * 本月端对业绩
     */
    Public function group_month(){
        $admin = M('Admin');
        $order = D('Order');
        $customer = M('Customer');
        $group = M('Group');
        //获取统计数据
        $where_order['delete'] = 1;

        $group_info = $group->where(['issale'=>'是'])->limit(6)->select();
        $admin_info = $admin->select();
        //初始化默认数据
        $where_order['ordercreatetime'] = $order->where_report('month');
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
        foreach($info as $n){
            $sort[] = $n['funds']["order_total_amount"];
        }
        array_multisort($sort,SORT_DESC,$info);
        return $info;
    }

    /**
     * 2018/12/17
     * 17:09
     * @return array
     * anthor liu
     * 历史业绩统计
     */
    Public function group_histort(){
        $admin = M('Admin');
        $order = D('Order');
        $customer = M('Customer');
        $group = M('Group');
        //获取统计数据
        $where_order['delete'] = 1;

        $group_info = $group->where(['issale'=>'是'])->limit(6)->select();
        $admin_info = $admin->select();
        //初始化默认数据
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
        foreach($info as $n){
            $sort[] = $n['funds']["order_total_amount"];
        }
        array_multisort($sort,SORT_DESC,$info);
        return $info;
    }

    /**
     * 2018/12/17
     * 17:08
     * @return array
     * anthor liu
     * 上月业绩统计
     */
    Public function group_lastmonth(){
        $admin = M('Admin');
        $order = D('Order');
        $customer = M('Customer');
        $group = M('Group');
        //获取统计数据
        $where_order['delete'] = 1;

        $group_info = $group->where(['issale'=>'是'])->limit(6)->select();
        $admin_info = $admin->select();
        //初始化默认数据
        $where_order['ordercreatetime'] = $order->where_report('lastmonth');
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
        foreach($info as $n){
            $sort[] = $n['funds']["order_total_amount"];
        }
        array_multisort($sort,SORT_DESC,$info);

        return $info;
    }

    /**
     * 2018/12/18
     * 10:43
     * @return array
     * anthor liu
     * 按天统计业绩---上月---小组
     */
    Public function group_lastmonth_day(){
        $admin = M('Admin');
        $order = D('Order');
        $group = M('Group');
        //获取统计数据
        $where_order['delete'] = 1;

        $group_info = $group->where(['issale'=>'是'])->limit(6)->select();
        $admin_info = $admin->select();
        //初始化默认数据
        $where_order['ordercreatetime'] = $order->where_report('lastmonth');
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
                            //获取上月00:00时间戳
                            $beginlastmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
                            //获取上月23:59时间戳
                            $endlastmonth=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
                            $j = 0;
                            for($i=$beginlastmonth;$i<=$endlastmonth;$i=$i+86400){
                                $m = $i + 86400;
                                $j++;
                                $g = $vvv['group_id'];
                                if($vvvv['ordercreatetime']>=$i and $vvvv['ordercreatetime']< $m){
                                    $day_funds['dayprice'][$g][$j] += $vvvv['orderprice'];
                                }
                            }
                        }
                    }
                }
                $c['day_funds'] = $day_funds;
            }
            unset($v['team']);
            $v['funds'] = $c['day_funds']['dayprice'];
            $grooup_list = $v['funds'];
        }
        //获取上月天数
        $d = date('t', strtotime('-1 month'));
        foreach ($group_info as $g){
            foreach ($grooup_list as $k=>$value){
                if($k == $g['group_id']){
                    $k = $g['group_name'];
                    $list[$k] = $value;
                }
            }
        }

        //没有业绩的补充0
        foreach ($list as $key=>$l){
            for($i=1;$i<$d+2;$i++){
                if(!isset($l,$l[$i])){
                    $l[$i-1] = 0;
                }else{
                    $l[$i-1] = $l[$i];
                }
            }

            ksort($l);
            array_pop($l);
            $list_in[$key] = $l;
        }
        //生产日期
        for($i=1;$i<=$d;$i++){
            $date[] = $i;
        }
//        $date = implode(',',$date);
        //整理返回值
//        $arr = ['one','two','three','four','five','six'];
//        $b = 0;
        foreach ($list_in as $k=>$v){
            $info['group_name'][] = $k;
            ksort($v);
//            $k_b = $arr[$b];
            $info['group_amount_day']['name'][] = $k;
            $info['group_amount_day']['day'][] = $v;
//            $b++;
        }
        $info['group_date'] = $date;
        return $info;
    }

    /**
     * 2018/12/18
     * 11:31
     * @return mixed
     * anthor liu
     * 按天统计业绩---本月---小组
     */
    Public function group_month_day(){
        $admin = M('Admin');
        $order = D('Order');
        $group = M('Group');
        //获取统计数据
        $where_order['delete'] = 1;

        $group_info = $group->where(['issale'=>'是'])->limit(6)->select();
        $admin_info = $admin->select();
        //初始化默认数据
        $where_order['ordercreatetime'] = $order->where_report('month');
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
                            //获取本月00:00时间戳
                            $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
                            //获取本月23:59时间戳
                            $endThismonth=time();

                            $j = 0;
                            for($i=$beginThismonth;$i<=$endThismonth;$i=$i+86400){
                                $m = $i + 86400;
                                $j++;
                                $g = $vvv['group_id'];
                                if($vvvv['ordercreatetime']>=$i and $vvvv['ordercreatetime']< $m){
                                    $day_funds['dayprice'][$g][$j] += $vvvv['orderprice'];
                                }
                            }
                        }
                    }
                }
                $c['day_funds'] = $day_funds;
            }
            unset($v['team']);
            $v['funds'] = $c['day_funds']['dayprice'];
            $grooup_list = $v['funds'];
        }
        //获取本月天数
//        $d = date("t");
        $d = date('d',time());
        if($d <= 7) $d = 7;
        foreach ($group_info as $g){
            foreach ($grooup_list as $k=>$value){
                if($k == $g['group_id']){
                    $k = $g['group_name'];
                    $list[$k] = $value;
                }
            }
        }

        //没有业绩的补充 "0"
        foreach ($list as $key=>$l){
            for($i=1;$i<$d+2;$i++){
                if(!isset($l,$l[$i])){
                    $l[$i-1] = 0;
                }else{
                    $l[$i-1] = $l[$i];
                }
            }
            ksort($l);
            array_pop($l);
            $list_in[$key] = $l;
        }
        //生产日期
        for($i=1;$i<=$d;$i++){
            $date[] = $i;
        }
//        $date = implode(',',$date);
        //整理返回值
//        $arr = ['one','two','three','four','five','six'];
//        $b = 0;
        foreach ($list_in as $k=>$v){
            $info['group_name'][] = $k;
            ksort($v);
//            $k_b = $arr[$b];
            $info['group_amount_day']['name'][] = $k;
            $info['group_amount_day']['day'][] = $v;
//            $b++;
        }
        $info['group_date'] = $date;
        return $info;
    }

    /**
     * 2018/12/18
     * 18:18
     * @return mixed
     * anthor liu
     * 按月统计业绩---本年---小组
     */
    Public function group_year(){
        $admin = M('Admin');
        $order = D('Order');
        $group = M('Group');
        //获取统计数据
        $where_order['delete'] = 1;

        $group_info = $group->where(['issale'=>'是'])->limit(6)->select();
        $admin_info = $admin->select();
        //获取今年00:00时间戳
        $beginthisyear=mktime(0,0,0,1,1,date('Y'));
        //获取今年23:59时间戳
        $endthisyear=mktime(23,59,59,12,31,date('Y'));
        $where_order['ordercreatetime'] = [between,[$beginthisyear,$endthisyear]];
        //初始化默认数据
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
                            $j = 0;
                            $month_day = date('t', strtotime('1 month'));
                            $m = $beginthisyear + (86400*$month_day);
                            for($i=$beginthisyear;$i<=$endthisyear;$i=$m){
                                $m = $i + (86400*$month_day);
                                $j++;
                                $month_day = date('t', strtotime(($j+1) .' month'));
                                $g = $vvv['group_id'];
                                if($vvvv['ordercreatetime']>=$i and $vvvv['ordercreatetime']< $m){
                                    $day_funds['dayprice'][$g][$j-1] += $vvvv['orderprice'];
                                }
                            }
                        }
                    }
                }
                $c['day_funds'] = $day_funds;
            }
            unset($v['team']);
            $v['funds'] = $c['day_funds']['dayprice'];
            $grooup_list = $v['funds'];
        }
//        echo "<pre>";
//        echo ' ';
//        print_r( $grooup_list);
//        exit();
        //获取本月天数
//        $d = date("t");
//        $d = 12;

        foreach ($group_info as $g){
            foreach ($grooup_list as $k=>$value){
                if($k == $g['group_id']){
                    $k = $g['group_name'];
                    $list[$k] = $value;
                }
            }
        }
        //没有业绩的补充 "0"
        foreach ($list as $key=>$l){
            for($i=0;$i<12;$i++){
                if(!isset($l,$l[$i])){
                    $l[$i] = 0;
                }
            }
            $list_in[$key] = $l;
        }
        //生产日期
//        for($i=1;$i<=12;$i++){
//            $date[] = $i;
//        }
//        $date = ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sept','Oct','Nov','Dec'];
        $date = ['1 月','2 月','3 月','4 月','5 月','6 月','7 月','8 月','9 月','10 月','11 月','12 月'];
//        $date = implode(',',$date);
        //整理返回值
//        $arr = ['one','two','three','four','five','six'];
//        $b = 0;
        foreach ($list_in as $k=>$v){
            $info['group_name'][] = $k;
            ksort($v);
//            $k_b = $arr[$b];
            $info['group_amount_day']['name'][] = $k;
            $info['group_amount_day']['day'][] = $v;
//            $b++;
        }
        $info['group_date'] = $date;
        return $info;
    }

    /**
     * @param $date
     * 2018/12/21
     * 11:20
     * anthor liu
     * 首页销售排名
     */
    Public function wel_sale_rank($date='null'){
        $admin = M('Admin');
        $order = D('Order');
        $where['delete'] = 1;
        $where['orderstatus'] = ['neq',4];
        if($date != 'null') $where['ordercreatetime'] = $date;
        //获取销售业绩排名
        $order_rank = $order
            ->field('saleid,count(saleid) as order_sum,sum(orderprice) as t_order')
            ->where($where)
            ->group('saleid')
            ->order('t_order desc')
            ->limit(5)
            ->select();
        //获取销售姓名和头像
        $sale_ids = array_map('array_shift',$order_rank);
        $sale_ids = implode(',',$sale_ids);
        $where_admin['id'] = ['in',$sale_ids];
        $admin_info = $admin
            ->field('id,nickname,img_small')
            ->where($where_admin)
            ->select();
        //组装数据
        foreach ($order_rank as $v){
            foreach ($admin_info as $vv){
                if($v['saleid'] == $vv['id']){
                    $info[] = array_merge($v,$vv);
                }
            }
        }
        return $info;
    }

    /**
     * 2018/12/21
     * 14:29
     * @return mixed
     * anthor liu
     * 按天统计业绩---本月
     */
    Public function month_day_amount(){
        $order = D('Order');
        //获取统计数据
        $where_order['delete'] = 1;
        $where_order['orderstatus'] = ['neq',4];
        $userid = $_SESSION['userid'];
        if($_SESSION['username'] != 'admin') $where_order['saleid'] = $userid;

        //初始化默认数据
        $where_order['ordercreatetime'] = $order->where_report('month');
        $order_info = $order->where($where_order)->select();

        //统计
        $list = $order_count = [];
        foreach ($order_info as $v){
            //获取本月00:00时间戳
            $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
            //获取本月23:59时间戳
            $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
            $j = 0;
            for($i=$beginThismonth;$i<=$endThismonth;$i=$i+86400){
                $m = $i + 86400;
                $j++;
                if($v['ordercreatetime']>=$i and $v['ordercreatetime']< $m){
                    $list[$j] += $v['orderprice'];
                    $order_count[$j] ++;
                }
            }
        }

        //获取本月天数
        $d = date('d',time());
        if($d <= 7) $d = 7;
        //没有业绩的补充0
        for($i=1;$i<$d+2;$i++){
            $date[] = $i;
            if(!isset($list,$list[$i])){
                $list[$i-1] = 0;
            }else{
                $list[$i-1] = $list[$i];
            }
            if(!isset($order_count,$order_count[$i])){
                $order_count[$i-1] = 0;
            }else{
                $order_count[$i-1] = $order_count[$i];
            }
        }

        ksort($list);
        ksort($order_count);
        array_pop($date);
        array_pop($list);
        array_pop($order_count);
        $info['date'] = $date;
        $info['list'] = $list;
        $info['order_count'] = $order_count;
        return $info;
    }



    /**
     * 2018/12/21
     * 16:15
     * @return array
     * anthor liu
     * 按天统计顾客数---本月
     */
    Public function month_day_customer(){
        $order = D('Order');
        $customer = D('Customer');
        //获取统计数据
        $where['delete'] = 1;

        //初始化默认数据
        $where['create_time'] = $order->where_report('month');
        $userid = $_SESSION['userid'];
        if($_SESSION['username'] != 'admin') $where['saleid'] = $userid;
        $customer_info = $customer->where($where)->select();

        //统计
        $list = [];
        foreach ($customer_info as $v){
            //获取本月00:00时间戳
            $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
            //获取本月23:59时间戳
            $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
            $j = 0;
            for($i=$beginThismonth;$i<=$endThismonth;$i=$i+86400){
                $m = $i + 86400;
                $j++;
                if($v['create_time']>=$i and $v['create_time']< $m){
                    $list[$j] ++;
                }
            }
        }

        //获取本月天数
        $d = date('d',time());
        if($d <= 7) $d = 7;
        //没有业绩的补充0
        for($i=1;$i<$d+2;$i++){
            if(!isset($list,$list[$i])){
                $list[$i-1] = 0;
            }else{
                $list[$i-1] = $list[$i];
            }
        }

        ksort($list);
        array_pop($list);
        return $list;
    }

    /**
     * 2018/12/21
     * 14:30
     * @return mixed
     * anthor liu
     * 按天统计订单---上月
     */
    Public function lastmonth_day_amount(){
        $order = D('Order');
        //获取统计数据
        $where_order['delete'] = 1;
        $where_order['orderstatus'] = ['neq',4];
        $userid = $_SESSION['userid'];
        if($_SESSION['username'] != 'admin') $where_order['saleid'] = $userid;
        //初始化默认数据
        $where_order['ordercreatetime'] = $order->where_report('lastmonth');
        $order_info = $order->where($where_order)->select();

        //统计
        $list = $order_count =[];
        foreach ($order_info as $v){
            //获取上月00:00时间戳
            $beginlastmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
            //获取上月23:59时间戳
            $endlastmonth=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
            $j = 0;
            for($i=$beginlastmonth;$i<=$endlastmonth;$i=$i+86400){
                $m = $i + 86400;
                $j++;
                if($v['ordercreatetime']>=$i and $v['ordercreatetime']< $m){
                    $list[$j] += $v['orderprice'];
                    $order_count[$j] ++;
                }
            }
        }

        //获取上月天数
        $d = date('t', strtotime('-1 month'));
        //没有业绩的补充0
        for($i=1;$i<$d+2;$i++){
            $date[] = $i;
            if(!isset($list,$list[$i])){
                $list[$i-1] = 0;
            }else{
                $list[$i-1] = $list[$i];
            }
            if(!isset($order_count,$order_count[$i])){
                $order_count[$i-1] = 0;
            }else{
                $order_count[$i-1] = $order_count[$i];
            }
        }

        ksort($list);
        ksort($order_count);
        array_pop($date);
        array_pop($list);
        array_pop($order_count);
        $info['date'] = $date;
        $info['list'] = $list;
        $info['order_count'] = $order_count;
        return $info;
    }

    /**
     * 2018/12/21
     * 15:39
     * @return mixed
     * anthor liu
     * 按天统计顾客数---上月
     */
    Public function lastmonth_day_customer(){
        $order = D('Order');
        $customer = D('Customer');
        //获取统计数据
        $where['delete'] = 1;

        //初始化默认数据
        $where['create_time'] = $order->where_report('lastmonth');
        $userid = $_SESSION['userid'];
        if($_SESSION['username'] != 'admin') $where['saleid'] = $userid;
        $customer_info = $customer->where($where)->select();

        //统计
        $list = [];
        foreach ($customer_info as $v){
            //获取上月00:00时间戳
            $beginlastmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
            //获取上月23:59时间戳
            $endlastmonth=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
            $j = 0;
            for($i=$beginlastmonth;$i<=$endlastmonth;$i=$i+86400){
                $m = $i + 86400;
                $j++;
                if($v['create_time']>=$i and $v['create_time']< $m){
                    $list[$j] ++;
                }
            }
        }

        //获取上月天数
        $d = date('t', strtotime('-1 month'));
        //没有业绩的补充0
        for($i=1;$i<$d+2;$i++){
            if(!isset($list,$list[$i])){
                $list[$i-1] = 0;
            }else{
                $list[$i-1] = $list[$i];
            }
        }

        ksort($list);
        array_pop($list);
        return $list;
    }



    /**
     * 2018/12/22
     * 14:29
     * @return mixed
     * anthor liu
     * 按天统计财务---上月
     */
    Public function month_day_amount_funds($month){
        $order = D('Order');
        //获取统计数据
        $where_order['delete'] = 1;
        $where_order['orderstatus'] = ['neq',4];

        //初始化默认数据
        $where_order['ordercreatetime'] = $order->where_report($month);
        $order_info = $order->where($where_order)->select();
        //统计
        if($month == 'month'){
            //获取本月00:00时间戳
            $beginmonth=mktime(0,0,0,date('m'),1,date('Y'));
            //获取本月23:59时间戳
            $endmonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        }else if($month == 'lastmonth'){
            //获取上月00:00时间戳
            $beginmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
            //获取上月23:59时间戳
            $endmonth=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
        }else{
            $arr = explode('-',$month);
            $m =$arr[0];
            $y =$arr[1];
            $beginmonth = mktime(0,0,0,$m,1,$y);
            $endmonth = mktime(23,59,59,$m,date('t', strtotime($month)),$y);
        }

        $list = $customer =[];
        foreach ($order_info as $v){
            $j = 0;
            for($i=$beginmonth;$i<=$endmonth;$i=$i+86400){
                $m = $i + 86400;
                $j++;
                if($v['ordercreatetime']>=$i and $v['ordercreatetime']< $m){
                    $list[$j]['funds'] += $v['orderprice'];
                    $list[$j]['courierfee'] += $v['courierfee'];
                    $list[$j]['serverfee'] += $v['serverfee'];
                    $list[$j]['pay'] += $v['pay'];
                    $list[$j]['payment'] += $v['payment'];
                    $list[$j]['refunds'] += $v['refunds'];
                    $list[$j]['order_count'] ++;
                    if(!in_array($v['cid'],$customer[$j])){
                        array_push($customer[$j],$v['cid']);
                        $list[$j]['customer'] ++;
                    }
                }
            }
        }

        //获取上月天数
        if($month == 'month'){
            $d = date('d',time());
        }else if($month == 'lastmonth'){
            $d = date('t', strtotime('-1 month'));
        }else{
            $d = date('t', strtotime($month));
        }

        //没有业绩的补充0
        for($i=1;$i<$d+2;$i++){
            $date[] = $i;
            if(!isset($list,$list[$i])){
                $list[$i-1]['funds'] =0;
                $list[$i-1]['courierfee'] =0;
                $list[$i-1]['serverfee'] =0;
                $list[$i-1]['pay'] =0;
                $list[$i-1]['payment'] =0;
                $list[$i-1]['refunds'] =0;
                $list[$i-1]['order_count'] =0;
                $list[$i-1]['customer'] =0;
            }else{
                $list[$i-1]['funds'] = $list[$i]['funds'];
                $list[$i-1]['courierfee'] = $list[$i]['courierfee'];
                $list[$i-1]['serverfee'] = $list[$i]['serverfee'];
                $list[$i-1]['pay'] = $list[$i]['pay'];
                $list[$i-1]['payment'] = $list[$i]['payment'];
                $list[$i-1]['refunds'] = $list[$i]['refunds'];
                $list[$i-1]['order_count'] = $list[$i]['order_count'];
                $list[$i-1]['customer'] = $list[$i]['customer'];
            }
        }
        ksort($list);
        array_pop($list);
        $info = $list;
        return $info;
    }

    /**
     * 2018/12/23
     * 9:53
     * anthor liu
     * 历史总数据
     */
    Public function history(){
        $order = M('Order');
        $customer = M('Customer');
        $where['delete'] = 1;
        $where['orderstatus'] = ['neq',4];
        $info = $order
            ->field('sum(orderprice) as totalfunds,count(orderid) as totalorder,sum(serverfee) as totalserverfee,sum(courierfee) as totalcourierfee')
            ->where($where)
            ->select();
        $map['delete'] = 1;
        $map['buyrate'] = ['gt',0];
        $info[] = $customer
            ->field('count(cid) as totalcustomer')
            ->where($map)
            ->select();
        $info = array_merge($info[0],$info[1][0]);
        return $info;
    }


}