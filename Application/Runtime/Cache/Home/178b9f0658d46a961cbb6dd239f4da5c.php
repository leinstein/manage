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
            <!--<form class="layui-form">-->
                <!--<div class="layui-form-item">-->
                    <!--<label for="link" class="layui-form-label">-->
                        <!--<span class="x-red">*</span>上传文件-->
                    <!--</label>-->
                    <!--<div class="layui-input-inline">-->
                      <!--<div class="site-demo-upbar">-->
                        <!--<input type="file" name="file" class="layui-upload-file" id="test">-->
                      <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="layui-form-item" id="LAY_demo_upload" style="padding: 0 20px 0 100px">-->
                <!---->
                <!--</div>-->
                <!--<div class="layui-form-item">-->
                    <!--<label  class="layui-form-label">-->
                    <!--</label>-->
                <!--</div>-->
            <!--</form>-->
            <style>
                #ListAction{
                    margin-top: 3%;
                    margin-left: 40%;
                    width: 20%;
                }
                 #test1{
                    
                     display: inline-block;
                 }
                
                #upload{
                    width: 65%;
                    height: 50px;
                    margin-left: 25%;
                    margin-top: 10%;
                }
                .layui-input{
                    display: inline-block;
                    width: 50%;
                    height: 50px;
                    line-height: 50px;
                }
                .btn-height{
                    height: 50px;
                }
                #detection{
                    width: 140px;
                }
                #result{
                    width: 50%;
                    height: 310px;
                    background-color: white;
                    margin-left: 25%;
                }
                .delection_item,.delection_num{
                    display: inline-block;
                    font-size: 16px;
                    margin-top: 20px;
                    margin-left: 20%;
                }
                #yes,#succ{
                    color: #1AA094;
                }
            </style>
            <div id="upload">
                <input type="text" name="" value="" id="name" autocomplete="off" class="layui-input">
                <button type="button" class="layui-btn btn-height" id="test1">
                  <i class="layui-icon">&#xe67c;</i>选择TXT文件
                </button>
                <button type="button" class="layui-btn btn-height" id="detection">
                   检测
                </button>
            </div>
            <div id="result">
                <div style="margin-top: 40px">
                    <div class="delection_item">　总检测：</div><div class="delection_num" id="totle">0</div>
                </div>
                <div>
                   <div class="delection_item">符合条件：</div><div class="delection_num" id="yes">0</div>
                </div>
                <div>
                   <div class="delection_item">重复号码：</div><div class="delection_num" id="rephone">0</div>
                </div>
                <div>
                   <div class="delection_item">自身重复：</div><div class="delection_num" id="chong">0</div>
                </div>
                <div>
                    <div class="delection_item">无法识别：</div><div class="delection_num" id="no">0</div>
                </div>
                <div>
                    <div class="delection_item">检测时间：</div><div class="delection_num" id="time">0</div>
                </div>
                <div>
                    <div class="delection_item">成功上传：</div><div class="delection_num" id="succ">0</div>
                </div>
            </div>
            <button class="layui-btn layui-btn-fluid btn-height" onclick="upload_txt()" id="ListAction">导入号码资源</button>
        </div>
        </div>
        <script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
        <script src="/Public/Home/lib2/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        
        <script>
            layui.use('upload', function(){
                var upload = layui.upload;
                
                //检测
                var uploadInsts = upload.render({
                    elem: '#test1' //绑定元素
                    ,url: 'updata_redis' //上传接口
                    ,accept: 'file'
                    ,exts: 'txt'
                    ,size:0
                    ,drag:true
                    ,method:'post'
                    ,auto: false //选择文件后不自动上传
                    ,data:{'type':'txt','bhv':'delection'}
                    ,bindAction: '#detection' //指向一个按钮触发上传
                    ,choose: function(obj){
                        //将每次选择的文件追加到文件队列
                        var files = obj.pushFile();
                        //预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
                        obj.preview(function(index, file, result){
                            $('#name').val(file.name);
                        });
                    }
                    ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                        layer.load(); //上传loading
                    }
                    ,done: function(res, index, upload){
                        layer.closeAll('loading'); //关闭loading
                        // var t = numbers($('#totle').html());
                        // var y = numbers($('#yes').html());
                        // var r = numbers($('#rephone').html());
                        // var n = numbers($('#no').html());
                        if(res.statu == 200){
                            $('#totle').html(res.msg.totle);
                            $('#yes').html(res.msg.successyes);
                            $('#rephone').html(res.msg.rephone);
                            $('#no').html(res.msg.no);
                            $('#time').html(res.msg.time);
                            $('#chong').html(res.msg.chong);
                            // layer.msg(res.tip);
                            layer.alert(res.tip, {icon: 6});
                        }else{
                            if(res.msg){
                                $('#totle').html(res.msg.totle);
                                $('#yes').html(res.msg.successyes);
                                $('#rephone').html(res.msg.rephone);
                                $('#no').html(res.msg.no);
                                $('#time').html(res.msg.time);
                                $('#chong').html(res.msg.chong);
                            }
                            layer.alert(res.tip, {icon: 5});
                            return false;
                        }
                    }
                    ,error: function(index, upload){
                        layer.closeAll('loading'); //关闭loading
                        layer.msg(res.tip);
                        return false;
                    }
                });
            });
        </script>
        <script>
            function upload_txt(){
                layer.load(2);
                $.ajax({
                    type: 'POST',
                    url: 'updata_redis',
                    dataType: 'json',
                    data:{'type':'txt','bhv':'upload'},
                    success: function(data){
                        if(data.statu == 200){
                            layer.closeAll('loading');
                            $('#succ').html(data.msg);
                            var c = '上传成功，共上传了' + data.msg +'条数据';
                            // $('#result').html(c);
                            layer.alert(c, {icon: 6});
                        }else{
                            layer.closeAll('loading');
                            layer.msg(data.tip);
                            return false;
                        }
                    },
                    error:function(data) {
                        layer.msg('系统错误');
                    },
                });
            }
        </script>
    </body>
</html>