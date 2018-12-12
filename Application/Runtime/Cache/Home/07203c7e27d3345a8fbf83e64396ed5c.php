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
            <form class="layui-form x-center" action="" style="width:800px">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item" style="width: 120%">
                    <label class="layui-form-label">日期范围</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="stat_date" placeholder="开始日" id="LAY_demorange_s">
                    </div>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="stat_date" placeholder="截止日" id="LAY_demorange_e">
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
                <button class="layui-btn" style="width: 125px;font-size: 16px;" onclick="member_add('添加客户','/Home/Customer/member-add','1000','600')"><i class="layui-icon">&#xe608;</i> 添 加</button>
                <div class="layui-input-inline">
                    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 20px;padding: 2px 4px"  href="/Home/Customer/index" title="首页">
                    <img src="/Public/Home/images/indexw.png" style="vertical-align: baseline;width: 27px;height: 27px">
                    </a>
                    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 20px"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
                </div>
        <!--<span class="x-right" style="line-height:40px">找到：-->
            <!--<a>-->
               <!--<?php echo ($count); ?>-->
            <!--</a>-->
          <!--个客户-->
        <!--</span>-->
        <span class="x-right" style="line-height:40px">全部：
            <a title="查看历史客户"  href="/Home/Customer/index?day=history">
               <?php echo ($statistical["history"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">今年：
            <a title="查看今年客户"  href="/Home/Customer/index?day=year">
              <?php echo ($statistical["year"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">上月：
            <a title="查看上月客户"  href="/Home/Customer/index?day=lastmonth">
                <?php echo ($statistical["lastmonth"]); ?>
            </a></span>
        <span class="x-right" style="line-height:40px">本月：
            <a title="查看本月客户"  href="/Home/Customer/index?day=month">
                <?php echo ($statistical["month"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">上周：
            <a title="查看上周客户"  href="/Home/Customer/index?day=lastweek">
                <?php echo ($statistical["lastweek"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">本周：
            <a title="查看本周客户"  href="/Home/Customer/index?day=weekday">
                <?php echo ($statistical["weekday"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">昨天：
            <a title="查看昨日客户"  href="/Home/Customer/index?day=yestoday">
                <?php echo ($statistical["yesterday"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">今天：
            <a title="查看今日客户"  href="/Home/Customer/index?day=today">
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
                        <th width="60px">
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
                                <?php $i++;echo $i; ?>
                            </td>
                            <td>
                                <u style="cursor:pointer;color:#01AAED;text-decoration: none;font-size: 14px" onclick="member_show('<?php echo ($v["name"]); ?>','/Home/Customer/show?cid=<?php echo ($v["cid"]); ?>','10001','1000','550')">
                                    <?php echo ($v["name"]); ?>
                                </u>
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
                                <a title="添加订单" href="javascript:;" onclick="order_add_list('添加订单','/Home/Customer/order_add','<?php echo ($v["cid"]); ?>','1280','760','<?php echo ($v["nickname"]); ?>')"
                                class="ml-5" style="text-decoration:none">
                                    <img src="/Public/Home/images/jia.png" width="15px">
                                </a>
                                <a title="编辑客户" href="javascript:;" onclick="member_edit('编辑客户','/Home/Customer/edit','<?php echo ($v["cid"]); ?>','1000','600')"
                                class="ml-5" style="text-decoration:none;margin-left: 10px">
                                    <i class="layui-icon">&#xe642;</i>
                                </a>
                                <a title="删除客户" href="javascript:;" onclick="member_del(this,'<?php echo ($v["cid"]); ?>')"
                                style="text-decoration:none;margin-left: 10px">
                                    <i class="layui-icon">&#xe640;</i>
                                </a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    <?php if($infoyestoday != ''): ?><tr><td  colspan="12"  class="bg_tr">昨天</td></tr><?php endif; ?>
                    <?php if(is_array($infoyestoday)): foreach($infoyestoday as $key=>$v): ?><tr>
                                <td>
                                    <?php $i++;echo $i; ?>
                                </td>
                                <td>
                                    <u style="cursor:pointer;color:#01AAED;text-decoration: none;font-size: 14px" onclick="member_show('<?php echo ($v["name"]); ?>','/Home/Customer/show?cid=<?php echo ($v["cid"]); ?>','10001','1000','550')">
                                        <?php echo ($v["name"]); ?>
                                    </u>
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
                                    <a title="添加订单" href="javascript:;" onclick="order_add_list('添加订单','/Home/Customer/order_add','<?php echo ($v["cid"]); ?>','1280','760','<?php echo ($v["nickname"]); ?>')"
                                       class="ml-5" style="text-decoration:none">
                                        <img src="/Public/Home/images/jia.png" width="15px">
                                    </a>
                                    <a title="编辑客户" href="javascript:;" onclick="member_edit('编辑客户','/Home/Customer/edit','<?php echo ($v["cid"]); ?>','1000','600')"
                                       class="ml-5" style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                    <a title="删除客户" href="javascript:;" onclick="member_del(this,'<?php echo ($v["cid"]); ?>')"
                                       style="text-decoration:none;margin-left: 10px">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                </td>
                            </tr><?php endforeach; endif; ?>
                        <?php if($infot != ''): ?><tr><td  colspan="12" class="bg_tr">昨天以前</td></tr><?php endif; ?>
                        <?php if(is_array($infot)): foreach($infot as $key=>$v): ?><tr>
                                    <td>
                                        <?php $i++;echo $i; ?>
                                    </td>
                                    <td>
                                        <u style="cursor:pointer;color:#01AAED;text-decoration: none;font-size: 14px" onclick="member_show('<?php echo ($v["name"]); ?>','/Home/Customer/show?cid=<?php echo ($v["cid"]); ?>','10001','1000','550')">
                                            <?php echo ($v["name"]); ?>
                                        </u>
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
                                        <a title="添加订单" href="javascript:;" onclick="order_add_list('添加订单','/Home/Customer/order_add','<?php echo ($v["cid"]); ?>','1280','760','<?php echo ($v["nickname"]); ?>')"
                                           class="ml-5" style="text-decoration:none">
                                            <img src="/Public/Home/images/jia.png" width="15px">
                                        </a>
                                        <a title="编辑客户" href="javascript:;" onclick="member_edit('编辑客户','/Home/Customer/edit','<?php echo ($v["cid"]); ?>','1000','600')"
                                           class="ml-5" style="text-decoration:none;margin-left: 10px">
                                            <i class="layui-icon">&#xe642;</i>
                                        </a>
                                        <a title="添加待办任务" href="javascript:;" onclick="member_edit('添加待办任务','/Home/Customer/addbacklog','<?php echo ($v["cid"]); ?>','600','600')"
                                           class="ml-5" style="text-decoration:none;margin-left: 10px">
                                            <i class="layui-icon">&#xe609;</i>
                                        </a>
                                        <a title="删除客户" href="javascript:;" onclick="member_del(this,'<?php echo ($v["cid"]); ?>')"
                                           style="text-decoration:none;margin-left: 10px">
                                            <i class="layui-icon">&#xe640;</i>
                                        </a>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
                <div id="page" style="margin-bottom: 70px;"><?php echo ($page); ?></div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        <script>
            // $('#table_css').click(function (e) {
            //     $('#table_css').css('background-color','red');
            // });
        </script>
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
             /*用户-添加*/
            function member_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }
            /*用户-查看*/
            function member_show(title,url,id,w,h){
                x_admin_show(title,url,w,h);
            }

            
            // 用户-编辑
            function member_edit (title,url,id,w,h) {
                url = url + '?cid=' + id;
                x_admin_show(title,url,w,h);
            }
            /*添加订单*/
            function order_add_list(title,url,id,w,h,cname){
                url = url + '?cid=' + id + '&cname=' + cname;
                x_admin_show(title,url,w,h);
            }
            /*用户-删除*/
            function member_del(obj,id){
                layer.confirm('确认要删除这个客户吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: 'del',
                        dataType: 'json',
                        data:{'cid':id},
                        success: function(data){
                            if(data.statu == 200){
                                $(obj).parents("tr").remove();
                                layer.msg('客户已删除!',{icon:1,time:1000});
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