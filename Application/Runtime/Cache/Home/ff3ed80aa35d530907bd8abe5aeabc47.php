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
                      <input class="layui-input" name="stat_date" placeholder="开始日" id="LAY_demorange_s"  autocomplete="off">
                    </div>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="stop_date" placeholder="截止日" id="LAY_demorange_e"  autocomplete="off">
                    </div>
                    <div class="layui-input-inline">
                      <input type="text" name="name"  placeholder="登录名 | 姓名 | 电话" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:120px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>
                    </div>
                  </div>
                </div>
            </form>
                <xblock>
                    <a title="本月排名" class="layui-btn"  href="/Home/Report/rank?month=month">
                        本月排名
                    </a>
                    <a title="上月排名" class="layui-btn"  href="/Home/Report/rank?month=lastmonth">
                        上月排名
                    </a>
                    <a title="历史排名" class="layui-btn"  href="/Home/Report/rank?month=history">
                        历史排名
                    </a>
                    <div class="layui-input-inline">
                        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 20px;padding: 2px 4px"  href="/Home/Report/rank?month=month" title="首页">
                        <img src="/Public/Home/images/indexw.png" style="vertical-align: baseline;width: 27px;height: 27px">
                        </a>
                        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 20px"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
                    </div>
                    <span class="x-right" style="line-height:40px">全部：
                        <a title="查看历史客户"  href="javascript;">
                           <?php echo ($count); ?>
                        </a>
                    </span>
                </xblock>
                <table class="layui-table">
                    <thead>
                        <tr>
                            <th width="30px">
                                排名
                            </th>
                            <th width="45px">
                                销售头像
                            </th>
                            <th width="60px">
                                销售姓名
                            </th>
                            <th width="60px">
                                销售额
                            </th>
                            <th  width="30px">
                                客户
                            </th>
                            <th width="30px">
                                订单
                            </th>
                            <th width="60px">
                                客户均价
                            </th>
                            <th  width="60px">
                                订单均价
                            </th>
                            <th  width="30px">
                                退单
                            </th>
                            <th width="60px">
                                退单金额
                            </th>
                            <th  width="45px">
                                退单率
                            </th>
                            <th  width="60px">
                                复购率
                            </th>
                        </tr>
                    </thead>
                    <style>.layui-table td, .layui-table th{text-align: center;}</style>
                    <style>
                        .order_total_amount{
                            font-size: 18px;
                            font-weight: bold;
                            color: #009688;
                        }
                    </style>
                    <tbody>
                        <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                                <td>
                                    <?php echo ($v["sort_amount"]); ?>
                                </td>
                                <td>
                                    <img src="<?php echo ($v["img_small"]); ?>" style="width: 32px;height: 32px;border-radius: 50%">
                                </td>
                                <td>
                                    <?php echo ($v["nickname"]); ?>
                                </td>
                                <td class="order_total_amount">
                                    <?php echo ($v["order_total_amount"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["customer_count"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_rate"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_customer_average"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_average"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_tui_rate"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_total_tui_amount"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["order_tui_average"]); ?>
                                </td>
                                <td>
                                    <?php echo ($v["buying_rate"]); ?>
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

            
            // 用户-编辑  用戶-添加待办任务
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