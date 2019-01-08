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
            <form class="layui-form" action="#" method="post" id="form_p" onsubmit="return false">
                <div class="layui-form-item">
                      <label for="class_name" class="layui-form-label">
                          <span class="x-red">*</span>分组
                      </label>
                      <div class="layui-input-inline">
                          <select name="class_id" lay-filter="class_name">
                              <option value="">请选择分组</option>
                              <?php if(is_array($class)): foreach($class as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["class_name"]); ?></option><?php endforeach; endif; ?>
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
                             
                          </select>
                      </div>
                     <div class="layui-form-mid layui-word-aux">
                        删除类型及类型中所有素材
                      </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn layui-btn-danger" lay-filter="add" lay-submit="">
                        删除
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
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
                var form = layui.form()
                    ,layer = layui.layer;

                form.on('select(class_name)', function(data){

                    $.getJSON("/Home/Material/type_add?id="+data.value, function(data){

                        var optionstring = "";

                        $.each(data.msg, function(i,item){

                            optionstring += "<option value=\"" + item.id + "\" >" + item.type + "</option>";

                        });

                        $("#type").html('<option value="">请选择类型</option>' + optionstring);

                        form.render('select');
                    });

                });
                //监听提交
                form.on('submit(add)', function(data){
                    var data = data.field;
                    console.log(data);
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Material/del_pic_type',
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