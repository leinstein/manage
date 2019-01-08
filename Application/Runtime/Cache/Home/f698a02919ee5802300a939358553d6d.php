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
        <style>
            .layui-fluid{margin-top: 20px;}
            .layui-input{color: #666;font-weight: normal;}
        </style>
        <div class="layui-fluid">
            <div class="layui-card">
                <div class="x-body">
                <xblock style="background-color: white !important;margin-top:0">
                    <a title="本月排名" class="layui-btn month_btn"  href="/Home/Report/consume?month=month">
                        本月排名
                    </a>
                    <a title="上月排名" class="layui-btn month_btn"  href="/Home/Report/consume?month=lastmonth">
                        上月排名
                    </a>
                    <a title="历史排名" class="layui-btn month_btn"  href="/Home/Report/consume?month=history">
                        历史排名
                    </a>
                    <span class="x-right" style="line-height:40px">
                        <form class="layui-form x-center" action="" style="width:600px;">
                            <div class="layui-form-pane">
                              <div class="layui-form-item" style="width: 120%">
                                <label class="layui-form-label">日期范围</label>
                                <div class="layui-input-inline">
                                  <input class="layui-input" name="stat_date" placeholder="开始日" id="LAY_demorange_s"  autocomplete="off">
                                </div>
                                <div class="layui-input-inline">
                                  <input class="layui-input" name="stop_date" placeholder="截止日" id="LAY_demorange_e"  autocomplete="off">
                                </div>
                                <div class="layui-input-inline" style="width:120px;margin-top: -4px">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>
                                </div>
                              </div>
                            </div>
                        </form>
                    </span>
                </xblock>
                <table class="layui-table">
                    <thead>
                        <tr>
                            <th width="30px">
                                排名
                            </th>
                            <th width="90px">
                                客户姓名
                            </th>
                            <th width="90px">
                                联系方式
                            </th>
                            <th>
                                地区
                            </th>
                            <th>
                                订单数
                            </th>
                            <th>
                                订单金额
                            </th>
                            <th>
                                订单均价
                            </th>
                            <th>
                                项目
                            </th>
                            <th>
                                销售
                            </th>
                            <th>
                                加入时间
                            </th>
                        </tr>
                    </thead>
                    <style>.layui-table td, .layui-table th{text-align: center;}</style>
                    <tbody>
                        <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                                <td class="rate_font">
                                    <?php echo ($v["sort_rate"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["name"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["phone"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["p_area"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["rate"]); ?>
                                </td>
                                <td class="order_total_amount">
                                    <?php echo ($v["totalorder"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_avg"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["group_name"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["nickname"]); ?>
                                </td>
                                <td>
                                    <?php echo (date('Y-m-d',$v["create_time"])); ?>
                                </td>
                            </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
             </div>
          </div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script>
            layui.use(['laydate','element','layer'], function(){
                $ = layui.jquery;//jquery
                laydate = layui.laydate;//日期插件
                layer = layui.layer;//弹出层

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
                    end.elem = this;
                    laydate(end);
                }

            });
        </script>
    </body>
</html>