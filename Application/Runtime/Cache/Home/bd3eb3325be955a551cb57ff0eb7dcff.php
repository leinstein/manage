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
            <xblock>
                <?php if(in_array(($action_name["Admin_add"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><button class="layui-btn layui-btn-danger size_btn"  onclick="delAll('清空记录','/Home/Admin/del_all_work')"><i class="layui-icon">&#xe608;</i>清空记录</button>
                  <?php else: ?>
                    <button class="layui-btn layui-btn-disabled-button size_btn"><i class="layui-icon">&#xe608;</i>清空记录</button><?php endif; ?>
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

            //批量删除提交
            function delAll (title,url) {
                layer.confirm('确认要删除所有记录吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        success: function(data){
                            if(data.statu == 200){
                                layer.msg(data.msg, {icon: 1});
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