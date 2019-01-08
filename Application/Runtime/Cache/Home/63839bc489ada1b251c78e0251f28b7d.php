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
            <form class="layui-form x-center"  style="width:52%">
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
                    <div class="layui-input-inline" style="width:120px">
                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>
                    </div>
                  </div>
                </div> 
            </form>
            <style>
                .layui-table td, .layui-table th{text-align: center;}
                .layui-layer-dialog{background-color: #f8f8f8}
            </style>
            <xblock>
                <?php if(in_array(($action_name["Goods_add"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><button class="layui-btn"  onclick="admin_add('添加商品','/Home/Goods/add','680','650')" style="width: 125px;font-size: 16px">
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
                        <th width="30px">
                            序号
                        </th>
                        <th width="160px">
                            商品名
                        </th>
                        <th style="width: 330px" >
                            图片
                        </th>
                        <th width="35px">
                            价格
                        </th>
                        <th width="35px">
                            库存
                        </th>
                        <th width="35px">
                            销量
                        </th>
                        <th width="35px">
                            类型
                        </th>
                        <th width="35px">
                            状态
                        </th>
                        <th>
                            商品说明
                        </th>
                        <th width="75px">
                            添加时间
                        </th>
                        <th width="90px">
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
                                <?php echo ($v["goodsname"]); ?>
                            </td>
                             <td  valign="middle" style="text-align: left">
                                 <?php if(is_array($v["goods_pic"])): foreach($v["goods_pic"] as $key=>$vv): ?><img onclick="big_img(960,720,'<?php echo ($vv["goodsimg"]); ?>','<?php echo ($v["goodsname"]); ?>')" src="<?php echo ($vv["goodsthums"]); ?>"  alt="查看原图" height="34" style="cursor: pointer;margin-left: 10px"><?php endforeach; endif; ?>
                            </td>
                            <td >
                                <?php echo (substr($v["goodsprice"],0,-3)); ?>
                            </td>
                            <td >
                                <?php echo ($v["goodsstock"]); ?>
                            </td>
                            <td >
                                <?php echo ($v["goodscount"]); ?>
                            </td>
                            <td>
                                <?php if($v['zeng'] == '1' ): ?>商品
                                    <?php else: ?>
                                        赠品<?php endif; ?>
                            </td>
                            <td class="td-status">
                                <?php if($v['status'] == '1' ): ?><span class="layui-btn layui-btn-mini">上架</span>
                                    <?php else: ?>
                                        <span class="layui-btn layui-btn-danger layui-btn-mini">下架</span><?php endif; ?>
                            </td>
                            <td style="text-align: left">
                                <?php echo ($v["note"]); ?>
                            </td>
                            <td>
                                <?php echo (date("Y-m-d",$v["create_time"])); ?>
                            </td>
                            <td class="td-manage">
                                <?php if(in_array(($action_name["Goods_stop"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): if($v['status'] == '1' ): ?><a style="text-decoration:none" onclick="admin_stop(this,'<?php echo ($v["goodsid"]); ?>')" href="javascript:;" title="下架">
                                            <i class="layui-icon">&#xe601;</i>
                                        </a>
                                    <?php else: ?>
                                        <a style="text-decoration:none;" onClick="admin_start(this,'<?php echo ($v["goodsid"]); ?>')" href="javascript:;" title="上架">
                                            <i class="layui-icon">&#xe62f;</i>
                                        </a><?php endif; ?>
                                <?php else: ?>
                                    <a style="text-decoration:none;" href="javascript:;" class="layui-btn-disabled-button" title="上架">
                                        <i class="layui-icon">&#xe62f;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Goods_edit"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="编辑" href="javascript:;" onclick="admin_edit('编辑','/Home/Goods/edit','<?php echo ($v["goodsid"]); ?>','680','650')" class="ml-5" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                <?php else: ?>
                                   <a title="编辑" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px;border: 0">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a><?php endif; ?>
                                <?php if(in_array(($action_name["Goods_del"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo ($v["goodsid"]); ?>')" style="text-decoration:none;margin-left: 10px">
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
                    end.elem = this;
                    laydate(end);
                }

            });
            
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
                layer.confirm('确认要下架吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Goods/stop',
                        dataType: 'json',
                        data:{'id':id},
                        success: function(data){
                            if(data.statu == 200){
                                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="admin_start(this,id)" href="javascript:;" title="上架"><i class="layui-icon">&#xe62f;</i></a>');
                                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-danger layui-btn-mini">下架</span>');
                                $(obj).remove();
                                layer.msg('下架!',{icon: 5,time:1000});
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
                layer.confirm('确认要上架吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Goods/start',
                        dataType: 'json',
                        data:{'id':id},
                        success: function(data){
                            if(data.statu == 200){
                                //发异步把用户状态进行更改
                                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="admin_stop(this,id)" href="javascript:;" title="下架"><i class="layui-icon">&#xe601;</i></a>');
                                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-mini">上架</span>');
                                $(obj).remove();
                                layer.msg('上架!',{icon: 6,time:1000});
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
                        url: '/Home/Goods/del',
                        dataType: 'json',
                        data:{'goodsid':id},
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
        <script>
            function big_img(w,h,urlimg,goodsname){
                layer.open({
                    title: '商品图片',
                    type: 0,
                    area: [w, h], //宽高
                    shadeClose: true,
                    content: '<a href="'+urlimg+'" download="'+goodsname+'" style="width:960px;text-align: center;display: inline-block"><img  src="'+urlimg+'"  height="540px"  alt=""></a>'
                });
            }
        </script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
    </body>
</html>