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
                <input type="hidden" name="auth_id" value="<?php echo ($info["auth_id"]); ?>">
                <div class="layui-form-item">
                    <label for="auth_level" class="layui-form-label">
                        <span class="x-red">*</span>权限类别
                    </label>
                    <div class="layui-input-inline">
                      <select name="auth_level">
                        <option value="">请选择类别</option>
                            <option value="1">添加菜单</option>
                            <option value="2">添加栏目</option>
                            <option value="3">添加按钮</option>
                      </select>
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>权限类别
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="auth_pid" class="layui-form-label">
                        <span class="x-red">*</span>上级权限
                    </label>
                    <div class="layui-input-inline">
                      <select name="auth_pid">
                        <option value="0">请选择上级</option>
                            <?php if(is_array($authinfo)): foreach($authinfo as $key=>$v): if($info['auth_id'] == $v['auth_id'] ): ?><option value="<?php echo ($v["auth_id"]); ?>" selected="selected"><?php echo str_repeat('&nbsp;',$v['level']*10);?>┝ <?php echo ($v["auth_name"]); ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo ($v["auth_id"]); ?>"><?php echo str_repeat('&nbsp;',$v['level']*10);?>┝ <?php echo ($v["auth_name"]); ?></option><?php endif; endforeach; endif; ?>
                      </select>
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>如果添加新菜单则不选
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="auth_name" class="layui-form-label">
                        <span class="x-red">*</span>权限名称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="auth_name" name="auth_name" value="<?php echo ($info["auth_name"]); ?>" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>权限名称
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="auth_c" class="layui-form-label">
                        <span class="x-red">*</span>控制器
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="auth_c" name="auth_c" value="<?php echo ($info["auth_c"]); ?>" required="" lay-verify="required"
                               autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>控制器名
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="auth_a" class="layui-form-label">
                        <span class="x-red">*</span>方法
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="auth_a" name="auth_a" value="<?php echo ($info["auth_a"]); ?>" required="" lay-verify="required"
                               autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>方法名
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="add" lay-submit="">
                        保存更新
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