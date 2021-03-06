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
            <blockquote class="layui-elem-quote">
                <dl style="color:#019688">
                <dt><span >订单</span></dt>
                     <table class="layui-table">
                        <thead>
                            <tr>
                                <th>
                                    订单号
                                </th>
                               <th>
                                    订单金额
                                </th>
                                <th>
                                    商品
                                </th>
                                <th>
                                    订单状态
                                </th>
                                <th>
                                    签收时间
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($o_info)): foreach($o_info as $key=>$v): ?><tr>
                                    <td>
                                        <?php echo ($v["orderno"]); ?>
                                    </td>
                                    <td>
                                        <?php echo (substr($v["orderprice"],0,-3)); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v["goods_de"]); ?>
                                    </td>
                                    <td>
                                        <?php if($v['orderstatus'] == 1): ?>待发货<?php endif; ?>
                                        <?php if($v['orderstatus'] == 2): ?>已发货<?php endif; ?>
                                        <?php if($v['orderstatus'] == 3): ?>已签收<?php endif; ?>
                                        <?php if($v['orderstatus'] == 4): ?>退单<?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($info['reciivingtime'] != 0): echo (date("Y-m-d",$v["reciivingtime"])); endif; ?>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
              </dl>
            </blockquote>
            <div class="pd-20">
                <style>.layui-table td{text-align: left}</style>
              <table  class="layui-table" lay-skin="line">
                <tbody>
                  <tr>
                    <th  width="80">订&nbsp; 单 &nbsp;数：</th>
                    <td><?php echo ($c_info["buyrate"]); ?></td>
                  </tr>
                  <tr>
                    <th>手机号码：</th>
                    <td><?php echo ($c_info["phone"]); ?></td>
                  </tr>
                  <tr>
                    <th>客户微信：</th>
                    <td><?php echo ($c_info["c_weixin"]); ?></td>
                  </tr>
                  <tr>
                    <th>微信名称：</th>
                    <td><?php echo ($c_info["a_role"]); ?></td>
                  </tr>
                  <tr>
                    <th>微&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;信：</th>
                    <td><?php echo ($c_info["a_weixin"]); ?></td>
                  </tr>
                  <tr>
                    <th>地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</th>
                    <td><?php echo ($c_info["address"]); ?></td>
                  </tr>
                  <tr>
                    <th>添加时间：</th>
                    <td><?php echo (date('Y-m-d',$c_info["create_time"])); ?></td>
                  </tr>
                  <tr>
                    <th>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：</th>
                    <td><?php echo ($c_info["note"]); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;
              
            });
        </script>
    </body>
</html>