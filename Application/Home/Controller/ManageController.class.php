<?php
namespace Home\Controller;
use Home\Common\HomeController;

class ManageController extends HomeController {
    /**
     * 2018/11/1
     * 13:37
     * anthor liu
     * 登陆管理系统
     */
    public function login(){
        if(IS_POST){
            //$manager_verify = I('post.manager_verify');
            $signup_ip = $logininfo['ip'] = get_client_ip();
            $iptype = get_area($signup_ip);
            $logininfo['city'] = $iptype['data']['country'].' '.$iptype['data']['region'].' '.$iptype['data']['country'].' '.$iptype['data']['isp'];
           // $verify = $this->verifyCode($manager_verify);
            //if ($verify){
                $name = I('post.username');
                $pwd = I('post.pass');
                $info = M('Admin')
                    ->where(array('username'=>$name))
                    ->where(array('password'=>md5($pwd)))
                    ->find();
                if($info){
                    if($info['status'] == 0) $this->ajaxReturn(['statu' => 202, 'msg' => '账号冻结,请联系管理员']);
                    session('userid',$info['id']);
                    session('username',$info['username']);
                    session('nickname',$info['nickname']);
                    session('roleid',$info['role_id']);
                    session('grade', $info['grade']);
                    session('role_id', $info['role_id']);
                    $time = $logininfo['logintime'] = time();
                    M('Admin')->where(['id'=>$info['id']])->save(['last_login_time'=>$time,'signup_ip'=>$signup_ip]);
                    $logininfo['loginstatus'] = 1;
                    $logininfo['errorinfo'] = '登陆成功';
                    $logininfo['loginname'] = $name;
                    $logininfo['loginpass'] = $pwd;
                    $logininfo['loginnickname'] = $info['nickname'];
                    M('Logininfo')->add($logininfo);
                    $this->ajaxReturn(['statu' => 200, 'msg' => '登陆成功']);
                }
                $logininfo['logintime'] = time();
                $logininfo['loginstatus'] = 2;
                $logininfo['errorinfo'] = '用户名或密码错误';
                $logininfo['loginname'] = $name;
                $logininfo['loginpass'] = $pwd;
                $logininfo['loginnickname'] = '';
                M('Logininfo')->add($logininfo);
                $this->ajaxReturn(['statu' => 202, 'msg' => '用户名或密码错误，请重新填写']);
//            }else{
//                $this->ajaxReturn(['statu' => 202, 'msg' => '验证码错误']);
//            }
        }
        $this->display();
    }

    /**
     * 2018/11/16
     * 13:37
     * anthor liu
     * 退出登陆
     */
    public function logout(){
        session(null);
        redirect('login');
    }

    /**
     * 2018/11/16
     * 13:36
     * anthor liu
     * 图片验证码
     */
    function verifyImg(){
        $cfg = array(
            'fontSize'  =>  20,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'imageH'    =>  42,               // 验证码图片高度
            'imageW'    =>  150,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',       // 验证码字体，不设置随机获取
        );
        $vry = new \Think\Verify($cfg);
        $vry->entry();
    }

    /**
     * @param $verify
     * 2018/11/16
     * 13:37
     * anthor liu
     *验证码
     * @return bool
     */
    function verifyCode($verify){
        $vry   = new \Think\Verify();
        if ($vry->check($verify)) {
            session('username', $verify);
            return true;
        } else {
            return false;
        }
    }

}