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
       
        .content_title_box{
            /*width: 96%;*/
            /*margin-left: 2%;*/
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
            /*width: 95%;*/
            /*margin-left: 2.5%;*/
            margin-top: 10px;
        }
        .layui-col-sm3{
            margin-top: 0;
        }
    </style>
    <body>
    
        <div class="x-body">
            <!--头部统计-->
            <div class="layui-row content_title_box layui-col-space20">
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
                                <div id="columnar" style="height: 380px;min-width: 100px"></div>
                            </div>
                            <div class="layui-tab-item">
                                <div id="columnar1" style="height: 380px;min-width: 100px"></div>
                            </div>
                            <div class="layui-tab-item">
                                <div id="columnar2" style="height: 380px;min-width: 100px"></div>
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
                                  /*.layui-show{*/
                                      /*width: 1000px;*/
                                      /*border:1px solid red;*/
                                  /*}*/
                                  /*.money_width{*/
                                      /*width: 60px !important;*/
                                  /*}*/
                              </style>
                          <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <ul class="list">
                                    <li style="margin-top: 8px">
                                        <span class="list_icon list_bg" style="color: white;">
                                            <img src="<?php echo ($order_rank["month"]["0"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["month"]["0"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["month"]["0"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["month"]["0"]["t_order"],0,-3)); ?></span>
                                        
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="<?php echo ($order_rank["month"]["1"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["month"]["1"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["month"]["1"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["month"]["1"]["t_order"],0,-3)); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="<?php echo ($order_rank["month"]["2"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["month"]["2"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["month"]["2"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["month"]["2"]["t_order"],0,-3)); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="<?php echo ($order_rank["month"]["3"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["month"]["3"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["month"]["3"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["month"]["3"]["t_order"],0,-3)); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="<?php echo ($order_rank["month"]["4"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["month"]["4"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["month"]["4"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["month"]["4"]["t_order"],0,-3)); ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="layui-tab-item">
                                <ul class="list">
                                    <li style="margin-top: 8px">
                                        <span class="list_icon list_bg" style="color: white;">
                                            <img src="<?php echo ($order_rank["lastmonth"]["0"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["lastmonth"]["0"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["lastmonth"]["0"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["lastmonth"]["0"]["t_order"],0,-3)); ?></span>
                                        
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="<?php echo ($order_rank["lastmonth"]["1"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["lastmonth"]["1"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["lastmonth"]["1"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["lastmonth"]["1"]["t_order"],0,-3)); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="<?php echo ($order_rank["lastmonth"]["2"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["lastmonth"]["2"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["lastmonth"]["2"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["lastmonth"]["2"]["t_order"],0,-3)); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="<?php echo ($order_rank["lastmonth"]["3"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["lastmonth"]["3"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["lastmonth"]["3"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["lastmonth"]["3"]["t_order"],0,-3)); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="<?php echo ($order_rank["lastmonth"]["4"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["lastmonth"]["4"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["lastmonth"]["4"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["lastmonth"]["4"]["t_order"],0,-3)); ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="layui-tab-item">
                                <ul class="list">
                                    <li style="margin-top: 8px">
                                        <span class="list_icon list_bg" style="color: white;">
                                            <img src="<?php echo ($order_rank["history"]["0"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["history"]["0"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["history"]["0"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["history"]["0"]["t_order"],0,-3)); ?></span>
                                        
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="<?php echo ($order_rank["history"]["1"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["history"]["1"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["history"]["1"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["history"]["1"]["t_order"],0,-3)); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="color: white">
                                            <img src="<?php echo ($order_rank["history"]["2"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["history"]["2"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["history"]["2"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["history"]["2"]["t_order"],0,-3)); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="<?php echo ($order_rank["history"]["3"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["history"]["3"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["history"]["3"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["history"]["3"]["t_order"],0,-3)); ?></span>
                                    </li>
                                    <li>
                                        <span class="list_icon list_bg" style="background-color: #ddd;">
                                            <img src="<?php echo ($order_rank["history"]["4"]["img_small"]); ?>"  style="border-radius: 50%;width:57px;height: 58px">
                                        </span>
                                        <span class="list_name"><?php echo ($order_rank["history"]["4"]["nickname"]); ?></span>
                                        <span class=""><?php echo ($order_rank["history"]["4"]["order_sum"]); ?> 单</span>
                                        <span class="money_width">￥ <?php echo (substr($order_rank["history"]["4"]["t_order"],0,-3)); ?></span>
                                    </li>
                                </ul>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            
            <!--订单统计-->
            <style>
            .bg_color_div{
                background-color: white;
                /*height: 100%;*/
            }
            .layui-col-md4{
                height: 195px;
                min-width: 550px;
                margin-top: 10px;
            }
            .content_box{
                /*width: 99.4%;*/
                /*margin-left: 0.3%;*/
            }
            .content{
                display: inline-block;
                /*height: 100%;*/
            }
            .content1{
                width: 30%;
                margin-left: 0;
    
            }
            .content2{
                width: 36%;
                margin-left: 0;
            }
            .content2,.content3{
                margin-left: -0.8%;
            }
            .content3{
                position: relative;
                top: -35px;
                width: 34%;
            }
            .table_title{
                padding-left: 25px;
            }
            .content_table{
                margin-top: 18px;
            }
            .content_table td{
                height: 35px;
                color: rgba(0,0,0,.65);
            }
            .ring{
                width: 100px;
                height: 100px;
                margin-left: 15%;
            }
            .month{
                position: relative;
                display: inline-block;
                font-size: 38px;
                width: 100%;
                margin-left: 20%;
                color: rgba(0,0,0,.4);
            }
            .x-body {
                padding: 0 20px 20px 20px;
            }
            .month_btn{
                margin-top: 12px;
            }
            .layui-input{
                color: #666;
                font-weight: normal;
            }
        </style>
            <div class="layui-row layui-col-space20 content_box">
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4">
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
                        <div id="ring_one_one" class="ring"></div>
                        <span class="month">本月</span>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4">
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
                        <div id="ring_one_two" class="ring"></div>
                        <span class="month">上月</span>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4">
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
                        <div id="ring_one_three" class="ring"></div>
                        <span class="month">历史</span>
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
                    width: 38%;
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
            <div class="layui-row" style="margin-top: 15px">
                <div style="height: 730px;background-color: white;">
                    <div class="layui-row" style="width: 100%;margin-left: 0;">
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>一次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate"><?php echo ($buyrate["rate"]["one"]); ?></div>
                          </div>
                          <div id="ring_one" class="ring"></div>
                        </div>
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>二次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate"><?php echo ($buyrate["rate"]["two"]); ?></div>
                          </div>
                          <div id="ring_two" class="ring"></div>
                        </div>
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>三次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate"><?php echo ($buyrate["rate"]["three"]); ?></div>
                          </div>
                          <div id="ring_three" class="ring"></div>
                        </div>
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>四次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate"><?php echo ($buyrate["rate"]["four"]); ?></div>
                          </div>
                          <div id="ring_four" class="ring"></div>
                        </div>
                       <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>五次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate"><?php echo ($buyrate["rate"]["five"]); ?></div>
                          </div>
                          <div id="ring_five" class="ring"></div>
                        </div>
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>六次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate"><?php echo ($buyrate["rate"]["six"]); ?></div>
                          </div>
                          <div id="ring_six" class="ring"></div>
                        </div>
                        <div class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                          <div class="rate_title">
                              <span>七次复购</span>
                          </div>
                          <div class="buy_rate">
                              <div class="repart_rate">复购率</div>
                              <div class="buying_rate"><?php echo ($buyrate["rate"]["seven"]); ?></div>
                          </div>
                          <div id="ring_seven" class="ring"></div>
                        </div>
                    </div>
                    <div class="layui-row" style="margin: 80px 30px 0">
                        <div id="brokenline" style="height: 500px"></div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <script src="/Public/home/js/jquery.js"></script>
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
                var day = <?php echo ($month_day); ?>;
                var day_customer = <?php echo ($month_day_customer); ?>;
                year = myDate.getFullYear();
                month = myDate.getMonth() + 1;
                var myChart = echarts.init(dom);
                var app = {};
                option = null;
                app.title = '本月顾客';
                
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
                            name:'顾客',
                            type:'bar',
                            barWidth: '50%',
                            data:day_customer
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
                var day = <?php echo ($month_day); ?>;
                year = myDate.getFullYear();
                month = myDate.getMonth() + 1;
                var myChart = echarts.init(dom);
                var app = {};
                option = null;
                app.title = '本月订单';
                option = {
                    color: ['#3398DB'],//柱子颜色  #3aa1ff
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                            type: 'line'        // 默认为直线，可选为：'line' | 'shadow'
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
                    xAxis: [
                        {
                            type: 'category',
                            data: day.date,
                            axisTick: {
                                alignWithLabel: true
                            },
                            // axisLabel:{
                            //     interval:0,//0：全部显示，1：间隔为1显示对应类目，2：依次类推，（简单试一下就明白了，这样说是不是有点抽象）
                            //     rotate:-30,//倾斜显示，-：顺时针旋转，+或不写：逆时针旋转
                            // }
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value'
                        }
                    ],
                    series: [
                        {
                            name: '订单',
                            type: 'bar',
                            barWidth: '50%',
                            data: day.order_count
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
                    var day = <?php echo ($lastmonth_day_amount); ?>;
                    var day_customer = <?php echo ($lastmonth_day_customer); ?>;
                    var myDate = new Date();
                    year = myDate.getFullYear();
                    month = myDate.getMonth();
                    if(month == 0){month = 12;}
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
                            axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                                type: 'line'        // 默认为直线，可选为：'line' | 'shadow'
                            },
                            formatter: year+"-"+month+"-{b}<br /><br /><div style='width: 8px;height: 8px;border: 1px solid #c02c38;display: inline-block;border-radius: 50%;background-color: #c02c38'></div> {a0}: {c0}<br /><div style='width: 8px;height: 8px;border: 1px solid #894276;display: inline-block;border-radius: 50%;background-color: #894276'></div> {a1}: {c1}<br /><div style='width: 8px;height: 8px;border: 1px solid #3398db;display: inline-block;border-radius: 50%;background-color: #3398db'></div> {a2}: {c2}"
                        },
                        color:['#c02c38','#894276','#3398db'],
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
                            data: day.date
                        },
                        yAxis: {
                            type: 'value'
                        },
                        series: [
                            {
                                name:'上月订单',
                                type:'line',
                                stack: '总量',
                                data:day.order_count
                            },
                            {
                                name:'上月销售额',
                                type:'line',
                                stack: '总量',
                                data:day.list
                            },
                            {
                                name:'上月顾客',
                                type:'line',
                                stack: '总量',
                                data:day_customer
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
            var basic = Number("<?php echo ($buyrate["basic"]); ?>") - Number("<?php echo ($buyrate["one"]); ?>");
            var rate = "<?php echo ($buyrate["one"]); ?>";
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
            ;
            if (option && typeof option === "object") {
            myChart.setOption(option, true);
            }
        </script>
        
        <!--退单率-->
        <script type="text/javascript">
            var dom = document.getElementById("ring_one_one");
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
            var dom = document.getElementById("ring_one_two");
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
            var dom = document.getElementById("ring_one_three");
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
        <script>
            //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
            layui.use('element', function(){
                var element = layui.element;

                //…
            });
        </script>
    </body>
</html>