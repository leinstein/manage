<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            风暴网络科技
        </title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="/Public/Home/css/x-admin.css" media="all">
        <link rel="stylesheet" href="/Public/Home/lib2/layui/css/layui.css" media="all">

    </head>
    <body>
        <div class="x-body">
            <style>
                .layui-nav{
                    /*background-color: #009e94;*/
                    height: 45px;
                    /*width: 50%;*/
                    display: inline-block;
                    margin-left: 1%;
                }
                #layui-nav-item,#layui-nav-item1,layui-nav-item2{
                    height: 45px;
                    line-height: 45px;
                }
                
            </style>
            
            <style>.layui-table td, .layui-table th{text-align: center}</style>
            <xblock>
                <button class="layui-btn layui-bg-green" onclick="admin_add('素材上传','/Home/Material/add','700','700')" style="height: 45px;line-height: 45px;margin-top: 7px"><i class="layui-icon">&#xe608;</i> 上 传 </button>
                <button class="layui-btn layui-bg-green" onclick="admin_add('添加组','/Home/Material/add_class','490','300')" style="height: 45px;line-height: 45px;margin-top: 7px"><i class="layui-icon">&#xe608;</i> 添 加 组 </button>
                <button class="layui-btn layui-bg-green" onclick="admin_add('添加类型','/Home/Material/add_pic_type','490','400')" style="height: 45px;line-height: 45px;margin-top: 7px"><i class="layui-icon">&#xe608;</i> 添 加 类 型 </button>
                <ul class="layui-nav layui-bg-green">
                  <li class="layui-nav-item" id="layui-nav-item1"><a href="<?php echo U('Material/management');?>">首页</a></li>
                    <?php if(is_array($class)): foreach($class as $key=>$c): ?><li class="layui-nav-item" id="layui-nav-item">
                            <a href="<?php echo U('Material/management',['id'=>$c['id']]);?>"><?php echo ($c["class_name"]); ?></a>
                            <dl class="layui-nav-child">
                                <?php if(is_array($pic_type)): foreach($pic_type as $key=>$p): if($c['id'] == $p['class_id']): ?><dd><a href="<?php echo U('Material/management',['id'=>$c['id'],'type'=>$p['id']]);?>"><?php echo ($p["type"]); ?></a></dd><?php endif; endforeach; endif; ?>
                            </dl>
                        </li><?php endforeach; endif; ?>
                </ul>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="30px">
                            序号
                        </th>
                        <th>
                            分组
                        </th>
                        <th>
                            类型
                        </th>
                        <th>
                            图片
                        </th>
                        <th>
                            描述
                        </th>
                        <th>
                            上传时间
                        </th>
                        <th width="60px">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
                            <td>
                                <?php echo ($v["sort"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["class_name"]); ?>
                            </td>
                            <td >
                                <?php echo ($v["type"]); ?>
                            </td>
                            <td style="text-align: center;vertical-align: middle">
                                <img onclick="big_img(960,540,'<?php echo ($v["pic_url"]); ?>')" src="<?php echo ($v["pic_thums_url"]); ?>"  alt="查看原图" height="34" style="cursor: pointer;">
                            </td>
                            <td style="text-align: left">
                                <?php echo ($v["note"]); ?>
                            </td>
                            <td width="90px">
                                <?php echo (date('Y-m-d',$v["create_time"])); ?>
                            </td>
                            <td class="td-manage" width="90px">
                                    <a title="编辑" href="javascript:;" onclick="admin_edit('编辑','/Home/material/edit','<?php echo ($v["mid"]); ?>','700','700')"
                                class="ml-5" style="text-decoration:none;margin-left: 10px">
                                    <i class="layui-icon">&#xe642;</i>
                                </a>
                                <a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo ($v["mid"]); ?>')"
                                style="text-decoration:none;margin-left: 10px">
                                    <i class="layui-icon">&#xe640;</i>
                                </a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <div id="page" style="margin-bottom: 50px"><?php echo ($page); ?></div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script>
            layui.use(['element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
                layer = layui.layer;//弹出层
                

            });

            
            /*添加*/
            function admin_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }
            
            //编辑
            function admin_edit (title,url,id,w,h) {
                url = url+'?id='+id;
                x_admin_show(title,url,w,h);
            }
            /*删除*/
            function admin_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: '/Home/Material/del',
                        dataType: 'json',
                        data:{'id':id},
                        success: function(data){
                            if(data.statu == 200){
                                $(obj).parents("tr").remove();
                                layer.msg('已删除!',{icon:1,time:1000});
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
            }
            </script>
        <script>
            function big_img(w,h,urlimg){
                layer.open({
                    title: '素材图片',
                    type: 0,
                    area: [w, h], //宽高
                    content: '<img  src="'+urlimg+'"  height="540px"  alt="">'
                });
            }
        </script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
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