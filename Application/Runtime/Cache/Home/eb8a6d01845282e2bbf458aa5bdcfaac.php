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
    <script type="text/javascript" src="/Public/Home/lib2/layui/layui.js" charset="utf-8"></script>
    <link rel="stylesheet" href="/Public/Home/laydate/theme/default/laydate.css">
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
            <select name="server_status">
              <option value="">回访状态</option>
              <option value="2">待回访</option>
              <option value="1">已回访</option>
            </select>
          </div>
          <input type="text" name="word"  placeholder="模糊搜索" autocomplete="off" class="layui-input" style="width: 120px">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>
        </form>
      </div>
      <xblock>
        <div class="layui-input-inline">
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;margin-left: 10px;padding: 2px 4px"  href="/Home/Server/index" title="首页">
            <img src="/Public/Home/images/indexw.png" style="vertical-align: baseline;width: 27px;height: 27px">
            </a>
        </div>
        <span class="x-right" style="line-height:40px">全部：
            <a title="订单"  href="/Home/Server/index?day=history">
               <?php echo ($statistical["history"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">今年：
            <a title="订单"  href="/Home/Server/index?day=year">
              <?php echo ($statistical["year"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">上月：
            <a title="订单"  href="/Home/Server/index?day=lastmonth">
                <?php echo ($statistical["lastmonth"]); ?>
            </a></span>
        <span class="x-right" style="line-height:40px">本月：
            <a title="订单"  href="/Home/Server/index?day=month">
                <?php echo ($statistical["month"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">上周：
            <a title="订单"  href="/Home/Server/index?day=lastweek">
                <?php echo ($statistical["lastweek"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">本周：
            <a title="订单"  href="/Home/Server/index?day=weekday">
                <?php echo ($statistical["weekday"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">昨天：
            <a title="订单"  href="/Home/Server/index?day=yestoday">
                <?php echo ($statistical["yesterday"]); ?>
            </a>
        </span>
        <span class="x-right" style="line-height:40px">今天：
            <a title="订单"  href="/Home/Server/index?day=today">
                <?php echo ($statistical["today"]); ?>
            </a>
        </span>
      </xblock>
      <style>.layui-table td, .layui-table th{text-align: center;}</style>
      <table class="layui-table">
        <thead>
          <tr>
            <th width="30px">序号</th>
            <th>客户姓名</th>
            <th>商品</th>
            <th>成交金额</th>
            <th>订单记录</th>
            <th>回访记录</th>
            <th>回访状态</th>
            <th>回访时间</th>
            <th>签单时间</th>
            <th>销售人员</th>
            <th width="60px">操作</th>
            </tr>
        </thead>
        <tbody>
          <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr <?php if($v['server_status'] != 0): ?>style="color:red"<?php endif; ?>>
              <td><?php echo ++$i;?></td>
              <td><font style="font-weight: bold;"><?php echo ($v["customer_name"]); ?></font></td>
              <td><?php echo ($v["goods_de"]); ?></td>
              <td><font style="font-weight: bold;"><?php echo (substr($v["orderprice"],0,-3)); ?></font></td>
                <td class="note"><?php echo ($v["desc"]); ?></td>
                <td class="note"><?php echo ($v["server_note"]); ?></td>
                <td>
                    <?php if($v['server_status'] == 0): ?><button class="layui-btn btn_style" style="background-color: #1ba194">待</button>
                    <?php else: ?>
                        <button class="layui-btn btn_style" style="background-color: red">已</button><?php endif; ?>
                </td>
              <td><?php if($v['create_time_note'] != null): echo (date("Y-m-d",$v["create_time_note"])); endif; ?></td>
              <td><?php if($v['reciivingtime'] != null): echo (date("Y-m-d",$v["create_time_note"])); endif; ?></td>
              <td><?php echo ($v["nickname"]); ?></td>
              <td class="td-manage">
                  <?php if(in_array(($action_name["Order_show"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="查看"  onclick="x_admin_show('查看','/Home/Order/show?orderid=<?php echo ($v["orderid"]); ?>',1200,700)" href="javascript:;" style="margin-right: 10px">
                          <i class="layui-icon"   style="vertical-align: baseline;width: 13px">&#xe63c;</i>
                        </a>
                  <?php else: ?>
                        <a title="查看" class="layui-btn-disabled-button" href="javascript:;" style="margin-right: 10px">
                          <i class="layui-icon"   style="vertical-align: baseline;width: 13px">&#xe63c;</i>
                        </a><?php endif; ?>
                  <?php if(in_array(($action_name["Server_server"]), is_array($role_ac)?$role_ac:explode(',',$role_ac))): ?><a title="客服" href="javascript:;" onclick="x_admin_show('客服','/Home/Server/server?orderid=<?php echo ($v["orderid"]); ?>&customer_name=<?php echo ($v["customer_name"]); ?>&customer_phone=<?php echo ($v["customer_phone"]); ?>',800,500)" class="ml-5" style="margin-right: 10px">
                            <i class="layui-icon"   style="vertical-align: baseline;width: 13px">&#xe642;</i>
                        </a>
                  <?php else: ?>
                        <a title="客服" href="javascript:;" class="ml-5 layui-btn-disabled-button" style="margin-right: 10px">
                            <i class="layui-icon"   style="vertical-align: baseline;width: 13px">&#xe642;</i>
                        </a><?php endif; ?>
              </td>
            </tr><?php endforeach; endif; ?>
        </tbody>
      </table>
      <div class="page" style="text-align: right;margin-bottom: 30px"><?php echo ($page); ?></div>
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
      
    </script>
  </body>
</html>