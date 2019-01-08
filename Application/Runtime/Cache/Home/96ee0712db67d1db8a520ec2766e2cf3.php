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
            <form class="layui-form x-center form-width" action="">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item" style="width: 120%">
                    <label class="layui-form-label">日期范围</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="stat_date" placeholder="开始日" id="LAY_demorange_s"  autocomplete="off">
                    </div>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="stat_date" placeholder="截止日" id="LAY_demorange_e"  autocomplete="off">
                    </div>
                    <div class="layui-input-inline">
                      <input type="text" name="name"  placeholder="模糊搜索" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:120px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>
                    </div>
                  </div>
                </div> 
            </form>
            <xblock>
                <div class="layui-input-inline">
                    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 20px;padding: 2px 4px"  href="/Home/Customer/backlog" title="首页">
                    <img src="/Public/Home/images/indexw.png" style="vertical-align: baseline;width: 27px;height: 27px">
                    </a>
                </div>
                <span class="x-right" style="line-height:40px">全部：
                    <a title="查看历史任务"  href="/Home/Customer/backlog?day=history">
                       <?php echo ($statistical["history"]); ?>
                    </a>
                </span>
                <span class="x-right" style="line-height:40px">明天：
                    <a title="查看明日任务"  href="/Home/Customer/backlog?day=tomorrow">
                        <?php echo ($statistical["tomorrow"]); ?>
                    </a>
                </span>
                <span class="x-right" style="line-height:40px">今天待完成：
                    <a title="查看今日待完成"  href="/Home/Customer/backlog?day=undo_today">
                        <?php echo ($statistical["undo_today"]); ?>
                    </a>
                </span>
                <span class="x-right" style="line-height:40px">今天已完成：
                    <a title="查看今日已完成"  href="/Home/Customer/backlog?day=ready_today">
                        <?php echo ($statistical["ready_today"]); ?>
                    </a>
                </span>
                <span class="x-right" style="line-height:40px">今天：
                    <a title="查看今日任务"  href="/Home/Customer/backlog?day=today">
                        <?php echo ($statistical["today"]); ?>
                    </a>
                </span>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="30px">
                            序号
                        </th>
                        <th width="60px">
                            客户姓名
                        </th>
                        <th>
                            任务内容
                        </th>
                        <th>
                            处理结果
                        </th>
                        <th width="60px">
                            任务类型
                        </th>
                        <th width="60px">
                            执行状态
                        </th>
                        <th width="90px">
                            执行时间
                        </th>
                        <th width="90px">
                            添加时间
                        </th>
                        <th width="60px">
                            执行人
                        </th>
                        <th  width="90px">
                            操作
                        </th>
                    </tr>
                </thead>
                <style>.layui-table td, .layui-table th{text-align: center;}</style>
                <tbody>
                    <?php if($infotoday != ''): ?><tr><td  colspan="12" class="bg_tr">今天</td></tr><?php endif; ?>
                    <?php if(is_array($infotoday)): foreach($infotoday as $key=>$v): ?><tr <?php if($v['status'] == 2): ?>style="color:red"<?php endif; ?>>
                            <td width="30px">
                                <?php echo ++$i;?>
                            </td>
                            <td >
                                <?php echo ($v["name"]); ?>
                            </td>
                            <td  class="note_text" style="text-align: left">
                                <?php echo ($v["content"]); ?>
                            </td>
                            <td  class="note_text" style="text-align: left">
                                <?php echo ($v["recontent"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["type"]); ?>
                            </td>
                             <td >
                                <?php if($v['status'] == 1): ?><font color="#006400">进行中</font><?php endif; ?>
                                <?php if($v['status'] == 2): ?><font color="red">已完成</font><?php endif; ?>
                                <?php if($v['status'] == 3): ?><font color="silver">已取消</font><?php endif; ?>
                            </td>
                            <td>
                                <?php echo (date("Y-m-d",$v["do_time"])); ?>
                            </td>
                            <td>
                                <?php echo (date("Y-m-d",$v["create_time"])); ?>
                            </td>
                            <td width="">
                                <?php echo ($v["nickname"]); ?>
                            </td>
                            <td class="td-manage">
                                <?php if(in_array(($action_name["Customer_addbacklog"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="添加待办任务" href="javascript:;" onclick="member_edit('添加待办任务','/Home/Customer/addbacklog','<?php echo ($v["cid"]); ?>','1000','700')" class="ml-5" style="text-decoration:none;">
                                        <i class="layui-icon">&#xe609;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="添加待办任务" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="text-decoration:none;">
                                        <i class="layui-icon">&#xe609;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Customer_editbacklog"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="处理待办任务" href="javascript:;" onclick="member_edit('处理待办任务','/Home/Customer/editbacklog','<?php echo ($v["bid"]); ?>','1000','700')"
                                       class="ml-5" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="处理待办任务" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Customer_del"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="删除待办" href="javascript:;" onclick="member_del(this,'<?php echo ($v["bid"]); ?>')"
                                       style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="删除待办" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a><?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    <?php if($infoyestoday != ''): ?><tr><td  colspan="12"  class="bg_tr">昨天</td></tr><?php endif; ?>
                    <?php if(is_array($infoyestoday)): foreach($infoyestoday as $key=>$v): ?><tr <?php if($v['status'] == 2): ?>style="color:red"<?php endif; ?>>
                            <td width="30px">
                                <?php echo ++$i;?>
                            </td>
                            <td >
                                <?php echo ($v["name"]); ?>
                            </td>
                            <td  class="note_text" style="text-align: left">
                                <?php echo ($v["content"]); ?>
                            </td>
                            <td  class="note_text" style="text-align: left">
                                <?php echo ($v["recontent"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["type"]); ?>
                            </td>
                             <td >
                                <?php if($v['status'] == 1): ?><font color="#006400">进行中</font><?php endif; ?>
                                <?php if($v['status'] == 2): ?><font color="red">已完成</font><?php endif; ?>
                                <?php if($v['status'] == 3): ?><font color="silver">已取消</font><?php endif; ?>
                            </td>
                            <td>
                                <?php echo (date("Y-m-d",$v["do_time"])); ?>
                            </td>
                            <td>
                                <?php echo (date("Y-m-d",$v["create_time"])); ?>
                            </td>
                            <td width="">
                                <?php echo ($v["nickname"]); ?>
                            </td>
                            <td class="td-manage">
                                <?php if(in_array(($action_name["Customer_addbacklog"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="添加待办任务" href="javascript:;" onclick="member_edit('添加待办任务','/Home/Customer/addbacklog','<?php echo ($v["cid"]); ?>','1000','700')" class="ml-5" style="text-decoration:none;">
                                        <i class="layui-icon">&#xe609;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="添加待办任务" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="text-decoration:none;">
                                        <i class="layui-icon">&#xe609;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Customer_editbacklog"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="处理待办任务" href="javascript:;" onclick="member_edit('处理待办任务','/Home/Customer/editbacklog','<?php echo ($v["bid"]); ?>','1000','700')"
                                       class="ml-5" style="text-decoration:none;text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="处理待办任务" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Customer_del"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="删除待办" href="javascript:;" onclick="member_del(this,'<?php echo ($v["bid"]); ?>')"
                                       style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="删除待办" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a><?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                        <?php if($infot != ''): ?><tr><td  colspan="12" class="bg_tr">昨天以前</td></tr><?php endif; ?>
                    <?php if(is_array($infot)): foreach($infot as $key=>$v): ?><tr <?php if($v['status'] == 2): ?>style="color:red"<?php endif; ?>>
                            <td width="30px">
                                <?php echo ++$i;?>
                            </td>
                            <td >
                                <?php echo ($v["name"]); ?>
                            </td>
                            <td  class="note_text" style="text-align: left">
                                <?php echo ($v["content"]); ?>
                            </td>
                            <td  class="note_text" style="text-align: left">
                                <?php echo ($v["recontent"]); ?>
                            </td>
                             <td>
                                <?php echo ($v["type"]); ?>
                            </td>
                             <td >
                                <?php if($v['status'] == 1): ?><font color="#006400">进行中</font><?php endif; ?>
                                <?php if($v['status'] == 2): ?><font color="red">已完成</font><?php endif; ?>
                                <?php if($v['status'] == 3): ?><font color="silver">已取消</font><?php endif; ?>
                            </td>
                            <td>
                                <?php echo (date("Y-m-d",$v["do_time"])); ?>
                            </td>
                            <td>
                                <?php echo (date("Y-m-d",$v["create_time"])); ?>
                            </td>
                            <td width="">
                                <?php echo ($v["nickname"]); ?>
                            </td>
                            <td class="td-manage">
                                <?php if(in_array(($action_name["Customer_addbacklog"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="添加待办任务" href="javascript:;" onclick="member_edit('添加待办任务','/Home/Customer/addbacklog','<?php echo ($v["cid"]); ?>','1000','700')" class="ml-5" style="text-decoration:none;">
                                        <i class="layui-icon">&#xe609;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="添加待办任务" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="text-decoration:none;">
                                        <i class="layui-icon">&#xe609;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Customer_editbacklog"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="处理待办任务" href="javascript:;" onclick="member_edit('处理待办任务','/Home/Customer/editbacklog','<?php echo ($v["bid"]); ?>','1000','700')"
                                       class="ml-5" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="处理待办任务" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Customer_del"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="删除待办" href="javascript:;" onclick="member_del(this,'<?php echo ($v["bid"]); ?>')"
                                       style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="删除待办" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a><?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
                <div id="page" style="margin-bottom: 70px;"><?php echo ($page); ?></div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
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
            
            // 编辑
            function member_edit (title,url,id,w,h) {
                url = url + '?id=' + id;
                x_admin_show(title,url,w,h);
            }
            /*用户-删除*/
            function member_del(obj,id){
                layer.confirm('确认要删除这个客户吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Customer/backlog_del',
                        dataType: 'json',
                        data:{'bid':id},
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
    </body>
</html>