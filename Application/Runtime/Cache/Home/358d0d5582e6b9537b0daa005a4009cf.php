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
    <body  style="background-color: #f0f2f5">
        <div class="x-body" style="padding: 0 20px 20px 20px;">
            <!--复购率-->
            <style>.layui-col-md2{width: 14.2857143%;min-width: 220px;height: 165px;margin-top: 20px;margin-bottom: 20px}</style>
            <div class="layui-row layui-col-space20" style="">
                    <div class="layui-col-md2">
                        <div class="bg_color_div">
                              <div class="rate_title">
                                  <span>一次复购</span>
                              </div>
                              <div class="buy_rate">
                                  <div class="repart_rate">复购率</div>
                                  <div class="buying_rate"><?php echo ($buyrate["rate"]["one"]); ?></div>
                              </div>
                              <div id="ring_one" class="ring"></div>
                              <div class="order_total order_top">复购/订单：<?php echo ($buyrate["one"]); ?> / <?php echo ($buyrate["basic"]); ?></div>
                            
                        </div>
                    </div>
                    <div class="layui-col-md2">
                        <div class="bg_color_div">
                            <div class="rate_title">
                                <span>二次复购</span>
                            </div>
                            <div class="buy_rate">
                                <div class="repart_rate">复购率</div>
                                <div class="buying_rate"><?php echo ($buyrate["rate"]["two"]); ?></div>
                            </div>
                            <div id="ring_two" class="ring"></div>
                            <div class="order_total order_top">复购/订单：<?php echo ($buyrate["two"]); ?> / <?php echo ($buyrate["basic"]); ?></div>
                        </div>
                    </div>
                    <div class="layui-col-md2">
                        <div class="bg_color_div">
                            <div class="rate_title">
                                <span>三次复购</span>
                            </div>
                            <div class="buy_rate">
                                <div class="repart_rate">复购率</div>
                                <div class="buying_rate"><?php echo ($buyrate["rate"]["three"]); ?></div>
                            </div>
                            <div id="ring_three" class="ring"></div>
                            <div class="order_total order_top">复购/订单：<?php echo ($buyrate["three"]); ?> / <?php echo ($buyrate["basic"]); ?></div>
                        </div>
                    </div>
                    <div class="layui-col-md2">
                        <div class="bg_color_div">
                            <div class="rate_title">
                                <span>四次复购</span>
                            </div>
                            <div class="buy_rate">
                                <div class="repart_rate">复购率</div>
                                <div class="buying_rate"><?php echo ($buyrate["rate"]["four"]); ?></div>
                            </div>
                            <div id="ring_four" class="ring"></div>
                            <div class="order_total order_top">复购/订单：<?php echo ($buyrate["four"]); ?> / <?php echo ($buyrate["basic"]); ?></div>
                        </div>
                    </div>
                   <div class="layui-col-md2">
                       <div class="bg_color_div">
                            <div class="rate_title">
                                <span>五次复购</span>
                            </div>
                            <div class="buy_rate">
                                <div class="repart_rate">复购率</div>
                                <div class="buying_rate"><?php echo ($buyrate["rate"]["five"]); ?></div>
                            </div>
                            <div id="ring_five" class="ring"></div>
                           <div class="order_total order_top">复购/订单：<?php echo ($buyrate["five"]); ?> / <?php echo ($buyrate["basic"]); ?></div>
                       </div>
                    </div>
                    <div class="layui-col-md2">
                        <div class="bg_color_div">
                            <div class="rate_title">
                                <span>六次复购</span>
                            </div>
                            <div class="buy_rate">
                                <div class="repart_rate">复购率</div>
                                <div class="buying_rate"><?php echo ($buyrate["rate"]["six"]); ?></div>
                            </div>
                            <div id="ring_six" class="ring"></div>
                            <div class="order_total order_top">复购/订单：<?php echo ($buyrate["six"]); ?> / <?php echo ($buyrate["basic"]); ?></div>
                        </div>
                    </div>
                    <div class="layui-col-md2">
                        <div class="bg_color_div">
                            <div class="rate_title">
                                <span>七次复购</span>
                            </div>
                            <div class="buy_rate">
                                <div class="repart_rate">复购率</div>
                                <div class="buying_rate"><?php echo ($buyrate["rate"]["seven"]); ?></div>
                            </div>
                            <div id="ring_seven" class="ring"></div>
                            <div class="order_total order_top">复购/订单：<?php echo ($buyrate["seven"]); ?> / <?php echo ($buyrate["basic"]); ?></div>
                        </div>
                    </div>
                </div>
            <div class="layui-fluid" style="padding: 0">
            <div class="layui-card">
            <div class="layui-row" style="background-color: white;padding: 10px 20px">
                <table class="layui-table" id="layui_table_w">
                <thead>
                    <tr>
                        <th width="30px"    rowspan="2">
                            排名
                        </th>
                        <th width="90px"    rowspan="2">
                            销售头像
                        </th>
                        <th width="90px"    rowspan="2">
                            销售姓名
                        </th>
                        <th   rowspan="2">
                            总订单
                        </th>
                        <th colspan="2">
                            复购率
                        </th>
                        <th colspan="2">
                            二次复购
                        </th>
                        <th colspan="2">
                            三次复购
                        </th>
                        <th colspan="2">
                            四次复购
                        </th>
                        <th colspan="2">
                            五次复购
                        </th>
                        <th colspan="2">
                            六次复购
                        </th>
                        <th colspan="2">
                            七次复购
                        </th>
                    </tr>
                    <tr>
                        <th>
                            单数
                        </th>
                        <th>
                            复购率
                        </th>
                        <th>
                            单数
                        </th>
                        <th>
                            复购率
                        </th>
                        <th>
                            单数
                        </th>
                        <th>
                            复购率
                        </th>
                        <th>
                            单数
                        </th>
                        <th>
                            复购率
                        </th>
                        <th>
                            单数
                        </th>
                        <th>
                            复购率
                        </th>
                        <th>
                            单数
                        </th>
                        <th>
                            复购率
                        </th>
                        <th>
                            单数
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
                                <?php echo ($v["sort_rate"]); ?>
                            </td>
                            <td style="padding: 3px">
                                <img src="<?php echo ($v["img_small"]); ?>" style="width: 40px;height: 40px;border-radius: 50%">
                            </td>
                            <td>
                                <?php echo ($v["nickname"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["basic"]); ?>
                            </td>
                            <td class="order_total_amount">
                                <?php echo ($v["buyrate"]["one"]); ?>
                            </td>
                            <td class="order_total_amount">
                                <?php echo ($v["buyrate"]["rate"]["one"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["two"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["rate"]["two"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["three"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["rate"]["three"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["four"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["rate"]["four"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["five"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["rate"]["five"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["six"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["rate"]["six"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["seven"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["buyrate"]["rate"]["seven"]); ?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
             <div id="page" style="margin-bottom: 20px;margin-top: 20px"><?php echo ($page); ?></div>
          </div>
        </div>
      </div>
    </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        <script src="/Public/home/js/echarts.min.js"></script>
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
        <!--复购率-->
        <script type="text/javascript">
            var dom = document.getElementById("ring_one");
            var myChart = echarts.init(dom);
            var app = {};
            var basic = Number("<?php echo ($buyrate["basic"]); ?>") - Number("<?php echo ($buyrate["one"]); ?>");
            var rate = "<?php echo ($buyrate["one"]); ?>";
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
            var basic = Number("<?php echo ($buyrate["basic"]); ?>") - Number("<?php echo ($buyrate["two"]); ?>");
            var rate = "<?php echo ($buyrate["two"]); ?>";
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#34bfa3','#f2f2f2'],
                series: [
                    {
                        name:'访问来源',
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
            var basic = Number("<?php echo ($buyrate["basic"]); ?>") - Number("<?php echo ($buyrate["three"]); ?>");
            var rate = "<?php echo ($buyrate["three"]); ?>";
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#34bfa3','#f2f2f2'],
                series: [
                    {
                        name:'访问来源',
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
            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
        </script>
        <script type="text/javascript">
            var dom = document.getElementById("ring_four");
            var myChart = echarts.init(dom);
            var app = {};
            var basic = Number("<?php echo ($buyrate["basic"]); ?>") - Number("<?php echo ($buyrate["four"]); ?>");
            var rate = "<?php echo ($buyrate["four"]); ?>";
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#34bfa3','#f2f2f2'],
                series: [
                    {
                        name:'访问来源',
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
            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
        </script>
        <script type="text/javascript">
            var dom = document.getElementById("ring_five");
            var myChart = echarts.init(dom);
            var app = {};
            var basic = Number("<?php echo ($buyrate["basic"]); ?>") - Number("<?php echo ($buyrate["five"]); ?>");
            var rate = "<?php echo ($buyrate["five"]); ?>";
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#34bfa3','#f2f2f2'],
                series: [
                    {
                        name:'访问来源',
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
            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
        </script>
        <script type="text/javascript">
            var dom = document.getElementById("ring_six");
            var myChart = echarts.init(dom);
            var app = {};
            var basic = Number("<?php echo ($buyrate["basic"]); ?>") - Number("<?php echo ($buyrate["six"]); ?>");
            var rate = "<?php echo ($buyrate["six"]); ?>";
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#34bfa3','#f2f2f2'],
                series: [
                    {
                        name:'访问来源',
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
            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
        </script>
        <script type="text/javascript">
            var dom = document.getElementById("ring_seven");
            var myChart = echarts.init(dom);
            var app = {};
            var basic = Number("<?php echo ($buyrate["basic"]); ?>") - Number("<?php echo ($buyrate["seven"]); ?>");
            var rate = "<?php echo ($buyrate["seven"]); ?>";
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#34bfa3','#f2f2f2'],
                series: [
                    {
                        name:'访问来源',
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
            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
        </script>
    </body>
</html>