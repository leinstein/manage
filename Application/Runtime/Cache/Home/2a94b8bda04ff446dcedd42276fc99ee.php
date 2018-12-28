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
        <!--<link rel="stylesheet" href="/Public/Home/lib/layui/css/layui.css" media="all">-->
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <div class="layui-layout layui-layout-admin">
            <div class="layui-header header header-demo">
                <div class="layui-main">
                    <style>
                        .logo{
                            font-size: 24px;
                        }
                        a:hover{
                            color: white;
                        }
                        #avatar{
                            width:30px;
                            height:30px;
                        }
                        .layui-nav .layui-nav-item{
                            line-height: 59px;
                        }
                        .header .layui-nav{
                            top:1px;
                        }
                        #tips{
                            
                            width: 20px;
                        }
                        #message span{
                            position: relative;
                            top: -7px;
                            left: -3px;
                            color: red;
                        }
                        #message cite{
                            display: none;
                            /*padding: 0 0 20px;*/
                        }
                        .layui-progress-big,.layui-progress-bar{
                            display: inline-block;
                            height: 12px !important;
                            line-height: 12px !important;
                            font-size: 12px !important;
                        }
                        .layui-progress-big{
                            width: 30%;
                            margin-left: 12%;
                        }
                        #span{
                            display: inline-block;
                            width: 35%;
                            margin-left: 20%;
                            height: 60px;
                            margin-top: -10px;
                            vertical-align: middle;
                            line-height: 56px;
                        }
                        #span img{
                            margin-left: 9%;
                            height: 15px;
                        }
                        #span .number{
                            display: inline-block;
                            font-size: 18px;
                            font-weight: bold;
                            font-style: italic;
                        }
                    </style>
                    <a class="logo" href="">
                       风暴<font style="font-size: 26px"><i> CRM </i></font>管理系统
                    </a>
                    <?php if($aim_this_month['aim'] != 'aim'): ?><span id="span">
                            <img src="/Public/Home/images/mubiao.png"> 任务目标：<div class="number"><?php echo ($aim_this_month["aim"]); ?></div>
                            <img src="/Public/Home/images/read.png"> 已完成：<div class="number"><?php echo (substr($aim_this_month["complete"],0,-3)); ?></div>
                            <img src="/Public/Home/images/avg.png"> 完成进度：<div class="number"><?php echo ($aim_this_month["avg"]); ?></div>
                        </span><?php endif; ?>
                    <ul class="layui-nav" lay-filter="side">
                        <li class="layui-nav-item">
                            <a href="javascript:;" _href="/Home/Customer/backlog?day=today" id="message" title="消息">
                                <img src="/Public/Home/images/tip.png" id="tips"><cite>今日待办</cite>
                                <span><?php echo ($backlog_count); ?></span>
                            </a>
                        </li>
                          <li class="layui-nav-item">
                              <img src="<?php echo ($avatar); ?>" class="layui-circle" id="avatar"  alt="">
                          </li>
                          <li class="layui-nav-item" style="margin-right: 50px">
                            <a href="javascript:;"><?php echo (session('nickname')); ?></a>
                            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                              <dd><a href="javascript:;" _href="Home/System/index"><cite>个人信息</cite></a></dd>
                              <dd><a href="<?php echo U('Manage/logout');?>"><cite>退出</cite></a></dd>
                            </dl>
                          </li>
                    </ul>
                </div>
            </div>
            <div class="layui-side layui-bg-black x-side">
                <div class="layui-side-scroll">
                    <ul class="layui-nav layui-nav-tree site-demo-nav" lay-filter="side">
                        <?php if(is_array($authinfoA)): foreach($authinfoA as $key=>$v): ?><li class="layui-nav-item">
                                <a class="javascript:;" href="javascript:;"  _href="Home/<?php echo ($v['auth_c']); ?>/<?php echo ($v['auth_a']); ?>">
                                    <i class="layui-icon" style="top: 3px;"><?php echo ($v["icon"]); ?></i><cite><?php echo ($v["auth_name"]); ?></cite>
                                </a>
                                <dl class="layui-nav-child">
                                    <?php if(is_array($authinfoB)): foreach($authinfoB as $key=>$vv): if(($vv["auth_pid"]) == $v["auth_id"]): ?><dd class="">
                                                <a href="javascript:;" _href="Home/<?php echo ($vv['auth_c']); ?>/<?php echo ($vv['auth_a']); ?>">
                                                    <cite><?php echo ($vv["auth_name"]); ?></cite>
                                                </a>
                                            </dd><?php endif; endforeach; endif; ?>
                                </dl>
                            </li><?php endforeach; endif; ?>
                        <li class="layui-nav-item" style="height: 30px; text-align: center">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="layui-tab layui-tab-card site-demo-title x-main" lay-filter="x-tab" lay-allowclose="true">
                <div class="x-slide_left"></div>
                <ul class="layui-tab-title" id="myList">
                    <li class="layui-this">
                        我的桌面
                        <i class="layui-icon layui-unselect layui-tab-close">ဆ</i>
                    </li>
                </ul>
                <div class="layui-tab-content site-demo site-demo-body">
                    <div class="layui-tab-item layui-show">
                        <iframe frameborder="0" src="/Home/Index/wel" class="x-iframe"></iframe>
                    </div>
                </div>
            </div>
            <div class="site-mobile-shade">
            </div>
        </div>
        <script src="/Public/Home/lib/layui/layui.js" charset="utf-8"></script>
        
        <script src="/Public/Home/js/x-admin.js"></script>
       
</body>
</html>