<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            X-admin v1.0
        </title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="/Public/Home/css/x-admin.css" media="all">
        <link rel="stylesheet" href="/Public/Home/lib2/layui/css/layui.css" media="all">

    </head>
    <body>
        <div class="x-body">
            <!--复购率-->
            <style>
                .ring,.buy_rate{
                    display: inline-block;
                    height: 80px;
                    /*border: 1px solid red;*/
                }
                .buyrate div{
                    color: #E2E2E2;
                }
                .rate_title{
                    height: 40px;
                    /*border: 1px solid red;*/
                    color: rgba(0,0,0,.65);
                    font-size: 16px;
                    width: 70px;
                    /*margin-bottom: 16px;*/
                    transition: all .3s;
                    margin-left: 18%;
                }
                .rate_title span{
                    display: inline-block;
                    margin-top: 16px;
                }
                .buy_rate{
                    position: relative;
                    top: -22px;
                    left: 4%;
                    width: 48%;
                }
                .ring{
                    position: relative;
                    top: -14px;
                    margin-left: 18px;
                    height: 78px;
                    width: 78px;
                }
                .repart_rate{
                    color: rgba(0,0,0,.45);
                    font-size: 14px;
                    height: 22px;
                    line-height: 22px;
                    margin-left: 30%;
                    margin-top: 10px;
                }
                .buying_rate{
                    color: rgba(0,0,0,.85);
                    line-height: 32px;
                    height: 32px;
                    font-size: 24px;
                    margin-left: 30%;
    
                }
                
                .order_total{
                    color: rgba(0,0,0,.45);
                    font-size: 14px;
                    width: 100%;
                    text-align: center;
                    margin-top: 5px;
                }
                .bg_color_div{
                    background-color: #f2f2f2;
                    height: 100%;
                }
                .order_top{
                    margin-top: -32px;
                }
            </style>
            <style>.layui-col-md2{width: 14.2857143%;min-width: 220px;height: 165px}</style>
            <div class="layui-row" style="width: 99%;margin-left: 0.5%;">
                <div class="layui-row layui-col-space20" style="width: 100%;margin-left: 0;">
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
                              <!--<div class="order_total">总订单数：<?php echo ($buyrate["basic"]); ?></div>-->
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
                            <!--<div class="order_total order_top">复购单数：<?php echo ($buyrate["two"]); ?></div>-->
                            <!--<div class="order_total">总订单数：<?php echo ($buyrate["basic"]); ?></div>-->
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
                            <!--<div class="order_total order_top">复购单数：<?php echo ($buyrate["three"]); ?></div>-->
                            <!--<div class="order_total">总订单数：<?php echo ($buyrate["basic"]); ?></div>-->
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
                            <!--<div class="order_total order_top">复购单数：<?php echo ($buyrate["four"]); ?></div>-->
                            <!--<div class="order_total">总订单数：<?php echo ($buyrate["basic"]); ?></div>-->
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
                            <!--<div class="order_total order_top">复购单数：<?php echo ($buyrate["five"]); ?></div>-->
                            <!--<div class="order_total">总订单数：<?php echo ($buyrate["basic"]); ?></div>-->
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
                            <!--<div class="order_total order_top">复购单数：<?php echo ($buyrate["six"]); ?></div>-->
                            <!--<div class="order_total">总订单数：<?php echo ($buyrate["basic"]); ?></div>-->
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
                            <!--<div class="order_total order_top">复购单数：<?php echo ($buyrate["seven"]); ?></div>-->
                            <!--<div class="order_total">总订单数：<?php echo ($buyrate["basic"]); ?></div>-->
                        </div>
                    </div>
                </div>
            </div>
            <!--<form class="layui-form x-center" action="" style="width:800px">-->
                <!--<div class="layui-form-pane" style="margin-top: 15px;">-->
                  <!--<div class="layui-form-item" style="width: 120%">-->
                    <!--<label class="layui-form-label">日期范围</label>-->
                    <!--<div class="layui-input-inline">-->
                      <!--<input class="layui-input" name="stat_date" placeholder="开始日" id="LAY_demorange_s"  autocomplete="off">-->
                    <!--</div>-->
                    <!--<div class="layui-input-inline">-->
                      <!--<input class="layui-input" name="stop_date" placeholder="截止日" id="LAY_demorange_e"  autocomplete="off">-->
                    <!--</div>-->
                    <!--<div class="layui-input-inline">-->
                      <!--<input type="text" name="name"  placeholder="登录名 | 姓名 | 电话" autocomplete="off" class="layui-input">-->
                    <!--</div>-->
                    <!--<div class="layui-input-inline" style="width:120px">-->
                        <!--<button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>-->
                    <!--</div>-->
                  <!--</div>-->
                <!--</div>-->
            <!--</form>-->
            <!--<xblock>-->
                <!--<a title="本月排名" class="layui-btn"  href="/Home/Report/rank?month=month">-->
                    <!--本月排名-->
                <!--</a>-->
                <!--<a title="上月排名" class="layui-btn"  href="/Home/Report/rank?month=lastmonth">-->
                    <!--上月排名-->
                <!--</a>-->
                <!--<a title="历史排名" class="layui-btn"  href="/Home/Report/rank?month=history">-->
                    <!--历史排名-->
                <!--</a>-->
                <!--<div class="layui-input-inline">-->
                    <!--<a class="layui-btn layui-btn-small" style="padding: 4px 4px"  href="/Home/Report/buyingrate" title="首页">-->
                    <!--<img src="/Public/Home/images/indexw.png" style="vertical-align: baseline;width: 27px;height: 27px">-->
                    <!--</a>-->
                    <!--<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 20px"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>-->
                <!--</div>-->
                <!--<span class="x-right" style="line-height:40px">全部：-->
                    <!--<a title="查看历史客户"  href="javascript;">-->
                       <!--<?php echo ($count); ?>-->
                    <!--</a>-->
                <!--</span>-->
            <!--</xblock>-->
            <style>
                #layui_table_w{
                    width: 98%;
                    margin-left: 1%;
                    margin-top: 20px;
                }
            </style>
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
                            二次复购率
                        </th>
                        <th colspan="2">
                            三次复购率
                        </th>
                        <th colspan="2">
                            四次复购率
                        </th>
                        <th colspan="2">
                            五次复购率
                        </th>
                        <th colspan="2">
                            六次复购率
                        </th>
                        <th colspan="2">
                            七次复购率
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
                <style>
                    .order_total_amount{
                        font-size: 18px;
                        font-weight: bold;
                        color: #009688;
                    }
                    .rate_font{
                        font-size: 24px !important;
                         font-weight: bold;
                        font-style: italic;
                    }
                </style>
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
            <div id="page" style="margin-bottom: 70px;"><?php echo ($page); ?></div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        <script src="/Public/home/js/echarts.min.js"></script>
        <script>
            // $('#table_css').click(function (e) {
            //     $('#table_css').css('background-color','red');
            // });
        </script>
        <script>
            layui.use(['laydate','element','laypage','layer'], function(){
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
                color:['#34bfa3','#ffffff'],
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
                color:['#34bfa3','#ffffff'],
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
                color:['#34bfa3','#ffffff'],
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
                color:['#34bfa3','#ffffff'],
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
                color:['#34bfa3','#ffffff'],
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
                color:['#34bfa3','#ffffff'],
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
                color:['#34bfa3','#ffffff'],
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
        <script>
            var _hmt = _hmt || [];
            (function() {
              var hm = document.createElement("script");
              hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
              var s = document.getElementsByTagName("script")[0];
              s.parentNode.insertBefore(hm, s);
            })();
        </script>
    </body>
</html>