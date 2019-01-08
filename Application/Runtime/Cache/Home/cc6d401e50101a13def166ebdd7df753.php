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
    <style>.td-manage a{margin-left: 10px;}</style>
    <body>
        <div class="x-body">
            <xblock>
                <?php if(in_array(($action_name["Auth_add"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><button class="layui-btn" onclick="admin_add('添加权限','/Home/Auth/add','600','500')"><i class="layui-icon">&#xe608;</i>添加权限</button>
                <?php else: ?>
                    <button class="layui-btn layui-btn-disabled-button"><i class="layui-icon">&#xe608;</i>添加权限</button><?php endif; ?>
                <span class="x-right" style="line-height:40px">共有数据：<?php echo ($count); ?> 条</span>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="30px">
                            序号
                        </th>
                        <th>
                            权限规则
                        </th>
                        <th>
                            权限名称
                        </th>
                        <th width="65px">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody id="x-link">
                    <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                            <td>
                                <?php echo ++$i;?>
                            </td>
                            <td>
                                <?php echo ($v["rule"]); ?>
                            </td>
                            <td>
                                <?php echo str_repeat('&nbsp;',$v['level']*10);?>┝ <?php echo ($v["auth_name"]); ?>
                            </td>
                            <td class="td-manage">
                                <?php if(in_array(($action_name["Auth_edit"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="编辑" href="javascript:;" onclick="rule_edit('编辑','/Home/Auth/edit','<?php echo ($v["auth_id"]); ?>','600','500')"
                                       class="ml-5" style="text-decoration:none">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                <?php else: ?>
                                   <a title="编辑" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="text-decoration:none">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Auth_del"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="删除" href="javascript:;" onclick="rule_del(this,'<?php echo ($v["auth_id"]); ?>')"
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

            <div id="page"></div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['element','layer','form'], function(){
                $ = layui.jquery;//jquery
              lement = layui.element();//面包导航
              layer = layui.layer;//弹出层
              form = layui.form();//弹出层
            })

            /*添加*/
            function admin_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }

            
            //-编辑
            function rule_edit (title,url,id,w,h) {
                url = url + '?auth_id=' + id;
                x_admin_show(title,url,w,h);
            }
            
            /*删除*/
            function rule_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    var auth_id = id;
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Auth/del',
                        dataType: 'json',
                        data:{'auth_id':auth_id},
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
            </script>
    </body>
</html>