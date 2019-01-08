<?php
namespace Home\Controller;
use Home\Common\HomeController;

class AdminController extends HomeController {
    /**
     * 2018/11/17
     * 9:28
     *anthor liu
     * 管理员列表
     */
    public function index()
    {
        $where = '';
        if($_POST['stat_date'] and !$_POST['stop_date']) $where['create_time'] = ['egt',strtotime($_POST['stat_date'])];
        if(!$_POST['stat_date'] and $_POST['stop_date']) $where['create_time'] = ['elt',strtotime($_POST['stop_date'])];
        if($_POST['stat_date'] and $_POST['stop_date']) $where['create_time'] = ['between',[strtotime($_POST['stat_date']),strtotime($_GET['stop_date'])]];
        if($_POST['word']){
            $word = '%'.trim($_POST['word']).'%';
            $where['username|nickname|mobile'] =array('like',$word);
        }
        $admin = M('Admin');
        $count = $admin->where($where)->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $list = $admin->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();
        $role = M('Role');
        foreach ($list as $v) {
            $a            = $role->where(['id' => $v['role_id']])->find();
            $v['role_name'] = $a['name'];
            $list_r[]     = $v;
        }
        $group = M('Group');
        foreach ($list_r as $v) {
            $a            = $group->where(['group_id' => $v['group_id']])->find();
            $v['group_name'] = $a['group_name'];
            $list_g[]     = $v;
        }
        //权限按钮
        $role = M('Role')->where(['id'=>$_SESSION['roleid']])->find();
        $role_ac = $role['role_auth_ac'];
        $action_name = get_action_name($role_ac);
        $this->assign([
            'id'=> session('id'),
            'list'=> $list_g,
            'count'=> $count,
            'page'=> $show,
            'firstRow'=> $page->firstRow,
            'role_ac'=> $role_ac,
            'action_name'=>$action_name
        ]);
//        $id = session('id');
//        $this->assign('id', $id);
//        $this->assign('list', $list_g);
//        $this->assign('count', $count);
//        $this->assign('page', $show);
//        $this->assign('firstRow', $page->firstRow);
        $this->display();
    }

    /**
     * 2018/11/21
     * 10:03
     * anthor liu
     * 停用管理员
     */
    public function stop()
    {
        $id = $_POST['id'];
        $res = M('Admin')->save(['id' => $id,'status'=>0]);
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '已停用']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "停用出错，请重试"]);
        }
    }

    /**
     * 2018/11/21
     * 10:36
     * anthor liu
     * 启用管理员
     */
    public function start()
    {
        $id = $_POST['id'];
        $res = M('Admin')->save(['id' => $id,'status'=>1]);
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '已启用']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "启用出错，请重试"]);
        }
    }

    /**
     * 2018/11/21
     * 10:40
     * anthor liu
     * 修改管理员信息
     */
    public function edit()
    {
        $admin = D('Admin');
        if (IS_POST) {
            $data['id']      = I('post.id');
            $data['username']      = trim(I('post.username'));
//            $data['password']      = trim(I('post.pass'));
            $data['nickname']      = trim(I('post.nickname'));
            $data['mobile']      = trim(I('post.phone'));
            $data['password']      = md5(trim(I('post.pass')));
            $pass      = trim(I('post.pass'));
            $repass      = trim(I('post.repass'));
            $data['role_id']  = $_POST['role_id'];
            $data['update_time'] = time();
            if (!$admin->create()) {
                $this->ajaxReturn(['statu' => 202, 'msg' => $admin->getError()]);
            } else {
                if(strlen($pass) < 6) $this->ajaxReturn(array('statu'=>202,'msg'=>"密码长度必须大于6位"));
                if($pass != $repass) $this->ajaxReturn(array('statu'=>202,'msg'=>"两次密码输入不一致"));
                $rows = $admin->save($data);
                if ($rows) {
                    $this->ajaxReturn(['statu' => 200, 'msg' => '修改成功']);
                } else {
                    $this->ajaxReturn(['statu' => 202, 'msg' => '修改失败']);
                }
            }
        } else {
            $id  = I('get.id');
            $info = $admin->find($id);
            $this->assign('info', $info);
            $role = M('Role')->select();
            $this->assign('role', $role);
            $this->display();
        }
    }

    /**
     * 2018/11/21
     * 11:26
     * anthor liu
     * 删除管理员
     */
    public function del()
    {
        $id = $_POST['id'];
        $res = M('Admin')->where(['id' => $id])->delete();
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '成功删除']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "删除出错"]);
        }
    }

    /**
     * 2018/11/21
     * 18:02
     * anthor liu
     * 划分项目组
     */
    public function group()
    {
        if (IS_POST) {
            $admin           = D('Admin');
            $data['role_id']   = I('post.role_id');
            $data['group_id']   = I('post.group_id');
            $data['id']   = I('post.admin_id');
            $data['update_time'] = time();
            $rows = $admin->save($data);
            if ($rows) {
                $this->ajaxReturn(['statu' => 200, 'msg' => '划分成功']);
            } else {
                $this->ajaxReturn(['statu' => 202, 'msg' => '划分出错']);
            }
        } else {
            $data['admin_id'] = $_GET['id'];
            $data['group_id'] = $_GET['group_id'];
            $data['role_id'] = $role_id = $_GET['role_id'];
            $role = M('Role')->field('id,name')->select();
            $group = M('Group')->field('group_id,group_name')->select();
            //当前角色名
            foreach ($role as $v){
                if($v['id'] == $role_id){
                    $data['role_name'] = $v['name'];
                }
            }
            //当前分组名
            foreach ($group as $v){
                if($v['group_id'] == $data['group_id']){
                    $data['group_name'] = $v['group_name'];
                }
            }
            $this->assign('role', $role);
            $this->assign('group', $group);
            $this->assign('data', $data);
            $this->display();
        }
    }

    /**
     * 2018/11/17
     * 12:01
     * anthor liu
     * 添加管理员
     */
    public function add()
    {
        if (IS_POST) {
            $admin                  = D('Admin');
            $data['username']       = trim(I('post.username'));
            $data['nickname']       = trim(I('post.nickname'));
            $data['mobile']         = trim(I('post.phone'));
            $data['role_id']        = $_POST['role'];
            $data['group_id']        = $_POST['group_id'];
            $data['create_time']    = time();
            $data['password']       = md5(trim(I('post.pass')));
            $data['grade']          = session('grade') + 1;
            $data['bid']            = session('userid');

            if (!$admin->create()) {
                $this->ajaxReturn(['status' => 'error', 'msg' => $admin->getError()]);
            } else {
                $res       = $admin->where(['username' => $data['username']])->find();
                $adminname = $res['username'];
                if ($adminname == $data['username']) {
                    $this->ajaxReturn(['statu' => 202, 'msg' => '用户名已经存在']);
                } else {
                    if ($admin->add($data)) {
                        $this->ajaxReturn(['statu' => 200, 'msg' => '添加成功']);
                    } else {
                        $this->ajaxReturn(['statu' => 202, 'msg' => '添加失败']);
                    }
                }
            }
        } else {
            $role = M('Role')->field('id,name')->select();
            $group = M('Group')->field('group_id,group_name')->select();
            $this->assign('role', $role);
            $this->assign('group', $group);
            $this->display();
        }
    }

    /**
     * 2018/12/6
     * 18:35
     * anthor liu
     * 操作日志
     */
    Public function work(){
        $where = '';
        if($_GET['stat_date']) $where['create_time'] = ['gt',strtotime($_POST['stat_date'])];
        if($_GET['stop_date']) $where['create_time'] = ['lt',strtotime($_POST['stop_date'])];
        if($_GET['word']){
            $word = '%'.trim($_GET['word']).'%';
            $where['loginname|loginnickname|errorinfo|ip|city'] =array('like',$word);
        }
        $logininfo = M('Logininfo');
        $count = $logininfo->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $list = $logininfo->where($where)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->display();
    }

    /**
     * 2018/12/29
     * 15:59
     * anthor liu
     * 清空登录记录
     */
    Public function del_all_work(){
        $res = M('Logininfo')->execute('TRUNCATE table fb_logininfo');
//        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '清除成功']);
//        } else {
//            $this->ajaxReturn(['statu' => 202, 'msg' => '清除失败，请重试']);
//        }
    }
    /**
     * 2018/12/14
     * 16:36
     * anthor liu
     * 分组管理列表
     */
    Public function group_management(){
        $group = M('Group')->order('group_id desc')->select();
        $admin_info = M('Admin')->select();
        foreach ($group as $v){
            foreach ($admin_info as $vv){
                if($vv['group_id'] == $v['group_id']){
                    $v['team'][] = $vv['nickname'];
                }
            }
            $v['team'] = implode(',',$v['team']);
            $info[] = $v;
        }
        //权限按钮
        $role = M('Role')->where(['id'=>$_SESSION['roleid']])->find();
        $role_ac = $role['role_auth_ac'];
        $action_name = get_action_name($role_ac);
        $this->assign([
            'info'=>$info,
            'role_ac'=> $role_ac,
            'action_name'=>$action_name
        ]);
//        $this->assign('info',$info);
        $this->display();
    }

    /**
     * 2018/12/14
     * 17:35
     * anthor liu
     * 添加分组
     */
    Public function add_group(){
        if (IS_POST) {
            $group    = M('Group');
            $data['group_name']   = I('post.group_name');
            $data['issale']   = I('post.issale');
            $data['remark']   = I('post.remark');
            $data['create_time'] = time();
            $rows = $group->add($data);
            if ($rows) {
                $this->ajaxReturn(['statu' => 200, 'msg' => '添加成功']);
            } else {
                $this->ajaxReturn(['statu' => 202, 'msg' => '添加失败，请重试']);
            }
        } else {
            $this->display();
        }
    }

    /**
     * 2018/12/14
     * 18:21
     * anthor liu
     * 编辑分组
     */
    Public function edit_group(){
        $group    = M('Group');
        if (IS_POST) {
            $data['group_id'] = I('post.group_id');
            $data['group_name']   = I('post.group_name');
            $data['issale']   = I('post.issale');
            $data['remark']   = I('post.remark');
            $data['create_time'] = time();
            $rows = $group->save($data);
            if ($rows) {
                $this->ajaxReturn(['statu' => 200, 'msg' => '保存成功']);
            } else {
                $this->ajaxReturn(['statu' => 202, 'msg' => '保存失败，请重试']);
            }
        } else {
            $group_id = $_GET['group_id'];
            $group_info = $group->where(['group_id'=>$group_id])->find();
            $this->assign('info',$group_info);
            $this->display();
        }
    }

    /**
     * 2018/12/15
     * 8:35
     * anthor liu
     * 删除分组
     */
    public function del_group()
    {
        $group_id = $_POST['group_id'];
        $res = M('Group')->where(['group_id' => $group_id])->delete();
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '成功删除']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "删除出错"]);
        }
    }

}