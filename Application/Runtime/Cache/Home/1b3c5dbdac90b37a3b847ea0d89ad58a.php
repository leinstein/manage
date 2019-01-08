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
    <link rel="stylesheet" href="/Public/Home/css/xadmin.css">
    <script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/Home/js/xadmin.js"></script>
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
      <style>.layui-table td, .layui-table th{text-align: center;}</style>
      <table class="layui-table">
        <thead>
          <tr>
            <th width="30px">序号</th>
            <th>客户姓名</th>
            <th>成交金额</th>
            <th width="480px">商品</th>
            <th>支付状态</th>
            <th width="60px">发货状态</th>
            <th>物流</th>
            <th>物流单号</th>
            <th>下单时间</th>
            <th>发货时间</th>
            <th>销售人员</th>
            <th width="120px">操作</th>
            </tr>
        </thead>
        <tbody>
          <?php if($infotoday != ''): ?><tr><td  colspan="12" class="bg_tr">今天</td></tr><?php endif; ?>
          <?php if(is_array($infotoday)): foreach($infotoday as $key=>$v): if($v['orderstatus'] == 1): ?><tr><?php endif; ?>
              <?php if($v['orderstatus'] == 2): ?><tr style="color:#009688"><?php endif; ?>
              <?php if($v['orderstatus'] == 3): ?><tr style="color:red"><?php endif; ?>
              <?php if($v['orderstatus'] == 4): ?><tr style="color:#999"><?php endif; ?>
              <td>
                  <?php echo ++$i;?>
              </td>
              <td><?php echo ($v["customer_name"]); ?></td>
              <td><?php echo (substr($v["orderprice"],0,-3)); ?></td>
              <td style="text-align: left"><?php echo ($v["goods_de"]); ?></td>
              <td>
                <?php if($v['paytype'] == 1): ?>付全款
                    <?php else: ?>
                        <?php if($v['paytype'] == 2): ?>付定金
                            <?php else: ?>
                              货到付款<?php endif; endif; ?>
              </td>
              <td>
                <?php if($v['orderstatus'] == 1): ?><button class="layui-btn btn_style" style="background-color: #393d49;">待</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 2): ?><button class="layui-btn btn_style">发</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 3): ?><button class="layui-btn btn_style" style="background-color: red">签</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 4): ?><button class="layui-btn btn_style" style="background-color: #999;">退</button><?php endif; ?>
              </td>
              <td><?php echo ($v["couriername"]); ?></td>
              <td><?php echo ($v["courierlist"]); ?></td>
              <td><?php echo (date("Y-m-d",$v["ordercreatetime"])); ?></td>
              <td><?php echo (date("Y-m-d",$v["deliverytime"])); ?></td>
              <td><?php echo ($v["nickname"]); ?></td>
              <td class="td-manage">
                  <?php if(in_array(($action_name["System_restore_order"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="恢复订单" href="javascript:;" onclick="member_restore(this,'<?php echo ($v["orderid"]); ?>')"
                           style="text-decoration:none;margin-left: 10px">
                            <i class="layui-icon">&#x1005;</i>
                        </a>
                    <?php else: ?>
                        <a title="恢复" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                            <i class="layui-icon">&#x1005;</i>
                        </a><?php endif; ?>
                    <?php if(in_array(($action_name["System_real_del_order"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="彻底删除" href="javascript:;" onclick="member_del(this,'<?php echo ($v["orderid"]); ?>')"
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
          <?php if(is_array($infoyestoday)): foreach($infoyestoday as $key=>$v): if($v['orderstatus'] == 1): ?><tr><?php endif; ?>
          <?php if($v['orderstatus'] == 2): ?><tr style="color:#009688"><?php endif; ?>
          <?php if($v['orderstatus'] == 3): ?><tr style="color:red"><?php endif; ?>
          <?php if($v['orderstatus'] == 4): ?><tr style="color:#999"><?php endif; ?>
              <td>
                  <?php echo ++$i;?>
              </td>
              <td><?php echo ($v["customer_name"]); ?></td>
              <td><?php echo (substr($v["orderprice"],0,-3)); ?></td>
              <td style="text-align: left"><?php echo ($v["goods_de"]); ?></td>
              <td>
                <?php if($v['paytype'] == 1): ?>付全款
                    <?php else: ?>
                        <?php if($v['paytype'] == 2): ?>付定金
                            <?php else: ?>
                              货到付款<?php endif; endif; ?>
              </td>
              <td>
                <?php if($v['orderstatus'] == 1): ?><button class="layui-btn btn_style" style="background-color: #393d49;">待</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 2): ?><button class="layui-btn btn_style">发</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 3): ?><button class="layui-btn btn_style" style="background-color: red">签</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 4): ?><button class="layui-btn btn_style" style="background-color: #999;">退</button><?php endif; ?>
              </td>
              <td><?php echo ($v["couriername"]); ?></td>
              <td><?php echo ($v["courierlist"]); ?></td>
              <td><?php echo (date("Y-m-d",$v["ordercreatetime"])); ?></td>
              <td><?php echo (date("Y-m-d",$v["deliverytime"])); ?></td>
              <td><?php echo ($v["nickname"]); ?></td>
              <td class="td-manage">
                <?php if(in_array(($action_name["System_restore_order"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="恢复订单" href="javascript:;" onclick="member_restore(this,'<?php echo ($v["orderid"]); ?>')"
                           style="text-decoration:none;margin-left: 10px">
                            <i class="layui-icon">&#x1005;</i>
                        </a>
                    <?php else: ?>
                        <a title="恢复" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                            <i class="layui-icon">&#x1005;</i>
                        </a><?php endif; ?>
                    <?php if(in_array(($action_name["System_real_del_order"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="彻底删除" href="javascript:;" onclick="member_del(this,'<?php echo ($v["orderid"]); ?>')"
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
          <?php if(is_array($infot)): foreach($infot as $key=>$v): if($v['orderstatus'] == 1): ?><tr><?php endif; ?>
          <?php if($v['orderstatus'] == 2): ?><tr style="color:#009688"><?php endif; ?>
          <?php if($v['orderstatus'] == 3): ?><tr style="color:red"><?php endif; ?>
          <?php if($v['orderstatus'] == 4): ?><tr style="color:#999"><?php endif; ?>
              <td>
                  <?php echo ++$i;?>
              </td>
              <td><?php echo ($v["customer_name"]); ?></td>
              <td><?php echo (substr($v["orderprice"],0,-3)); ?></td>
              <td style="text-align: left"><?php echo ($v["goods_de"]); ?></td>
              <td>
                <?php if($v['paytype'] == 1): ?>付全款
                    <?php else: ?>
                        <?php if($v['paytype'] == 2): ?>付定金
                            <?php else: ?>
                              货到付款<?php endif; endif; ?>
              </td>
              <td>
                <?php if($v['orderstatus'] == 1): ?><button class="layui-btn btn_style" style="background-color: #393d49;">待</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 2): ?><button class="layui-btn btn_style">发</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 3): ?><button class="layui-btn btn_style" style="background-color: red">签</button><?php endif; ?>
                    <?php if($v['orderstatus'] == 4): ?><button class="layui-btn btn_style" style="background-color: #999;">退</button><?php endif; ?>
              </td>
              <td><?php echo ($v["couriername"]); ?></td>
              <td><?php echo ($v["courierlist"]); ?></td>
              <td><?php echo (date("Y-m-d",$v["ordercreatetime"])); ?></td>
              <td><?php echo (date("Y-m-d",$v["deliverytime"])); ?></td>
              <td><?php echo ($v["nickname"]); ?></td>
              <td class="td-manage">
                <?php if(in_array(($action_name["System_restore_order"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="恢复订单" href="javascript:;" onclick="member_restore(this,'<?php echo ($v["orderid"]); ?>')"
                           style="text-decoration:none;margin-left: 10px">
                            <i class="layui-icon">&#x1005;</i>
                        </a>
                    <?php else: ?>
                        <a title="恢复" href="javascript:;" class="layui-btn-disabled-button" style="text-decoration:none;margin-left: 10px">
                            <i class="layui-icon">&#x1005;</i>
                        </a><?php endif; ?>
                    <?php if(in_array(($action_name["System_real_del_order"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="彻底删除" href="javascript:;" onclick="member_del(this,'<?php echo ($v["orderid"]); ?>')"
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
      <div class="page" style="text-align: right;margin-bottom: 30px"><?php echo ($page); ?></div>
    </div>
    </div>
    <script>
        layui.use(['element','layer'], function(){
            $ = layui.jquery;//jquery
            layer = layui.layer;//弹出层
        });


        function member_restore(obj,id){
            layer.confirm('确认要恢复这个订单吗？',function(index){
                $.ajax({
                    type: 'POST',
                    url: '/Home/System/restore_order',
                    dataType: 'json',
                    data:{'orderid':id},
                    success: function(data){
                        if(data.statu == 200){
                            $(obj).parents("tr").remove();
                            layer.msg('订单已恢复!',{icon:1,time:1000});
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
            layer.confirm('确认要删除这个订单吗？',function(index){
                $.ajax({
                    type: 'POST',
                    url: '/Home/System/real_del_order',
                    dataType: 'json',
                    data:{'orderid':id},
                    success: function(data){
                        if(data.statu == 200){
                            $(obj).parents("tr").remove();
                            layer.msg('订单已彻底删除!',{icon:1,time:1000});
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