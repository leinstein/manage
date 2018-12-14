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
        //获取今天00:00时间戳
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        //获取今天24:00时间戳
        $todayend = strtotime(date('Y-m-d'.'00:00:00',time()+3600*24));
        //where条件
        $today['ordercreatetime'] = [between,[$todaystart,$todayend]];
        //获取今天添加订单数
        $statistical['today'] = $order->where($today)->where(['delete'=>1])->count();

        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //获取昨天24:00时间戳
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        //统计昨天订单
        $yesterday['ordercreatetime'] = [between,[$beginYesterday,$endYesterday]];
        //获取昨天添加订单数
        $statistical['yesterday'] = $order->where($yesterday)->where(['delete'=>1])->count();

        //获取本周00:00时间戳
        $startthisweek=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
        //获取本周23:59时间戳
        $endToday=mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));
        //统计本周订单
        $weekday['ordercreatetime'] = [between,[$startthisweek,$endToday]];
        //获取本周添加订单数
        $statistical['weekday'] = $order->where($weekday)->where(['delete'=>1])->count();

        //获取上周00:00时间戳
        $beginLastweek=mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
        //获取上周23:59时间戳
        $endLastweek=mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
        //统计上周订单
        $lastweek['ordercreatetime'] = [between,[$beginLastweek,$endLastweek]];
        //获取上周添加订单数
        $statistical['lastweek'] = $order->where($lastweek)->where(['delete'=>1])->count();

        //获取本月00:00时间戳
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        //获取本月23:59时间戳
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        //统计本月注册的订单
        $month['ordercreatetime'] = [between,[$beginThismonth,$endThismonth]];
        //获取本月添加订单数
        $statistical['month'] = $order->where($month)->where(['delete'=>1])->count();

        //获取上月00:00时间戳
        $beginlastmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        //获取上月23:59时间戳
        $endlastmonth=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
        //统计上月订单
        $lastmonth['ordercreatetime'] = [between,[$beginlastmonth,$endlastmonth]];
        //获取上月添加订单数
        $statistical['lastmonth'] = $order->where($lastmonth)->where(['delete'=>1])->count();

        //获取今年00:00时间戳
        $beginthisyear=mktime(0,0,0,date('m')-1,1,date('Y'));
        //获取今年23:59时间戳
        $endthisyear=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
        //统计今年订单
        $year['ordercreatetime'] = [between,[$beginthisyear,$endthisyear]];
        //获取今年添加订单数
        $statistical['year'] = $order->where($year)->where(['delete'=>1])->count();

        //历史订单数
        $statistical['history'] = $order->where(['delete'=>1])->count();
        return $statistical;
    }

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
        $today = [between,[$todaystart,$todayend]];
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
        $yesterday = [between,[$beginYesterday,$endYesterday]];
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
        $weekday = [between,[$startthisweek,$endToday]];
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
        $lastweek = [between,[$beginLastweek,$endLastweek]];
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
        $month = [between,[$beginThismonth,$endThismonth]];
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
        $lastmonth = [between,[$beginlastmonth,$endlastmonth]];
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
        $beginthisyear=mktime(0,0,0,date('m')-1,1,date('Y'));
        //获取今年23:59时间戳
        $endthisyear=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
        //统计今年订单
        $year = [between,[$beginthisyear,$endthisyear]];
        return $year;
    }
}