<?php
namespace Home\Controller;
use Home\Common\HomeController;

class IndexController extends HomeController {
    /**
     * 2018/11/19
     * 15:04
     * anthor liu
     * 后台首页
     */
    public function index(){
        $id=session('userid');
        $username = session('username');
        $admin=M('Admin');
        if($username !== 'admin'){
            $roleinfo = M('Admin')
                ->alias('m')
                ->join('__ROLE__ as r on m.role_id = r.id')
                ->where(array('m.id'=>$id))
                ->field('r.role_auth_ids,nickname')
                ->find();
            $authids = $roleinfo['role_auth_ids'];
            $authInfo = M('auth')->order('sort desc')->select($authids);
        }else{
            $authInfo = M('auth')->order('sort desc')->select();
        }
        foreach ($authInfo as $k=>$v){
            if($v['auth_level'] == 2){
                $authinfoB[] = $v;
            }else if($v['auth_level'] == 1){
                $authinfoA[] = $v;
            }
        }
        $this->assign('authinfoA',$authinfoA);
        $this->assign('authinfoB',$authinfoB);
        $info=$admin->field('last_login_time,img_big')->where(['id'=>$id])->find();
        $this->assign('time',date('Y-m-d H:i:s',$info['last_login_time']));
        $this->assign('avatar',$info['img_big']);
        $this->assign('id',$id);
        $this->display();
    }
    public function wel(){
        $this->display('welcome');
    }
}