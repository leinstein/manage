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
    </head>
    <body>
        <div class="x-body">
          <style>.layui-input{border: none;}</style>
            <form class="layui-form" action="#" method="post" id="form_p" onsubmit="return false">
              <input type="hidden" name="orderid" value="<?php echo ($data["oid"]); ?>">
              <input type="hidden" name="s_nid" value="<?php echo ($info["nid"]); ?>">
                <div class="layui-form-item">
                      <label for="class_name" class="layui-form-label">
                          <span class="x-red">*</span>客户姓名
                      </label>
                      <div class="layui-input-inline">
                          <input type="text"  name="" autocomplete="off" value="<?php echo ($data["customer_name"]); ?>" class="layui-input">
                      </div>
                </div>
                <div class="layui-form-item">
                      <label for="class_name" class="layui-form-label">
                          <span class="x-red">*</span>客户电话
                      </label>
                      <div class="layui-input-inline">
                          <input type="text"  name="" autocomplete="off" value="<?php echo ($data["customer_phone"]); ?>" class="layui-input">
                      </div>
                </div>
                <div class="layui-form-item layui-form-text">
                      <label for="note" class="layui-form-label">
                          回访记录
                      </label>
                      <div class="layui-input-block">
                          <textarea placeholder="请输入内容" style="width: 93%" lay-verify="note"  id="note" name="server_note" class="layui-textarea"><?php echo ($info["server_note"]); ?></textarea>
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
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8">
        </script>
        <!--<link rel="stylesheet" href="/Public/Home/lib2/layui/css/layui.css" media="all">-->
        <script>
            layui.use(['form','layer','element','layedit'], function(){
                $ = layui.jquery;
                var form = layui.form()
                    ,layer = layui.layer;
                var element = layui.element;
                var layedit = layui.layedit;

                //自定义验证规则
                form.verify({
                    note: function(value){
                        layedit.sync(editindex);
                    }
                });
                //富文本
                var editindex = layedit.build('note',{
                    height:100,
                    tool: [
                        'strong' //加粗
                        ,'italic' //斜体
                        ,'underline' //下划线
                        ,'del' //删除线
                        ,'|' //分割线
                        ,'left' //左对齐
                        ,'center' //居中对齐
                        ,'right' //右对齐
                    ]
                });
                
                //监听提交
                form.on('submit(add)', function(data){
                    var data = data.field;
                    console.log(data);
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Server/server',
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