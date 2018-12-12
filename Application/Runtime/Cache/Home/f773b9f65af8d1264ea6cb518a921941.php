<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!--<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />-->
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
      .layui-form-select .layui-edge{
          right: -285px;
      }
      .layui-input, .layui-textarea{
          width: 481px;
      }
      .layui-form-item{
          width: 48%;
          display: inline-block;
      }
      .layui-textarea{
          min-height: 50px;
      }
    #goodsbox{
        width: 1075px;
        border: 1px solid #1ba194;
        border-radius: 2px;
        margin-left: 110px;
        display: none;
        margin-bottom: 30px;
        margin-top: -7px;
    }
    #goodsitem{
        margin: 15px 10px;
    }
    #goodsnumber{
        width: 45px;
        display: inline;
        height: 24px;
        line-height: 24px;
        line-height: 24px\9;
        border: 1px solid #e2e2e2;
        background-color: #fff;
        border-radius: 2px;
    }
    #orderfee{
        margin-left: 110px;
    }
      #orderfee th{
          color: #777;
          border: 0px;
          padding-right: 2px;
      }
      #orderfee td{
          border: 0px;
          padding-left: 2px;
      }
      #show_goods{
          cursor: pointer;
          text-align: center;
          background-color: #1ba194;
          border-radius: 5px;
          border:0px;
          width: 100px;
          color: #ffffff;
          font-size: 16px;
      }
      .icon_shop{
          cursor: pointer;
          margin: 0 10px;
          font-size: 28px;
          color: #000000;
      }
    #orderfee tr{
        background-color: #f2f2f2;
    }
    #orderfee th{
        text-align: right;
    }
    #orderfee td{
        font-size: 24px;
    
    }
    #orderfee td font{
        color: #999;
    }
    #orderfee td blod,span{
        color: red;
    }
      .zengp{
          display: inline-block;
          /*border:1px solid #777;*/
          padding: 5px 30px;
          /*margin: -3px;*/
          border-radius: 3px;
      }
      #show_zeng{
          cursor: pointer;
          background-color: #1ba194;
          width: 130px;
          height: 37px;
          border-radius: 5px;
          line-height: 37px;
          text-align: center;
          display: inline-block;
          margin-top: 5px;
          color: #ffffff;
          font-size: 16px;
      }
      .zengpar{
          margin-right: 20px;
          float: left;
          height: 45px;
          background-color: #f2f2f2;
          width: 31%;
          text-align: center;
          margin-bottom: 15px;
      }
      #zengbox{
          width: 1075px;
          border: 1px solid #1ba194;
          border-radius: 2px;
          margin-left: 110px;
          display: none;
          margin-bottom: 30px;
          margin-top: 7px;
      }
      #zengsitem{
          margin: 15px 10px;
      }
      #btn_sub{
          margin-left: 596px;
      }
      #btn_sub button{
          /*float: right;*/
          display: inline-block;
          width: 165px;
          height: 39px;
          position: relative;
          vertical-align: middle;
          line-height: 39px;
          cursor: pointer;
          text-align: center;
          font-size: 16px;
          font-weight: 700;
          background: #ff0036;
          color: #fff;
          margin-left: 422px;
          margin-top: 30px;
      }
      .btn_order{
          float: right;
          padding: 9px 15px;
          min-height: 20px;
          line-height: 20px;
          font-size: 20px;
          color: #666;
          margin-top: 20px;
      }
  </style>
  <body>
    <div class="x-body">
        <form class="layui-form" onsubmit="return false">
          <input type="hidden" name="orderid" value="<?php echo ($data["orderid"]); ?>">
          <input type="hidden" name="cid" value="<?php echo ($customer["cid"]); ?>">
            <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red"></span>姓名
              </label>
              <div class="layui-input-inline">
                  <input type="text" value="<?php echo ($customer["name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电话&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($customer["phone"]); ?>" required="" disabled="disabled"
                         autocomplete="off" class="layui-input" style="border: 0px;">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="address_id" class="layui-form-label">
                  <span class="x-red"></span>收货地址
              </label>
              <div class="layui-input-inline">
                  <select name="address_id">
                      <?php if(is_array($add_ress)): foreach($add_ress as $key=>$v): if($order['address_id'] == $v['addressid']): ?><option value="<?php echo ($v["addressid"]); ?>" selected="selected"><?php echo ($v["add"]); ?></option>
                            <?php else: ?>
                              <option value="<?php echo ($v["addressid"]); ?>"><?php echo ($v["add"]); ?></option><?php endif; endforeach; endif; ?>
                  </select>
              </div>
          </div>
          <div class="layui-form-item layui-form-text" style="width: 90%">
              <label for="desc" class="layui-form-label">
                  <span class="x-red">*</span>商品列表
              </label>
              <div class="layui-input-block">
                  <table class="layui-table" style="width: 108%">
                      <thead>
                        <tr>
                            <td>商品名</td>
                            <td>商品单价</td>
                            <td>商品库存</td>
                            <td>购买数量</td>
                            <td>单品总价</td>
                            <td>操作</td>
                        </tr>
                      </thead>
                      <tbody id="tbody_goods">
                          <?php if(is_array($goods_buy)): foreach($goods_buy as $key=>$v): ?><tr>
                                <td><?php echo ($v["goodsname"]); ?></td>
                                <td><?php echo (substr($v["goodsprice"],0,-3)); ?></td>
                                <td><?php echo ($v["goodsstock"]); ?></td>
                                <td onselectstart="return false">
                                    <span onclick="shop_re(this,'<?php echo (substr($v["goodsprice"],0,-3)); ?>')" class="icon_shop">-</span>
                                    <input type="text" readonly="readonly"  class="layui-input" id="goodsnumber" name="goodsnumber_<?php echo ($v["goodsid"]); ?>" value="<?php echo ($v["goods_count"]); ?>"><span onclick="shop_ad(this,'<?php echo (substr($v["goodsprice"],0,-3)); ?>')" class="icon_shop">+</span>
                                </td>
                                <td><?php echo (substr($v["goodsprice"],0,-3)); ?></td>
                                <td>
                                    <a title="删除"  href="javascript:;" onclick="goods_del(this,'<?php echo (substr($v["goodsprice"],0,-3)); ?>')" style="text-decoration:none">删 除</a>
                                </td>
                            </tr><?php endforeach; endif; ?>
                          <tr><td style="border:0px;height: 2px"></td></tr>
                          <tr>
                            <td id="show_goods" onclick="show_goods()">
                                <i class="layui-icon">&#xe608;</i> 添 加 商 品
                            </td>
                        </tr>
                      </tbody>
                  </table>
              </div>
          </div>
            <div id="goodsbox">
              <?php if(is_array($goods_s)): foreach($goods_s as $key=>$v): ?><a style="text-decoration:none" id="goodsitem" class="layui-btn" onclick="goods_card(this,'<?php echo ($v["goodsid"]); ?>')" href="javascript:;" title="加入清单">
                                        <?php echo ($v["goodsname"]); ?>
                  </a><?php endforeach; endif; ?>
          </div>
          <div class="layui-form-item layui-form-text" style="width: 90%">
              <label for="desc" class="layui-form-label">
                  赠品列表
              </label>
              <div class="layui-input-block" id="zeng_add">
                  
                    <?php if(is_array($zengs_buy)): foreach($zengs_buy as $key=>$v): ?><div class="zengpar">
                        <div class="zengp" onselectstart="return false">
                            <?php echo ($v["goodsname"]); ?>&nbsp;&nbsp;&nbsp;
                            <span onclick="shop_pre(this)" class="icon_shop">-</span>
                            <input type="text" readonly="readonly"  class="layui-input" id="goodsnumber"  name="zengsnumber_<?php echo ($v["goodsid"]); ?>" value="<?php echo ($v["zengs_count"]); ?>">
                            <span onclick="shop_nex(this)" class="icon_shop">+</span>&nbsp;&nbsp;&nbsp;
                            <a title="删除"  href="javascript:;" onclick="zeng_del(this)" style="text-decoration:none">删 除</a>
                        </div>
                        </div><?php endforeach; endif; ?>
                  
                  <div id="show_zeng" onclick="show_zeng()">
                      <i class="layui-icon">&#xe608;</i> 添 加 赠 品
                  </div>
              </div>
          </div>
            <div id="zengbox">
              <?php if(is_array($goods_z)): foreach($goods_z as $key=>$v): ?><a style="text-decoration:none" id="zengsitem" class="layui-btn" onclick="zeng_card(this,'<?php echo ($v["goodsid"]); ?>')" href="javascript:;" title="加入清单">
                                        <?php echo ($v["goodsname"]); ?>
                  </a><?php endforeach; endif; ?>
          </div>
          
          <script>
          
          </script>
          <div class="layui-form-item" style="margin-top: 20px">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>付款方式
              </label>
              <div class="layui-input-inline">
                  <select name="paytype">
                    <option value="">付款方式</option>
                      <?php if($order['paytype'] == 3): ?><option value="3" selected>货到付款</option>
                          <?php else: ?>
                          <option value="3">货到付款</option><?php endif; ?>
                      <?php if($order['paytype'] == 1): ?><option value="1" selected>已付全款</option>
                          <?php else: ?>
                          <option value="1">已付全款</option><?php endif; ?>
                      <?php if($order['paytype'] == 2): ?><option value="2" selected>付定金-货到付款</option>
                          <?php else: ?>
                          <option value="2">付定金-货到付款</option><?php endif; ?>
                  </select>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>支付方式
              </label>
              <div class="layui-input-inline">
                  <select name="payform">
                    <option value="">支付方式</option>
                      <?php if($order['payform'] == 1): ?><option value="1" selected>微信</option>
                          <?php else: ?>
                          <option value="1">微信</option><?php endif; ?>
                      <?php if($order['payform'] == 2): ?><option value="2" selected>支付宝</option>
                          <?php else: ?>
                          <option value="2">支付宝</option><?php endif; ?>
                      <?php if($order['payform'] == 3): ?><option value="3" selected>银行卡转账</option>
                          <?php else: ?>
                           <option value="3">银行卡转账</option><?php endif; ?>
                      <?php if($order['payform'] == 4): ?><option value="4" selected>快递代收</option>
                          <?php else: ?>
                          <option value="4">快递代收</option><?php endif; ?>
                  </select>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="cheapprice" class="layui-form-label">
                  <span class="x-red">*</span>优惠金额
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="cheapprice" onblur="goods_p(this)" name="cheapprice" value="<?php echo (substr($order["cheapprice"],0,-3)); ?>" required="" autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="pay" class="layui-form-label">
                  <span class="x-red">*</span>已付款金额
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="pay" name="pay" value="<?php echo (substr($order["pay"],0,-3)); ?>" onblur="goods_y(this)" value="<?php echo (substr($order["pay"],0,-3)); ?>" required="" autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="couriername" class="layui-form-label">
                  <span class="x-red">*</span>配送物流
              </label>
              <div class="layui-input-inline">
                  <select id="shipping" name="couriername" class="valid">
                      <?php if(is_array($courier)): foreach($courier as $key=>$v): if($order['couriername'] == $v['couname']): ?><option value="<?php echo ($v["couname"]); ?>" selected><?php echo ($v["couname"]); ?></option>
                            <?php else: ?>
                              <option value="<?php echo ($v["couname"]); ?>"><?php echo ($v["couname"]); ?></option><?php endif; endforeach; endif; ?>
                  </select>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="deliverytime" class="layui-form-label">
                  <span class="x-red">*</span>发货时间
              </label>
              <div class="layui-input-inline">
                      <input class="layui-input" name="deliverytime" placeholder="发货时间" value="<?php echo (date('Y-m-d',$order["deliverytime"])); ?>" id="LAY_demorange_s">
              </div>
          </div>
            <div class="layui-form-item layui-form-text" style="width: 100%">
              <label for="desc" class="layui-form-label">
                  备注
              </label>
              <div class="layui-input-block">
                  <textarea placeholder="请输入内容" style="width: 1074px;min-height: 100px" id="desc" name="desc" class="layui-textarea"><?php echo ($order["desc"]); ?></textarea>
              </div>
          </div>
            <div id="orderfee">
                <table class="layui-table" style="width: 96%">
                    <tr>
                        <th>订单原价:</th>
                        <td><font>￥</font> <span  id="totlepay"><?php echo ($order["totalpeice"]); ?></span></td>
                        <th>优惠金额:</th>
                        <td><font>￥</font> <span  id="ppay"><?php echo (substr($order["cheapprice"],0,-3)); ?></span></td>
                        <th>已付款:</th>
                        <td><font>￥</font> <span id="payyi"><?php echo (substr($order["pay"],0,-3)); ?></span></td>
                        <th>快递代收款:</th>
                        <td><font>￥</font> <span id="paydai"><?php echo (substr($order["paymentfee"],0,-3)); ?></span></td>
                    </tr>
                </table>
            </div>
            
          <div class="layui-form-item" id="btn_sub">
              <label for="L_repass" class="layui-form-label">
              </label>
              <div class="btn_order"> 订单总价 : <font style="font-size: 32px;color: #999">￥</font><span  id="nowpay" style="    color: #ff1b4b;font: 700 36px tahoma;"><?php echo (substr($order["orderprice"],0,-3)); ?></span></div>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  <i class="layui-icon">&#xe618;</i> 修 改 订 单
              </button>
          </div>
      </form>
    </div>
    <script src="/Public/Home/lib2/layui/layui.js" charset="utf-8"></script>
    <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
    <script>
        layui.use(['laydate','element','form','layer'], function(){
            $ = layui.jquery;
            laydate = layui.laydate;
            var form = layui.form
                ,layer = layui.layer;

            laydate.render({
                elem: '#LAY_demorange_s' //指定元素
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
        
         /*添加商品*/
         function goods_card(obj,goodsid){
             $.ajax({
                 type: 'POST',
                 url: '/Home/Customer/goods_add_card',
                 dataType: 'json',
                 data:{'goodsid':goodsid},
                 success: function(data){
                     if(data.statu == 200){
                         $("#tbody_goods").prepend('<tr>\n' +
                             '<td>'+ data.msg.goodsname +'</td>\n' +
                             '<td>'+ data.msg.goodsprice +'</td>\n' +
                             '<td>'+ data.msg.goodsstock +'</td>\n' +
                             '<td onselectstart="return false">\n' +
                             '<span onclick="shop_re(this,'+data.msg.goodsprice +
                             ')" class="icon_shop">-</span>' +
                             '<input type="text" readonly="readonly"  class="layui-input" id="goodsnumber" name="goodsnumber_'+ data.msg.goodsid +'" value="1">' +
                             '<span onclick="shop_ad(this,'+data.msg.goodsprice +
                             ')" class="icon_shop">+</span>\n' +
                             '</td>\n' +
                             '<td>'+ data.msg.goodsprice +'</td>\n' +
                             '<td>\n' +
                             '<a title="删除"  href="javascript:;" onclick="goods_del(this,' +data.msg.goodsprice +
                             ')"\n' +
                             'style="text-decoration:none">\n' +
                             '删 除\n' +
                             '</a>\n' +
                             '</td>\n' +
                             '</tr> ');
                         $('#goodsbox').css('display','none');
                         var totle = $('#totlepay').html();
                         var ppay = $('#ppay').html();
                         if(totle != 0){
                             totle = Number(totle) + Number(data.msg.goodsprice);
                         }else{
                             totle = Number(data.msg.goodsprice);
                         }
                         $('#totlepay').html(totle);
                         $('#nowpay').html(totle - ppay);
                         $(obj).remove();
                     }else{
                         layer.msg(data.msg);
                         return false;
                     }
                 },
                 error:function(data) {
                     layer.msg('系统错误');
                 },
             });
         }
         
         /*添加赠品*/
         function zeng_card(obj,goodsid){
             $.ajax({
                 type: 'POST',
                 url: '/Home/Customer/goods_add_card',
                 dataType: 'json',
                 data:{'goodsid':goodsid},
                 success: function(data){
                     if(data.statu == 200){
                         $("#zeng_add").prepend('<div class="zengpar">\n' +
                             '<div class="zengp" onselectstart="return false">'+data.msg.goodsname +
                             '&nbsp;&nbsp;&nbsp;<span onclick="shop_pre(this)" class="icon_shop">-</span>\n' +
                             '<input type="text" readonly="readonly"  class="layui-input" id="goodsnumber" name="zengsnumber_'+ data.msg.goodsid +'" value="1">\n' +
                             '<span onclick="shop_nex(this)" class="icon_shop">+</span>&nbsp;&nbsp;&nbsp;\n' +
                             '<a title="删除"  href="javascript:;" onclick="zeng_del(this)" style="text-decoration:none">\n' +
                             '删 除\n' +
                             '</a>\n' +
                             '</div>');
                         $('#zengbox').css('display','none');
                         $(obj).remove();
                     }else{
                         layer.msg(data.msg);
                         return false;
                     }
                 },
                 error:function(data) {
                     layer.msg('系统错误');
                 },
             });
         }
    </script>
    <script>
        //删除商品
       function goods_del(obj,price){
           var goods_number  = Number($(obj).parent().prev().prev().find('input').val());
           var totle = Number($('#totlepay').html());
           totle = totle - price*goods_number;
           var nowpay = Number($('#nowpay').html());
           nowpay = nowpay - price*goods_number;
           $('#totlepay').html(totle);
           $('#nowpay').html(nowpay);
           $('#paydai').html( nowpay - Number($('#payyi').html()));
           $(obj).parents("tr").remove();
        }
        //删除赠品
        function zeng_del(obj) {
            $(obj).parent("div").parent("div").remove();
        }
        //优惠金额变动
        function goods_p(obj) {
            var p = Number($(obj).val());
            var totlepay = Number($('#totlepay').html());
            var payyi = Number($('#payyi').html());
            $('#ppay').html(p);
            $('#nowpay').html( totlepay - p);
            var paydai = totlepay - payyi -p;
            $('#paydai').html(paydai);
        }
        //已付款金额变动
        function goods_y(obj) {
            var p = Number($(obj).val());
            var nowpay = Number($('#nowpay').html());
            var youhui = Number($('#ppay').html());
            $('#payyi').html(p);
            $('#paydai').html( nowpay - p);
        }
        //展示商品
        function show_goods() {
            $('#goodsbox').css('display','block');
        }
        //展示赠品
        function show_zeng() {
            $('#zengbox').css('display','block');
        }
        //商品数量+1
        function shop_ad(obj,price) {
            var goods_number  = Number($(obj).prev().val());
            var totle = Number($('#totlepay').html());
            price = Number(price);
            totle = totle + price;
            var nowpay = Number($('#nowpay').html());
            nowpay = nowpay + price;
            goods_number = goods_number + 1;
            $(obj).prev().val(goods_number);
            $(obj).parent().next().html(goods_number*price);
            $('#totlepay').html(totle);
            $('#nowpay').html(nowpay);
            $('#paydai').html( nowpay - Number($('#payyi').html()));
            
        }
        //赠品数量+1
        function shop_pre(obj) {
            var goods_number  = Number($(obj).next().val());
            goods_number = goods_number - 1;
            $(obj).next().val(goods_number);
        }
        //赠品数量-1
        function shop_nex(obj) {
            var goods_number  = Number($(obj).prev().val());
            goods_number = goods_number + 1;
            $(obj).prev().val(goods_number);
        }
        //商品数量-1
        function shop_re(obj,price) {
            var goods_number  = Number($(obj).next().val());
            var totle = Number($('#totlepay').html());
            totle = totle - Number(price);
            var nowpay = Number($('#nowpay').html());
            nowpay = nowpay - price;
            if(goods_number>1){
                goods_number = goods_number - 1;
                $(obj).next().val(goods_number);
                $(obj).parent().next().html(goods_number*price);
                $('#totlepay').html(totle);
                $('#nowpay').html(nowpay);
                $('#paydai').html( nowpay - Number($('#payyi').html()));
            }else{
                layer.msg('购买商品数量必须大于1');
            }
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