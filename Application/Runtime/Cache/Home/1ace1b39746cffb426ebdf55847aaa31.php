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
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="30px">
                            序号
                        </th>
                        <th width="60px">
                            姓名
                        </th>
                        <th width="90px">
                            联系方式
                        </th>
                        <th width="30px">
                            性别
                        </th>
                        <th  width="30px">
                            年龄
                        </th>
                        <th width="45px">
                            销售
                        </th>
                        <th width="80px">
                            项目
                        </th>
                        <th  width="110px">
                            地区
                        </th>
                        <th  width="45px">
                            订单数
                        </th>
                        <th style="text-align: center">
                            备注
                        </th>
                        <th  width="80px">
                            添加时间
                        </th>
                        <th  width="115px">
                            操作
                        </th>
                    </tr>
                </thead>
                <style>.layui-table td, .layui-table th{text-align: center;}</style>
                <tbody>
                    <?php if($infotoday != ''): ?><tr><td  colspan="12" class="bg_tr">今天</td></tr><?php endif; ?>
                    <?php if(is_array($infotoday)): foreach($infotoday as $key=>$v): ?><tr>
                            <td>
                                <?php echo ++$i;?>
                            </td>
                            <td>
                                <?php if(in_array(($action_name["Customer_show"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><u style="cursor:pointer;color:#01AAED;text-decoration: none;font-size: 14px" onclick="member_show('<?php echo ($v["name"]); ?>','/Home/Customer/show?cid=<?php echo ($v["cid"]); ?>','10001','1000','550')">
                                        <?php echo ($v["name"]); ?>
                                    </u>
                                <?php else: ?>
                                    <u style="cursor:pointer;color:#01AAED;text-decoration: none;font-size: 14px" class="layui-btn-disabled-button">
                                        <?php echo ($v["name"]); ?>
                                    </u><?php endif; ?>
                            </td>
                            <td >
                                <?php echo ($v["phone"]); ?>
                            </td>
                            <td >
                                <?php if($v['sex'] == 1): ?>男
                                    <?php else: ?>
                                    女<?php endif; ?>
                            </td>
                            <td >
                                <?php echo ($v["age"]); ?>
                            </td>
                            <td >
                                <?php echo ($v["nickname"]); ?>
                            </td>
                            <td >
                                <?php echo ($v["item_name"]); ?>
                            </td>
                            <td >
                                <?php echo ($v["address"]); ?>
                            </td>
                            <td >
                                <?php echo ($v["buyrate"]); ?>
                            </td>
                            <td  class="note_text" style="text-align: left">
                                <?php echo ($v["note"]); ?>
                            </td>
                            <td>
                                <?php echo (date("Y-m-d",$v["create_time"])); ?>
                            </td>
                            <td class="td-manage">
                                <?php if(in_array(($action_name["System_restore_customer"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="恢复客户" href="javascript:;" onclick="member_restore(this,'<?php echo ($v["cid"]); ?>')"
                                       style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#x1005;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="恢复" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#x1005;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["System_real_del_customer"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="彻底删除" href="javascript:;" onclick="member_del(this,'<?php echo ($v["cid"]); ?>')"
                                       style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="彻底删除" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a><?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    <?php if($infoyestoday != ''): ?><tr><td  colspan="12"  class="bg_tr">昨天</td></tr><?php endif; ?>
                    <?php if(is_array($infoyestoday)): foreach($infoyestoday as $key=>$v): ?><tr>
                                <td>
                                    <?php echo ++$i;?>
                                </td>
                                <td>
                                    <?php if(in_array(($action_name["Customer_show"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><u style="cursor:pointer;color:#01AAED;text-decoration: none;font-size: 14px" onclick="member_show('<?php echo ($v["name"]); ?>','/Home/Customer/show?cid=<?php echo ($v["cid"]); ?>','10001','1000','550')">
                                            <?php echo ($v["name"]); ?>
                                        </u>
                                    <?php else: ?>
                                        <u style="cursor:pointer;color:#01AAED;text-decoration: none;font-size: 14px" class="layui-btn-disabled-button">
                                            <?php echo ($v["name"]); ?>
                                        </u><?php endif; ?>
                                </td>
                                <td >
                                    <?php echo ($v["phone"]); ?>
                                </td>
                                <td >
                                    <?php if($v['sex'] == 1): ?>男
                                        <?php else: ?>
                                        女<?php endif; ?>
                                </td>
                                <td >
                                    <?php echo ($v["age"]); ?>
                                </td>
                                <td >
                                    <?php echo ($v["nickname"]); ?>
                                </td>
                                <td >
                                    <?php echo ($v["item_name"]); ?>
                                </td>
                                <td >
                                    <?php echo ($v["address"]); ?>
                                </td>
                                <td >
                                    <?php echo ($v["buyrate"]); ?>
                                </td>
                                <td  style="text-align: left">
                                    <?php echo ($v["note"]); ?>
                                </td>
                                <td>
                                    <?php echo (date("Y-m-d",$v["create_time"])); ?>
                                </td>
                                <td class="td-manage">
                                    <?php if(in_array(($action_name["System_restore_customer"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="恢复客户" href="javascript:;" onclick="member_restore(this,'<?php echo ($v["cid"]); ?>')"
                                       style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#x1005;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="恢复" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#x1005;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["System_real_del_customer"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="彻底删除" href="javascript:;" onclick="member_del(this,'<?php echo ($v["cid"]); ?>')"
                                       style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                <?php else: ?>
                                    <a title="彻底删除" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a><?php endif; ?>
                                </td>
                            </tr><?php endforeach; endif; ?>
                        <?php if($infot != ''): ?><tr><td  colspan="12" class="bg_tr">昨天以前</td></tr><?php endif; ?>
                        <?php if(is_array($infot)): foreach($infot as $key=>$v): ?><tr>
                                    <td>
                                        <?php echo ++$i;?>
                                    </td>
                                    <td>
                                        <?php if(in_array(($action_name["Customer_show"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><u style="cursor:pointer;color:#01AAED;text-decoration: none;font-size: 14px" onclick="member_show('<?php echo ($v["name"]); ?>','/Home/Customer/show?cid=<?php echo ($v["cid"]); ?>','10001','1000','550')">
                                                <?php echo ($v["name"]); ?>
                                            </u>
                                        <?php else: ?>
                                            <u style="cursor:pointer;color:#01AAED;text-decoration: none;font-size: 14px" class="layui-btn-disabled-button">
                                                <?php echo ($v["name"]); ?>
                                            </u><?php endif; ?>
                                    </td>
                                    <td >
                                        <?php echo ($v["phone"]); ?>
                                    </td>
                                    <td >
                                        <?php if($v['sex'] == 1): ?>男
                                            <?php else: ?>
                                            女<?php endif; ?>
                                    </td>
                                    <td >
                                        <?php echo ($v["age"]); ?>
                                    </td>
                                    <td >
                                        <?php echo ($v["nickname"]); ?>
                                    </td>
                                    <td >
                                        <?php echo ($v["item_name"]); ?>
                                    </td>
                                    <td >
                                        <?php echo ($v["address"]); ?>
                                    </td>
                                    <td >
                                        <?php echo ($v["buyrate"]); ?>
                                    </td>
                                    <td  style="text-align: left">
                                        <?php echo ($v["note"]); ?>
                                    </td>
                                    <td>
                                        <?php echo (date("Y-m-d",$v["create_time"])); ?>
                                    </td>
                                    <td class="td-manage">
                                        <?php if(in_array(($action_name["System_restore_customer"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="恢复客户" href="javascript:;" onclick="member_restore(this,'<?php echo ($v["cid"]); ?>')"
                                               style="text-decoration:none;margin-left: 10px">
                                                <i class="layui-icon">&#x1005;</i>
                                            </a>
                                        <?php else: ?>
                                            <a title="恢复" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                                <i class="layui-icon">&#x1005;</i>
                                            </a><?php endif; ?>
                                        <?php if(in_array(($action_name["System_real_del_customer"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="彻底删除" href="javascript:;" onclick="member_del(this,'<?php echo ($v["cid"]); ?>')"
                                               style="text-decoration:none;margin-left: 10px">
                                                <i class="layui-icon">&#xe640;</i>
                                            </a>
                                        <?php else: ?>
                                            <a title="彻底删除" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                                                <i class="layui-icon">&#xe640;</i>
                                            </a><?php endif; ?>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
                <div id="page" style="margin-bottom: 50px;"><?php echo ($page); ?></div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['element','layer'], function(){
                $ = layui.jquery;//jquery
              layer = layui.layer;//弹出层
            });
            
            
            function member_restore(obj,id){
                layer.confirm('确认要恢复这个客户吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/System/restore_customer',
                        dataType: 'json',
                        data:{'cid':id},
                        success: function(data){
                            if(data.statu == 200){
                                $(obj).parents("tr").remove();
                                layer.msg('客户已恢复!',{icon:1,time:1000});
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
            /*用户-删除*/
            function member_del(obj,id){
                layer.confirm('确认要删除这个客户吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/System/real_del_customer',
                        dataType: 'json',
                        data:{'cid':id},
                        success: function(data){
                            if(data.statu == 200){
                                $(obj).parents("tr").remove();
                                layer.msg('客户已彻底删除!',{icon:1,time:1000});
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