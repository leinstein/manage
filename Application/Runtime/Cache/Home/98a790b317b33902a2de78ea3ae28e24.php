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
            <xblock><button class="layui-btn" onclick="role_add('添加角色','add.html','500','400')"><i class="layui-icon">&#xe608;</i>添加</button>
            <div class="layui-input-inline">
                <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 200px"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
            </div>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            序号
                        </th>
                        <th>
                            角色名
                        </th>
                        <th>
                            描述
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                            <td>
                                <?php $i++;echo $i; ?>
                            </td>
                            <td>
                                <?php echo ($v["name"]); ?>
                            </td>
                            <td >
                                <?php echo ($v["description"]); ?>
                            </td>
                            <td class="td-manage">
                                <a title="分配权限" href="javascript:;" onclick="role_distribution('分配权限','distribution.html','1000','700','<?php echo ($v["id"]); ?>')"
                                   class="ml-5" style="text-decoration:none">
                                    <i class="layui-icon">&#xe614;</i>
                                </a>
                                <a title="编辑" href="javascript:;" onclick="role_edit('编辑','edit','<?php echo ($v["id"]); ?>','510','400')"
                                class="ml-5" style="text-decoration:none">
                                    <i class="layui-icon">&#xe642;</i>
                                </a>
                                <a title="删除" href="javascript:;" onclick="role_del(this,'<?php echo ($v["id"]); ?>')"
                                style="text-decoration:none">
                                    <i class="layui-icon">&#xe640;</i>
                                </a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>

            <div id="page"></div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
              laydate = layui.laydate;//日期插件
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层

              //以上模块根据需要引入
            });

            /*删除*/
            function role_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    var role_id = id;
                    $.ajax({
                        type: 'POST',
                        url: 'del',
                        dataType: 'json',
                        data:{'role_id':role_id},
                        success: function(data){
                            if(data.statu == 200){
                                $(obj).parents("tr").remove();
                                layer.msg(data.msg,{icon:1,time:1000});
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
             /*添加*/
            function role_add(title,url,w,h,id){
                x_admin_show(title,url,w,h,id);
            }
            
            /*分配*/
            function role_distribution(title,url,w,h,id){
                url = url+'?role_id='+id;
                x_admin_show(title,url,w,h);
            }

             
            //编辑
            function role_edit (title,url,id,w,h) {
                url = url+'?role_id='+id;
                x_admin_show(title,url,w,h);
            }
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