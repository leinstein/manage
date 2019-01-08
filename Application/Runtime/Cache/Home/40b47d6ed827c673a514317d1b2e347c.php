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
    <script type="text/javascript" src="/Public/Home/lib2/layui/layui.js" charset="utf-8"></script>
    <link rel="stylesheet" href="/Public/Home/laydate/theme/default/laydate.css">
  </head>
  <style>
      .layui-input{width: 245px;}
      .layui-form-item{width: 46%;display: inline-block;}
      .layui-textarea{min-height: 50px;}
      .layui-form-select .layui-edge{ right: -40px;}
  </style>
  <body>
    <div class="x-body">
        <form class="layui-form" onsubmit="return false">
            <input type="hidden"  name="orderid" value="<?php echo ($order["orderid"]); ?>">
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red"></span>收货人
              </label>
              <div class="layui-input-inline">
                  <input type="text" name="username" value="<?php echo ($name); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电话&nbsp;&nbsp;<?php echo ($phone); ?>" required="" readonly
                  autocomplete="off" class="layui-input" style="border: 0">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="address" class="layui-form-label">
                  <span class="x-red"></span>收货地址
              </label>
              <div class="layui-input-inline">
                  <input type="text" name="address" value="<?php echo ($address); ?>" required=""  readonly
                  autocomplete="off" class="layui-input" style="border: 0">
              </div>
          </div>
            <div class="layui-form-item">
              <label for="refunds" class="layui-form-label">
                  <span class="x-red"></span>返款金额
              </label>
              <div class="layui-input-inline">
                  <input type="text" name="refunds" value="<?php echo (substr($order["refunds"],0,-3)); ?>"   autocomplete="off" class="layui-input">
              </div>
          </div>
            <div class="layui-form-item">
              <label for="serverfee" class="layui-form-label">
                  <span class="x-red"></span>手续费
              </label>
              <div class="layui-input-inline">
                  <input type="text" name="serverfee" value="<?php echo (substr($order["serverfee"],0,-3)); ?>"   autocomplete="off" class="layui-input">
              </div>
          </div>
          
          <div class="layui-form-item">
              <label for="orderstatus" class="layui-form-label">
                  <span class="x-red">*</span>签单状态
              </label>
              <div class="layui-input-inline">
                  <select name="orderstatus">
                      <?php if($order['orderstatus'] == 1): ?><option value="1" selected>待发货</option><?php else: ?><option value="1">待发货</option><?php endif; ?>
                      <?php if($order['orderstatus'] == 2): ?><option value="2" selected>已发货</option><?php else: ?><option value="2">已发货</option><?php endif; ?>
                      <?php if($order['orderstatus'] == 3): ?><option value="3" selected>已签收</option><?php else: ?><option value="3">已签收</option><?php endif; ?>
                      <?php if($order['orderstatus'] == 4): ?><option value="4" selected>退单</option><?php else: ?><option value="4">退单</option><?php endif; ?>
                  </select>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="reciivingtime" class="layui-form-label">
                  <span class="x-red">*</span>收货时间
              </label>
              <div class="layui-input-inline">
                      <input class="layui-input" name="reciivingtime" value="<?php echo ($order["收货时间"]); ?>" placeholder="收货时间" id="LAY_demorange_s" autocomplete="off">
              </div>
          </div>
          <div class="layui-form-item layui-form-text" style="width: 93%">
              <label for="desc" class="layui-form-label">
                  描述
              </label>
              <div class="layui-input-block">
                  <textarea placeholder="请输入内容" id="desc" name="desc" class="layui-textarea"><?php echo ($order["desc"]); ?></textarea>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  提交
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer','laydate'], function(){
            $ = layui.jquery;
            laydate = layui.laydate;
          var form = layui.form
          ,layer = layui.layer;

            laydate.render({
                elem: '#LAY_demorange_s', //指定元素
                type: 'datetime',
                format: 'y-MM-dd',
                value: new Date()
            });
          //监听提交
          form.on('submit(add)', function(data){
              var data = data.field;
              $.ajax({
                  type: 'POST',
                  url: '',
                  dataType: 'json',
                  data:data,
                  success: function(data){
                      if(data.statu == 200){
                          layer.alert(data.msg, {icon: 6},function () {
                              // 获得frame索引
                              var index = parent.layer.getFrameIndex(window.name);
                              //关闭当前frame
                              parent.layer.close(index);
                              //刷新父页面
                              window.parent.location.reload();
                          });
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
        });
    </script>
  </body>
</html>