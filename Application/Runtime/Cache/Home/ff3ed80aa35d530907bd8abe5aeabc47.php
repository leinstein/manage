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
    </head>
    <body style="background-color: #f0f2f5;overflow-x:hidden">
        <style>
            .layui-fluid{margin-top: 20px;width: 98%;margin-left: 1%;background-color: white;}
            .layui-input{color: #666;font-weight: normal}
            .layui-card{padding: 20px 20px 80px 20px;}
        </style>
        <div class="layui-fluid">
            <div class="layui-card">
                <xblock style="background-color: white !important;margin: 0">
                    <a title="本月排名" class="layui-btn"  href="/Home/Report/rank?month=month">
                        本月排名
                    </a>
                    <a title="上月排名" class="layui-btn"  href="/Home/Report/rank?month=lastmonth">
                        上月排名
                    </a>
                    <a title="历史排名" class="layui-btn"  href="/Home/Report/rank?month=history">
                        历史排名
                    </a>
                    <div class="layui-input-inline">
                        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 20px;padding: 2px 4px"  href="/Home/Report/rank?month=month" title="首页">
                            <img src="/Public/Home/images/indexw.png" style="vertical-align: baseline;width: 27px;height: 27px">
                        </a>
                    </div>
                    <span class="x-right" style="line-height:40px">
                        <form class="layui-form x-center" action="" style="width:810px;margin-top: -15px;">
                            <div class="layui-form-pane" style="margin-top: 15px;">
                              <div class="layui-form-item" style="width: 120%">
                                <label class="layui-form-label">日期范围</label>
                                <div class="layui-input-inline">
                                  <input class="layui-input" name="stat_date" placeholder="开始日" id="LAY_demorange_s"  autocomplete="off">
                                </div>
                                <div class="layui-input-inline">
                                  <input class="layui-input" name="stop_date" placeholder="截止日" id="LAY_demorange_e"  autocomplete="off">
                                </div>
                                <div class="layui-input-inline">
                                  <input type="text" name="name"  placeholder="登录名 | 姓名 | 电话" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-input-inline" style="width:120px">
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
                                销售头像
                            </th>
                            <th width="90px">
                                销售姓名
                            </th>
                            <th width="60px">
                                销售额
                            </th>
                            <th>
                                客户
                            </th>
                            <th>
                                订单
                            </th>
                            <th>
                                客户均价
                            </th>
                            <th>
                                订单均价
                            </th>
                            <th>
                                退单
                            </th>
                            <th>
                                退单金额
                            </th>
                            <th>
                                退单率
                            </th>
                            <th>
                                复购率
                            </th>
                        </tr>
                    </thead>
                    <style>.layui-table td, .layui-table th{text-align: center;}</style>
                    <tbody>
                        <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                                <td class="rate_font">
                                    <?php echo ($v["sort_amount"]); ?>
                                </td>
                                <td style="padding: 3px">
                                    <img src="<?php echo ($v["img_small"]); ?>" style="width: 40px;height: 40px;border-radius: 50%">
                                </td>
                                <td>
                                    <?php echo ($v["nickname"]); ?>
                                </td>
                                <td class="order_total_amount">
                                    <?php echo ($v["order_total_amount"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["customer_count"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_rate"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_customer_average"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_average"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_tui_rate"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_total_tui_amount"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_tui_average"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["buying_rate"]); ?>
                                </td>
                            </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
                <div id="page" style="margin-bottom: 50px;margin-top: 20px"><?php echo ($page); ?></div>
              </div>
           </div>
         </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        
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
                end.elem = this
                laydate(end);
              }
              
            });
        </script>
    </body>
</html>