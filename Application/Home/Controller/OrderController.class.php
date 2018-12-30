<?php
namespace Home\Controller;
use Home\Common\HomeController;

class OrderController extends HomeController {
    /**
     * 2018/11/22
     * 14:17
     * anthor liu
     * 订单列表
     */
     Public function index(){
         $order = D('Order');
         $where['delete'] = 1;
         $userid = $_SESSION['userid'];
         if($_SESSION['username'] != 'admin') $where['saleid'] = $userid;
//         $where['orderstatus'] = ['neq',4];
         if($_GET['stat_date'] and !$_GET['stop_date']) $where['ordercreatetime'] = ['egt',strtotime($_GET['stat_date'])];
         if(!$_GET['stat_date'] and $_GET['stop_date']) $where['ordercreatetime'] = ['elt',strtotime($_GET['stop_date'])];
         if($_GET['stat_date'] and $_GET['stop_date']) $where['ordercreatetime'] = ['between',[strtotime($_GET['stat_date']),strtotime($_GET['stop_date'])]];
         if($_GET['paytype']) $where['paytype'] = $_GET['paytype'];
         if($_GET['payform']) $where['payform'] = $_GET['payform'];
         if($_GET['orderstatus']) $where['orderstatus'] = $_GET['orderstatus'];
         if($_GET['word']){
             $word = '%'.trim($_GET['word']).'%';
             $where['orderno|desc|couriername|courierlist|goods_de|orderprice|cheapprice|pay|payment|paymentfee'] =array('like',$word);
         }
         //获取统计数据
         if($_GET['day']){
             if($_GET['day'] == 'history'){
                 $where['delete'] = 1;
             }else{
                 $where['ordercreatetime'] = $order->where_s($_GET['day']);
             }
         }

         $count = $order->where($where)->count();//满足条件的数量
         $page  = new \Think\Page($count, 25);//实例化分页
         $page->setConfig('prev','上一页');
         $page->setConfig('next','下一页');
         $show  = $page->show();//分页显示输出
         $list = $order->where($where)->order('orderid desc')->limit($page->firstRow . ',' . $page->listRows)->select();
         $customer = M('Customer')->select();
         $admin = M('Admin')->select();

         foreach ($list as $v) {
            foreach ($customer as $vv){
                if($v['cid'] == $vv['cid']){
                    $v['customer_name'] = $vv['name'];
                    $v['customer_phone'] = $vv['phone'];
                    break;
                }
            }
            foreach ($admin as $vvv){
                if($vvv['id'] == $v['saleid']){
                    $v['nickname'] = $vvv['nickname'];
                    break;
                }
            }
            $v['paynow'] = $v['orderprice'];
            $info[] = $v;
         }
         //获取今天00:00时间戳
         $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
         //获取昨天00:00时间戳
         $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
         //昨天结束
         $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
         foreach ($info as $v){
             if($v['ordercreatetime'] > $todaystart){
                 $infotoday[] = $v;
             }else if($v['ordercreatetime'] < $endYesterday and $v['ordercreatetime'] > $beginYesterday){
                 $infoyestoday[] = $v;
             }else{
                 $infot[] = $v;
             }
         }
         $order_s = D('Order');
         //获取统计数据
         $statistical = $order_s->statistical();
         //权限按钮
         $role = M('Role')->where(['id'=>$_SESSION['roleid']])->find();
         $role_ac = $role['role_auth_ac'];
         $action_name = get_action_name($role_ac);
         $this->assign([
             'statistical'=> $statistical,
             'infotoday'=> $infotoday,
             'infoyestoday'=> $infoyestoday,
             'infot'=> $infot,
             'count'=> $count,
             'page'=> $show,
             'firstRow'=> $page->firstRow,
             'role_ac'=> $role_ac,
             'action_name'=>$action_name
         ]);
         $this->display();
     }


    /**
     * 2018/12/4
     * 9:34
     * anthor liu
     * 编辑订单
     */
     Public function edit(){
        if(IS_POST){
            $goods = M('Goods');
            //客户ID
            $data['cid'] = $_POST['cid'];
            //订单ID
            $data['orderid'] = $_POST['orderid'];

            $goodsdata = $goods->select();
            //快递ID
            $data['address_id'] = $_POST['address_id'];
            //优惠金额
            $data['cheapprice'] = $_POST['cheapprice'];
            //物流
            $data['couriername'] = $_POST['couriername'];
            //备注
            $data['desc'] = $_POST['desc'];
            //已付款金额
            $data['pay'] = $_POST['pay'];
            //付款类型
            $data['paytype'] = $_POST['paytype'];
            //付款方式
            $data['payform'] = $_POST['payform'];
            //发货时间
            $data['deliverytime'] = strtotime($_POST['deliverytime']);
            //订单金额
            $data['orderprice'] = 0;
            //商品
            foreach ($_POST as $k => $v) {
                $str = substr($k,0,12);
                $order_goods_id = substr($k,12);
                if($str == 'goodsnumber_'){
                    $data['goods_ids'][] = substr($k,12).'-'.$v;
                    $data['total_ids'][] = substr($k,12);
                    foreach ($goodsdata as $vv){
                        if($vv['goodsid'] == $order_goods_id){
                            $data['goods_de'][]  = $vv['goodsname'].'x'.$v;
                            $data['orderprice'] += $vv['goodsprice'] * $v;
                            $go['goodsstock'] = $vv['goodsstock'] - $v;
                            $go['goodscount'] = $vv['goodscount'] + $v;
                            $go['goodsid'] = $vv['goodsid'];
                            //修改商品库存和销量
                            $goods->save($go);
                        }
                    }
                }
                if($str == 'zengsnumber_'){
                    $data['zengs_ids'][] = substr($k,12).'-'.$v;
                    $data['total_ids'][] = substr($k,12);
                    foreach ($goodsdata as $vv){
                        if($vv['goodsid'] == $order_goods_id){
                            $data['goods_de'][]  = $vv['goodsname'].'x'.$v;
                            $go['goodsstock'] = $vv['goodsstock'] - $v;
                            $go['goodscount'] = $vv['goodscount'] + $v;
                            $go['goodsid'] = $vv['goodsid'];
                            //修改赠品库存和销量
                            $goods->save($go);
                        }
                    }
                }
            }
            $data['goods_ids'] = implode(',', $data['goods_ids']);
            if(!$data['goods_ids']) $this->ajaxReturn(['statu' => 202, 'msg' => '选择商品为空']);
            $data['zengs_ids'] = implode(',', $data['zengs_ids']);
            $data['goods_de'] = implode(',', $data['goods_de']);
            $data['total_ids'] = implode(',', $data['total_ids']);
            //订单总价 = 商品总价 - 优惠金额
            $data['orderprice'] = $data['orderprice'] - $data['cheapprice'];
            //待收款 = 订单总价 - 已付款
            $data['payment'] = $data['orderprice'] -  $data['pay'];
            //快递代收款金额 = 订单总价 - 已付款
            $data['paymentfee'] = $data['orderprice']  - $data['pay'];

            $data['orderupdatetime'] = time();

            //修改订单
            $res = M('Order')->save($data);
            if($res){
                $this->ajaxReturn(['statu' => 200, 'msg' => '修改订单成功']);
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => '修改订单失败']);
            }
        }else{
            $data['orderid'] = $cid = $_GET['orderid'];
            $order = M('Order')->where(['orderid'=>$data['orderid']])->find();
            $order['totalpeice'] = $order['orderprice'] + $order['cheapprice'];

            //所有商品
            $goods = M('Goods')->where(['status'=>1])->select();
            $goods_ids = explode(',',$order['goods_ids']);
            $zengs_ids = explode(',',$order['zengs_ids']);
            foreach ($goods_ids as $k=>$v){
                $g = explode('-',$v);
                foreach ($goods as $vv){
                    if($vv['goodsid'] == $g[0]){
                        $vv['goods_count'] = $g[1];
                        $goods_buy[] = $vv;
                    }
                }
            }
            foreach ($zengs_ids as $k=>$v){
                $z = explode('-',$v);
                foreach ($goods as $vv){
                    if($vv['goodsid'] == $z[0]){
                        $vv['zengs_count'] = $z[1];
                        $zengs_buy[] = $vv;
                    }
                }
            }

            //物流选择
            $courier = M('Courier')->order('sort desc')->select();
            //当前客户信息
            $customer = M('Customer')->where(['cid'=>$order['cid']])->find();
            //收货地址
            $add = M('Address')->where(['cid'=>$order['cid']])->select();

            foreach ($add as $v){
                $dat['add'] = $v['province'].$v['city'].$v['area'].$v['address'];
                $dat['addressid'] = $v['addressid'];
                $dat['phone'] = $v['phone'];
                $add_ress[] = $dat;
            }
            foreach ($goods as $v){
                if($v['zeng'] == 1){
                    $goods_s[] = $v;
                }else{
                    $goods_z[] = $v;
                }
            }
            $this->assign('data',$data);
            $this->assign('order',$order);
            $this->assign('goods_buy',$goods_buy);
            $this->assign('zengs_buy',$zengs_buy);
            $this->assign('courier',$courier);
            $this->assign('customer',$customer);
            $this->assign('add_ress',$add_ress);
            $this->assign('goods_s',$goods_s);
            $this->assign('goods_z',$goods_z);
            $this->display();
        }
     }

    /**
     * 2018/11/22
     * 11:00
     * anthor liu
     * 查看订单详情
     */
    Public function show(){
        $order = M('Order');
        $address = M('Address');
        $admin = M('Admin');
        $group = M('Group');
        $servernote = M('Servernote');
        $orderid = $_GET['orderid'];
        $info = $order->where(['orderid'=>$orderid])->find();
        $customer = M('Customer')->where(['cid'=>$info['cid']])->find();
        $info['name'] = $customer['name'];
        $info['phone'] = $customer['phone'];
        $info['buyrate'] = number_zi($customer['buyrate']);
        $add = $address->where(['addressid'=>$info['address_id']])->find();
        $info['address'] = $add['province'].$add['city'].$add['area'].$add['address'];
        $salename = $admin->where(['id'=>$info['saleid']])->find();
        $objname  = $group->where(['group_id'=>$salename['group_id']])->find();
        $info['objectsale'] = $objname['group_name'].'-'.$salename['nickname'];
        $info['server_note'] = $servernote->field('server_note')->where(['oid'=>$info['orderid']])->find();
        $info['server_note'] = $info['server_note']['server_note'];
        //付款方式
        if($info['paytype'] == 1) $info['paytype'] = '付全款';
        if($info['paytype'] == 2) $info['paytype'] = '付定金';
        if($info['paytype'] == 3) $info['paytype'] = '货到付款';
        if($info['payform'] == 1) $info['payform'] = '微信';
        if($info['payform'] == 2) $info['payform'] = '支付宝';
        if($info['payform'] == 3) $info['payform'] = '银行卡转账';
        if($info['payform'] == 4) $info['payform'] = '快递代收';
        if($info['orderstatus'] == 1) $info['orderstatus'] = '待发货';
        if($info['orderstatus'] == 2) $info['orderstatus'] = '已发货';
        if($info['orderstatus'] == 3) $info['orderstatus'] = '已签收';
        if($info['orderstatus'] == 4) $info['orderstatus'] = '退单';
        $this->assign('info',$info);
        $this->display();
    }

    /**
     * 2018/11/29
     * 11:40
     * anthor liu
     * 仓库管理
     */
    Public function update_order(){
        if(IS_POST){
            $data = $_POST;
            //发货时间
            $data['deliverytime'] = strtotime($_POST['deliverytime']);
//            if($data['deliverytime'] != ""){
//                //收货时间
//                $data['reciivingtime'] = strtotime($_POST['reciivingtime']);
//            }
            //发货添加待办任务
            if($_POST['orderstatus'] == 2){
                $backlog['cid'] = $_POST['cid'];
                $backlog['uid'] = $_POST['uid'];
                $backlog['content'] = "跟踪收货，指导服用";
                $backlog['type'] = "客户跟踪";
                $backlog['create_time'] = time();
                $backlog['do_time'] = time() + 259200; // 三天以后提醒
                M('Backlog')->add($backlog);
            }

            if(M('Order')->save($data)){
                $this->ajaxReturn(['statu' => 200, 'msg' => '修改订单成功']);
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => '修改订单失败']);
            }
        }else{
            $orderid = $_GET['orderid'];
            $order = M('Order')->field('orderid,orderno,cid,address_id,couriername,desc,deliverytime,saleid')->where(['orderid'=>$orderid])->find();
            $order['deliverytime'] = date('Y-m-d',$order['deliverytime']);
            $customer = M('Customer')->where(['cid'=>$order['cid']])->find();
            $address = M('Address')->where(['addressid'=>$order['address_id']])->find();
            //物流选择
            $courier = M('Courier')->order('sort desc')->select();
            $this->assign('courier',$courier);
            $this->assign('customer',$customer);
            $this->assign('order',$order);
            $this->assign('address',$address['province'].$address['city'].$address['area'].$address['address']);
            $this->display();
        }
    }

    /**
     * 2018/12/24
     * 10:34
     * anthor liu
     * 删除订单
     */
    Public function del(){
        $orderid = $_POST['orderid'];
        $res = M('Order')->save(['orderid' => $orderid,'delete'=>0]);
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '成功删除']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "删除出错"]);
        }
    }

}