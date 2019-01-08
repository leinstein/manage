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
                        <th width="120px">
                            项目-销售
                        </th>
                        <th>
                            订单备注
                        </th>
                        <th>
                            客服回访
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
                         <td>
                            <?php echo ($info["server_note"]); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
  </body>
</html>