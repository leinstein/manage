<?php

namespace Home\Model;
use Think\Model;

class CustomerModel extends Model
{
    /**
     * 2018/12/8
     * 15:10
     * @return mixed
     * anthor liu
     * 客户统计信息
     */
    Public function statistical($group = 'null'){
        $customer = M('Customer');
        $where['delete'] = 1;
        $userid = $_SESSION['userid'];
        if($_SESSION['username'] != 'admin' and $group == 'null') $where_order['saleid'] = $userid;
        if($_SESSION['username'] != 'admin' and $group == 'group') $where['itemid'] = $_SESSION['groupid'];
        //获取今天00:00时间戳
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        //获取今天24:00时间戳
        $todayend = strtotime(date('Y-m-d'.'00:00:00',time()+3600*24));
        //where条件
        $today['create_time'] = ['between',[$todaystart,$todayend]];
        //获取今天添加客户数
        $statistical['today'] = $customer->where($today)->where($where)->count();

        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //获取昨天24:00时间戳
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        //统计昨天注册的用户
        $yesterday['create_time'] = ['between',[$beginYesterday,$endYesterday]];
        //获取昨天添加客户数
        $statistical['yesterday'] = $customer->where($yesterday)->where($where)->count();

        //获取本周00:00时间戳
        $startthisweek=mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
        //获取本周23:59时间戳
        $endToday=mktime(23,59,59,date('m'),date('d')-date('w'),date('Y'));
        //统计本周注册的用户
        $weekday['create_time'] = ['between',[$startthisweek,$endToday]];
        //获取本周添加客户数
        $statistical['weekday'] = $customer->where($weekday)->where($where)->count();

        $beginLastweek=mktime(0,0,0,date('m'),date('d')-date('w')+1-14,date('Y'));
        //获取上周23:59时间戳
        $endLastweek=mktime(23,59,59,date('m'),date('d')-date('w')-7,date('Y'));
        //统计上周注册的用户
        $lastweek['create_time'] = ['between',[$beginLastweek,$endLastweek]];
        //获取上周添加客户数
        $statistical['lastweek'] = $customer->where($lastweek)->where($where)->count();

        //获取本月00:00时间戳
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        //获取本月23:59时间戳
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        //统计本月注册的用户
        $month['create_time'] = ['between',[$beginThismonth,$endThismonth]];
        //获取本月添加客户数
        $statistical['month'] = $customer->where($month)->where($where)->count();

        //获取上月00:00时间戳
        $beginlastmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        //获取上月23:59时间戳
        $endlastmonth=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
        //统计上月注册的用户
        $lastmonth['create_time'] = ['between',[$beginlastmonth,$endlastmonth]];
        //获取上月添加客户数
        $statistical['lastmonth'] = $customer->where($lastmonth)->where($where)->count();

        //获取今年00:00时间戳
        $beginthisyear=mktime(0,0,0,date('m')-1,1,date('Y'));
        //获取今年23:59时间戳
        $endthisyear=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
        //统计今年注册的用户
        $year['create_time'] = ['between',[$beginthisyear,$endthisyear]];
        //获取今年添加客户数
        $statistical['year'] = $customer->where($year)->where($where)->count();

        //历史用户数
        $statistical['history'] = $customer->where($where)->count();
        return $statistical;
    }

    /**
     * 2018/12/8
     * 15:10
     * @return mixed
     * anthor liu
     * 待办任务统计信息
     */
    Public function statistical_backlog(){
        $customer = M('Backlog');
        //获取今天00:00时间戳
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        //获取今天24:00时间戳
        $todayend = strtotime(date('Y-m-d'.'00:00:00',time()+3600*24));
        //where条件
        $today['create_time'] = ['between',[$todaystart,$todayend]];
        //获取今天添加客户数
        $statistical['today'] = $customer->where($today)->where(['delete'=>1])->count();

        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //获取昨天24:00时间戳
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        //统计昨天注册的用户
        $yesterday['create_time'] = ['between',[$beginYesterday,$endYesterday]];
        //获取昨天添加客户数
        $statistical['yesterday'] = $customer->where($yesterday)->where(['delete'=>1])->count();

        //历史用户数
        $statistical['history'] = $customer->where(['delete'=>1])->count();
        $statistical['yesterdayprev'] = $statistical['history'] - $statistical['yesterday'] - $statistical['today'];
        return $statistical;
    }

    /**
     * @param $info  客户信息  数组
     * 2018/12/13
     * 17:19
     * anthor liu
     * 七次复购率
     */
    Public function report_rate($info){
        $buyrate['one'] = $buyrate['two'] = $buyrate['three'] = $buyrate['four'] = $buyrate['five'] = $buyrate['six'] = $buyrate['seven'] = $buyrate['basic'] = 0;
        foreach ($info as $m){
            if($m['buyrate'] > 1) $buyrate['basic'] ++;
            if($m['buyrate'] >= 2) $buyrate['one'] ++;
            if($m['buyrate'] >= 3) $buyrate['two'] ++;
            if($m['buyrate'] >= 4) $buyrate['three'] ++;
            if($m['buyrate'] >= 5) $buyrate['four'] ++;
            if($m['buyrate'] >= 6) $buyrate['five'] ++;
            if($m['buyrate'] >= 7) $buyrate['six'] ++;
            if($m['buyrate'] >= 8) $buyrate['seven'] ++;
        }
        $buyrate['rate']['one'] = round($buyrate['one'] / $buyrate['basic'],3)*100 . '%';
        $buyrate['rate']['two'] = round($buyrate['two'] / $buyrate['basic'],3)*100 . '%';
        $buyrate['rate']['three'] = round($buyrate['three'] / $buyrate['basic'],3)*100 . '%';
        $buyrate['rate']['four'] = round($buyrate['four'] / $buyrate['basic'],3)*100 . '%';
        $buyrate['rate']['five'] = round($buyrate['five'] / $buyrate['basic'],3)*100 . '%';
        $buyrate['rate']['six'] = round($buyrate['six'] / $buyrate['basic'],3)*100 . '%';
        $buyrate['rate']['seven'] = round($buyrate['seven'] / $buyrate['basic'],3)*100 . '%';
        return $buyrate;
    }
}