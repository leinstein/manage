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
            <style>.td-manage a{ margin-left: 10px; }
            </style>
            <xblock>
                  <?php if(in_array(($action_name["Admin_add_group"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><button class="layui-btn" onclick="admin_add('添加分组','/Home/Admin/add_group','600','400')"><i class="layui-icon">&#xe608;</i>添加</button>
                  <?php else: ?>
                        <button class="layui-btn layui-btn-disabled-button"><i class="layui-icon">&#xe608;</i>添加</button><?php endif; ?>
                <span class="x-right" style="line-height:40px">共有数据：<?php echo ($count); ?> 条</span></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            序号
                        </th>
                        <th>
                            组名
                        </th>
                        <th>
                            组员
                        </th>
                        <th>
                            描述
                        </th>
                        <th>
                            销售组
                        </th>
                        <th>
                            创建时间
                        </th>
                        <th width="70px">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                            <td>
                                <?php echo ++$i;?>
                            </td>
                            <td>
                                <?php echo ($v["group_name"]); ?>
                            </td>
                            <td>
                               <?php echo ($v["team"]); ?>
                            </td>
                            <td>
                               <?php echo ($v["remark"]); ?>
                            </td>
                            <td>
                               <?php echo ($v["issale"]); ?>
                            </td>
                             <td>
                                <?php echo (date('Y-m-d',$v["create_time"])); ?>
                            </td>
                            <td class="td-manage">
                                <?php if(in_array(($action_name["Admin_edit_group"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="编辑" href="javascript:;" onclick="admin_edit('编辑','/Home/Admin/edit_group','<?php echo ($v["group_id"]); ?>','','400')" class="ml-5" style="text-decoration:none">
                                            <i class="layui-icon">&#xe642;</i>
                                        </a>
                                  <?php else: ?>
                                    <a title="编辑" href="javascript:;"  class="ml-5 layui-btn-disabled-button" style="text-decoration:none">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Admin_del_group"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo ($v["group_id"]); ?>')"
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
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script>
            layui.use(['element','layer'], function(){
                $ = layui.jquery;//jquery
                layer = layui.layer;//弹出层
                
            });

           
            /*添加*/
            function admin_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }
            //编辑
            function admin_edit (title,url,id,w,h) {
                url = url+'?group_id='+id;
                x_admin_show(title,url,w,h);
            }
            /*删除*/
            function admin_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Admin/del_group',
                        dataType: 'json',
                        data:{'group_id':id},
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