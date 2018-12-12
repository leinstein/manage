<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            风暴网络科技
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
            <form class="layui-form x-center" action="" method="post" style="width:80%">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">
                    <label class="layui-form-label">日期范围</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="stat_date" placeholder="开始日" id="LAY_demorange_s">
                    </div>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="stop_date" placeholder="截止日" id="LAY_demorange_e">
                    </div>
                    <div class="layui-input-inline">
                      <input type="text" name="username"  placeholder="请输入姓名" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>

                    </div>
                    <div class="layui-input-inline">
                        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
                    </div>
                  </div>
                </div> 
            </form>
            <xblock><button class="layui-btn" onclick="admin_add('添加用户','add','600','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：<?php echo ($count); ?> 条</span></xblock>
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
                            最后登陆时间
                        </th>
                        <th>
                            最后登陆IP
                        </th>
                        <th>
                            状态
                        </th>
                        <th>
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
                                <?php if($v['status'] == '1' ): ?><a style="text-decoration:none" onclick="admin_stop(this,'<?php echo ($v["id"]); ?>')" href="javascript:;" title="停用">
                                            <i class="layui-icon">&#xe601;</i>
                                        </a>
                                    <?php else: ?>
                                        <a style="text-decoration:none" onClick="admin_start(this,'<?php echo ($v["id"]); ?>')" href="javascript:;" title="启用">
                                            <i class="layui-icon">&#xe62f;</i>
                                        </a><?php endif; ?>
                                <a title="编辑" href="javascript:;" onclick="admin_edit('编辑','edit','<?php echo ($v["id"]); ?>','','510')"
                                class="ml-5" style="text-decoration:none">
                                    <i class="layui-icon">&#xe642;</i>
                                </a>
                                <a style="text-decoration:none"  onclick="admin_group('划分项目组','group','<?php echo ($v["role_id"]); ?>','470','300','<?php echo ($v["id"]); ?>')"
                                   href="javascript:;" title="划分项目组">
                                <i class="layui-icon">&#xe631;</i>
                                </a>
                                <a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo ($v["id"]); ?>')"
                                style="text-decoration:none">
                                    <i class="layui-icon">&#xe640;</i>
                                </a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <div id="page"><?php echo ($page); ?></div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script>
            layui.use(['laydate','element','laypage','layer'], function(){
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

            //批量删除提交
            function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                    //捉到所有被选中的，发异步进行删除
                    layer.msg('删除成功', {icon: 1});
                });
            }
            /*添加*/
            function admin_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }

            /*划分*/
            function admin_group(title,url,role_id,w,h,id){
                url = url + '?id='+id + '&role_id=' + role_id;
                x_admin_show(title,url,w,h);
            }

            /*停用*/
            function admin_stop(obj,id){
                layer.confirm('确认要停用吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: 'stop',
                        dataType: 'json',
                        data:{'id':id},
                        success: function(data){
                            if(data.statu == 200){
                                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="admin_start(this,id)" href="javascript:;" title="启用"><i class="layui-icon">&#xe62f;</i></a>');
                                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-warm layui-btn-mini">已停用</span>');
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
                        url: 'start',
                        dataType: 'json',
                        data:{'id':id},
                        success: function(data){
                            if(data.statu == 200){
                                //发异步把用户状态进行更改
                                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="admin_stop(this,id)" href="javascript:;" title="停用"><i class="layui-icon">&#xe601;</i></a>');
                                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>');
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
                        url: 'del',
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