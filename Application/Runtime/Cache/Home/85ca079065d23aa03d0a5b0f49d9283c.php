<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>
            X-admin v1.0
        </title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="/Public/Home/css/x-admin.css" media="all">
    </head>
    
    <body>
        <div class="x-body">
            <form class="layui-form" onsubmit="return false">
                <input type="hidden" name="customerid" value="<?php echo ($data["cid"]); ?>">
                <div class="layui-form-item">
                    <label for="L_name" class="layui-form-label">
                        <span class="x-red">*</span>姓名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_name" name="name" value="<?php echo ($data['name']); ?>" required="" lay-verify="name"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">性别</label>
                    <div class="layui-input-block">
                        <input type="radio" name="sex" value="1" title="男">
                        <input type="radio" name="sex" value="2" title="女" checked>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_age" class="layui-form-label">
                        <span class="x-red">*</span>年龄
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_age" name="age" value="<?php echo ($data['age']); ?>"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_phone" class="layui-form-label">
                        <span class="x-red">*</span>电话
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_phone" name="phone" required="" value="<?php echo ($data['phone']); ?>" lay-verify="phone"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_address" class="layui-form-label">
                        <span class="x-red">*</span>添加新地址
                    </label>
                    <div class="layui-input-inline" style="width: 26%">
			    		<select name="P1" lay-filter="province">
			    			<option></option>
			    		</select>
			    	</div>
			    	<div class="layui-input-inline" style="width: 26%">
			    		<select name="C1" lay-filter="city">
			    			<option></option>
			    		</select>
			    	</div>
			    	<div class="layui-input-inline" style="width: 28%">
			    		<select name="A1" lay-filter="area">
			    			<option></option>
			    		</select>
                    </div>
                    <div class="layui-input-inline" style="width: 82%;margin-left: 110px;margin-top: 15px;">
                        <input type="text" id="L_address" name="address"  placeholder="请输入详细地址"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                
                <div class="layui-form-item layui-form-text">
                      <label for="note" class="layui-form-label">
                          备注
                      </label>
                      <div class="layui-input-block">
                          <textarea placeholder="请输入内容" style="width: 93%"  id="note" name="note" class="layui-textarea"><?php echo ($data['note']); ?></textarea>
                      </div>
                </div>
                <div class="layui-form-item" style="margin-top: 40px">
                    <button  class="layui-btn" lay-filter="add" style="margin-left: 110px;width: 125px" lay-submit="">
                        确认修改
                    </button>
                </div>
            </form>
        </div>
        
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8">
        </script>
        

        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        
        <script src="/Public/Home/js/jquery.min.js" charset="utf-8"></script>
        <script src="/Public/Home/js/citys.js" charset="utf-8"></script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;
            
              //自定义验证规则
              form.verify({
                  name: function(value){
                      if(value == ''){
                          return '必须输入客户姓名';
                      }
                  }
                ,phone: function(value){
                  if(value.length < 7){
                    return '请输入正确的手机号码';
                  }
                }
              });

              //监听提交
              form.on('submit(add)', function(data){
                  var data = data.field;
                  $.ajax({
                      type: 'POST',
                      url: 'edit',
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

            pca.init('select[name=P1]', 'select[name=C1]', 'select[name=A1]');
            });
        </script>
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
    </body>

</html>