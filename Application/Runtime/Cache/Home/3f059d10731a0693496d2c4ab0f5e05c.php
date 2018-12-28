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
        <link rel="stylesheet" href="/Public/home/css/x-admin.css" media="all">
        <link rel="stylesheet" href="/Public/Home/lib2/layui/css/layui.css" media="all">
    </head>
    <style>
        body{
            background-color: #f0f2f5;
        }
        
        .layui-row{
    
            width: 101.6%;
            margin-left: -0.8%;
            
        }
        .word{
            position: relative;
            top: -56px;
            left: 58px;
            font-size: 28px;
            display: inline-block;
            color: rgba(0,0,0,.45);
        }
        .img_icon{
            margin: -42px 0 0 56px;
        }
        .word_title{
            font-size: 14px;
        }
        .word_number{
            font-size: 22px;
            color: rgba(0,0,0,.85);
            
        }
        .word_box{
            height: 8px;
        }
        .word_english{
            height: 25px;
            /*font-size: 12px;*/
            font-weight: inherit;
            width: 83%;
            /*text-align: center;*/
            margin-top: 12px;
            color: rgba(0,0,0,.45);
        }
        .l_box{
            width: 45%;
            display: inline-block;
        }
        .r_box{
            width: 53%;
            margin-top: 10px;
            display: inline-block;
            color: rgba(0,0,0,.85);
        }
        .bg_color{
            height: 160px;
            background-color: white;
        }
        .sec_bg_color{
            height: 400px;
            background-color: white;
        }
        .sec_black{
            width: 100%;
            margin-left: 0%;
            margin-top: 10px;
        }
        .layui-col-sm3{
            margin-top: 0;
        }
    </style>
    <body>
        <div class="x-body">
            <!--头部统计-->
            <div class="layui-row layui-col-space20">
                <div class="layui-col-xs6 layui-col-sm6 layui-col-md3">
                    <div class="bg_color">
                        <div class="l_box">
                            <span class="word">今天</span><br>
                            <img src="/Public/Home/images/today1.png" height="60px" class="img_icon">
                        </div>
                        <div class="r_box">
                            <div  class="word_english">Today</div>
                            <i class="layui-icon">&#xe770;</i>
                            <span class="word_title">客户数：</span>
                            <span class="word_number"> <?php echo ($customer_stati["today"]); ?></span>
                            <div class="word_box"></div>
                            
                            <i class="layui-icon">&#xe63c;</i>
                            <span class="word_title">订单数：</span>
                            <span class="word_number"> <?php echo ($order_stati["today"]); ?></span>
                            <div  class="word_box"></div>
                        
                            <i class="layui-icon">&#xe65e;</i>
                            <span class="word_title">销售额：</span>
                            <span class="word_number"> <?php echo (substr($order_stati["today_order"],0,-3)); ?></span>
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs6 layui-col-sm6 layui-col-md3">
                    <div class="bg_color">
                        <div class="l_box">
                            <span class="word">昨天</span><br>
                            <img src="/Public/Home/images/yestoday.png" height="60px" class="img_icon">
                        </div>
                        <div class="r_box">
                            <div  class="word_english">Yestoday</div>
                            <i class="layui-icon">&#xe770;</i>
                            <span class="word_title">客户数：</span>
                            <span class="word_number"> <?php echo ($customer_stati["yesterday"]); ?></span>
                            <div class="word_box"></div>
                            
                            <i class="layui-icon">&#xe63c;</i>
                            <span class="word_title">订单数：</span>
                            <span class="word_number"> <?php echo ($order_stati["yesterday"]); ?></span>
                            <div  class="word_box"></div>
                            
                            <i class="layui-icon">&#xe65e;</i>
                            <span class="word_title">销售额：</span>
                            <span class="word_number"> <?php echo (substr($order_stati["yesterday_order"],0,-3)); ?></span>
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs6 layui-col-sm6 layui-col-md3">
                    <div class="bg_color">
                        <div class="l_box">
                            <span class="word">本月</span><br>
                            <img src="/Public/Home/images/month5.png" height="60px" class="img_icon">
                        </div>
                        <div class="r_box">
                            <div  class="word_english">Month</div>
                            <i class="layui-icon">&#xe770;</i>
                            <span class="word_title">客户数：</span>
                            <span class="word_number"> <?php echo ($customer_stati["month"]); ?></span>
                            <div class="word_box"></div>
                            
                            <i class="layui-icon">&#xe63c;</i>
                            <span class="word_title">订单数：</span>
                            <span class="word_number"> <?php echo ($order_stati["month"]); ?></span>
                            <div  class="word_box"></div>
                            
                            <i class="layui-icon">&#xe65e;</i>
                            <span class="word_title">销售额：</span>
                            <span class="word_number"> <?php echo (substr($order_stati["month_order"],0,-3)); ?></span>
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs6 layui-col-sm6 layui-col-md3">
                    <div class="bg_color">
                        <div class="l_box">
                            <span class="word">上月</span><br>
                            <img src="/Public/Home/images/month6.png" height="60px" class="img_icon">
                        </div>
                        <div class="r_box">
                            <div  class="word_english">Last　Month</div>
                            <i class="layui-icon">&#xe770;</i>
                            <span class="word_title">客户数：</span>
                            <span class="word_number"> <?php echo ($customer_stati["lastmonth"]); ?></span>
                            <div class="word_box"></div>
                            
                            <i class="layui-icon">&#xe63c;</i>
                            <span class="word_title">订单数：</span>
                            <span class="word_number"> <?php echo ($order_stati["lastmonth"]); ?></span>
                            <div  class="word_box"></div>
                            
                            <i class="layui-icon">&#xe65e;</i>
                            <span class="word_title">销售额：</span>
                            <span class="word_number"> <?php echo (substr($order_stati["lastmonth_order"],0,-3)); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--柱状统计-->
            <div class="layui-row sec_black">
                <div class="layui-col-xs9 layui-col-sm9 layui-col-md10">
                    <div class="sec_bg_color">
                        <div class="layui-tab layui-tab-brief" style="">
                          <ul class="layui-tab-title">
                            <li  class="layui-this">本月销售额</li>
                            <li>上月销售额</li>
                          </ul>
                          <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <div id="columnar" style="height: 380px;min-width: 100px"></div>
                            </div>
                            <div class="layui-tab-item">
                                <div id="columnar1" style="height: 380px;min-width: 100px"></div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                
                <style>
                    #title_width li{
                        width: 26%;
                    }
                    .bg_color_md3{
                        height: 400px;
                        margin-top: 10px;
                        background-color: white;
                        border-left: 3px solid #f2f2f2;
                    }
                    #title_z{
                        font-size: 24px;
                        margin-left: 30px;
                        color: rgba(0,0,0,.5);
                    }
                    #title_z,.z_ke,.z_ding,.z_amount,.z_count{
                        display: inline-block;
                        
                    }
                    .z_count{
                        font-size: 24px;
                        /*font-weight: bold;*/
                        height: 50px;
                        line-height: 50px;
                        /*color: #ff0036;*/
                        color: rgba(0,0,0,.5);
                        
                    }
                    #title_z{
                        margin-bottom: 20px;
                        margin-top: 20px;
                    }
                    .z_ke,.z_ding,.z_amount{
                        font-size: 18px;
                        height: 50px;
                        line-height: 50px;
                        margin-left: 30px;
                        color: rgba(0,0,0,.5);
                        /*color: #813c85;*/
                    }
                    .amount_icon{
                        font-size: 18px;
                        color: rgba(0,0,0,.4);
                    }
                    .title_span{
                        color: rgba(0,0,0,.4);
                        display: inline-block;
                        float: right;
                        margin-right: 30px;
                        margin-top: 30px;
                    }
                    .title_img{
                        width: 20px;
                    }
                </style>
                
                <div class="layui-col-xs3 layui-col-sm3 layui-col-md2">
                    <div class="bg_color_md3">
                        <div id="title_z">历史总数据 </div><span class="title_span"> Total Data</span><br>
                        <div class="z_ke"><img class="title_img" src="/Public/Home/images/kuai.png"> 快递费：</div>
                            <div class="z_count"><?php echo ($history["totalcourierfee"]); ?></div><br>
                        <div class="z_ding"><img class="title_img" src="/Public/Home/images/fee.png"> 手续费：</div>
                            <div class="z_count"><?php echo ($history["totalserverfee"]); ?></div><br>
                        <div class="z_amount"><img class="title_img" src="/Public/Home/images/bfb.png"> 快递成本占比：</div>
                            <div class="z_count"><?php echo ($history["chengbenli"]); ?></div>
                        <div class="z_ke"><i class="layui-icon amount_icon">&#xe770;</i> 客户数：</div>
                            <div class="z_count"><?php echo ($history["totalcustomer"]); ?></div><br>
                        <div class="z_ding"><i class="layui-icon amount_icon">&#xe63c;</i> 订单数：</div>
                            <div class="z_count"><?php echo ($history["totalorder"]); ?></div><br>
                        <div class="z_amount"><i class="layui-icon amount_icon">&#xe65e;</i> 销售额：</div>
                            <div class="z_count"><?php echo ($history["totalfunds"]); ?></div>
                    </div>
                </div>
              </div>
            
            <!--表格-->
            <style>
                .buyrate div{
                    color: #E2E2E2;
                }
                
                .rate_title span{
                    display: inline-block;
                    margin-top: 16px;
                }
                
                .layui-fluid{
                    margin-top: 20px;
                }
                .layui-fluid{
                    width: 100%;
                    margin-left: -1%;
                }
                #LAY_demorange_s{
                    color: #666;
                }
                .layui-table th,td{
                    text-align: center;
                }
            </style>
            <!--<div class="layui-row" style="margin-top: 20px;width: 100%;margin-left: 0%;">-->
                <!--<div style="height: 730px;background-color: white;">-->
                    <div class="layui-fluid">
                      <div class="layui-card">
                        <div class="x-body">
                        <xblock style="background-color: white !important;margin-top: -10px !important;margin-bottom: -10px !important;">
                            <a title="本月排名" class="layui-btn month_btn"  href="/Home/Report/funds?month=month">
                                本月财务统计
                            </a>
                            <a title="上月排名" class="layui-btn month_btn"  href="/Home/Report/funds?month=lastmonth">
                                上月财务统计
                            </a>
                            <span class="x-right" style="margin-top: -13px">
                                <form class="layui-form x-center" action="" style="width:400px;">
                                    <div class="layui-form-pane" style="margin-top: 15px;">
                                      <div class="layui-form-item" style="width: 120%">
                                        <label class="layui-form-label">日期范围</label>
                                          <div class="layui-input-inline">
                                            <input type="text" class="layui-input" autocomplete="off" name="month" id="LAY_demorange_s" value="<?php echo ($month); ?>" placeholder="选择月份">
                                          </div>
                                        <div class="layui-input-inline" style="width:120px;">
                                            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>
                                        </div>
                                      </div>
                                    </div>
                                </form>
                            </span>
                        </xblock>
                            <!--</div>-->
                        <table class="layui-table" style="margin-top: -10px">
                            <thead>
                                <tr>
                                    <th width="45px">
                                        日期
                                    </th>
                                    <th>
                                        销售金额
                                    </th>
                                    <th>
                                        客户
                                    </th>
                                    <th>
                                        订单
                                    </th>
                                    <th>
                                        均价
                                    </th>
                                    <th>
                                        快递费
                                    </th>
                                    <th>
                                        手续费
                                    </th>
                                    <th>
                                        现金收入
                                    </th>
                                    <th>
                                        代收货款
                                    </th>
                                    <th>
                                        返款
                                    </th>
                                    <th>
                                        毛收入
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($info)): foreach($info as $k=>$v): ?><tr>
                                        <td>
                                            <?php echo ($k+1); ?>
                                        </td>
                                        <td>
                                            <?php echo ($v["funds"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($v["customer"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($v["order_count"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($v["amount_avg"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($v["courierfee"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($v["serverfee"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($v["pay"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($v["payment"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($v["refunds"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($v["income"]); ?>
                                        </td>
                                    </tr><?php endforeach; endif; ?>
                                <style>
                                    .zonghe td{
                                        font-weight: bold;
                                        font-size: 18px;
                                    }
                                </style>
                                    <tr class="zonghe">
                                        <td>
                                            合计
                                        </td>
                                        <td>
                                            <?php echo ($composite["funds"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($composite["customer"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($composite["order_count"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($composite["amount_avg"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($composite["courierfee"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($composite["serverfee"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($composite["pay"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($composite["payment"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($composite["refunds"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($composite["income"]); ?>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
        </div>
        <script src="/Public/home/js/jquery.js"></script>
        <script src="/Public/home/lib2/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/home/js/x-admin.js"></script>
        <script src="/Public/home/js/echarts.min.js"></script>
        
        <!--柱状图-->
        <script type="text/javascript">
                var dom = document.getElementById("columnar");
                var day = <?php echo ($month_day); ?>;
                var myDate = new Date();
                year = myDate.getFullYear();
                month = myDate.getMonth() + 1;
                var myChart = echarts.init(dom);
                var app = {};
                option = null;
                app.title = '本月销售额';
                
                option = {
                    color: ['#3398DB'],//柱子颜色  #3aa1ff
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                            type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                        },
                        formatter: year+"-"+month+"-{b}<br /><br /><div style='width: 8px;height: 8px;border: 1px solid #3398db;display: inline-block;border-radius: 50%;background-color: #3398db'></div> {a}: {c}"
                    },
                    grid: {
                        left: '1%',
                        top: '3%',
                        right: '2%',
                        // bottom: '3%',
                        containLabel: true
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : day.date,
                            axisTick: {
                                alignWithLabel: true
                            },
                            // axisLabel:{
                            //     interval:0,//0：全部显示，1：间隔为1显示对应类目，2：依次类推，（简单试一下就明白了，这样说是不是有点抽象）
                            //     rotate:-30,//倾斜显示，-：顺时针旋转，+或不写：逆时针旋转
                            // }
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            name:'销售额',
                            type:'bar',
                            barWidth: '50%',
                            data:day.list
                        }
                    ]
                };
                ;
                if (option && typeof option === "object") {
                    myChart.setOption(option, true);
                }
           </script>
        <script type="text/javascript">
                var dom = document.getElementById("columnar1");
                var width = $("#columnar").width();
                var height = $("#columnar").height();
                $("#columnar1").css("width", width).css("height", height);
                var day = <?php echo ($lastmonth_day); ?>;
                year = myDate.getFullYear();
                month = myDate.getMonth();
                if(month == 0){month = 12;}
                var myChart = echarts.init(dom);
                var app = {};
                option = null;
                app.title = '上月销售额';
                
                option = {
                    color: ['#3398DB'],//柱子颜色  #3aa1ff
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                            type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                        },
                        formatter: year+"-"+month+"-{b}<br /><br /><div style='width: 8px;height: 8px;border: 1px solid #3398db;display: inline-block;border-radius: 50%;background-color: #3398db'></div> {a}: {c}"
                    },
                    grid: {
                        left: '1%',
                        top: '3%',
                        right: '2%',
                        // bottom: '3%',
                        containLabel: true
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : day.date,
                            axisTick: {
                                alignWithLabel: true
                            },
                            // axisLabel:{
                            //     interval:0,//0：全部显示，1：间隔为1显示对应类目，2：依次类推，（简单试一下就明白了，这样说是不是有点抽象）
                            //     rotate:-30,//倾斜显示，-：顺时针旋转，+或不写：逆时针旋转
                            // }
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            name:'销售额',
                            type:'bar',
                            barWidth: '50%',
                            data:day.list
                        }
                    ]
                };
                ;
                if (option && typeof option === "object") {
                    myChart.setOption(option, true);
                }
           </script>
        <script>
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
                laydate = layui.laydate;//日期插件
                layer = layui.layer;//弹出层
                element = layui.element;

                //年月选择器
                laydate.render({
                    elem: '#LAY_demorange_s'
                    ,type: 'month'
                });
                
            });
            
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