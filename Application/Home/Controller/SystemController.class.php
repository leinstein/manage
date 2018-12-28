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
            if($v['complete']  == '' and $u_aim_time < time()){
                    $star = mktime(0,0,0,$m,1,$y);
                    $end = mktime(23,59,59,$m,date('t', strtotime($v['month'])),$y);
                    $map['delete'] = 1;
                    if($_SESSION['userid'] != 'admin'){
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
        $this->assign('info',$info_full);
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
}