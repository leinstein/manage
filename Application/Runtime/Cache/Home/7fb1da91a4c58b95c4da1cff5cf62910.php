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
    <script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Home/lib2/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/Home/js/xadmin.js"></script>
    <link rel="stylesheet" href="/Public/Home/laydate/theme/default/laydate.css">
  </head>
  <style>
      .layui-input{ width: 245px;}
      .layui-form-item{width: 46%;display: inline-block;}
      .layui-textarea{min-height: 50px;}
      .layui-form-select .layui-edge{right: -40px;}
  </style>
  <body>
    <div class="x-body">
        <form class="layui-form" onsubmit="return false">
            <input type="hidden"  name="orderid" value="<?php echo ($order["orderid"]); ?>">
            <input type="hidden"  name="cid" value="<?php echo ($order["cid"]); ?>">
            <input type="hidden"  name="uid" value="<?php echo ($order["saleid"]); ?>">
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red"></span>收货人
              </label>
              <div class="layui-input-inline">
                  <input type="text" name="username" value="<?php echo ($customer['name']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电话&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($customer['phone']); ?>" required="" readonly
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
              <label for="couriername" class="layui-form-label">
                  <span class="x-red">*</span>配送物流
              </label>
              <div class="layui-input-inline">
                  <select id="shipping" name="couriername" class="valid">
                      <?php if(is_array($courier)): foreach($courier as $key=>$v): if($v['couname'] == $order['couriername']): ?><option value="<?php echo ($v["couname"]); ?>" selected="selected"><?php echo ($v["couname"]); ?></option>
                            <?php else: ?>
                              <option value="<?php echo ($v["couname"]); ?>"><?php echo ($v["couname"]); ?></option><?php endif; endforeach; endif; ?>
                  </select>
              </div>
          </div>
            <div class="layui-form-item">
              <label for="courierlist" class="layui-form-label">
                  <span class="x-red">*</span>快递单号
              </label>
              <div class="layui-input-inline">
                  <input type="text" name="courierlist"  autocomplete="off" class="layui-input">
              </div>
          </div>
            <div class="layui-form-item">
              <label for="courierfee" class="layui-form-label">
                  <span class="x-red">*</span>快递费
              </label>
              <div class="layui-input-inline">
                  <input type="text" name="courierfee"  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="orderstatus" class="layui-form-label">
                  <span class="x-red">*</span>付款方式
              </label>
              <div class="layui-input-inline">
                  <select name="orderstatus">
                    <option value="1">待发货</option>
                    <option value="2">已发货</option>
                    <!--<option value="3">已签收</option>-->
                    <option value="4">退单</option>
                  </select>
              </div>
          </div>
            <div class="layui-form-item">
              <label for="deliverytime" class="layui-form-label">
                  <span class="x-red">*</span>发货时间
              </label>
              <div class="layui-input-inline">
                      <input class="layui-input" name="deliverytime" value="<?php echo ($order["deliverytime"]); ?>" placeholder="发货时间" id="LAY_demorange_s" autocomplete="off">
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
                  确认修改
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['laydate','form','layer'], function(){
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
          //自定义验证规则
          form.verify({
            nikename: function(value){
              if(value.length < 5){
                return '昵称至少得5个字符啊';
              }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
          });

          //监听提交
          form.on('submit(add)', function(data){
              var data = data.field;
                    console.log(data);
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
    <script>
        $(function () {
            $('#deliverytime').val("<?php echo $order['deliverytime']; ?>");
        })
    </script>
  </body>
</html>