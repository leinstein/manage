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
        if(IS_POST){
            if($_POST['stat_date']) $where['create_time'] = ['gt',strtotime($_POST['stat_date'])];
            if($_POST['stop_date']) $where['create_time'] = ['lt',strtotime($_POST['stop_date'])];
            if($_POST['username'])  $where['nickname'] = trim($_POST['username']);
        }
        $admin = M('Admin');
        $count = $admin->count();//满足条件的数量
        $page  = new \Think\Page($count, 5);//实例化分页
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
        $id = session('id');
        $this->assign('id', $id);
        $this->assign('list', $list_r);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
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
            $data['password']      = trim(I('post.pass'));
            $data['nickname']      = trim(I('post.nickname'));
            $data['mobile']      = trim(I('post.phone'));
            $data['pass']      = md5(trim(I('post.pass')));
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
            $data['id']   = I('post.admin_id');
            $data['update_time'] = time();
            $rows = $admin->save($data);
            if ($rows) {
                $this->ajaxReturn(['statu' => 200, 'msg' => '划分成功']);
            } else {
                $this->ajaxReturn(['statu' => 202, 'msg' => '划分出错']);
            }
        } else {
            $id = $_GET['id'];
            $role_id = $_GET['role_id'];
            $role = M('Role')->field('id,name')->select();
            foreach ($role as $v){
                if($v['id'] == $role_id){
                    $role_name = $v['name'];
                }
            }
            $this->assign('role', $role);
            $this->assign('admin_id', $id);
            $this->assign('role_name', $role_name);
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
            $admin           = D('Admin');
            $data['username']   = trim(I('post.username'));
            $data['nickname']   = trim(I('post.nickname'));
            $data['mobile']   = trim(I('post.phone'));
            $data['role_id'] = $_POST['role'];
            $data['create_time'] = time();
            $data['password']     = md5(trim(I('post.pass')));
            $data['grade']   = session('grade') + 1;
            $data['bid']     = session('userid');

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
            $this->assign('role', $role);
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
        $list = $logininfo->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->display();
    }
}