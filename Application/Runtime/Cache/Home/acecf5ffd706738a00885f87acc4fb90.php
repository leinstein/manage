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
        <link rel="stylesheet" href="/Public/Home/laydate/theme/default/laydate.css">
    </head>
    <body>
        <div class="x-body">
            <form class="layui-form" action="#" method="post" id="form_p" onsubmit="return false">
                <div class="layui-form-item">
                      <label for="month" class="layui-form-label">
                          <span class="x-red">*</span>选择月份
                      </label>
                      <div class="layui-input-inline">
                              <input class="layui-input" name="month" value="" placeholder="月份" id="LAY_demorange_s" autocomplete="off">
                      </div>
                </div>
                <div class="layui-form-item">
                    <label for="aim" class="layui-form-label">
                        <span class="x-red">*</span>业绩目标
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="aim" name="aim" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                      <label for="note" class="layui-form-label">
                          对自己说
                      </label>
                      <div class="layui-input-block">
                          <textarea placeholder="" style="width: 93%"  id="note" name="note" class="layui-textarea"></textarea>
                      </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="add" lay-submit="">
                        增加
                    </button>
                </div>
            </form>
        </div>
        </div>
        <script src="/Public/Home/lib2/layui/layui.js" charset="utf-8">
        </script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
                var form = layui.form
                ,layer = layui.layer;
                
              //监听提交
              form.on('submit(add)', function(data){
                  var data = data.field;
                  console.log(data);
                  $.ajax({
                      type: 'POST',
                      url: '',
                      dataType: 'json',
                      data:data,
                      success: function(data){
                          if(data.statu == 200){
                              layer.alert(data.msg, {icon: 6},function () {
                                  // 获得frame索引
                                  var index = parent.layer.getFrameIndex(window.name);
                                  //关闭当前frame
                                  parent.layer.close(index);
                                  //刷新父页面
                                  window.parent.location.reload();
                              });
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
            });
        </script>
    <script>
        layui.use(['laydate'], function(){
            $ = layui.jquery;//jquery
            laydate = layui.laydate;//日期插件

            //年月选择器
            laydate.render({
                elem: '#LAY_demorange_s'
                ,type: 'month'
            });
        });
    </script>
    </body>
</html>