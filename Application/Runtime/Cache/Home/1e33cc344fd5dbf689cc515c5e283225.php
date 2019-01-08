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
        <link rel="stylesheet" href="/Public/Home/lib2/layui/css/layui.css" media="all">
    </head>
    <body style="background-color: #f0f2f5">
        <style>
            .layui-fluid{margin-top: 20px;width: 98%;margin-left: 1%;background-color: white;padding: 0;}
            .layui-input{color: #666;font-weight: normal;}
        </style>
        <div class="layui-fluid">
            <div class="layui-card">
                <div class="x-body">
                <xblock style="background-color: white !important;margin: 0">
                      <?php if(in_array(($action_name["System_add"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><button class="layui-btn"  onclick="admin_add('添加商品','/Home/System/add','500','500')">
                            <i class="layui-icon">&#xe608;</i> 添 加
                        </button>
                      <?php else: ?>
                        <button class="layui-btn layui-btn-disabled-button">
                            <i class="layui-icon">&#xe608;</i> 添 加
                        </button><?php endif; ?>
                </xblock>
                <table class="layui-table">
                    <thead>
                        <tr>
                            <th width="90px">
                                月份
                            </th>
                            <th width="120px">
                                目标
                            </th>
                            <th width="90px">
                                已完成
                            </th>
                            <th width="90px">
                                完成度
                            </th>
                            <th>
                                进度
                            </th>
                            <th width="90px">
                                完成状态
                            </th>
                            <th width="300px">
                                对自己说
                            </th>
                            <th width="30px">操作</th>
                        </tr>
                    </thead>
                    <style>.layui-table td, .layui-table th{text-align: center;}</style>
                    <tbody>
                        <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                                <td>
                                    <?php echo ($v["month"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["aim"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["complete"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["avg"]); ?>
                                </td>
                                <td>
                                    <div class="layui-progress" lay-showpercent="true">
                                      <div class="layui-progress-bar" lay-percent="<?php echo ($v["avg"]); ?>"></div>
                                    </div>
                                </td>
                                <td>
                                    <?php if($v['complete'] > $v['aim']): ?>完成
                                        <?php else: ?>
                                        未完成<?php endif; ?>
                                </td>
                                <td>
                                    <?php echo ($v["note"]); ?>
                                </td>
                                <td class="td-manage">
                                    <?php if(in_array(($action_name["Role_del"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="删除" href="javascript:;" onclick="del_aim(this,'<?php echo ($v["id"]); ?>')"
                                           style="text-decoration:none;">
                                            <i class="layui-icon">&#xe640;</i>
                                        </a>
                                      <?php else: ?>
                                        <a title="删除" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                            <i class="layui-icon">&#xe640;</i>
                                        </a><?php endif; ?>
                                </td>
                            </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
                <div id="page" style="margin-bottom: 50px;"><?php echo ($page); ?></div>
              </div>
           </div>
        </div>

        <script src="/Public/Home/lib2/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        
        <script>
            layui.use(['element','layer'], function(){
                $ = layui.jquery;//jquery
                layer = layui.layer;//弹出层
            });
            /*添加*/
            function admin_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }
            /*删除*/
            function del_aim(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/System/del_aim',
                        dataType: 'json',
                        data:{'id':id},
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