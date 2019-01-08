<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>风暴CRM管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/Public/Home/css/font.css">
    <link rel="stylesheet" href="/Public/Home/lib2/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/Home/css/xadmin.css">
    <script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Home/lib2/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/Home/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-body">
        <form action="" method="post" class="layui-form layui-form-pane" onsubmit="return false">
                <div class="layui-form-item">
                        <span class="x-red">*</span>当前正在给<span style="font-size:25px; color:#009688;">【<?php echo ($roleinfo["name"]); ?>】</span>角色分配权限
                    <div class="layui-input-inline">
                        <input type="hidden" name="role_id" value="<?php echo ($roleinfo["id"]); ?>">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        拥有权限
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                            <?php if(is_array($authinfoA)): foreach($authinfoA as $key=>$v): ?><tr>
                                    <td width="130px">
                                        <input type="checkbox"  class="checkx" name="auth_id[]" lay-skin="primary" value="<?php echo ($v["auth_id"]); ?>" title="<?php echo ($v["auth_name"]); ?>" <?php if(in_array(($v["auth_id"]), is_array($roleinfo["role_auth_ids"])?$roleinfo["role_auth_ids"]:explode(',',$roleinfo["role_auth_ids"]))): ?>checked<?php endif; ?>>
                                    </td>
                                    <td>
                                        <div class="layui-input-block">
                                            <?php if(is_array($authinfoB)): foreach($authinfoB as $key=>$vv): ?><div>
                                                    <?php if(($vv["auth_pid"]) == $v["auth_id"]): ?><input name="auth_id[]" lay-skin="primary" type="checkbox" title="<?php echo ($vv["auth_name"]); ?>" class="checkp" value="<?php echo ($vv["auth_id"]); ?>" <?php if(in_array(($vv["auth_id"]), is_array($roleinfo["role_auth_ids"])?$roleinfo["role_auth_ids"]:explode(',',$roleinfo["role_auth_ids"]))): ?>checked<?php endif; ?>><?php endif; ?>
                                                    <?php if(is_array($authinfoC)): foreach($authinfoC as $key=>$vvv): if(($v["auth_id"]) == $vv["auth_pid"]): if(($vv["auth_id"]) == $vvv["auth_pid"]): ?><input name="auth_id[]" lay-skin="primary" type="checkbox" title="<?php echo ($vvv["auth_name"]); ?>" class="checkp" value="<?php echo ($vvv["auth_id"]); ?>" <?php if(in_array(($vvv["auth_id"]), is_array($roleinfo["role_auth_ids"])?$roleinfo["role_auth_ids"]:explode(',',$roleinfo["role_auth_ids"]))): ?>checked<?php endif; ?>><?php endif; endif; endforeach; endif; ?>
                                                </div><?php endforeach; endif; ?>
                                        </div>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="add">增加</button>
              </div>
            </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          //自定义验证规则
          form.verify({
            nikename: function(value){
              if(value.length < 5){
                return '昵称至少得5个字符啊';
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
                      }else if(data.statu == 203){
                          layer.alert(data.msg, {icon: 2},function () {
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
  </body>
</html>