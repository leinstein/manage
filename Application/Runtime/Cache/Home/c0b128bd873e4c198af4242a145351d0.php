<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            风暴CRM管理系统
        </title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="/Public/Home/css/x-admin.css" media="all">
        <link rel="stylesheet" href="/Public/Home/css/fengbao.css" media="all">
        <link rel="stylesheet" href="/Public/Home/lib2/layui/css/layui.css" media="all">
    </head>
    <body style="background-color: #f0f2f5;overflow-x:hidden">
                <div class="layui-row sec_black report_sec_black">
                    <div class="layui-col-xs9 layui-col-sm9 layui-col-md9">
                        <div class="layui-tab  layui-tab-brief" lay-filter="docDemoTabBrief">
                          <ul class="layui-tab-title" id="team_li_width">
                            <li class="layui-this">本月</li>
                            <li>上月</li>
                            <li>今年</li>
                          </ul>
                          <div class="layui-tab-content report_layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <div id="brokenline" style="height: 360px"></div>
                            </div>
                            <div class="layui-tab-item">
                                <div id="brokenline1" style="height: 360px"></div>
                            </div>
                            <div class="layui-tab-item">
                                <div id="brokenline2" style="height: 360px"></div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <style>
                          .list li span{
                              color: rgba(0,0,0,.8);
                              display: inline-block;
                              margin-left: 20px;
                          }
                          .list{
                              height: 320px;
                          }
                          .list li{
                              height: 47px;
                              line-height: 47px;
                          }
                          .list_icon{
                              font-size: 18px;
                              margin-right: 16px;
                              height: 35px;
                              line-height: 35px;
                              border-radius: 50%;
                              width: 35px;
                              text-align: center;
                              margin-top: 1.5px;
                              background-color: #1AA094;
                          }
                          .list_name{
                              margin-right: 8px;
                          }
                          .list_bg{
                              background-color: #314659;
                              color: white;
                          }
                          #list_title{
                              font-size: 30px;
                              color: rgba(0,0,0,.45);
                          }
                          #list_first{
                              height: 60px;
                              padding: 20px;
                          }
                          .order_count{
                              width: 58px;
                          }
                          .layui-input{
                              color: #666;
                              font-weight: normal;
                          }
                      </style>
                    <div class="layui-col-xs3 layui-col-sm3 layui-col-md3">
                        <div class="layui-tab layui-tab-brief" style="">
                          <ul class="layui-tab-title" id="team_rank_width">
                            <li  class="layui-this">本月排行榜</li>
                            <li>上月排行榜</li>
                            <li>历史排行榜</li>
                          </ul>
                          <div class="layui-tab-content report_layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <ul class="list" id="list">
                                    <li style="margin-top: 8px">
                                        <span class="list_icon list_bg" style="color: white">1</span>
                                        <span class="list_name"><?php echo ($group_month["0"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_month["0"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_month["0"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">2</span>
                                        <span class="list_name"><?php echo ($group_month["1"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_month["1"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_month["1"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">3</span>
                                        <span class="list_name"><?php echo ($group_month["2"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_month["2"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_month["2"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">4</span>
                                        <span class="list_name"><?php echo ($group_month["3"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_month["3"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_month["3"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">5</span>
                                        <span class="list_name"><?php echo ($group_month["4"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_month["4"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_month["4"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">6</span>
                                        <span class="list_name"><?php echo ($group_month["5"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_month["5"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_month["5"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="layui-tab-item">
                                <ul class="list" id="list_style">
                                    <li style="margin-top: 8px">
                                        <span class="list_icon list_bg"  style="color: white">1</span>
                                        <span class="list_name"><?php echo ($group_lastmonth["0"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_lastmonth["0"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_lastmonth["0"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">2</span>
                                        <span class="list_name"><?php echo ($group_lastmonth["1"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_lastmonth["1"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_lastmonth["1"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">3</span>
                                        <span class="list_name"><?php echo ($group_lastmonth["2"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_lastmonth["2"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_lastmonth["2"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">4</span>
                                        <span class="list_name"><?php echo ($group_lastmonth["3"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_lastmonth["3"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_lastmonth["3"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">5</span>
                                        <span class="list_name"><?php echo ($group_lastmonth["4"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_lastmonth["4"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_lastmonth["4"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">6</span>
                                        <span class="list_name"><?php echo ($group_lastmonth["5"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_lastmonth["5"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_lastmonth["5"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="layui-tab-item">
                                <ul class="list">
                                    <li style="margin-top: 8px">
                                        <span class="list_icon list_bg"  style="color: white">1</span>
                                        <span class="list_name"><?php echo ($group_history["0"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_history["0"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_history["0"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">2</span>
                                        <span class="list_name"><?php echo ($group_history["1"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_history["1"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_history["1"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">3</span>
                                        <span class="list_name"><?php echo ($group_history["2"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_history["2"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_history["2"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">4</span>
                                        <span class="list_name"><?php echo ($group_history["3"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_history["3"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_history["3"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">5</span>
                                        <span class="list_name"><?php echo ($group_history["4"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_history["4"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_history["4"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">6</span>
                                        <span class="list_name"><?php echo ($group_history["5"]["group_name"]); ?></span>
                                        <span class="order_count"><?php echo ($group_history["5"]["funds"]["order_rate"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo ($group_history["5"]["funds"]["order_total_amount"]); ?></span>
                                    </li>
                                </ul>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="layui-fluid">
                <div class="layui-card">
                    <div class="x-body">
                    <xblock style="background-color: white !important;margin-top: -10px !important;margin-bottom: -10px !important;">
                        <a title="本月排名" class="layui-btn month_btn"  href="/Home/Report/team?month=month">
                            本月排名
                        </a>
                        <a title="上月排名" class="layui-btn month_btn"  href="/Home/Report/team?month=lastmonth">
                            上月排名
                        </a>
                        <a title="历史排名" class="layui-btn month_btn"  href="/Home/Report/team?month=history">
                            历史排名
                        </a>
                        <span class="x-right" style="margin-top: -13px">
                            <form class="layui-form x-center" action="" style="width:605px">
                                <div class="layui-form-pane" style="margin-top: 15px;">
                                  <div class="layui-form-item" style="width: 120%">
                                    <label class="layui-form-label">日期范围</label>
                                    <div class="layui-input-inline">
                                      <input class="layui-input" name="stat_date" placeholder="开始日" id="LAY_demorange_s"  autocomplete="off">
                                    </div>
                                    <div class="layui-input-inline">
                                      <input class="layui-input" name="stop_date" placeholder="截止日" id="LAY_demorange_e"  autocomplete="off">
                                    </div>
                                    <div class="layui-input-inline" style="width:120px;">
                                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>
                                    </div>
                                  </div>
                                </div>
                            </form>
                        </span>
                    </xblock>
                    <table class="layui-table" style="margin-top: -10px">
                        <thead>
                            <tr>
                                <th width="30px">
                                    排名
                                </th>
                                <th width="105px">
                                    组名
                                </th>
                                <th width="90px">
                                    销售金额
                                </th>
                                <th width="90px">
                                    业绩占比
                                </th>
                                <th>
                                    销售人数
                                </th>
                                <th>
                                    平均业绩
                                </th>
                                <th>
                                    客户
                                </th>
                                <th>
                                    订单
                                </th>
                                <th>
                                    退单
                                </th>
                                <th>
                                    退单率
                                </th>
                                <th>
                                    退单金额
                                </th>
                                <th>
                                    退单金额率
                                </th>
                            </tr>
                        </thead>
                        <style>.layui-table td, .layui-table th{text-align: center;}</style>
                        <tbody>
                            <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                                    <td class="rate_font">
                                        <?php echo ++$i;?>
                                    </td>
                                    <td>
                                        <?php echo ($v["group_name"]); ?>
                                    </td>
                                    <td class="order_total_amount">
                                        <?php echo ($v["funds"]["order_total_amount"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["funds"]["group_funds_avg"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["funds"]["group_people"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["funds"]["group_people_avg"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["funds"]["customer_count"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["funds"]["order_rate"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["funds"]["order_tui_rate"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["funds"]["order_tui_average"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["funds"]["order_total_tui_amount"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["funds"]["order_tui_funds_average"]); ?>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                                <tr class="zonghe">
                                    <td colspan="2">
                                        合计
                                    </td>
                                    
                                    <td class="order_total_amount">
                                        <?php echo ($group_sum["amount"]); ?>
                                    </td>
                                    <td>
                                        100%
                                    </td>
                                    <td>
                                        <?php echo ($group_sum["group_p"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($group_sum["amount_avg"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($group_sum["customer"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($group_sum["order_count"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($group_sum["order_tui_count"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($group_sum["order_tui_avg"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($group_sum["tui_amount"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($group_sum["order_tui_amount_avg"]); ?>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    <div id="page" style="margin-bottom: 50px;"><?php echo ($page); ?></div>
                </div>
              </div>
            </div>
    
        <script src="/Public/Home/js/jquery.js"></script>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/home/js/x-admin.js"></script>
        <script src="/Public/home/js/echarts.min.js"></script>
        
        <!--折线图-->
        <script type="text/javascript">
                    var dom = document.getElementById("brokenline");
                    var  date_day = <?php echo ($info_month_day); ?>;
                    var myDate = new Date();
                    year = myDate.getFullYear();
                    month = myDate.getMonth();
                    month_this = month + 1;
                    var myChart = echarts.init(dom);
                    var app = {};
                    option = null;
                    option = {
                        title: {
                            text: '本月统计',
                            color:'#ccc'
                        },
                        tooltip: {
                            trigger: 'axis',
                            formatter: year+"-"+month_this+"-{b}<br /><br /><div style='width: 8px;height: 8px;border: 1px solid #c02c38;display: inline-block;border-radius: 50%;background-color: #c02c38'></div> {a0}: {c0}<br /><div style='width: 8px;height: 8px;border: 1px solid #894276;display: inline-block;border-radius: 50%;background-color: #894276'></div> {a1}: {c1}<br /><div style='width: 8px;height: 8px;border: 1px solid #322f3b;display: inline-block;border-radius: 50%;background-color: #322f3b'></div> {a2}: {c2}<br /><div style='width: 8px;height: 8px;border: 1px solid #3170a7;display: inline-block;border-radius: 50%;background-color: #3170a7'></div> {a3}: {c3}<br /><div style='width: 8px;height: 8px;border: 1px solid #806332;display: inline-block;border-radius: 50%;background-color: #806332'></div> {a4}: {c4}<br /><div style='width: 8px;height: 8px;border: 1px solid #fa5d19;display: inline-block;border-radius: 50%;background-color: #fa5d19'></div> {a5}: {c5}"
                        },
                        color:['#c02c38','#894276','#322f3b','#3170a7','#806332','#fa5d19'],
                        legend: {
                            data:date_day.group_name
                        },
                        grid: {
                            left: '1%',
                            right: '1%',
                            containLabel: true
                        },
                        toolbox: {
                            feature: {
                                saveAsImage: {}
                            }
                        },
                        xAxis: {
                            type: 'category',
                            boundaryGap: false,
                            data: date_day.group_date
                        },
                        yAxis: {
                            type: 'value'
                        },
                        series: [
                            {
                                name:date_day.group_amount_day.name[0],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#c02c38'
                                    }
                                },
                                data:date_day.group_amount_day.day[0]
                            },
                            {
                                name:date_day.group_amount_day.name[1],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#894276'
                                    }
                                },
                                data:date_day.group_amount_day.day[1]
                            },
                            {
                                name:date_day.group_amount_day.name[2],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#322f3b'
                                    }
                                },
                                data:date_day.group_amount_day.day[2]
                            },
                            {
                                name:date_day.group_amount_day.name[3],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#3170a7'
                                    }
                                },
                                data:date_day.group_amount_day.day[3]
                            },
                            {
                                name:date_day.group_amount_day.name[4],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#806332'
                                    }
                                },
                                data:date_day.group_amount_day.day[4]
                            },
                            {
                                name:date_day.group_amount_day.name[5],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#fa5d19'
                                    }
                                },
                                data:date_day.group_amount_day.day[5]
                            }
                        ]
                    };
                    if (option && typeof option === "object") {
                        myChart.setOption(option, true);
                    }
               </script>
        <script type="text/javascript">
                    var dom = document.getElementById("brokenline1");
                    var width = $("#brokenline").width();
                    var height = $("#brokenline").height();
                    $("#brokenline1").css("width", width).css("height", height);
                    var  date_day = <?php echo ($info_lastmonth_day); ?>;
                    var myDate = new Date();
                    year = myDate.getFullYear();
                    month = myDate.getMonth();
                    month_last = month;
                    if(month == 0){month_last = 12;}
                    var myChart = echarts.init(dom);
                    var app = {};
                    option = null;
                    option = {
                        title: {
                            text: '上月统计',
                            color:'#ccc'
                        },
                        tooltip: {
                            trigger: 'axis',
                            formatter: year+"-"+month_last+"-{b}<br /><br /><div style='width: 8px;height: 8px;border: 1px solid #c02c38;display: inline-block;border-radius: 50%;background-color: #c02c38'></div> {a0}: {c0}<br /><div style='width: 8px;height: 8px;border: 1px solid #894276;display: inline-block;border-radius: 50%;background-color: #894276'></div> {a1}: {c1}<br /><div style='width: 8px;height: 8px;border: 1px solid #322f3b;display: inline-block;border-radius: 50%;background-color: #322f3b'></div> {a2}: {c2}<br /><div style='width: 8px;height: 8px;border: 1px solid #3170a7;display: inline-block;border-radius: 50%;background-color: #3170a7'></div> {a3}: {c3}<br /><div style='width: 8px;height: 8px;border: 1px solid #806332;display: inline-block;border-radius: 50%;background-color: #806332'></div> {a4}: {c4}<br /><div style='width: 8px;height: 8px;border: 1px solid #fa5d19;display: inline-block;border-radius: 50%;background-color: #fa5d19'></div> {a5}: {c5}"
                        },
                        color:['#c02c38','#894276','#322f3b','#3170a7','#806332','#fa5d19'],
                        legend: {
                            data:date_day.group_name
                        },
                        grid: {
                            left: '1%',
                            right: '1%',
                            containLabel: true
                        },
                        toolbox: {
                            feature: {
                                saveAsImage: {}
                            }
                        },
                        xAxis: {
                            type: 'category',
                            boundaryGap: false,
                            data: date_day.group_date
                        },
                        yAxis: {
                            type: 'value'
                        },
                        series: [
                            {
                                name:date_day.group_amount_day.name[0],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#c02c38'
                                    }
                                },
                                data:date_day.group_amount_day.day[0]
                            },
                            {
                                name:date_day.group_amount_day.name[1],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#894276'
                                    }
                                },
                                data:date_day.group_amount_day.day[1]
                            },
                            {
                                name:date_day.group_amount_day.name[2],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#322f3b'
                                    }
                                },
                                data:date_day.group_amount_day.day[2]
                            },
                            {
                                name:date_day.group_amount_day.name[3],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#3170a7'
                                    }
                                },
                                data:date_day.group_amount_day.day[3]
                            },
                            {
                                name:date_day.group_amount_day.name[4],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#806332'
                                    }
                                },
                                data:date_day.group_amount_day.day[4]
                            },
                            {
                                name:date_day.group_amount_day.name[5],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#fa5d19'
                                    }
                                },
                                data:date_day.group_amount_day.day[5]
                            }
                        ]
                    };
                    if (option && typeof option === "object") {
                        myChart.setOption(option, true);
                    }
               </script>
        <script type="text/javascript">
                    var dom = document.getElementById("brokenline2");
                    var width = $("#brokenline").width();
                    var height = $("#brokenline").height();
                    $("#brokenline2").css("width", width).css("height", height);
                    var  date_day = <?php echo ($info_year_month); ?>;
                    var myDate = new Date();
                    year = myDate.getFullYear();
                    var myChart = echarts.init(dom);
                    var app = {};
                    option = null;
                    option = {
                        title: {
                            text: '今年统计',
                            color:'#ccc'
                        },
                        tooltip: {
                            trigger: 'axis',
                            formatter: year+"-{b}<br /><br /><div style='width: 8px;height: 8px;border: 1px solid #c02c38;display: inline-block;border-radius: 50%;background-color: #c02c38'></div> {a0}: {c0}<br /><div style='width: 8px;height: 8px;border: 1px solid #894276;display: inline-block;border-radius: 50%;background-color: #894276'></div> {a1}: {c1}<br /><div style='width: 8px;height: 8px;border: 1px solid #322f3b;display: inline-block;border-radius: 50%;background-color: #322f3b'></div> {a2}: {c2}<br /><div style='width: 8px;height: 8px;border: 1px solid #3170a7;display: inline-block;border-radius: 50%;background-color: #3170a7'></div> {a3}: {c3}<br /><div style='width: 8px;height: 8px;border: 1px solid #806332;display: inline-block;border-radius: 50%;background-color: #806332'></div> {a4}: {c4}<br /><div style='width: 8px;height: 8px;border: 1px solid #fa5d19;display: inline-block;border-radius: 50%;background-color: #fa5d19'></div> {a5}: {c5}"
                        },
                        color:['#c02c38','#894276','#322f3b','#3170a7','#806332','#fa5d19'],
                        legend: {
                            data:date_day.group_name
                        },
                        grid: {
                            left: '1%',
                            right: '1%',
                            containLabel: true
                        },
                        toolbox: {
                            feature: {
                                saveAsImage: {}
                            }
                        },
                        xAxis: {
                            type: 'category',
                            boundaryGap: false,
                            data: date_day.group_date
                        },
                        yAxis: {
                            type: 'value'
                        },
                        series: [
                            {
                                name:date_day.group_amount_day.name[0],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#c02c38'
                                    }
                                },
                                data:date_day.group_amount_day.day[0]
                            },
                            {
                                name:date_day.group_amount_day.name[1],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#894276'
                                    }
                                },
                                data:date_day.group_amount_day.day[1]
                            },
                            {
                                name:date_day.group_amount_day.name[2],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#322f3b'
                                    }
                                },
                                data:date_day.group_amount_day.day[2]
                            },
                            {
                                name:date_day.group_amount_day.name[3],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#3170a7'
                                    }
                                },
                                data:date_day.group_amount_day.day[3]
                            },
                            {
                                name:date_day.group_amount_day.name[4],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#806332'
                                    }
                                },
                                data:date_day.group_amount_day.day[4]
                            },
                            {
                                name:date_day.group_amount_day.name[5],
                                type:'line',
                                stack: '总量',
                                lineStyle:{
                                    normal:{
                                        color:'#fa5d19'
                                    }
                                },
                                data:date_day.group_amount_day.day[5]
                            }
                        ]
                    };
                    if (option && typeof option === "object") {
                        myChart.setOption(option, true);
                    }
               </script>

        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['laydate','element','layer'], function(){
                $ = layui.jquery;//jquery
              laydate = layui.laydate;//日期插件
              layer = layui.layer;//弹出层
                var element = layui.element;
              
              
              var start = {
                istoday: false
                ,choose: function(datas){
                  end.min = datas; //开始日选好后，重置结束日的最小日期
                  end.start = datas //将结束日的初始值设定为开始日
                }
              };
              
              var end = {
                istoday: false
                ,choose: function(datas){
                  start.max = datas; //结束日选好后，重置开始日的最大日期
                }
              };
              
              document.getElementById('LAY_demorange_s').onclick = function(){
                start.elem = this;
                laydate(start);
              }
              document.getElementById('LAY_demorange_e').onclick = function(){
                end.elem = this
                laydate(end);
              }
              
            });
            
             /*用户-添加*/
            function member_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }
            /*用户-查看*/
            function member_show(title,url,id,w,h){
                x_admin_show(title,url,w,h);
            }

            
            // 用户-编辑  用戶-添加待办任务
            function member_edit (title,url,id,w,h) {
                url = url + '?cid=' + id;
                x_admin_show(title,url,w,h);
            }
            /*添加订单*/
            function order_add_list(title,url,id,w,h,cname){
                url = url + '?cid=' + id + '&cname=' + cname;
                x_admin_show(title,url,w,h);
            }
        </script>
        <script>
            //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
            layui.use('element', function(){
                var element = layui.element;
            
                //…
            });
        </script>
    </body>
</html>