<?php

namespace Home\Controller;
use Home\Common\HomeController;

class RoleController extends HomeController{
    /**
     * 2018/11/17
     * 9:21
     *anthor liu
     * 角色列表
     */
    function index(){
        $info = M('Role')->order('id asc')->select();
        $this->assign('info',$info);
        $this->display();
    }

    /**
     * 2018/11/17
     * 9:21
     *anthor liu
     * 角色权限
     */
    function distribution(){
        $role = D('Role');
        if(IS_POST){
            $role_dis_id = session('role_dis_id');
            if($role_dis_id == $_POST['role_id']){
                $z = $role->saveAuth($_POST['role_id'],$_POST['auth_id']);
                if($z){
                    $this->ajaxReturn(['statu' => 200, 'msg' => '权限分配成功']);
                }else{
                    $this->ajaxReturn(['statu' => 202, 'msg' => '权限分配失败']);
                }
            }else{
                $this->ajaxReturn(['statu' => 203, 'msg' => '非法操作，请联系管理员']);
            }
        }else{
            $role_id = I('get.role_id');
            $roleinfo = $role->find($role_id);
            $this->assign('roleinfo',$roleinfo);
            session('role_dis_id',$role_id);
            $authinfoA = D('Auth')->where(array('auth_level'=>'1'))->select();
            $level['auth_level'] = array('in',array(2));
            $authinfoB = D('Auth')->where($level)->select();
            $authinfoC = D('Auth')->where(['auth_level'=>3])->select();
            $this->assign('authinfoA',$authinfoA);
            $this->assign('authinfoB',$authinfoB);
            $this->assign('authinfoC',$authinfoC);
            $this->display();
        }
    }

    /**
     * 2018/11/19
     * 16:14
     * anthor liu
     * 删除权限
     */
    public function del(){
        $id = $_POST['role_id'];
        $res = M('Role')->where(['id'=>$id])->delete();
        if($res){
            $this->ajaxReturn(array('statu'=>200,'msg'=>'已删除'));
        }else{
            $this->ajaxReturn(array('statu'=>202,'msg'=>"删除出错"));
        }
    }

    /**
     * 2018/11/17
     * 9:22
     *anthor liu
     * 添加角色
     */
    public function add(){
        if(IS_POST){
            $role = M('Role');
            $role_name = I('post.name');
            $description = I('post.description');
            $pid = I('post.pid');
            $time= time();
            $r = $role->where(array('name'=>$role_name))->find();
            if($r){
                $this->ajaxReturn(array('statu'=>202,'msg'=>"此角色名称已经存在"));
            }else{
                $role_id = $role->add(array('name'=>$role_name,'description'=>$description,'pid'=>$pid,'create_time'=>$time));
                if($role_id){
                    $this->ajaxReturn(array('statu'=>200,'msg'=>'添加成功，现在可以分配分配权限'));
                }else{
                    $this->ajaxReturn(array('statu'=>202,'msg'=>"添加失败"));
                }
            }
        }else{
            $rolename = M('Role')->select();
            $this->assign('rolename', $rolename);
            $this->display();
        }
    }

    /**
     * 2018/11/21
     * 15:37
     * anthor liu
     * 编辑角色
     */
    public function edit()
    {
        $role = D('Role');
        if (IS_POST) {
            $role_name = I('post.name');
            $description = I('post.description');
            $pid = I('post.pid');
            $id = I('post.id');
            $time= time();
            $role_id = $role->save(array('id'=>$id,'name'=>$role_name,'description'=>$description,'pid'=>$pid,'create_time'=>$time));
            if($role_id){
                $this->ajaxReturn(array('statu'=>200,'msg'=>'更新成功'));
            }else{
                $this->ajaxReturn(array('statu'=>202,'msg'=>"更新失败"));
            }
        } else {
            $id  = I('get.role_id');
            $info = $role->find($id);
            $this->assign('info', $info);
            $role = $role->select();
            $this->assign('role', $role);
            $this->display();
        }
    }
}