<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/Public/Home/css/font.css">
    <link rel="stylesheet" href="/Public/Home/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Home/lib2/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/Home/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" style="text-align: center">
          <input class="layui-input" placeholder="开始日" name="stat_date" id="start" autocomplete="off">
          <input class="layui-input" placeholder="截止日" name="stop_date" id="end" autocomplete="off">
          <div class="layui-input-inline">
            <select name="paytype">
              <option value="">支付状态</option>
              <option value="3">货到付款</option>
              <option value="1">已付全款</option>
              <option value="2">付定金-货到付款</option>
            </select>
          </div>
          <div class="layui-input-inline">
            <select name="payform">
              <option value="">支付方式</option>
              <option value="1">微信</option>
              <option value="2">支付宝</option>
              <option value="3">银行卡转账</option>
              <option value="4">快递代收</option>
            </select>
          </div>
          <div class="layui-input-inline">
            <select name="orderstatus">
              <option value="">订单状态</option>
              <option value="1">待发货</option>
              <option value="2">已发货</option>
              <option value="3">已签收</option>
              <option value="4">退单</option>
            </select>
          </div>
          <input type="text" name="word"  placeholder="模糊搜索" autocomplete="off" class="layui-input" style="width: 120px">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>
        </form>
      </div>
      <xblock>
        <div class="layui-input-inline">
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 10px;padding: 2px 4px"  href="/Home/Funds/index" title="首页">
            <img src="/Public/Home/images/indexw.png" style="vertical-align: baseline;width: 27px;height: 27px">
            </a>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 20px"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <span class="x-right" style="line-height:40px">找到：
            <a>
               <?php echo ($count); ?>
            </a>
          个订单
        </span>
        <span class="x-right" style="line-height:40px">全部：
            <a title="查看历史订单"  href="/Home/Funds/index?day=history">
               <?php echo ($statistical["history"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">今年：
            <a title="查看今年订单"  href="/Home/Funds/index?day=year">
              <?php echo ($statistical["year"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">上月：
            <a title="查看上月订单"  href="/Home/Funds/index?day=lastmonth">
                <?php echo ($statistical["lastmonth"]); ?>
            </a></span>
        <span class="x-right" style="line-height:40px">本月：
            <a title="查看本月订单"  href="/Home/Funds/index?day=month">
                <?php echo ($statistical["month"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">上周：
            <a title="查看上周订单"  href="/Home/Funds/index?day=lastweek">
                <?php echo ($statistical["lastweek"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">本周：
            <a title="查看本周订单"  href="/Home/Funds/index?day=weekday">
                <?php echo ($statistical["weekday"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">昨天：
            <a title="查看昨日订单"  href="/Home/Funds/index?day=yestoday">
                <?php echo ($statistical["yesterday"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">今天：
            <a title="查看今日订单"  href="/Home/Funds/index?day=today">
                <?php echo ($statistical["today"]); ?>
            </a>
        </span>
      </xblock>
        <style>
            .btn_style{
                padding: 0;
                height: 20px;
                line-height: 20px;
                width: 20px;
            }
        </style>
      <style>.layui-table td, .layui-table th{text-align: center;}</style>
      <table class="layui-table">
        <thead>
          <tr>
            <th width="30px">序号</th>
            <th>客户姓名</th>
            <th>物流</th>
            <th>物流单号</th>
            <th>付款方式</th>
            <th>支付状态</th>
            <th>成交金额</th>
            <th>已付金额</th>
            <th>代收</th>
            <th>快递费</th>
            <th>手续费</th>
            <th>返款</th>
            <th>支出成本</th>
            <th>实际收入</th>
            <th>状态</th>
            <th>签单时间</th>
            <th>销售人员</th>
            <th width="60px">操作</th>
            </tr>
        </thead>
        <tbody>
          <?php if($infotoday != ''): ?><tr><td  colspan="18" class="bg_tr">今天</td></tr><?php endif; ?>
          <?php if(is_array($infotoday)): foreach($infotoday as $key=>$v): ?><tr>
              <td><?php echo ++$i;?></td>
              <td><font style="font-weight: bold;"><?php echo ($v["customer_name"]); ?></font></td>
              <td><?php echo ($v["couriername"]); ?></td>
              <td><?php echo ($v["courierlist"]); ?></td>
                <td>
                  <?php if($v['payform'] == 1): ?>微信<?php endif; ?>
                  <?php if($v['payform'] == 2): ?>支付宝<?php endif; ?>
                  <?php if($v['payform'] == 3): ?>银行卡转账<?php endif; ?>
                  <?php if($v['payform'] == 4): ?>快递代收<?php endif; ?>
              </td>
              <td>
                <?php if($v['paytype'] == 1): ?>付全款
                    <?php else: ?>
                        <?php if($v['paytype'] == 2): ?>付定金
                            <?php else: ?>
                              货到付款<?php endif; endif; ?>
              </td>
              <td><font style="font-weight: bold;"><?php echo (substr($v["orderprice"],0,-3)); ?></font></td>
              <td><?php echo (substr($v["pay"],0,-3)); ?></td>
              <td><?php echo (substr($v["paymentfee"],0,-3)); ?></td>
              <td><?php echo (substr($v["courierfee"],0,-3)); ?></td>
              <td><?php echo (substr($v["serverfee"],0,-3)); ?></td>
              <td><?php echo (substr($v["refunds"],0,-3)); ?></td>
              <td>
                  <?php if($v['chengben'] != 0): ?><font style="font-weight: bold;color: darkgreen;font-size: 18px;"><?php echo ($v["chengben"]); ?></font><?php endif; ?>
              </td>
              <td>
                  <?php if($v['chengben'] != 0): ?><font style="font-weight: bold;color: red;font-size: 18px;"><?php echo ($v["realfee"]); ?></font><?php endif; ?>
               </td>
                <td>
                    <?php if($v['orderstatus'] == 1): ?><button class="layui-btn btn_style" style="background-color: #393d49;">待</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 2): ?><button class="layui-btn btn_style">发</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 3): ?><button class="layui-btn btn_style" style="background-color: red">签</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 4): ?><button class="layui-btn btn_style" style="background-color: #999;">退</button><?php endif; ?>
              </td>
              <td><?php if($v['reciivingtime'] != 0): echo (date("Y-m-d",$v["reciivingtime"])); endif; ?></td>
              <td><?php echo ($v["nickname"]); ?></td>
              <td class="td-manage">
                <a title="查看"  onclick="x_admin_show('查看','/Home/Order/show?orderid=<?php echo ($v["orderid"]); ?>',1200,700)" href="javascript:;" style="margin-right: 10px">
                  <i class="layui-icon"   style="vertical-align: baseline;width: 13px">&#xe63c;</i>
                </a>
                <a title="财务" href="javascript:;" onclick="x_admin_show('财务','update_order?orderid=<?php echo ($v["orderid"]); ?>',800,400)" class="ml-5" style="margin-right: 10px">
                  <img src="/Public/Home/images/caiwu.png" style="vertical-align: baseline;width: 14px;height: 14px">
                </a>
              </td>
            </tr><?php endforeach; endif; ?>
          <?php if($infoyestoday != ''): ?><tr><td  colspan="18"  class="bg_tr">昨天</td></tr><?php endif; ?>
          <?php if(is_array($infoyestoday)): foreach($infoyestoday as $key=>$v): ?><tr>
              <td><?php echo ++$i;?></td>
              <td><font style="font-weight: bold;"><?php echo ($v["customer_name"]); ?></font></td>
              <td><?php echo ($v["couriername"]); ?></td>
              <td><?php echo ($v["courierlist"]); ?></td>
                <td>
                  <?php if($v['payform'] == 1): ?>微信<?php endif; ?>
                  <?php if($v['payform'] == 2): ?>支付宝<?php endif; ?>
                  <?php if($v['payform'] == 3): ?>银行卡转账<?php endif; ?>
                  <?php if($v['payform'] == 4): ?>快递代收<?php endif; ?>
              </td>
              <td>
                <?php if($v['paytype'] == 1): ?>付全款
                    <?php else: ?>
                        <?php if($v['paytype'] == 2): ?>付定金
                            <?php else: ?>
                              货到付款<?php endif; endif; ?>
              </td>
              <td><font style="font-weight: bold;"><?php echo (substr($v["orderprice"],0,-3)); ?></font></td>
              <td><?php echo (substr($v["pay"],0,-3)); ?></td>
              <td><?php echo (substr($v["paymentfee"],0,-3)); ?></td>
              <td><?php echo (substr($v["courierfee"],0,-3)); ?></td>
              <td><?php echo (substr($v["serverfee"],0,-3)); ?></td>
              <td><?php echo (substr($v["refunds"],0,-3)); ?></td>
              <td>
                  <?php if($v['chengben'] != 0): ?><font style="font-weight: bold;color: darkgreen;font-size: 18px;"><?php echo ($v["chengben"]); ?></font><?php endif; ?>
              </td>
              <td>
                  <?php if($v['chengben'] != 0): ?><font style="font-weight: bold;color: red;font-size: 18px;"><?php echo ($v["realfee"]); ?></font><?php endif; ?>
               </td>
                <td>
                <!--<?php if($v['orderstatus'] == 1): ?>待发货<?php endif; ?>-->
                <!--<?php if($v['orderstatus'] == 2): ?>已发货<?php endif; ?>-->
                <!--<?php if($v['orderstatus'] == 3): ?>已签收<?php endif; ?>-->
                <!--<?php if($v['orderstatus'] == 4): ?>退单<?php endif; ?>-->
                    <?php if($v['orderstatus'] == 1): ?><button class="layui-btn btn_style" style="background-color: #393d49;color:white">待</button><?php endif; ?>
                <?php if($v['orderstatus'] == 2): ?><button class="layui-btn btn_style">发</button><?php endif; ?>
                <?php if($v['orderstatus'] == 3): ?><button class="layui-btn btn_style" style="background-color: red">签</button><?php endif; ?>
                <?php if($v['orderstatus'] == 4): ?><button class="layui-btn btn_style" style="background-color: #999;">退</button><?php endif; ?>
              </td>
              <td><?php if($v['reciivingtime'] != 0): echo (date("Y-m-d",$v["reciivingtime"])); endif; ?></td>
              <td><?php echo ($v["nickname"]); ?></td>
              <td class="td-manage">
                <a title="查看"  onclick="x_admin_show('查看','/Home/Order/show?orderid=<?php echo ($v["orderid"]); ?>',1200,700)" href="javascript:;" style="margin-right: 10px">
                  <i class="layui-icon"   style="vertical-align: baseline;width: 13px">&#xe63c;</i>
                </a>
                <a title="财务" href="javascript:;" onclick="x_admin_show('财务','update_order?orderid=<?php echo ($v["orderid"]); ?>',800,400)" class="ml-5" style="margin-right: 10px">
                  <img src="/Public/Home/images/caiwu.png" style="vertical-align: baseline;width: 14px;height: 14px">
                </a>
              </td>
            </tr><?php endforeach; endif; ?>
          <?php if($infot != ''): ?><tr><td  colspan="18" class="bg_tr">昨天以前</td></tr><?php endif; ?>
          <?php if(is_array($infot)): foreach($infot as $key=>$v): ?><tr>
              <td><?php echo ++$i;?></td>
              <td><font style="font-weight: bold;"><?php echo ($v["customer_name"]); ?></font></td>
              <td><?php echo ($v["couriername"]); ?></td>
              <td><?php echo ($v["courierlist"]); ?></td>
                <td>
                  <?php if($v['payform'] == 1): ?>微信<?php endif; ?>
                  <?php if($v['payform'] == 2): ?>支付宝<?php endif; ?>
                  <?php if($v['payform'] == 3): ?>银行卡转账<?php endif; ?>
                  <?php if($v['payform'] == 4): ?>快递代收<?php endif; ?>
              </td>
              <td>
                <?php if($v['paytype'] == 1): ?>付全款
                    <?php else: ?>
                        <?php if($v['paytype'] == 2): ?>付定金
                            <?php else: ?>
                              货到付款<?php endif; endif; ?>
              </td>
              <td><font style="font-weight: bold;"><?php echo (substr($v["orderprice"],0,-3)); ?></font></td>
              <td><?php echo (substr($v["pay"],0,-3)); ?></td>
              <td><?php echo (substr($v["paymentfee"],0,-3)); ?></td>
              <td><?php echo (substr($v["courierfee"],0,-3)); ?></td>
              <td><?php echo (substr($v["serverfee"],0,-3)); ?></td>
              <td><?php echo (substr($v["refunds"],0,-3)); ?></td>
              <td>
                  <?php if($v['chengben'] != 0): ?><font style="font-weight: bold;color: darkgreen;font-size: 18px;"><?php echo ($v["chengben"]); ?></font><?php endif; ?>
              </td>
              <td>
                  <?php if($v['chengben'] != 0): ?><font style="font-weight: bold;color: red;font-size: 18px;"><?php echo ($v["realfee"]); ?></font><?php endif; ?>
               </td>
                <td>
                <?php if($v['orderstatus'] == 1): ?><button class="layui-btn btn_style" style="background-color: #393d49;color:white">待</button><?php endif; ?>
                <?php if($v['orderstatus'] == 2): ?><button class="layui-btn btn_style">发</button><?php endif; ?>
                <?php if($v['orderstatus'] == 3): ?><button class="layui-btn btn_style" style="background-color: red">签</button><?php endif; ?>
                <?php if($v['orderstatus'] == 4): ?><button class="layui-btn btn_style" style="background-color: #999;">退</button><?php endif; ?>
              </td>
              <td><?php if($v['reciivingtime'] != 0): echo (date("Y-m-d",$v["reciivingtime"])); endif; ?></td>
              <td><?php echo ($v["nickname"]); ?></td>
              <td class="td-manage">
                <a title="查看"  onclick="x_admin_show('查看','/Home/Order/show?orderid=<?php echo ($v["orderid"]); ?>',1200,700)" href="javascript:;" style="margin-right: 10px">
                  <i class="layui-icon"   style="vertical-align: baseline;width: 13px">&#xe63c;</i>
                </a>
                <a title="财务" href="javascript:;" onclick="x_admin_show('财务','update_order?orderid=<?php echo ($v["orderid"]); ?>',800,400)" class="ml-5" style="margin-right: 10px">
                  <img src="/Public/Home/images/caiwu.png" style="vertical-align: baseline;width: 14px;height: 14px">
                </a>
              </td>
            </tr><?php endforeach; endif; ?>
        </tbody>
      </table>
      <div class="page" style="text-align: right;"><?php echo ($page); ?></div>
    </div>
    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }
              
          });
      }

      /*订单-删除*/
      function member_del(obj,orderid){
          layer.confirm('确认要删除吗？',function(index){
              $.ajax({
                  type: 'POST',
                  url: 'del',
                  dataType: 'json',
                  data:{'orderid':orderid},
                  success: function(data){
                      if(data.statu == 200){
                          //发异步删除数据
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
      
      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>