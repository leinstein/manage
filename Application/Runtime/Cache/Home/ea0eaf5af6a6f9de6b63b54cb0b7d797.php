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
                <input type="hidden" name="group_id" value="<?php echo ($info["group_id"]); ?>">
                <div class="layui-form-item">
                    <label for="group_name" class="layui-form-label">
                        <span class="x-red">*</span>组名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="group_name" name="group_name" value="<?php echo ($info["group_name"]); ?>" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>组名或项目名
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否销售组</label>
                    <div class="layui-input-block">
                        <?php if($info['issale'] == '是'): ?><input type="radio" name="issale" value="是" title="是" checked>
                        <?php else: ?>
                            <input type="radio" name="issale" value="是" title="是"><?php endif; ?>
                        <?php if($info['issale'] == '否'): ?><input type="radio" name="issale" value="否" title="否" checked>
                        <?php else: ?>
                            <input type="radio" name="issale" value="否" title="否"><?php endif; ?>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                      <label for="remark" class="layui-form-label">
                          描述
                      </label>
                      <div class="layui-input-block">
                          <textarea placeholder="请输入分组说明" id="remark" name="remark" class="layui-textarea"><?php echo ($info["remark"]); ?></textarea>
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

              //监听提交
              form.on('submit(add)', function(data){
                  var data = data.field;
                  $.ajax({
                      type: 'POST',
                      url: '/Home/Admin/edit_group',
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