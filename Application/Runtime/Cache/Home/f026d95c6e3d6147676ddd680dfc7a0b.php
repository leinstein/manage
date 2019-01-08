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
        <div class="layui-row layui-col-space20" id="layui-row">
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 rete_layui-col-md4">
                <div class="bg_color_div">
                    <div class="content content1">
                        <table class="content_table">
                            <tr>
                                <td class="table_title">总订单：<?php echo ($report["month"]["sum"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单数：<?php echo ($report["month"]["chargeback"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单率：<?php echo ($report["month"]["avg"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">实际订单：<?php echo ($report["month"]["real_order"]); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="content content2">
                        <table class="content_table">
                            <tr>
                                <td class="table_title">订单总金额：<?php echo (substr($report["month"]["amount"],0,-3)); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单总金额：<?php echo ($report["month"]["refunds"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单金额率：<?php echo ($report["month"]["amount_avg"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">实际成交金额：<?php echo ($report["month"]["real_amount"]); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="content content3">
                        <div id="ring_one" class="ring_rate"></div>
                        <span class="month">本月</span>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 rete_layui-col-md4">
                <div class="bg_color_div">
                    <div class="content content1">
                        <table class="content_table">
                            <tr>
                                <td class="table_title">总订单：<?php echo ($report["lastmonth"]["sum"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单数：<?php echo ($report["lastmonth"]["chargeback"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单率：<?php echo ($report["lastmonth"]["avg"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">实际订单：<?php echo ($report["lastmonth"]["real_order"]); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="content content2">
                        <table class="content_table">
                            <tr>
                                <td class="table_title">订单总金额：<?php echo (substr($report["lastmonth"]["amount"],0,-3)); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单总金额：<?php echo ($report["lastmonth"]["refunds"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单金额率：<?php echo ($report["lastmonth"]["amount_avg"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">实际成交金额：<?php echo ($report["lastmonth"]["real_amount"]); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="content content3">
                        <div id="ring_two" class="ring_rate"></div>
                        <span class="month">上月</span>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 rete_layui-col-md4">
                <div class="bg_color_div">
                    <div class="content content1">
                        <table class="content_table">
                            <tr>
                                <td class="table_title">总订单：<?php echo ($report["history"]["sum"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单数：<?php echo ($report["history"]["chargeback"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单率：<?php echo ($report["history"]["avg"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">实际订单：<?php echo ($report["history"]["real_order"]); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="content content2">
                        <table class="content_table">
                            <tr>
                                <td class="table_title">订单总金额：<?php echo (substr($report["history"]["amount"],0,-3)); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单总金额：<?php echo ($report["history"]["refunds"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">退单金额率：<?php echo ($report["history"]["amount_avg"]); ?></td>
                            </tr>
                            <tr>
                                <td class="table_title">实际成交金额：<?php echo ($report["history"]["real_amount"]); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="content content3">
                        <div id="ring_three" class="ring_rate"></div>
                        <span class="month">历史</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-fluid">
            <div class="layui-card">
                <div class="x-body" style="padding: 0 20px 80px 20px;">
                    <xblock style="background-color: white !important;">
                        <a title="本月排名" class="layui-btn month_btn_rate"  href="/Home/Report/return_rate?month=month">
                            本月排名
                        </a>
                        <a title="上月排名" class="layui-btn month_btn_rate"  href="/Home/Report/return_rate?month=lastmonth">
                            上月排名
                        </a>
                        <a title="历史排名" class="layui-btn month_btn_rate"  href="/Home/Report/return_rate?month=history">
                            历史排名
                        </a>
                        <span class="x-right" style="line-height:40px">
                            <form class="layui-form x-center" action="" style="width:800px">
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
                                    <div class="layui-input-inline" style="width:120px;margin-top: -4px">
                                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>
                                    </div>
                                  </div>
                                </div>
                            </form>
                        </span>
                    </xblock>
                <!--</div>-->
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
                                <th>
                                    总订单
                                </th>
                                <th>
                                    退单数
                                </th>
                                <th>
                                    退单率
                                </th>
                                <th>
                                    总订单金额
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
                                        <?php echo ($v["sort_rate"]); ?>
                                    </td>
                                    <td style="padding: 3px">
                                        <img src="<?php echo ($v["img_small"]); ?>" style="width: 40px;height: 40px;border-radius: 50%">
                                    </td>
                                    <td>
                                        <?php echo ($v["nickname"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["order_rate"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["order_tui_rate"]); ?>
                                    </td>
                                    <td class="order_total_amount">
                                        <?php echo ($v["order_tui_average"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["order_total_amount"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["order_total_tui_amount"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["order_tui_funds_average"]); ?>
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
        <script src="/Public/home/js/echarts.min.js"></script>
        <!--退单率-->
        <script type="text/javascript">
            var dom = document.getElementById("ring_one");
            var myChart = echarts.init(dom);
            var app = {};
            var basic = "<?php echo ($report["month"]["refunds"]); ?>";
            var rate =  "<?php echo ($report["month"]["real_amount"]); ?>";
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    data:['复购率','1']
                },
                color:['#34bfa3','#f2f2f2'],
                series: [
                    {
                        name:'复购',
                        type:'pie',
                        radius: ['30%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            normal: {
                                show: false,
                                position: 'center'  //提示显示位置
                            },
                            emphasis: {
                                show: true,
                                textStyle: {
                                    fontSize: '12'
                                }
                            }
                        },
                        labelLine: {
                            normal: {
                                show: false
                            }
                        },
                        data:[
                            {value:rate},
                            {value:basic}
                        ]
                    }
                ]
            };
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
        </script>
        <script type="text/javascript">
            var dom = document.getElementById("ring_two");
            var myChart = echarts.init(dom);
            var app = {};
            var basic = "<?php echo ($report["lastmonth"]["refunds"]); ?>";
            var rate =  "<?php echo ($report["lastmonth"]["real_amount"]); ?>";
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    data:['复购率','1']
                },
                color:['#34bfa3','#f2f2f2'],
                series: [
                    {
                        name:'复购',
                        type:'pie',
                        radius: ['30%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            normal: {
                                show: false,
                                position: 'center'  //提示显示位置
                            },
                            emphasis: {
                                show: true,
                                textStyle: {
                                    fontSize: '12'
                                }
                            }
                        },
                        labelLine: {
                            normal: {
                                show: false
                            }
                        },
                        data:[
                            {value:rate},
                            {value:basic}
                        ]
                    }
                ]
            };
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
        </script>
        <script type="text/javascript">
            var dom = document.getElementById("ring_three");
            var myChart = echarts.init(dom);
            var app = {};
            var basic = "<?php echo ($report["history"]["refunds"]); ?>";
            var rate =  "<?php echo ($report["history"]["real_amount"]); ?>";
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    data:['复购率','1']
                },
                color:['#34bfa3','#f2f2f2'],
                series: [
                    {
                        name:'复购',
                        type:'pie',
                        radius: ['30%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            normal: {
                                show: false,
                                position: 'center'  //提示显示位置
                            },
                            emphasis: {
                                show: true,
                                textStyle: {
                                    fontSize: '12'
                                }
                            }
                        },
                        labelLine: {
                            normal: {
                                show: false
                            }
                        },
                        data:[
                            {value:rate},
                            {value:basic}
                        ]
                    }
                ]
            };
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
        </script>
        
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

            //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                    //捉到所有被选中的，发异步进行删除
                    layer.msg('删除成功', {icon: 1});
                });
             }
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
            /*用户-删除*/
            function member_del(obj,id){
                layer.confirm('确认要删除这个客户吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: 'del',
                        dataType: 'json',
                        data:{'cid':id},
                        success: function(data){
                            if(data.statu == 200){
                                $(obj).parents("tr").remove();
                                layer.msg('客户已删除!',{icon:1,time:1000});
                            }else{
                                layer.msg(data.msg);
                                return false;
                            }
                        },
                        error:function(data) {
                            layer.msg('系统错误');
                        },
                    });
                });
            }
            </script>
    </body>
</html>