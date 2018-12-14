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
            <form class="layui-form" action="#" method="post" onsubmit="return false">
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>登录名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="username" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>将会成为您唯一的登入名
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="nickname" class="layui-form-label">
                        <span class="x-red">*</span>姓名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="nickname" name="nickname" required="" lay-verify="required"
                               autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>填写真是姓名
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="phone" class="layui-form-label">
                        <span class="x-red">*</span>手机
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="phone" name="phone" required="" lay-verify="phone"
                               autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>填写手机号码
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="role" class="layui-form-label">
                        <span class="x-red">*</span>角色
                    </label>
                    <div class="layui-input-inline">
                      <select name="role">
                        <option value="">请选择角色</option>
                            <?php if(is_array($role)): foreach($role as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
                      </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_pass" name="pass" required="" lay-verify="pass"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        6到16个字符
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                        <span class="x-red">*</span>确认密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_repass" name="repass" required="" lay-verify="repass"
                        autocomplete="off" class="layui-input">
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
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;
            
              //自定义验证规则
              form.verify({
                  nickname: function(value){
                  if(value.length < 2){
                    return '姓名必须大于两个字';
                  }
                }
                ,pass: [/(.+){6,12}$/, '密码必须6到12位']
                ,repass: function(value){
                    if($('#L_pass').val()!=$('#L_repass').val()){
                        return '两次密码不一致';
                    }
                }
              });

              //监听提交
              form.on('submit(add)', function(data){
                  var data = data.field;
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