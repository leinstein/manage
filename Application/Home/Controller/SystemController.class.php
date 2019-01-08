<?php

namespace Home\Controller;
use Home\Common\HomeController;

class SystemController extends HomeController{
    /**
     * 2018/11/20
     * 11:18
     * anthor liu
     * 个人基本信息-修改
     */
    Public function Index(){
        $admin = M('Admin');
        if(IS_POST){
            $data['nickname'] = I('post.nickname');
            $data['mobile'] = I('post.phone');
            if($_POST['pass'] != ''){
                $pass = I('post.pass');
                $repass = I('post.repass');
                if(strlen($pass) < 6) $this->ajaxReturn(array('statu'=>202,'msg'=>"密码长度必须大于6位"));
                if($pass != $repass) $this->ajaxReturn(array('statu'=>202,'msg'=>"两次密码输入不一致"));
                $data['password'] = md5($pass);
            }
            $data['update_time'] = time();
            $data['id'] = session('userid');
            if($admin->save($data)){
                $this->ajaxReturn(array('statu'=>200,'msg'=>'保存设置成功'));
            }else{
                $this->ajaxReturn(array('statu'=>202,'msg'=>'保存设置失败'));
            }
        }
        $id = session('userid');
        $info = $admin->field('username,mobile,img_big,nickname')->where(['id'=>$id])->find();
        $this->assign('info',$info);
        $this->display();
    }


    /**
     * 2018/11/20
     * 14:55
     * anthor liu
     * 头像上传
     */
    public function update_avatar() {
        if( IS_POST  ) {
            // 实例化上传类
            $upload = new \Think\Upload();
            // 设置附件上传大小（8）
            $upload->maxSize = 10240000;
            // 设置附件上传类型
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            // 设置附件上传目录
            $upload->rootPath = './Public/Uploads/';
            // 设置附件上传（子）目录
            $upload->savePath = '';
            // 上传文件
            $info = $upload->upload();
            if( !empty( $info ) ) {
                //得到图片上传路径
                $orImg = "./Public/Uploads/" . $info['file']['savepath'] . $info['file']['savename'];
                $image = new \Think\Image();
                $image->open( $orImg );
                //切割图片（文件名和后缀名）
                list( $fileName, $ext ) = explode( ".", $info['file']['savename'] );
                $imgSmall = "./Public/Uploads/" . $info['file']['savepath'] . $fileName . '_s.' . $ext;
                // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb( 150, 150 )->save( $imgSmall );
                //保存在数据库中的路径
                $brandInfo['img_big'] = "/Public/Uploads/" . $info['file']['savepath'] . $info['file']['savename'];
                $brandInfo['img_small'] = "/Public/Uploads/" . $info['file']['savepath'] . $fileName . '_s.' . $ext;
                $url = "/Public/Uploads/" . $info['file']['savepath'] . $fileName . '_s.' . $ext;
            }
            $id = session('userid');
            //删除原图
            $pic=M('Admin')->field('img_big,img_small')->where(array('id'=>$id))->find();
            $img_big = $pic['img_big'];
            $img_small = $pic['img_small'];
            unlink($_SERVER["DOCUMENT_ROOT"].$img_big);
            unlink($_SERVER["DOCUMENT_ROOT"].$img_small);

            $res = M('Admin')->where(['id'=>$id])->save( $brandInfo );
            if( $res !== false ) {
                $this->ajaxReturn(array('statu'=>200,'msg'=>"头像上传成功",'url'=>$url));
            }else {
                $this->ajaxReturn(array('statu'=>202,'msg'=>'上传失败'));
            }
        }else {
            $this->ajaxReturn(array('statu'=>202,'msg'=>'上传错误'));
        }
    }

    /**
     * 2018/12/27
     * 18:36
     * anthor liu
     * 目标管理
     */
    Public function aims(){
        $order = M('Order');
        $aim = M('Aim');
        $userid = $_SESSION['userid'];
        $info = $aim->where(['userid'=>$userid])->order('month desc')->select();

        foreach ($info as $v){
            $arr = explode('-', $v['month']);
            $m = $arr[1];
            $y = $arr[0];
            $u_aim_time = strtotime($v['month']);
            //上月月初时间戳
            $u_this_time = mktime(0,0,0,date('m')-1,1,date('Y'));
            //上月以前的直接存储，不去查询
            //上月和本月的，每次去查询完成金额
            //现在以后的空着不管
            if($v['complete']  == 0 and $u_aim_time < time()){
                    $star = mktime(0,0,0,$m,1,$y);
                    $end = mktime(23,59,59,$m,date('t', strtotime($v['month'])),$y);
                    $map['delete'] = 1;
                    if($_SESSION['username'] != 'admin'){
                        $map['saleid'] = $userid;
                    }
                    $map['orderstatus'] = ['neq',4];
                    $map['ordercreatetime'] = ['between',[$star,$end]];
                    $v['complete'] = $order->where($map)->sum('orderprice');
                    if($u_aim_time < $u_this_time){
                        $aim->save($v);
                    }
            }
            $v['avg'] = round($v['complete'] / $v['aim'] , 3) * 100 . '%';
            $info_full[] = $v;
        }
        //权限按钮
        $role = M('Role')->where(['id'=>$_SESSION['roleid']])->find();
        $role_ac = $role['role_auth_ac'];
        $action_name = get_action_name($role_ac);

        $this->assign([
            'info'=>$info_full,
            'role_ac'=> $role_ac,
            'action_name'=>$action_name
        ]);
        $this->display();
    }

    /**
     * 2018/12/27
     * 19:15
     * anthor liu
     * 添加目标
     */
    Public function add(){
        if (IS_POST){
            $aim = M('Aim');
            $data = $_POST;
            $data['userid'] = $_SESSION['userid'];
            $data['create_time'] = time();
            //只允许设定一次，不能更改
            $exist = $aim->where(['userid'=>$data['userid'],'month'=>$data['month']])->find();
            if($exist){
                $this->ajaxReturn(['statu' => 202, 'msg' => $data['month'].'目标已设定，请勿重复设置']);
            }else{
                $res = $aim->add($data);
                if($res){
                    $this->ajaxReturn(['statu' => 200, 'msg' => '添加成功']);
                }else{
                    $this->ajaxReturn(['statu' => 202, 'msg' => '添加失败']);
                }
            }
        }else{
            $this->display();
        }
    }

    /**
     * 2019/1/1
     * 12:35
     * anthor liu
     * 删除的客户
     */
    Public function customer(){
        $where['delete'] = 0;
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
        $group = M('Group')->select();
        $address = M('Address');
        foreach ($list as $v) {
            //销售人员姓名
            foreach ($admininfo as $vv){
                if($v['saleid'] == $vv['id']){
                    $v['nickname'] = $vv['nickname'];
                }
            }
            //销售人员所在分组
            foreach ($group as $vv){
                if($v['itemid'] == $vv['group_id']){
                    $v['item_name'] = $vv['group_name'];
                }
            }
            $add = $address->where(['addressid'=>$v['address_id']])->find();
            $v['address'] = $add['province'].'-'.$add['city'];
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
        //权限按钮
        $role = M('Role')->where(['id'=>$_SESSION['roleid']])->find();
        $role_ac = $role['role_auth_ac'];
        $action_name = get_action_name($role_ac);

        $this->assign([
            'statistical'=> $statistical,
            'infotoday'=>$infotoday,
            'infoyestoday'=>$infoyestoday,
            'infot'=>$infot,
            'count'=>$count,
            'page'=>$show,
            'firstRow'=>$page->firstRow,
            'role_ac'=> $role_ac,
            'action_name'=>$action_name
        ]);
        $this->display();

    }

    /**
     * 2019/1/1
     * 17:14
     * anthor liu
     * 恢复客户
     */
    Public function restore_customer(){
        $cid = $_POST['cid'];
        $res = M('Customer')->save(['cid'=>$cid,'delete'=>1]);
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '恢复成功']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "恢复出错，请重试"]);
        }
    }

    /**
     * 2019/1/1
     * 17:14
     * anthor liu
     *彻底删除客户
     */
    Public function real_del_customer(){
        $cid = $_POST['cid'];
        $res = M('Customer')->where(['cid'=>$cid])->delete();
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '成功删除']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "删除出错"]);
        }
    }

    /**
     * 2019/1/1
     * 12:37
     * anthor liu
     * 删除的订单
     */
    Public function order(){
        $order = D('Order');
        $where['delete'] = 0;
        $groupid = $_SESSION['groupid'];
        if($_SESSION['username'] != 'admin') $where['projectid'] = $groupid;
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
     * 2019/1/1
     * 17:14
     * anthor liu
     * 恢复订单
     */
    Public function restore_order(){
        $orderid = $_POST['orderid'];
        $order = M('Order');
        $res = $order->save(['orderid'=>$orderid,'delete'=>1]);
        if ($res) {
            $order_info = $order->where(['orderid'=>$orderid])->find();
            $cid = $order_info['cid'];
            if($order_info['orderstatus'] != 4){
                M('Customer')->where(['cid'=>$cid])->setInc('buyrate');
            }
            $this->ajaxReturn(['statu' => 200, 'msg' => '恢复成功']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "恢复出错，请重试"]);
        }
    }

    /**
     * 2019/1/1
     * 17:14
     * anthor liu
     *彻底删除订单
     */
    Public function real_del_order(){
        $orderid = $_POST['orderid'];
        $res = M('Order')->where(['orderid'=>$orderid])->delete();
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '成功删除']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "删除出错"]);
        }
    }

    /**
     * 2019/1/1
     * 16:52
     * anthor liu
     * 删除目标
     */
    Public function del_aim(){
        $id = $_POST['id'];
        $res = M('Aim')->where(['id'=>$id])->delete();
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '成功删除']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "删除出错"]);
        }
    }
}