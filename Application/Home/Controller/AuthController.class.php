<?php

namespace Home\Controller;
use Home\Common\HomeController;

class AuthController extends HomeController{
    /**
     * 2018/11/17
     * 9:18
     *anthor liu
     * 权限列表
     */
    function index()
    {
        $auth = M('Auth');
        $info = $auth->select();
        $info = generateTree($info);
        foreach ($info as $v){
            $v['rule'] = $v['auth_c'].' - '.$v['auth_a'];
            $infos[] = $v;
        }
        $count = $auth->count();//满足条件的数量
        //权限按钮
        $role = M('Role')->where(['id'=>$_SESSION['roleid']])->find();
        $role_ac = $role['role_auth_ac'];
        $action_name = get_action_name($role_ac);
        $this->assign([
            'count'=> $count,
            'info'=> $infos,
            'role_ac'=> $role_ac,
            'action_name'=>$action_name
        ]);
//        $this->assign('count', $count);
//        $this->assign('info', $infos);
        $this->display();
    }

    /**
     * 2018/11/17
     * 17:17
     * anthor liu
     * 添加权限
     */
    public function add(){
        $auth = M('Auth');
        if (IS_POST) {
            $data               = $_POST;
//            $auth_name = $data['auth_name'];
//            $r = $auth->where(array('auth_name'=>$auth_name))->find();
//            if($r){
//                $this->ajaxReturn(array('statu'=>202,'msg'=>"此权限名称已经存在"));
//            }else{
                $auth_id = $auth->add($data);
                if($auth_id){
                    $this->ajaxReturn(array('statu'=>200,'msg'=>'添加成功'));
                }else{
                    $this->ajaxReturn(array('statu'=>202,'msg'=>"添加失败"));
                }
//            }
        } else {
            $authinfo = $auth->where(['auth_level' => ['in',[1,2]],'delete'=>1])
                ->select();
            $authinfo = generateTree($authinfo);
            $this->assign('authinfo', $authinfo);
            $this->display();
        }
    }

    /**
     * 2018/11/21
     * 16:03
     * anthor liu
     * 修改权限
     */
    public function edit()
    {
        $auth = D('Auth');
        if (IS_POST) {
            $data = $_POST;
            if($auth->save($data)){
                $this->ajaxReturn(array('statu'=>200,'msg'=>'修改成功'));
            }else{
                $this->ajaxReturn(array('statu'=>202,'msg'=>"修改失败"));
            }
        } else {
            $auth_id  = $_GET['auth_id'];
            $info = $auth->where(['auth_id' => $auth_id])->find();
            $authinfo = $auth->where(['auth_level' => ['in',[1,2]],'delete'=>1])
                ->select();
            $authinfo = generateTree($authinfo);
            $this->assign('authinfo', $authinfo);
            $this->assign('info', $info);
            $this->assign('level', $info['auth_level']);
            $this->display();
        }
    }

    /**
     * 2018/11/19
     * 14:27
     * anthor liu
     * 删除权限
     */
    public function del(){
        $id = $_POST['auth_id'];
        $res = M('Auth')->where(['auth_id'=>$id])->delete();
        if($res){
            $this->ajaxReturn(array('statu'=>200,'msg'=>'已删除'));
        }else{
            $this->ajaxReturn(array('statu'=>202,'msg'=>"删除出错"));
        }
    }
}