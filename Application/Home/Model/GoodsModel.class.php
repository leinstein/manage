<?php

namespace Home\Model;
use Think\Model;

class GoodsModel extends Model
{
    /**
     * 2018/12/6
     * 8:50
     * @return mixed
     * anthor liu
     * 统计
     */
    Public function statistical(){
        $goods = M('Goods');
        //获取今天00:00时间戳
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        //获取今天24:00时间戳
        $todayend = strtotime(date('Y-m-d'.'00:00:00',time()+3600*24));
        //where条件
        $today['create_time'] = [between,[$todaystart,$todayend]];
        //获取今天添加订单数
        $statistical['today'] = $goods->where($today)->count();

        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //获取昨天24:00时间戳
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        //统计昨天订单
        $yesterday['create_time'] = [between,[$beginYesterday,$endYesterday]];
        //获取昨天添加订单数
        $statistical['yesterday'] = $goods->where($yesterday)->count();

        //获取本周00:00时间戳
        $startthisweek=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
        //获取本周23:59时间戳
        $endToday=mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));
        //统计本周订单
        $weekday['create_time'] = [between,[$startthisweek,$endToday]];
        //获取本周添加订单数
        $statistical['weekday'] = $goods->where($weekday)->count();

        //获取上周00:00时间戳
        $beginLastweek=mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
        //获取上周23:59时间戳
        $endLastweek=mktime(23,59,59,date('m'),date('d')-date('w'),date('Y'));
        //统计上周订单
        $lastweek['create_time'] = [between,[$beginLastweek,$endLastweek]];
        //获取上周添加订单数
        $statistical['lastweek'] = $goods->where($lastweek)->count();

        //获取本月00:00时间戳
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        //获取本月23:59时间戳
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        //统计本月注册的订单
        $month['create_time'] = [between,[$beginThismonth,$endThismonth]];
        //获取本月添加订单数
        $statistical['month'] = $goods->where($month)->count();

        //获取上月00:00时间戳
        $beginlastmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        //获取上月23:59时间戳
        $endlastmonth=strtotime(date("Y-m-d 23:59:59", strtotime(-date('d').'day')));
        //统计上月订单
        $lastmonth['create_time'] = [between,[$beginlastmonth,$endlastmonth]];
        //获取上月添加订单数
        $statistical['lastmonth'] = $goods->where($lastmonth)->count();

        //获取今年00:00时间戳
        $beginthisyear=mktime(0,0,0,date('m')-1,1,date('Y'));
        //获取今年23:59时间戳
        $endthisyear=mktime(23,59,59,date('m')-1,date('t')-1,date('Y'));
        //统计今年订单
        $year['create_time'] = [between,[$beginthisyear,$endthisyear]];
        //获取今年添加订单数
        $statistical['year'] = $goods->where($year)->count();

        //历史订单数
        $statistical['history'] = $goods->count();
        return $statistical;
    }
}