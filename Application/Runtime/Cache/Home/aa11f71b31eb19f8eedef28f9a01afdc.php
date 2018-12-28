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
    <script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Home/lib2/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/Home/js/xadmin.js"></script>
    <script src="/Public/Home/laydate/laydate.js"></script>
    <link rel="stylesheet" href="/Public/Home/laydate/theme/default/laydate.css">
    
      <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>
      .infoitem{
          display: inline-block;
          border: 0;
      }
      
  </style>
  <body>
    <div class="x-body">
        <form class="layui-form" onsubmit="return false">
            <input type="hidden"  name="cid" value="<?php echo ($customer["cid"]); ?>">
          <div class="layui-form-item infoitem">
              <label for="username" class="layui-form-label">
                  <span class="x-red"></span>客户姓名：
              </label>
              <div class="layui-input-inline" style="width: 100px">
                  <input type="text" name="username" value="<?php echo ($customer["name"]); ?>" required="" readonly
                  autocomplete="off" class="layui-input" style="border: 0;">
              </div>
          </div>
          <div class="layui-form-item infoitem" style="margin-left: -45px">
              <label for="phone" class="layui-form-label">
                  <span class="x-red"></span>电话：
              </label>
              <div class="layui-input-inline" style="width: 150px">
                  <input type="text" name="phone" value="<?php echo ($customer["phone"]); ?>" required="" readonly
                         autocomplete="off" class="layui-input" style="border: 0;">
              </div>
          </div>
            <div class="layui-form-item infoitem" style="margin-left: -10px">
              <label for="address" class="layui-form-label">
                  <span class="x-red"></span>收货地址：
              </label>
              <div class="layui-input-inline">
                  <input type="text" name="address" value="<?php echo ($add); ?>" required="" readonly
                         autocomplete="off" class="layui-input" style="width: 350px;border: 0;">
              </div>
          </div>
            
                    <table class="layui-table" style="width: 92%;margin-left: 30px;margin-bottom: 20px">
                    <thead>
                        <tr>
                            <th>
                                序号
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
                                下单时间
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($o_info == null): ?><tr><td colspan="5" style="text-align: center">此客户还没有订单</td></tr>
                        <?php else: ?>
                            <?php if(is_array($o_info)): foreach($o_info as $key=>$v): ?><tr>
                                    <td>
                                        <?php echo ++$i;?>
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
                                        <?php if($v['ordercreatetime'] != 0): echo (date("Y-m-d",$v["ordercreatetime"])); endif; ?>
                                    </td>
                                </tr><?php endforeach; endif; endif; ?>
                    </tbody>
                </table>
            
            <style>
                .title_box{
                    margin: 35px 0 30px 30px;
                    border-bottom: 2px solid #009688;
                    width: 92%;
                    font-size: 18px;
                    color: #009688;
                    font-weight: bold;
                    padding: 2px;
                }
            </style>
            <div class="title_box">
                添加待办任务
            </div>
            
          <div class="layui-form-item" style="width: 47%;display: inline-block;">
              <label for="type" class="layui-form-label">
                  <span class="x-red">*</span>执行类型
              </label>
              <div class="layui-input-inline" style="width: 230px">
                  <select name="type">
                    <option value="客户跟踪" selected>客户跟踪</option>
                  </select>
              </div>
          </div>
            
          <div class="layui-form-item" style="width: 47%;display: inline-block;">
              <label for="do_time" class="layui-form-label">
                  <span class="x-red">*</span>执行时间
              </label>
              <div class="layui-input-inline">
                      <input class="layui-input" name="do_time" placeholder="执行时间" id="LAY_demorange_s" style="width: 230px" autocomplete="off">
              </div>
          </div>
          <div class="layui-form-item layui-form-text" style="width: 93%">
              <label for="content" class="layui-form-label">
                  <span class="x-red">*</span>任务详情
              </label>
              <div class="layui-input-block">
                  <textarea style="width: 103%" placeholder="请输入内容" id="content" name="content" class="layui-textarea"></textarea>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="" style="width: 130px;margin-left: 669px;margin-top: 15px">
                  提 交
              </button>
          </div>
      </form>
        <style>
            ul li {
                list-style: none;
            }
            .track-rcol {
                width: 92%;
                /*border: 1px solid #eee;*/
                margin-top: 40px;
                margin-left: 30px;
            }

            .track-list {
                margin: 20px;
                padding-left: 5px;
                position: relative;
            }

            .track-list li {
                position: relative;
                padding: 20px 0 10px 25px;
                line-height: 18px;
                border-left: 1px solid #d9d9d9;
                color: #777;
            }

            .track-list li.first {
                color: red;
                padding-top: 0;
                border-left-color: #fff;
                margin-bottom: 15px;
            }

            .track-list li .node-icon {
                position: absolute;
                left: -6px;
                top: 50%;
                width: 9px;
                height: 9px;
                border-radius: 50%;
                background-color: #777;
            }

            .track-list li.first .node-icon {
                background-position: 0 -72px;
            }

            .track-list li .time {
                margin-right: 20px;
                position: relative;
                top: 4px;
                display: inline-block;
                vertical-align: middle;
            }

            .track-list li .txt {
                position: relative;
                top: 4px;
                display: inline-block;
                vertical-align: middle;
            }

            .track-list li.first .time {
                margin-right: 20px;
            }

            .track-list li.first .txt {
                max-width: 600px;
            }

        </style>
        <style>
                .title_t{
                    margin: 35px 0 30px 3px;
                    border-bottom: 2px solid #009688;
                    width: 104%;
                    font-size: 18px;
                    color: #009688;
                    font-weight: bold;
                    padding: 2px;
                    margin-left: -17px;
                }
            </style>
        <div class="track-rcol">
			<div class="track-list">
                <ul>
                    <li  class="title_t" style="border-left: 0;color: #009688;padding-left: 2px">待执行任务</li>
                    <?php if(is_array($backlog_info)): foreach($backlog_info as $key=>$v): if($v['status'] == 1): ?><li class="first">
                                <i class="node-icon"></i>
                                <span class="time"><font style="font-weight: bold">任务内容 </font>　<?php echo (date('Y-m-d H:i',$v["create_time"])); ?>　</span>
                                <span class="txt">　<?php echo ($v["content"]); ?></span><div style="height: 10px"></div>
                                <span class="time"><font style="font-weight: bold">处理结果 </font>　<?php echo (date('Y-m-d H:i',$v["do_time"])); ?>　</span>
                                <span class="txt">　<?php if($v['recontent'] == ''): ?><font style="font-weight: bold;color: #777">未处理</font><?php endif; echo ($v["recontent"]); ?></span>
					        </li><?php endif; endforeach; endif; ?>
                </ul>
				<ul>
                    <li class="title_t" style="border-left: 0;color: #009688;padding-left: 2px;">已完成任务</li>
					<?php if(is_array($backlog_info)): foreach($backlog_info as $key=>$v): if($v['status'] != 1): ?><li>
                                <i class="node-icon"></i>
                                <span class="time"><font style="font-weight: bold">任务内容 </font>　<?php echo (date('Y-m-d H:i',$v["create_time"])); ?>　</span>
                                <span class="txt">　<?php echo ($v["content"]); ?></span><div style="height: 10px"></div>
                                <span class="time"><font style="font-weight: bold">处理结果 </font>　<?php echo (date('Y-m-d H:i',$v["do_time"])); ?>　</span>
                                <span class="txt">　<?php echo ($v["recontent"]); ?></span>
					        </li><?php endif; endforeach; endif; ?>
				</ul>
			</div>
		</div>
    </div>
    <script>
        layui.use(['laydate','form','layer'], function(){
            $ = layui.jquery;
            laydate = layui.laydate;
          var form = layui.form
          ,layer = layui.layer;
            
            laydate.render({
                elem: '#LAY_demorange_s' //指定元素
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
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>