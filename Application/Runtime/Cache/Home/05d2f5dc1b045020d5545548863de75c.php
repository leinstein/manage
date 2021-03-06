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
            <form class="layui-form">
                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        <span class="x-red">*</span>上传图片
                    </label>
                    <div class="layui-input-inline">
                      <div class="site-demo-upbar">
                        <input type="file" name="file" class="layui-upload-file" id="test">
                      </div>
                    </div>
                </div>
                <div class="layui-form-item" id="LAY_demo_upload" style="padding: 0 20px 0 100px">
                
                </div>
                <div class="layui-form-item">
                    <label  class="layui-form-label">
                    </label>
                </div>
            </form>
            <form class="layui-form" action="#" method="post" id="form_p" onsubmit="return false">
                <div class="layui-form-item">
                    <label for="goodsname" class="layui-form-label">
                        <span class="x-red">*</span>商品名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="goodsname" name="goodsname" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>请填写商品名
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">类型</label>
                    <div class="layui-input-block">
                      <input type="radio" name="zeng" value="1" title="商品" checked>
                      <input type="radio" name="zeng" value="2" title="赠品">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="goodsprice" class="layui-form-label">
                        <span class="x-red">*</span>价格
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="goodsprice" name="goodsprice" required="" lay-verify="required"
                               autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>请填写商品单价
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="goodsstock" class="layui-form-label">
                        <span class="x-red">*</span>库存
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="goodsstock" name="goodsstock" required=""
                               autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>请填写商品库存量
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                      <label for="note" class="layui-form-label">
                          备注
                      </label>
                      <div class="layui-input-block">
                          <textarea placeholder="请输入内容" style="width: 93%"  id="note" name="note" class="layui-textarea"></textarea>
                      </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="add" lay-submit="">
                        增加
                    </button>
                </div>
            </form>
        </div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer','upload'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;

                //图片上传接口
                layui.upload({
                    url: 'up_goods_img' //上传接口
                    ,success: function(res){ //上传成功后的回调
                        if(res.statu == 200){
                            $('#LAY_demo_upload').append('<img  style="width: 150px;height: 85px;margin: 10px"   src="'+res.url+'"><div class="delbtn" onclick="delpic(this,'+res.pic_id+')" >x</div>');
                            $('#form_p').append('<input type="hidden" class="pic_ids" id="goods_pic_id_'+res.pic_id+'" name="goods_pic_id_'+res.pic_id+'" value="'+res.pic_id+'">');
                        }else{
                            layer.alert(res.msg);
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
            function delpic(obj,picid){
                $.ajax({
                    type: 'POST',
                    url: 'delpic',
                    dataType: 'json',
                    data:{'picid':picid},
                    success: function(data){
                        if(data.statu == 200){
                            layer.msg(data.msg);
                            $(obj).prev().remove();
                            $(obj).remove();
                            var inp = $(".pic_ids");
                            $.each(inp,function (i,v) {
                                    var id = $(v).val();
                                    if(id == picid){
                                        v.remove();
                                    }
                                }
                            )
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
    </body>
</html>