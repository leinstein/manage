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
    <body style="background-color: #f0f2f5;overflow-x:hidden;">
        <div class="x-body">
            <!--表格-->
            <div class="layui-fluid" style="width: 100%;margin-left: -1%;">
              <div class="layui-card">
                <div class="x-body">
                <xblock style="background-color: white !important;margin-top: -10px !important;margin-bottom: -10px !important;">
                    <a title="本月统计" class="layui-btn month_btn"  href="/Home/Report/resource?month=month">
                        本月统计
                    </a>
                    <a title="上月统计" class="layui-btn month_btn"  href="/Home/Report/resource?month=lastmonth">
                        上月统计
                    </a>
                    <span class="x-right" style="margin-top: -13px">
                        <form class="layui-form x-center" action="" style="width:400px;">
                            <div class="layui-form-pane" style="margin-top: 15px;">
                              <div class="layui-form-item" style="width: 120%">
                                <label class="layui-form-label">日期范围</label>
                                  <div class="layui-input-inline">
                                    <input type="text" class="layui-input" autocomplete="off" name="month" id="LAY_demorange_s" value="<?php echo ($month); ?>" placeholder="选择月份">
                                  </div>
                                <div class="layui-input-inline" style="width:120px;">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i> 搜 索</button>
                                </div>
                              </div>
                            </div>
                        </form>
                    </span>
                </xblock>
                    <!--</div>-->
                <table class="layui-table" style="margin-top: -10px">
                    <thead>
                        <tr>
                            <th width="45px">
                                日期
                            </th>
                            <?php if(is_array($info)): foreach($info as $key=>$v): ?><th>
                                    <?php echo ($v["nickname"]); ?>
                                </th><?php endforeach; endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($cc)): foreach($cc as $k=>$c): ?><tr>
                                <td>
                                    <?php echo ++$i;?>
                                </td>
                                <?php if(is_array($c)): foreach($c as $key=>$count): ?><td>
                                        <?php echo ($count["count"]); ?>
                                    </td><?php endforeach; endif; ?>
                            </tr><?php endforeach; endif; ?>
                            <tr class="zonghe">
                                <td>
                                    合计
                                </td>
                                <?php if(is_array($info)): foreach($info as $key=>$v): ?><td>
                                    <?php echo ($v["avg"]); ?>
                                </td><?php endforeach; endif; ?>
                            </tr>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
        <script src="/Public/home/js/jquery.js"></script>
        <script src="/Public/home/lib2/layui/layui.js" charset="utf-8"></script>
        <script src="/Public/home/js/x-admin.js"></script>
        <script src="/Public/home/js/echarts.min.js"></script>
        <script>
            layui.use(['laydate','element','layer'], function(){
                $ = layui.jquery;//jquery
                laydate = layui.laydate;//日期插件
                layer = layui.layer;//弹出层
                element = layui.element;

                //年月选择器
                laydate.render({
                    elem: '#LAY_demorange_s'
                    ,type: 'month'
                });
                
            });
        </script>
    </body>
</html>