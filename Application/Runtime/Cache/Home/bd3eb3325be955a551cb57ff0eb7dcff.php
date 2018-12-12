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
            <form class="layui-form x-center" action="" method="" style="width:80%">
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
            <xblock>
                <div class="layui-input-inline">
                    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 20px;padding: 2px 4px"  href="/Home/Admin/work" title="首页">
                    <img src="/Public/Home/images/indexw.png" style="vertical-align: baseline;width: 27px;height: 27px">
                    </a>
                    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 20px"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
                </div>
                <span class="x-right" style="line-height:40px">共有数据：<?php echo ($count); ?> 条</span>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            序号
                        </th>
                        <th>
                            姓名
                        </th>
                        <th>
                            登陆状态
                        </th>
                        <th>
                            IP
                        </th>
                        <th>
                            地域
                        </th>
                        <th>
                            操作状态
                        </th>
                        <th>
                            操作时间
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
                            <td>
                                <?php echo ++$i;?>
                            </td>
                            <td>
                               <?php echo ($v["loginnickname"]); ?>
                            </td>
                            <td >
                                <?php if($v['loginstatus'] == 1): ?>用户【<?php echo ($v["loginname"]); ?>】登陆成功<?php endif; ?>
                                <?php if($v['loginstatus'] == 2): ?>用户【<?php echo ($v["loginname"]); ?>】登陆失败：<?php echo ($v["errorinfo"]); endif; ?>
                            </td>
                            <td >
                                <?php echo ($v["ip"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["city"]); ?>
                            </td>
                            <td>
                                <?php if($v['loginstatus'] == 1): ?>操作成功<?php endif; ?>
                                <?php if($v['loginstatus'] == 2): ?><font color="red">操作失败</font><?php endif; ?>
                            </td>
                            <td>
                                <?php echo (date('Y-m-d H:i:s',$v["logintime"])); ?>
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