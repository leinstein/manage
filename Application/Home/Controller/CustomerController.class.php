<?php
namespace Home\Controller;
use Home\Common\HomeController;

class CustomerController extends HomeController {
    /**
     * 2018/11/22
     * 9:41
     * anthor liu
     * 客户列表
     */
    Public function index(){
        $where['delete'] = 1;
        if($_GET['stat_date'] and !$_GET['stop_date']) $where['create_time'] = ['egt',strtotime($_GET['stat_date'])];
        if(!$_GET['stat_date'] and $_GET['stop_date']) $where['create_time'] = ['elt',strtotime($_GET['stop_date'])];
        if($_GET['stat_date'] and $_GET['stop_date']) $where['create_time'] = ['between',[strtotime($_GET['stat_date']),strtotime($_GET['stop_date'])]];
        if($_GET['name']){
            $word = '%'.trim($_GET['name']).'%';
            $where['name|note|phone|age'] =array('like',$word);
        }
        $customer = D('Customer');
        $order = D('Order');
        //获取统计数据
        if($_GET['day']){
            if($_GET['day'] == 'history'){
                $where['delete'] = 1;
            }else{
                $where['create_time'] = $order->where_s($_GET['day']);
            }
        }
        $statistical = $customer->statistical();
        $count = $customer->where($where)->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页

        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $list = $customer->where($where)->order('cid desc')->limit($page->firstRow . ',' . $page->listRows)->select();

        $admininfo = M('Admin')->select();
        $roleinfo = M('Role')->select();
        $address = M('Address');
        foreach ($list as $v) {
            //销售人员姓名
            foreach ($admininfo as $vv){
                if($v['saleid'] == $vv['id']){
                    $v['nickname'] = $vv['nickname'];
                }
            }
            //销售人员所在分组
            foreach ($roleinfo as $vv){
                if($v['itemid'] == $vv['id']){
                    $v['item_name'] = $vv['name'];
                }
            }
            $add = $address->where(['addressid'=>$v['address_id']])->find();
            $v['address'] = $add['province'].'-'.$add['city'];
//            $v['address'] = $add['province'].$add['city'].$add['area'].$add['address'];
            $info[] = $v;
        }
        //获取今天00:00时间戳
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //昨天结束
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        foreach ($info as $v){
            if($v['create_time'] > $todaystart){
                $infotoday[] = $v;
            }else if($v['create_time'] < $endYesterday and $v['create_time'] > $beginYesterday){
                $infoyestoday[] = $v;
            }else{
                $infot[] = $v;
            }
        }
        $this->assign('statistical', $statistical);
        $this->assign('infotoday', $infotoday);
        $this->assign('infoyestoday', $infoyestoday);
        $this->assign('infot', $infot);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->display();

    }

    /**
     * 2018/11/23
     * 11:52
     * anthor liu
     * 为客户添加订单
     * cid 当前客户ID
     */
    Public function order_add(){
        if(IS_POST){
            $goods = M('Goods');
            $goodsdata = $goods->select();
            $data['saleid'] = session('userid');
            //快递ID
            $data['address_id'] = $_POST['address_id'];
            //优惠金额
            $data['cheapprice'] = $_POST['cheapprice'];
            //客户ID
            $data['cid'] = $_POST['cid'];
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

            $data['ordercreatetime'] = time();

            //订单号码主体（YYYYMMDDHHIISSNNNNNNNN）
            $order_id_main = date('YmdHis') . rand(10000000,99999999);
            //订单号码主体长度
            $order_id_len = strlen($order_id_main);
            $order_id_sum = 417;
            for($i=0; $i<$order_id_len; $i++){
                $order_id_sum += (int)(substr($order_id_main,$i,1));
            }
            //唯一订单号码（YYYYMMDDHHIISSNNNNNNNNCC）
            $data['orderno'] =  $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
            //新增订单
            $res = M('Order')->add($data);
            if($res){
                $customer = M('Customer')->where(['cid'=>$data['cid']])->find();
                $buyrate = $customer['buyrate'] + 1;
                M('Customer')->save(['cid'=>$data['cid'],'buyrate'=>$buyrate]);
                //返回
                $this->ajaxReturn(['statu' => 200, 'msg' => '添加订单成功']);
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => '添加订单失败']);
            }
        }else{
            $data['cid'] = $cid = $_GET['cid'];
            $data['cname'] = $_GET['cname'];
            //物流选择
            $courier = M('Courier')->order('sort desc')->select();
            //当前客户信息
            $customer = M('Customer')->where(['cid'=>$cid])->find();
            //收货地址
            $add = M('Address')->where(['cid'=>$cid])->select();
            //所有商品
            $goods = M('Goods')->where(['status'=>1])->select();
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
            $this->assign('courier',$courier);
            $this->assign('customer',$customer);
            $this->assign('add_ress',$add_ress);
            $this->assign('goods_s',$goods_s);
            $this->assign('goods_z',$goods_z);
            $this->display();
        }
    }

    /**
     * 2018/11/29
     * 11:59
     * anthor liu
     * 添加客户
     */
    Public function add(){
        if(IS_POST){
            $address = M('Address');
            $customer = M('Customer');
            $data['consignee'] = $_POST['name'];
            $data['phone'] = $_POST['phone'];
            $data['province'] = $_POST['P1'];
            $data['city'] = $_POST['C1'];
            $data['area'] = $_POST['A1'];
            $data['address'] = $_POST['address'];
            $data['create_time'] = time();
            if($addressid = $address->add($data)){
                $cdata['name'] = $_POST['name'];
                $cdata['phone'] = $_POST['phone'];
                $cdata['saleid'] = session('userid');
                $cdata['sex'] = $_POST['sex'];
                $cdata['c_weixin'] = $_POST['c_weixin'];
                $cdata['a_weixin'] = $_POST['a_weixin'];
                $cdata['a_role'] = $_POST['a_role'];
                $cdata['age'] = $_POST['age'];
                $cdata['note'] = $_POST['note'];
                $cdata['address_id'] = $addressid;
                $cdata['create_time'] = time();
                if($cid = $customer->add($cdata)){
                    if($address->save(['addressid'=>$addressid,'cid'=>$cid])){
                        $this->ajaxReturn(['statu' => 200, 'msg' => '客户添加成功']);
                    }else{
                        $this->ajaxReturn(['statu' => 202, 'msg' => '客户添加失败']);
                    }
                }else{
                    $this->ajaxReturn(['statu' => 202, 'msg' => '客户添加失败']);
                }
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => '地址添加失败']);
            }
        }else{
            $this->display('member-add');
        }
    }

    /**
     * 2018/12/1
     * 14:47
     * anthor liu
     * 修改客户信息
     */
    Public function edit(){
        $customer = M('Customer');
        if(IS_POST){
            $address = M('Address');
            $data['consignee'] = $_POST['name'];
            $data['phone'] = $_POST['phone'];
            $data['province'] = $_POST['P1'];
            $data['city'] = $_POST['C1'];
            $data['area'] = $_POST['A1'];
            $data['address'] = $_POST['address'];
            $data['cid'] = $_POST['customerid'];
            $data['create_time'] = time();
            if($_POST['address']){
                $addressid = $address->add($data);
            }else{
                $addressid = true;
            }
            if($addressid){
                $cdata['cid'] = $_POST['customerid'];
                $cdata['name'] = $_POST['name'];
                $cdata['phone'] = $_POST['phone'];
                $cdata['c_weixin'] = $_POST['c_weixin'];
                $cdata['a_weixin'] = $_POST['a_weixin'];
                $cdata['a_role'] = $_POST['a_role'];
                $cdata['sex'] = $_POST['sex'];
                $cdata['age'] = $_POST['age'];
                $cdata['note'] = $_POST['note'];
                $cdata['address_id'] = $addressid;
                $cdata['update_time'] = time();
                if($customer->save($cdata)){
                    $this->ajaxReturn(['statu' => 200, 'msg' => '客户修改成功']);
                }else{
                    $this->ajaxReturn(['statu' => 202, 'msg' => '客户修改失败']);
                }
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => '地址添加失败']);
            }
        }else{
            $cid = $_GET['cid'];
            $data = $customer->where(['cid'=>$cid])->find();
            $this->assign('data',$data);
            $this->display('member-edit');
        }
    }

    /**
     * 2018/12/1
     * 15:29
     * @return mixed|void
     * anthor liu
     * 客户详情
     */
    Public function show(){
        $cid = $_GET['cid'];
        $customer = M('Customer');
        $order = M('Order');
        $address = M('Address');
        $c_info = $customer->where(['cid'=>$cid])->find();
        $o_info = $order->where(['cid'=>$cid])->select();
        $add = $address->where(['addressid'=>$c_info['address_id']])->find();
        $c_info['address'] = $add['province'].$add['city'].$add['area'].$add['address'];
        $this->assign('c_info',$c_info);
        $this->assign('o_info',$o_info);
        $this->display('member-show');
    }

    /**
     * 2018/12/1
     * 16:26
     * anthor liu
     * 删除客户
     */
    public function del()
    {
        $cid = $_POST['cid'];
        $res = M('Customer')->save(['cid' => $cid,'delete'=>0]);
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '成功删除']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "删除出错"]);
        }
    }


    /**
     * 2018/11/25
     * 11:18
     * anthor liu
     * 商品加入清单
     */
    Public function goods_add_card(){
        if(IS_POST){
            $goodsid = $_POST['goodsid'];
            $res = M('Goods')->where(['goodsid'=>$goodsid])->find();
            $res['goodsprice'] = substr($res['goodsprice'],0,-3);
            if($res){
                $this->ajaxReturn(['statu' => 200, 'msg' => $res]);
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => 'error']);
            }
        }
    }

    /**
     * 2018/12/7
     * 9:03
     * anthor liu
     * 待办任务列表
     */
    Public function backlog(){
        $where = '';
        if($_GET['stat_date']) $where['create_time'] = ['gt',strtotime($_GET['stat_date'])];
        if($_GET['stop_date']) $where['create_time'] = ['lt',strtotime($_GET['stop_date'])];
        if($_GET['name']){
            $word = '%'.trim($_GET['name']).'%';
            $where['content'] =array('like',$word);
        }
        //获取统计数据
        if($_GET['day']){
            if($_GET['day'] == 'history'){
                $where['delete'] = 1;
            }else{
                $where['create_time'] = D('Order')->where_s($_GET['day']);
            }
        }
        $backlog = D('Backlog');
        $count = $backlog->where($where)->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页

        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $list = $backlog->where($where)->order('bid desc')->limit($page->firstRow . ',' . $page->listRows)->select();

        $admininfo = M('Admin')->select();
        //$roleinfo = M('Role')->select();
        $customer = M('Customer')->select();
        foreach ($list as $v) {
            //销售人员姓名
            foreach ($customer as $n){
                if($v['cid'] == $n['cid']){
                    $v['name'] = $n['name'];
                }
            }
            //销售人员姓名
            foreach ($admininfo as $vv){
                if($v['uid'] == $vv['id']){
                    $v['nickname'] = $vv['nickname'];
                    $v['itemid'] = $vv['role_id'];
                }
            }
            //销售人员所在分组
//            foreach ($roleinfo as $vv){
//                if($v['itemid'] == $vv['id']){
//                    $v['item_name'] = $vv['name'];
//                }
//            }
            $info[] = $v;
        }
        //获取今天00:00时间戳
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //昨天结束
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        foreach ($info as $v){
            if($v['create_time'] > $todaystart){
                $infotoday[] = $v;
            }else if($v['create_time'] < $endYesterday and $v['create_time'] > $beginYesterday){
                $infoyestoday[] = $v;
            }else{
                $infot[] = $v;
            }
        }
        $statistical = D('Customer')->statistical_backlog();
        $this->assign('statistical', $statistical);
        $this->assign('infotoday', $infotoday);
        $this->assign('infoyestoday', $infoyestoday);
        $this->assign('infot', $infot);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->display();
    }

    /**
     * 2018/12/8
     * 11:23
     * anthor liu
     * 添加待办任务
     */
    Public function addbacklog(){
        $customer = M('Customer');
        $address = M('Address');
        $order = M('Order');
        $backlog = M('Backlog');
        if(IS_POST){
            $data['cid'] = $_POST['cid'];
            $data['type'] = $_POST['type'];
            $data['content'] = trim($_POST['content']);
            $data['do_time'] = strtotime($_POST['do_time']);
            $data['uid'] = session('userid');
            $data['create_time'] = time();
            //存储任务
            if($backlog->add($data)){
              $this->ajaxReturn(['statu' => 200, 'msg' => '任务添加成功']);
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => '任务添加失败，请重新添加']);
            }
        }else{
            $data['cid'] = $cid = $_GET['cid'];
            //当前客户信息
            $customer = $customer->where(['cid'=>$cid])->find();
            //收货地址
            $add = $address->where(['addressid'=>$customer['address_id']])->find();
            $add = $add['province'].$add['city'].$add['area'].$add['address'];
            //客户订单信息
            $o_info = $order->where(['cid'=>$cid])->select();
            //跟进信息
            $backlog_info = $backlog->where(['cid'=>$cid])->order('create_time desc')->select();
            $this->assign('data',$data);
            $this->assign('o_info',$o_info);
            $this->assign('backlog_info',$backlog_info);
            $this->assign('customer',$customer);
            $this->assign('add',$add);
            $this->display();
        }
    }

    /**
     * 2018/12/8
     * 11:22
     * anthor liu
     * 处理待办任务
     */
    Public function editbacklog(){
        $customer = M('Customer');
        $address = M('Address');
        $order = M('Order');
        $backlog = M('Backlog');
        if(IS_POST){
            $data['bid'] = $_POST['bid'];
            $data['do_time'] = strtotime($_POST['do_time']);
            $data['recontent'] = $_POST['recontent'];
            $data['status'] = $_POST['status'];
            //存储任务
            if($backlog->save($data)){
                $this->ajaxReturn(['statu' => 200, 'msg' => '待办任务已完成']);
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => '保存失败，请重新保存']);
            }
        }else{
            $bid = $_GET['bid'];
            $backlog_b = $backlog->where(['bid'=>$bid])->find();
            $cid = $backlog_b['cid'];
            //当前客户信息
            $customer = $customer->where(['cid'=>$cid])->find();
            //收货地址
            $add = $address->where(['addressid'=>$customer['address_id']])->find();
            $add = $add['province'].$add['city'].$add['area'].$add['address'];
            //客户订单信息
            $o_info = $order->where(['cid'=>$cid])->select();
            //跟进信息
            $backlog_info = $backlog->where(['cid'=>$cid])->order('create_time desc')->select();
            $this->assign('bid',$bid);
            $this->assign('o_info',$o_info);
            $this->assign('backlog_info',$backlog_info);
            $this->assign('backlog_b',$backlog_b);
            $this->assign('customer',$customer);
            $this->assign('add',$add);
            $this->display();
        }
    }

    /**
     * 2018/11/22
     * 9:41
     * anthor liu
     * 客户列表
     */
    Public function kehu(){
        $where['delete'] = 1;
        if($_GET['stat_date']) $where['create_time'] = ['gt',strtotime($_GET['stat_date'])];
        if($_GET['stop_date']) $where['create_time'] = ['lt',strtotime($_GET['stop_date'])];
        if($_GET['name']){
            $word = '%'.trim($_GET['name']).'%';
            $where['name|note|phone|age'] =array('like',$word);
        }
        $customer = D('Customer');
        $order = D('Order');
        //获取统计数据
        if($_GET['day']){
            if($_GET['day'] == 'history'){
                $where['delete'] = 1;
            }else{
                $where['create_time'] = $order->where_s($_GET['day']);
            }
        }
        $statistical = $customer->statistical();
        $count = $customer->where($where)->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页

        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $list = $customer->where($where)->order('cid desc')->limit($page->firstRow . ',' . $page->listRows)->select();

        $admininfo = M('Admin')->select();
        $roleinfo = M('Role')->select();
        $address = M('Address');
        foreach ($list as $v) {
            //销售人员姓名
            foreach ($admininfo as $vv){
                if($v['saleid'] == $vv['id']){
                    $v['nickname'] = $vv['nickname'];
                }
            }
            //销售人员所在分组
            foreach ($roleinfo as $vv){
                if($v['itemid'] == $vv['id']){
                    $v['item_name'] = $vv['name'];
                }
            }
            $add = $address->where(['addressid'=>$v['address_id']])->find();
            $v['address'] = $add['province'].'-'.$add['city'];
//            $v['address'] = $add['province'].$add['city'].$add['area'].$add['address'];
            $info[] = $v;
        }
        //获取今天00:00时间戳
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //昨天结束
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        foreach ($info as $v){
            if($v['create_time'] > $todaystart){
                $infotoday[] = $v;
            }else if($v['create_time'] < $endYesterday and $v['create_time'] > $beginYesterday){
                $infoyestoday[] = $v;
            }else{
                $infot[] = $v;
            }
        }
        $this->assign('statistical', $statistical);
        $this->assign('infotoday', $infotoday);
        $this->assign('infoyestoday', $infoyestoday);
        $this->assign('infot', $infot);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->display();

    }
}