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
        <!--<link rel="stylesheet" href="/Public/home/css/x-admin.css" media="all">-->
        <link rel="stylesheet" href="/Public/Home/lib2/layui/css/layui.css" media="all">
    </head>
    <style>
        body{
            background-color: #f0f2f5;
        }
        /*.ring{*/
            /*float: left;*/
        /*}*/
        .layui-col-md3{
            margin-top: 20px;
           
        }
       
        .layui-row{
         
            width: 96%;
            margin-left: 2%;
            
        }
    </style>
    <style>
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
            width: 95%;
            margin-left: 2.5%;
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
                            <span class="word_number"> 6</span>
                            <div class="word_box"></div>
                        
                            <i class="layui-icon">&#xe63c;</i>
                            <span class="word_title">订单数：</span>
                            <span class="word_number"> 7</span>
                            <div  class="word_box"></div>
                        
                            <i class="layui-icon">&#xe65e;</i>
                            <span class="word_title">销售额：</span>
                            <span class="word_number"> 12001</span>
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
                            <span class="word_number"> 8</span>
                            <div class="word_box"></div>
                            
                            <i class="layui-icon">&#xe63c;</i>
                            <span class="word_title">订单数：</span>
                            <span class="word_number"> 9</span>
                            <div  class="word_box"></div>
                            
                            <i class="layui-icon">&#xe65e;</i>
                            <span class="word_title">销售额：</span>
                            <span class="word_number"> 15123</span>
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
                            <span class="word_number"> 70</span>
                            <div class="word_box"></div>
                            
                            <i class="layui-icon">&#xe63c;</i>
                            <span class="word_title">订单数：</span>
                            <span class="word_number"> 90</span>
                            <div  class="word_box"></div>
                            
                            <i class="layui-icon">&#xe65e;</i>
                            <span class="word_title">销售额：</span>
                            <span class="word_number"> 100123</span>
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
                            <span class="word_number"> 365</span>
                            <div class="word_box"></div>
                            
                            <i class="layui-icon">&#xe63c;</i>
                            <span class="word_title">订单数：</span>
                            <span class="word_number"> 568</span>
                            <div  class="word_box"></div>
                            
                            <i class="layui-icon">&#xe65e;</i>
                            <span class="word_title">销售额：</span>
                            <span class="word_number"> 1200123</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--柱状统计-->
            <div class="layui-row sec_black">
                <div class="layui-col-xs9 layui-col-sm9 layui-col-md9">
                    <div class="sec_bg_color">
                        <div class="layui-tab layui-tab-brief" style="">
                          <ul class="layui-tab-title">
                            <li  class="layui-this">本月销售额</li>
                            <li>本月顾客</li>
                            <li>本月订单</li>
                          </ul>
                          <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <div id="columnar" style="height: 380px"></div>
                            </div>
                            <div class="layui-tab-item">
                                <div id="columnar1" style="height: 380px"></div>
                            </div>
                            <div class="layui-tab-item">
                                <div id="columnar2" style="height: 380px"></div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <style>
                    #title_width li{
                        width: 26%;
                    }
                </style>
                <div class="layui-col-xs3 layui-col-sm3 layui-col-md3">
                  <div class="sec_bg_color">
                        <div class="layui-tab layui-tab-brief" style="">
                          <ul class="layui-tab-title" id="title_width">
                            <li  class="layui-this">本月排行榜</li>
                            <li>上月排行榜</li>
                            <li>历史排行榜</li>
                          </ul>
                              <style>
                                  .list li span{
                                      color: rgba(0,0,0,.8);
                                      display: inline-block;
                                      font-size: 14px;
                                      height: 45px;
                                      width:57px;
                                      border-radius: 50%;
                                      line-height: 45px;
                                      /*line-height: 20px;*/
                                      margin-left: 20px;
                                  }
                                  .list li{
                                      height: 65px;
                                      line-height: 65px;
                                  }
                                  .list_icon{
                                      border-radius: 20px;
                                      font-size: 12px;
                                      margin-right: 16px;
                                      height: 57px !important;
                                      line-height: 57px !important;
                                      text-align: center;
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
                                  .money_width{
                                      width: 60px !important;
                                  }
                              </style>
                          <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <ul class="list">
                                    <li style="margin-top: 8px">
                                        <span class="list_icon list_bg" style="color: white;">
                                            <img src="/public/Home/images/10.jpg"  style="border-radius: 50%;width:57px;height: 58px">

                                        </span>
                                        <span class="list_name">方一勺</span>
                                        <span class="">130</span>
                                        <span class="money_width">￥ 52000</span>
                                        
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="/public/Home/images/11.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">沈勇</span>
                                        <span class="">10</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="/public/Home/images/12.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">蒋佳恩</span>
                                        <span class="">111</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="/public/Home/images/13.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">周伯通</span>
                                        <span class="">112 单</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="/public/Home/images/14.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">段誉</span>
                                        <span class="">196</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="layui-tab-item">
                                <ul class="list">
                                    <li style="margin-top: 8px">
                                        <span class="list_icon list_bg" style="color: white;">
                                            <img src="/public/Home/images/10.jpg"  style="border-radius: 50%;width:57px;height: 58px">

                                        </span>
                                        <span class="list_name">方一勺2</span>
                                        <span class="">130</span>
                                        <span class="money_width">￥ 52000</span>
                                        
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="/public/Home/images/11.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">沈勇2</span>
                                        <span class="">10</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="/public/Home/images/12.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">蒋佳恩2</span>
                                        <span class="">111</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="/public/Home/images/13.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">周伯通2</span>
                                        <span class="">112 单</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="/public/Home/images/14.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">段誉2</span>
                                        <span class="">196</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="layui-tab-item">
                                <ul class="list">
                                    <li style="margin-top: 8px">
                                        <span class="list_icon list_bg" style="color: white;">
                                            <img src="/public/Home/images/10.jpg"  style="border-radius: 50%;width:57px;height: 58px">

                                        </span>
                                        <span class="list_name">方一勺1</span>
                                        <span class="">130</span>
                                        <span class="money_width">￥ 52000</span>
                                        
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="/public/Home/images/11.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">沈勇1</span>
                                        <span class="">10</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="/public/Home/images/12.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">蒋佳恩1</span>
                                        <span class="">111</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="/public/Home/images/13.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">周伯通1</span>
                                        <span class="">112 单</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="/public/Home/images/14.jpg"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name">段誉1</span>
                                        <span class="">196</span>
                                        <span class="money_width">￥ 52000</span>
                                    </li>
                                </ul>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
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
                    /*margin-bottom: 16px;*/
                    transition: all .3s;
                    margin-left: 12%;
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
                .layui-col-md2{
                    /*background-color: #00F7DE;*/
                    margin-top: 50px;
                }
            </style>
            <style>.layui-col-md2{width: 14.2857143%;height: 120px}</style>
            <div class="layui-row" style="width: 95%;margin-left: 2.5%;margin-top: 20px">
                <div style="height: 730px;background-color: white;">
                    <div class="layui-row" style="width: 100%;margin-left: 0;">
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>一次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate">38%</div>
                          </div>
                          <div id="ring_one" class="ring"></div>
                        </div>
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>二次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate">88%</div>
                          </div>
                          <div id="ring_two" class="ring"></div>
                        </div>
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>三次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate">65%</div>
                          </div>
                          <div id="ring_three" class="ring"></div>
                        </div>
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>四次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate">76%</div>
                          </div>
                          <div id="ring_four" class="ring"></div>
                        </div>
                       <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>五次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate">75%</div>
                          </div>
                          <div id="ring_five" class="ring"></div>
                        </div>
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>六次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate">77%</div>
                          </div>
                          <div id="ring_six" class="ring"></div>
                        </div>
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>七次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate">98%</div>
                          </div>
                          <div id="ring_seven" class="ring"></div>
                        </div>
                    </div>
                    <div class="layui-row" style="margin-top: 80px">
                        <div id="brokenline" style="height: 500px"></div>
                    </div>
                </div>
            </div>
            
            
            <script>
            //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
            layui.use('element', function(){
                var element = layui.element;
            
                //…
            });
            </script>
            
        
        </div>
        <style>
            .layui-main p{
                text-align: center;
                margin: 20px;
            }
        </style>
        <div class="layui-footer footer footer-demo"  lay-filter="side">
            <div class="layui-main">
                <p>
                    <a   href="javascript:;"  _href="/">
                        <img src="/public/Home/images/500k.png" width="40px">
                    </a>
                </p>
                <p>
                    <a target="_blank" href="http://www.miitbeian.gov.cn">
                        Copyright ©2017 风暴网络
                    </a>
                </p>
            </div>
        </div>
        <script src="/Public/home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/home/js/x-admin.js"></script>
        <script src="/Public/home/js/echarts.min.js"></script>
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
        <!--柱状图-->
        <script type="text/javascript">
                var dom = document.getElementById("columnar");
                var myChart = echarts.init(dom);
                //var chart = echarts.init(dom, 'light');
                var app = {};
                option = null;
                app.title = '坐标轴刻度与标签对齐';
                
                option = {
                    color: ['#3398DB'],//柱子颜色  #3aa1ff
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                            type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                        }
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
                            data : ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'],
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
                            data:[10, 52, 200, 334, 390, 330, 220,10, 52, 160, 380, 352, 142, 400,10, 52, 200, 334, 390, 330, 220,10, 52, 160, 380, 352, 142, 400,45,123,456]
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
                var myChart = echarts.init(dom);
                //var chart = echarts.init(dom, 'light');
                var app = {};
                option = null;
                app.title = '坐标轴刻度与标签对齐';
                
                option = {
                    color: ['#3398DB'],//柱子颜色  #3aa1ff
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                            type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                        }
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
                            data : ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'],
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
                            data:[10, 52, 200, 334, 390, 330, 20,10, 52, 60, 380, 352, 42, 400,10, 52, 10, 334, 390, 330, 220,10, 52, 160, 370, 352, 142, 400,45,13,456]
                        }
                    ]
                };
                ;
                if (option && typeof option === "object") {
                    myChart.setOption(option, true);
                }
           </script>
        <script type="text/javascript">
                var dom = document.getElementById("columnar2");
                var width = $("#columnar").width();
                var height = $("#columnar").height();
                $("#columnar2").css("width", width).css("height", height);
                var myChart = echarts.init(dom);
                //var chart = echarts.init(dom, 'light');
                var app = {};
                option = null;
                app.title = '坐标轴刻度与标签对齐';
                
                option = {
                    color: ['#3398DB'],//柱子颜色  #3aa1ff
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                            type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                        }
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
                            data : ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'],
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
                            data:[10, 52, 200, 384, 390, 330, 290,10, 52, 140, 380, 352, 142, 410,10, 52, 200, 334, 390, 330, 20,10, 52, 60, 38, 352, 142, 440,45,123,456]
                        }
                    ]
                };
                ;
                if (option && typeof option === "object") {
                    myChart.setOption(option, true);
                }
           </script>
        <!--折线图-->
        <script type="text/javascript">
                    var dom = document.getElementById("brokenline");
                    var myChart = echarts.init(dom);
                    var app = {};
                    option = null;
                    option = {
                        title: {
                            text: '上月统计',
                            color:'#ccc'
                        },
                        tooltip: {
                            trigger: 'axis'
                        },
                        legend: {
                            data:['上月订单','上月销售额','上月顾客']
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
                            data: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31']
                        },
                        yAxis: {
                            type: 'value'
                        },
                        series: [
                            {
                                name:'上月订单',
                                type:'line',
                                stack: '总量',
                                data:[120, 132, 101, 134, 90, 230, 210,120, 132, 101, 134, 90, 230, 210,120, 132, 101, 134, 90, 230, 210,120, 132, 101, 134, 90, 230, 210, 90, 230, 210]
                            },
                            {
                                name:'上月销售额',
                                type:'line',
                                stack: '总量',
                                data:[120, 130, 101, 145, 90, 230, 235, 120, 102, 101, 134, 91, 230, 212, 120, 132, 101, 144, 20, 233, 235, 120, 102, 101, 124, 10, 230, 210, 90, 220, 220]
                            },
                            {
                                name:'上月顾客',
                                type:'line',
                                stack: '总量',
                                data:[100, 112, 93, 124, 80, 201, 174, 123, 70, 120, 122, 40, 230, 210, 100, 112, 93, 124, 80, 201, 174,123, 70, 120, 122, 40, 230, 210, 40, 230, 210]
                            }
                        ]
                    };
                    if (option && typeof option === "object") {
                        myChart.setOption(option, true);
                    }
               </script>
        <!--//复购率-->
        <script type="text/javascript">
            var dom = document.getElementById("ring_one");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#f0f2f5','#34bfa3'],
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
                            {value:335},
                            {value:148}
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
            option = null;
            app.title = '环形图';
            
            option = {
            legend: {
                orient: 'vertical',
                x: 'center',
                data:['复购率','1']
            },
            color:['#f0f2f5','#34bfa3'],
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
                        {value:335},
                        {value:1548}
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
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#f0f2f5','#34bfa3'],
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
                            {value:335},
                            {value:548}
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
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#f0f2f5','#34bfa3'],
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
                            {value:35},
                            {value:148}
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
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#f0f2f5','#34bfa3'],
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
                            {value:35},
                            {value:158}
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
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#f0f2f5','#34bfa3'],
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
                            {value:3350},
                            {value:14800}
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
            option = null;
            app.title = '环形图';

            option = {
                legend: {
                    orient: 'vertical',
                    x: 'center',
                    data:['复购率','1']
                },
                color:['#f0f2f5','#34bfa3'],
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
                            {value:35},
                            {value:1408}
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
            function getDate() {
                var base = +new Date(2016, 10, 21);
                var oneDay = 24 * 3600 * 1000;
                var date = [];
                var data = [Math.random() * 300];


                for (var i = 1; i < 20000; i++) {
                    var now = new Date(base += oneDay);
                    date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('/'));
                    data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                }
                return date;
            }
        </script>
    </body>
</html>