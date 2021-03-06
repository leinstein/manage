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
    </head>
    <body>
        <div class="x-body">
            <form class="layui-form x-center" action="" method="post" style="width:50%">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">
                    <label class="layui-form-label">日期范围</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="stat_date" placeholder="开始日" id="LAY_demorange_s" autocomplete="off">
                    </div>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="stop_date" placeholder="截止日" id="LAY_demorange_e" autocomplete="off">
                    </div>
                    <div class="layui-input-inline">
                      <input type="text" name="word"  placeholder="模糊搜索" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>

                    </div>
                  </div>
                </div> 
            </form>
            <style>.td-manage a{margin-left: 10px;}</style>
            <xblock>
                  <?php if(in_array(($action_name["Admin_add"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><button class="layui-btn" onclick="admin_add('添加用户','/Home/Admin/add','600','530')"><i class="layui-icon">&#xe608;</i>添加</button>
                  <?php else: ?>
                    <button class="layui-btn layui-btn-disabled-button"><i class="layui-icon">&#xe608;</i>添加</button><?php endif; ?>
                  <span class="x-right" style="line-height:40px">共有数据：<?php echo ($count); ?> 条</span>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            序号
                        </th>
                        <th>
                            登录名
                        </th>
                        <th>
                            姓名
                        </th>
                        <th>
                            头像
                        </th>
                        <th>
                            手机
                        </th>
                        <th>
                            角色
                        </th>
                        <th>
                            分组名
                        </th>
                        <th>
                            最后登陆时间
                        </th>
                        <th>
                            最后登陆IP
                        </th>
                        <th>
                            状态
                        </th>
                        <th width="130px">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
                            <td>
                                <?php $i++;echo $i; ?>
                            </td>
                            <td>
                                <?php echo ($v["username"]); ?>
                            </td>
                            <td>
                               <?php echo ($v["nickname"]); ?>
                            </td>
                             <td align="center" valign="middle">
                                <img  src="<?php echo ($v["img_small"]); ?>" width="40" alt="">
                            </td>
                            <td >
                                <?php echo ($v["mobile"]); ?>
                            </td>
                            <td >
                                <?php echo ($v["role_name"]); ?>
                            </td>
                            <td >
                                <?php echo ($v["group_name"]); ?>
                            </td>
                            <td>
                                <?php if($v['last_login_time'] != '0' ): echo (date("Y-m-d H:i:s",$v["last_login_time"])); ?>
                                    <?php else: ?>
                                        未登录<?php endif; ?>
                            </td>
                            <td >
                                <?php echo ($v["signup_ip"]); ?>
                            </td>
                            <td class="td-status">
                                <?php if($v['status'] == '1' ): ?><span class="layui-btn layui-btn-mini">已启用</span>
                                    <?php else: ?>
                                        <span class="layui-btn layui-btn-danger layui-btn-mini">已停用</span><?php endif; ?>
                            </td>
                            <td class="td-manage">
                                <?php if(in_array(($action_name["Admin_stop"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): if($v['status'] == '1' ): ?><a style="text-decoration:none" onclick="admin_stop(this,'<?php echo ($v["id"]); ?>')" href="javascript:;" title="停用">
                                            <i class="layui-icon">&#xe601;</i>
                                        </a>
                                        <?php else: ?>
                                            <a style="text-decoration:none" onClick="admin_start(this,'<?php echo ($v["id"]); ?>')" href="javascript:;" title="启用">
                                                <i class="layui-icon">&#xe62f;</i>
                                            </a><?php endif; ?>
                                  <?php else: ?>
                                    <a style="text-decoration:none" class="layui-btn-disabled-button" href="javascript:;" title="停用">
                                        <i class="layui-icon">&#xe601;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Admin_edit"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="编辑" href="javascript:;" onclick="admin_edit('编辑','/Home/Admin/edit','<?php echo ($v["id"]); ?>','','510')"
                                       class="ml-5" style="text-decoration:none">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                  <?php else: ?>
                                    <a title="编辑" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="text-decoration:none">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Admin_group"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a style="text-decoration:none"  onclick="admin_group('划分项目组','/Home/Admin/group','<?php echo ($v["role_id"]); ?>','470','400','<?php echo ($v["id"]); ?>','<?php echo ($v["group_id"]); ?>')"
                                       href="javascript:;" title="划分项目组">
                                        <i class="layui-icon">&#xe631;</i>
                                    </a>
                                  <?php else: ?>
                                    <a style="text-decoration:none" href="javascript:;" class="ml-5 layui-btn-disabled-button" title="划分项目组">
                                        <i class="layui-icon">&#xe631;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Admin_del"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo ($v["id"]); ?>')"
                                       style="text-decoration:none">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                  <?php else: ?>
                                    <a title="删除" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="text-decoration:none">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a><?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <div id="page" style="margin-bottom: 50px;margin-top: 20px"><?php echo ($page); ?></div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script>
            layui.use(['laydate','element','layer'], function(){
                $ = layui.jquery;//jquery
                laydate = layui.laydate;//日期插件
                layer = layui.layer;//弹出层
                
                var start = {
                    istoday: false
                    ,choose: function(datas){
                        end.min = datas; //开始日选好后，重置结束日的最小日期
                        end.start = datas //将结束日的初始值设定为开始日
                    }
                };

                var end = {
                    istoday: false
                    ,choose: function(datas){
                        start.max = datas; //结束日选好后，重置开始日的最大日期
                    }
                };

                document.getElementById('LAY_demorange_s').onclick = function(){
                    start.elem = this;
                    laydate(start);
                }
                document.getElementById('LAY_demorange_e').onclick = function(){
                    end.elem = this
                    laydate(end);
                }

            });
            
            /*添加*/
            function admin_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }

            /*划分*/
            function admin_group(title,url,role_id,w,h,id,group_id){
                url = url + '?id='+id + '&role_id=' + role_id + '&group_id=' + group_id;
                x_admin_show(title,url,w,h);
            }

            /*停用*/
            function admin_stop(obj,id){
                layer.confirm('确认要停用吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Admin/stop',
                        dataType: 'json',
                        data:{'id':id},
                        success: function(data){
                            if(data.statu == 200){
                                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="admin_start(this,id)" href="javascript:;" title="启用"><i class="layui-icon">&#xe62f;</i></a>');
                                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-danger layui-btn-mini">已停用</span>');
                                $(obj).remove();
                                layer.msg('已停用!',{icon: 5,time:1000});
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
            }

            /*启用*/
            function admin_start(obj,id){
                layer.confirm('确认要启用吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Admin/start',
                        dataType: 'json',
                        data:{'id':id},
                        success: function(data){
                            if(data.statu == 200){
                                //发异步把用户状态进行更改
                                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="admin_stop(this,id)" href="javascript:;" title="停用"><i class="layui-icon">&#xe601;</i></a>');
                                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-mini">已启用</span>');
                                $(obj).remove();
                                layer.msg('已启用!',{icon: 6,time:1000});
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
            }
            //编辑
            function admin_edit (title,url,id,w,h) {
                url = url+'?id='+id;
                x_admin_show(title,url,w,h);
            }
            /*删除*/
            function admin_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Admin/del',
                        dataType: 'json',
                        data:{'id':id},
                        success: function(data){
                            if(data.statu == 200){
                                $(obj).parents("tr").remove();
                                layer.msg('已删除!',{icon:1,time:1000});
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
            }
            </script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
    </body>
</html>