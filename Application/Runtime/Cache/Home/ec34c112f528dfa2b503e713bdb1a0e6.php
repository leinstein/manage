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
  <style>
      .layui-input{
          border: 0;
      }
      .layui-form-item{
          border-bottom: 0;
          width: 45%;
      }
      .block_title{
          margin-left: 10px;
          font-size: 18px;
          font-weight: bold;
      }
      .title3{
          margin-top: 35px;
      }
  </style>
  <body>
    <div class="x-body">
             <div class="block_title">收货人信息</div>
             <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            收货人姓名
                        </th>
                       <th>
                            收货人电话
                        </th>
                        <th>
                            收货人地址
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo ($info["name"]); ?>
                        </td>
                        <td>
                            <?php echo ($info["phone"]); ?>
                        </td>
                        <td>
                            <?php echo ($info["address"]); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="block_title title3">订单详情</div>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            订单号
                        </th>
                        <th>
                            购买商品
                        </th>
                        <th>
                            订单金额
                        </th>
                        <th>
                            优惠金额
                        </th>
                        <th>
                            已付款
                        </th>
                        <th>
                            待付款
                        </th>
                        <th>
                            付款方式
                        </th>
                        <th>
                            支付方式
                        </th>
                        <th>
                            订单状态
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo ($info["orderno"]); ?>
                        </td>
                        <td>
                            <?php echo ($info["goods_de"]); ?>
                        </td>
                        <th>
                            <?php echo (substr($info["orderprice"],0,-3)); ?>
                        </th>
                        <th>
                            <?php echo (substr($info["cheapprice"],0,-3)); ?>
                        </th>
                        <th>
                            <?php echo (substr($info["pay"],0,-3)); ?>
                        </th>
                        <th>
                            <?php echo (substr($info["payment"],0,-3)); ?>
                        </th>
                        <th>
                            <?php echo ($info["paytype"]); ?>
                        </th>
                        <th>
                           <?php echo ($info["payform"]); ?>
                        </th>
                        <th>
                            <?php echo ($info["orderstatus"]); ?>
                        </th>
                    </tr>
                </tbody>
            </table>
            <div class="block_title title3">物流信息</div>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            快递名称
                        </th>
                        <th>
                            快递单号
                        </th>
                        <th>
                            快递费
                        </th>
                        <th>
                            发货时间
                        </th>
                        <th>
                            签收时间
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo ($info["couriername"]); ?>
                        </td>
                        <td>
                            <?php echo ($info["courierlist"]); ?>
                        </td>
                        <td>
                            <?php echo ($info["courierfee"]); ?>
                        </td>
                        <td>
                            <?php if($info['deliverytime'] != 0): echo (date("Y-m-d",$info["deliverytime"])); endif; ?>
                        </td>
                        <td>
                            <?php if($info['reciivingtime'] != 0): echo (date("Y-m-d",$info["reciivingtime"])); endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="block_title title3">订单备注</div>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="150px">
                            项目-销售
                        </th>
                        <th>
                            备注
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo ($info["objectsale"]); ?>
                        </td>
                        <td>
                            <?php echo ($info["desc"]); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--姓名-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["name"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--电话-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["phone"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--收货地址-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["address"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--项目-销售-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["objectsale"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--订单号-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["orderno"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--购买商品-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["goods_de"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--订单金额-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo (substr($info["orderprice"],0,-3)); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--优惠金额-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo (substr($info["cheapprice"],0,-3)); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--已付款-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo (substr($info["pay"],0,-3)); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--待付款-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo (substr($info["payment"],0,-3)); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--付款方式-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["paytype"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--支付方式-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["payform"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--支付方式-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["payform"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--订单状态-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["orderstatus"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--快递名称-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["couriername"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--快递单号-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["courierlist"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--快递费-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value="<?php echo ($info["courierfee"]); ?>" class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--发货时间-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<?php if($info['deliverytime'] != 0): ?>-->
                      <!--<input type="text" value='<?php echo (date("Y-m-d",$info["deliverytime"])); ?>' class="layui-input">-->
                  <!--<?php endif; ?>-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--收货时间-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<?php if($info['reciivingtime'] != 0): ?>-->
                      <!--<input type="text" value='<?php echo (date("Y-m-d",$info["reciivingtime"])); ?>' class="layui-input">-->
                  <!--<?php endif; ?>-->
              <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item">-->
              <!--<label class="layui-form-label">-->
                  <!--订单备注-->
              <!--</label>-->
              <!--<div class="layui-input-inline">-->
                  <!--<input type="text" value='<?php echo ($info["desc"]); ?>' class="layui-input">-->
              <!--</div>-->
            <!--</div>-->
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
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
            console.log(data);
            //发异步，把数据提交给php
            layer.alert("增加成功", {icon: 6},function () {
                // 获得frame索引
                var index = parent.layer.getFrameIndex(window.name);
                //关闭当前frame
                parent.layer.close(index);
            });
            return false;
          });
          
          
        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>