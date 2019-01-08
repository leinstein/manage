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
        <link rel="stylesheet" href="/Public/Home/lib2/layui/css/layui.css" media="all">
    </head>
    <body style="background-color: #f0f2f5">
        <style>
            .layui-fluid{ margin-top: 20px;margin-bottom: 30px;}
            .layui-bg-green{width: 101.8%;margin-left: -1%;margin-top: -10px;}
			.layui-layer-dialog{background-color: #f8f8f8}
        </style>
        <div class="layui-fluid">
            <div class="layui-card">
                <div class="x-body">
            		<style>
                        .layui-col-space30{margin-left: -1.5%;width: 102%;}
                        .layui-nav{height: 45px;}
                        #layui-nav-item,#layui-nav-item1{height: 45px;line-height: 45px;}
					</style>
                <xblock style="background-color: white !important;margin-top: 5px">
					<ul class="layui-nav layui-bg-green">
					  <li class="layui-nav-item" id="layui-nav-item1"><a href="<?php echo U('Material/index');?>">首页</a></li>
					  	<?php if(is_array($class)): foreach($class as $key=>$c): ?><li class="layui-nav-item" id="layui-nav-item">
								<a href="<?php echo U('Material/index',['id'=>$c['id']]);?>"><?php echo ($c["class_name"]); ?></a>
								<dl class="layui-nav-child" style="top:46px">
									<?php if(is_array($pic_type)): foreach($pic_type as $key=>$p): if($c['id'] == $p['class_id']): ?><dd><a href="<?php echo U('Material/index',['id'=>$c['id'],'type'=>$p['id']]);?>"><?php echo ($p["type"]); ?></a></dd><?php endif; endforeach; endif; ?>
								</dl>
							</li><?php endforeach; endif; ?>
					</ul>
                </xblock>
					  <div class="layui-row layui-col-space30" style="margin-bottom: 50px;">
						  <?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="layui-col-xs6 layui-col-sm3 layui-col-md2" id="content_sm">
								  <div class="grid-demo grid-demo-bg1">
									  <img onclick="big_img(960,540,'<?php echo ($v["pic_url"]); ?>','<?php echo ($v["note"]); ?>')" src="<?php echo ($v["pic_thums_url"]); ?>" style="cursor: pointer">
								  </div>
							  </div><?php endforeach; endif; ?>
					  </div>
                      <div id="page"><?php echo ($page); ?></div>
        		</div>
            </div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/Home/js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['element','layer'], function(){
                $ = layui.jquery;//jquery
              layer = layui.layer;//弹出层
              
              
            });
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
    </body>
</html>