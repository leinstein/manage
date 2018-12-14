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
                <input type="hidden" name="admin_id" value="<?php echo ($admin_id); ?>">
                <div class="layui-form-item">
                    <label for="role" class="layui-form-label">
                        <span class="x-red">*</span>当前角色
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" value="<?php echo ($role_name); ?>" readonly="readonly" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="role" class="layui-form-label">
                        <span class="x-red">*</span>新角色
                    </label>
                    <div class="layui-input-inline">
                      <select name="role_id">
                        <option value="">请选择角色</option>
                            <?php if(is_array($role)): foreach($role as $key=>$v): if($info['role_id'] == $v['id'] ): ?><option value="<?php echo ($v["id"]); ?>" selected="selected"><?php echo ($v["name"]); ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endif; endforeach; endif; ?>
                      </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="add" lay-submit="">
                        划分
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