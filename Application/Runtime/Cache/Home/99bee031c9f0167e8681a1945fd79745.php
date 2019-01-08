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
            <style>
                .layui-table td, .layui-table th{text-align: center;}
                .layui-layer-dialog{background-color: #f8f8f8}
                xblock{height: 40px}
            </style>
            <xblock>
                <span class="x-right" style="line-height:40px">全部：
                    <a title="全部"  href="/Home/Telephone/phone">
                       <?php echo ($avg["totle"]); ?>
                    </a>
                </span>
                <span class="x-right" style="line-height:40px">未使用：
                    <a title="未使用"  href="/Home/Telephone/phone?day=unused">
                      <?php echo ($avg["unused"]); ?>
                    </a>
                </span>
                <span class="x-right" style="line-height:40px">已使用：
                    <a title="已使用"  href="/Home/Telephone/phone?day=use">
                      <?php echo ($avg["use"]); ?>
                    </a>
                </span>
                <span class="x-right" style="line-height:40px">上月：
                    <a title="上月"  href="/Home/Telephone/phone?day=lastmonth">
                        <?php echo ($avg["lastmonth"]); ?>
                    </a></span>
                <span class="x-right" style="line-height:40px">本月：
                    <a title="本月"  href="/Home/Telephone/phone?day=month">
                        <?php echo ($avg["month"]); ?>
                    </a>
                </span>
                <span class="x-right" style="line-height:40px">昨天：
                    <a title="昨天"  href="/Home/Telephone/phone?day=yestoday">
                        <?php echo ($avg["yesterday"]); ?>
                    </a>
                </span>
                <span class="x-right" style="line-height:40px">今天：
                    <a title="今天"  href="/Home/Telephone/phone?day=today">
                        <?php echo ($avg["today"]); ?>
                    </a>
                </span>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="30px">
                            序号
                        </th>
                        <th>
                            电话号码
                        </th>
                        <th>
                            微信
                        </th>
                        <th>
                            人员
                        </th>
                        <th width="90px">
                            上传时间
                        </th>
                        <th width="90px">
                            使用时间
                        </th>
                        <th width="60px">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
                            <td>
                                <?php echo ++$i;?>
                            </td>
                            <td>
                                <?php echo ($v["phone"]); ?>
                            </td>
                            <td >
                                <?php echo ($v["weixin"]); ?>
                            </td>
                            <td >
                                <?php echo ($v["nickname"]); ?>
                            </td>
                            <td >
                                <?php echo (date("Y-m-d",$v["create_time"])); ?>
                            </td>
                            <td>
                                <?php if($v['use_time'] > 100): echo (date("Y-m-d",$v["use_time"])); endif; ?>
                            </td>
                            <td class="td-manage">
                                <?php if(in_array(($action_name["Goods_del"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo ($v["id"]); ?>')" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                <?php else: ?>
                                   <a title="删除" href="javascript:;" class="layui-btn-disabled-button"  style="text-decoration:none;margin-left: 10px;border: 0">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a><?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <div id="page" style="margin-bottom: 50px"><?php echo ($page); ?></div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script>
            layui.use(['element','layer'], function(){
                $ = layui.jquery;//jquery
                layer = layui.layer;//弹出层
            });
            
            /*删除*/
            function admin_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Telephone/del',
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