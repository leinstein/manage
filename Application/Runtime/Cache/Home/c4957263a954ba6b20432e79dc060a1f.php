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
<link rel="stylesheet" href="/Public/Home/laydate/theme/default/laydate.css">
</head>
    <body style="background-color: #f0f2f5">
        <div class="x-body">
            <style>
                #ListAction{
                    margin-top: 3%;
                    margin-left: 40%;
                    width: 20%;
                }
                .btn-height{
                    height: 50px;
                }
                #phone_res{
                    width: 60%;
                    background-color: white;
                    margin-left: 20%;
                }
                .layui-col-md6{
                    height: 130px;
                    line-height: 130px;
                    color: #676767;
                    font-weight: bold;
                    text-align: center;
                }
                .layui-col-md6 {
                    font-size: 60px;
                    -webkit-animation: mymove 1s infinite; /* Chrome, Safari, Opera */
                    animation: mymove 1s;
                }
                
                /* Chrome, Safari, Opera */
                @-webkit-keyframes mymove {
                    50% {font-size: 70px;color: #1ba194}
                    100% {font-size: 50px;color: #676767}
                }
                
                /* Standard syntax */
                @keyframes mymove {
                    50% {font-size: 70px;color: #1ba194}
                    100% {font-size: 50px;color: #676767}
                }
                .grid-demo{
                    min-height: 200px;
                }
            </style>
            <div id="phone_res">
                <div class="layui-row" id="phone_z">
                    <div class="layui-col-xs12 layui-col-sm12 layui-col-md12" style="text-align: center;">
                      <div class="grid-demo" style="font-size: 40px;color: #868585;line-height: 200px">获取号码</div>
                    </div>
                </div>
            </div>
            <button class="layui-btn layui-btn-fluid btn-height" onclick="get_phone()" id="ListAction">获取号码</button>
    
    </div>
        <script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
        <script src="/Public/Home/lib2/layui/layui.js" charset="utf-8"> </script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['laydate','element','layer'], function() {
                $ = layui.jquery;//jquery
                layer = layui.layer;//弹出层
            });
            function get_phone() {
                layer.load();
                $.ajax({
                    type: 'POST',
                    url: '/Home/Telephone/index',
                    dataType: 'json',
                    success: function (data) {
                        if (data.statu == 200) {
                            layer.closeAll('loading');
                            $("#phone_z").html('');

                            $.each(data.data, function (i, item) {

                                string = '<div class="layui-col-xs12 layui-col-sm6 layui-col-md6">\n' +
                                    '<div class="grid-demo" onclick="this.style.color = \'#bbbcbd\'">'+item.phone+'</div>\n' +
                                    '</div>';
                                $("#phone_z").append(string);
                                
                            });

                            
                        } else {
                            layer.closeAll('loading');
                            // layer.msg(data.msg);
                            $("#phone_z").html('<div class="layui-col-xs12 layui-col-sm12 layui-col-md12" style="text-align: center;">\n' +
                                '                      <div class="grid-demo" style="font-size: 40px;color: #868585;line-height: 200px">'+data.msg+'</div>\n' +
                                '                    </div>');
                            return false;
                        }
                    },
                    error: function (data) {
                        layer.msg('系统错误');
                    },
                });
            }
            // function get_phone() {
            //     layer.load();
            //     $.ajax({
            //         type: 'POST',
            //         url: '/Home/Telephone/index',
            //         dataType: 'json',
            //         success: function (data) {
            //             if (data.statu == 200) {
            //                 layer.closeAll('loading');
            //                 var string = "";
            //
            //                 $.each(data.data, function (i, item) {
            //
            //                     string += '<div class="layui-col-xs12 layui-col-sm6 layui-col-md6">\n' +
            //                         '<div class="grid-demo" onclick="this.style.color = \'#bbbcbd\'">'+item.phone+'</div>\n' +
            //                         '</div>';
            //
            //                 });
            //
            //                 $("#phone_z").html(string);
            //             } else {
            //                 layer.closeAll('loading');
            //                 layer.msg(data.tip);
            //                 return false;
            //             }
            //         },
            //         error: function (data) {
            //             layer.msg('系统错误');
            //         },
            //     });
            // }
        </script>
    </body>
</html>