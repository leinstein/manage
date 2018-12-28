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
    <style>
        .delbtn{
            color: white;
            width: 14px;
            height: 15px;
            line-height: 15px;
            padding: 1px 1px 2px 4px;
            font-size: 20px;
            background-color: red;
            display: inline-block;
            vertical-align: bottom;
            margin-left: -29px;
            margin-bottom: 10px;
            cursor: pointer;
        }
    </style>
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
                    <img  style="width: 150px;height: 85px;margin: 10px"  src="<?php echo ($material["pic_thums_url"]); ?>">
                    <div class="delbtn" onclick="delpic(this,'<?php echo ($v["picid"]); ?>')" >x</div>
                </div>
                <div class="layui-form-item">
                    <label  class="layui-form-label">
                    </label>
                </div>
            </form>
            <form class="layui-form" action="#" method="post" id="form_p" onsubmit="return false">
                <input type="hidden" name="id" value="<?php echo ($material["id"]); ?>">
                <div class="layui-form-item">
                      <label for="class_name" class="layui-form-label">
                          <span class="x-red">*</span>分组
                      </label>
                      <div class="layui-input-inline">
                          <select name="class_id" lay-filter="class_name">
                              <option value="">请选择分组</option>
                              <?php if(is_array($class)): foreach($class as $key=>$v): if($material['class_id'] == $v['id']): ?><option value="<?php echo ($v["id"]); ?>" selected><?php echo ($v["class_name"]); ?></option>
                                      <?php else: ?>
                                      <option value="<?php echo ($v["id"]); ?>"><?php echo ($v["class_name"]); ?></option><?php endif; endforeach; endif; ?>
                          </select>
                      </div>
                </div>
                <div class="layui-form-item">
                      <label for="type" class="layui-form-label">
                          <span class="x-red">*</span>类型
                      </label>
                      <div class="layui-input-inline">
                          <select name="type_id" id="type">
                              <option value="">请选择类型</option>
                              <?php if(is_array($pic_type)): foreach($pic_type as $key=>$vv): if($material['type_id'] == $vv['id']): ?><option value="<?php echo ($vv["id"]); ?>" selected><?php echo ($vv["type"]); ?></option>
                                      <?php else: ?>
                                      <option value="<?php echo ($vv["id"]); ?>"><?php echo ($vv["type"]); ?></option><?php endif; endforeach; endif; ?>
                          </select>
                      </div>
                </div>
                <div class="layui-form-item layui-form-text">
                      <label for="note" class="layui-form-label">
                          记录
                      </label>
                      <div class="layui-input-block">
                          <textarea placeholder="请输入内容" style="width: 93%" lay-verify="note"  id="note" name="note" class="layui-textarea"><?php echo ($material["note"]); ?></textarea>
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
        <!--<link rel="stylesheet" href="/Public/Home/lib2/layui/css/layui.css" media="all">-->
        <script>
            layui.use(['form','layer','upload','element','layedit'], function(){
                $ = layui.jquery;
                var form = layui.form()
                    ,layer = layui.layer;
                var element = layui.element;
                var layedit = layui.layedit;

                //自定义验证规则
                form.verify({
                    note: function(value){
                        layedit.sync(editindex);
                    }
                });
                //富文本
                var editindex = layedit.build('note',{
                    height:180,
                    tool: [
                        'strong' //加粗
                        ,'italic' //斜体
                        ,'underline' //下划线
                        ,'del' //删除线
                        ,'|' //分割线
                        ,'left' //左对齐
                        ,'center' //居中对齐
                        ,'right' //右对齐
                    ]

                });
                //图片上传接口
                layui.upload({
                    url: 'up_material_img' //上传接口
                    ,success: function(res){ //上传成功后的回调
                        if(res.statu == 200){
                            $('#LAY_demo_upload').append('<img  style="width: 150px;height: 85px;margin: 10px"   src="'+res.url+'"><div class="delbtn" onclick="delpic(this,'+res.pic_id+')" >x</div>');
                            $('#form_p').append('<input type="hidden" class="pic_ids" id="goods_pic_id_'+res.pic_id+'" name="goods_pic_id_'+res.pic_id+'" value="'+res.pic_id+'">');
                        }else{
                            layer.alert(res.msg);
                        }
                    }
                });

                form.on('select(class_name)', function(data){

                    $.getJSON("/Home/Material/type_add?id="+data.value, function(data){

                        var optionstring = "";

                        $.each(data.msg, function(i,item){

                            optionstring += "<option value=\"" + item.id + "\" >" + item.type + "</option>";

                        });

                        $("#type").html('<option value="">请选择类型</option>' + optionstring);

                        form.render('select'); //这个很重要

                    });

                });
                //监听提交
                form.on('submit(add)', function(data){
                    var data = data.field;
                    console.log(data);
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Material/edit',
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
                    url: '/Home/Material/delpic',
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