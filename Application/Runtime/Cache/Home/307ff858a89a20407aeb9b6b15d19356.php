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
        <link rel="stylesheet" href="/Public/Home/lib2/layui/css/layui.css" media="all">
    </head>
    <body style="background-color: #f0f2f5">
        <style>
            .layui-fluid{
                margin-top: 20px;
            }
            .layui-bg-green{
                width: 101.8%;
                margin-left: -1%;
                margin-top: -10px;
			}
			.layui-fluid{
				margin-bottom: 30px;
			}
            #down{
                /*position: relative;*/
                /*top:400px;*/
                /*left: 200px;*/
            }
        </style>
        <div class="layui-fluid">
            <div class="layui-card">
                <div class="x-body">
            		<style>
						.layui-col-sm3{
                            height: 200px;
                            overflow: hidden;
                            
                        }
                        .layui-col-sm3 img{
                            height: 200px;
                        }
                        .grid-demo-bg1{
                            text-align: center;
                        }
                        .layui-row{
                            margin-bottom: 50px;
                        }
                        #page{
                            margin-top: -30px;
                        }
                        .layui-col-space30{
                            margin-left: -1.5%;
                            width: 102%;
                        }
					</style>
                <xblock style="background-color: white !important;margin-top: 5px">
                    <style>
                        .layui-nav{
                            /*background-color: #009e94;*/
                            height: 45px;
                        }
                        #layui-nav-item,#layui-nav-item1{
                            height: 45px;
                            line-height: 45px;
                        }
                    </style>
					<ul class="layui-nav layui-bg-green">
					  <li class="layui-nav-item" id="layui-nav-item1"><a href="<?php echo U('Material/index');?>">首页</a></li>
					  	<?php if(is_array($class)): foreach($class as $key=>$c): ?><li class="layui-nav-item" id="layui-nav-item">
								<a href="<?php echo U('Material/index',['id'=>$c['id']]);?>"><?php echo ($c["class_name"]); ?></a>
								<dl class="layui-nav-child">
									<?php if(is_array($pic_type)): foreach($pic_type as $key=>$p): if($c['id'] == $p['class_id']): ?><dd><a href="<?php echo U('Material/index',['id'=>$c['id'],'type'=>$p['id']]);?>"><?php echo ($p["type"]); ?></a></dd><?php endif; endforeach; endif; ?>
								</dl>
							</li><?php endforeach; endif; ?>
					</ul>
                </xblock>
					  <div class="layui-row layui-col-space30">
						  <?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="layui-col-xs6 layui-col-sm3 layui-col-md2">
								  <div class="grid-demo grid-demo-bg1">
									  <img onclick="big_img(960,540,'<?php echo ($v["pic_url"]); ?>','<?php echo ($v["note"]); ?>')" src="<?php echo ($v["pic_thums_url"]); ?>" style="cursor: pointer">
								  </div>
							  </div><?php endforeach; endif; ?>
					  </div>
                      <div id="page"><?php echo ($page); ?></div>
        		</div>
            </div>
        </div>
        <!--<script src="/Public/home/js/jquery.js"></script>-->
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        <!--<script src="/Public/Home/js/clipboard.min.js" charset="utf-8"></script>-->
        
        <script>
            layui.use(['element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
              layer = layui.layer;//弹出层
              
              
            });

            //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                    //捉到所有被选中的，发异步进行删除
                    layer.msg('删除成功', {icon: 1});
                });
             }
             /*用户-添加*/
            function member_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }
            /*用户-查看*/
            function member_show(title,url,id,w,h){
                x_admin_show(title,url,w,h);
            }

            
            // 用户-编辑  用戶-添加待办任务
            function member_edit (title,url,id,w,h) {
                url = url + '?cid=' + id;
                x_admin_show(title,url,w,h);
            }
            /*添加订单*/
            function order_add_list(title,url,id,w,h,cname){
                url = url + '?cid=' + id + '&cname=' + cname;
                x_admin_show(title,url,w,h);
            }
            /*用户-删除*/
            function member_del(obj,id){
                layer.confirm('确认要删除这个客户吗？',function(index){
                    $.ajax({
                        type: 'POST',
                        url: 'del',
                        dataType: 'json',
                        data:{'cid':id},
                        success: function(data){
                            if(data.statu == 200){
                                $(obj).parents("tr").remove();
                                layer.msg('客户已删除!',{icon:1,time:1000});
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
            function big_img(w,h,urlimg,note){
                layer.open({
                    title: '素材图片',
                    type: 0,
                    area: [w, h], //宽高
                    content: '<a href="'+urlimg+'" download="'+note+'" style="width:960px;text-align: center;display: inline-block"><img  src="'+urlimg+'"  height="540px"  alt=""></a><div style="margin-top: 10px;font-size: 16px;color: #666;"><div style="display: inline-block;margin-left: 15px" id="note">'+note+'</div></div>'
                });
            }
        </script>
        <!--<a href="'+urlimg+'" download="'+note+'"><img  src="'+urlimg+'"  height="540px"  alt=""></a><div style="margin-top: 10px;font-size: 16px;color: #666;width: 100%"><button style="" class="layui-btn layui-btn-xs" >复制 </button><div style="display: inline-block;margin-left: 15px" id="note">'+note+'</div></div>-->
        <script type="text/javascript">
            // function copynote()
            // {
                // var note=document.getElementById("note");
                // var note = $('#note').html(); // 选择对象
                // var clipboard = new ClipboardJS('.layui-btn-xs', {
                //     target: function() {
                //         layer.tips(note, '.layui-btn-xs', {
                //             tipsMore: true,
                //             tips: [3, '#009e94']
                //         });
                //         return document.querySelector('#note');
                //     }
                // });
                // var clipboard = new Clipboard('.layui-btn-xs', {
                //     text: function() {
                //         return note;
                //     }
                // });
                // $(note).select();
                // document.execCommand("Copy"); // 执行浏览器复制命令
                // layer.tips(note, '.layui-btn-xs', {
                //     tipsMore: true,
                //     tips: [3, '#009e94']
                // });
            // }
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