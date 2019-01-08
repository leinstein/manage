<?php

namespace Home\Controller;
use Home\Common\HomeController;
use Think\Cache\Driver\Redis;

class TelephoneController extends HomeController{

    /**
     * 2019/1/4
     * 15:13
     * anthor liu
     * 获取号码
     */
    Public function index(){
        if(IS_POST){
            $phone = M('Phone');
            $uid = $_SESSION['userid'];
            $info = $phone->where(['weixin'=>1])->order('id desc')->limit(8)->select();
            if($info){
                $time= time();
                foreach ($info as $v){
                    $w=[];
                    $w['weixin'] = $v['weixin']  +1;
                    $w['uid'] = $uid;
                    $w['use_time'] = $time;

                    $p1 = substr($v['phone'],0,3);
                    $p2 = substr($v['phone'],3,4);
                    $p3 = substr($v['phone'],7,4);
                    $v['phone'] = $p1 . ' ' . $p2 . ' ' . $p3;
                    $info_p[] = $v;
                    $phone->where(['id'=>$v['id']])->setField($w);
                }
                $this->ajaxReturn(['statu' => 200, 'msg' => '获取成功','data'=>$info_p]);
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => '没有数据了']);
            }


        }else{
            $this->display();
        }
    }

    /**
     * 2019/1/4
     * 15:14
     * anthor liu
     * txt号码资源上传
     */
    Public function updata(){
        if(IS_POST){
            set_time_limit(1000);
            $phone = M('Phone');
            $phone_temp = M('Phone_temp');
            if($_POST['type'] == 'txt'){
                //检测
                if($_POST['bhv'] == 'delection'){
                    $count = $phone_temp->count();
                    if($count > 0){
                        $this->ajaxReturn(['statu' => 202, 'tip' => $count,'tip'=>'还有数据未上传，请先上传']);
                    }else{
                        $file = $_FILES['file'];
                        if($file['error'] == 1){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '上传的文件超过了 php.ini 中 upload_max_filesize选项限制的值']);
                        }else if($file['error'] == 2){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值']);
                        }else if($file['error'] == 3){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '文件只有部分被上传']);
                        }else if($file['error'] == 4){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '没有文件被上传']);
                        }else if($file['error'] == 6){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '找不到临时文件夹']);
                        }else if($file['error'] == 7){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '文件写入失败']);
                            $this->ajaxReturn(['statu' => 202, 'tip' => '文件写入失败']);
                        }

                        $time_start = microtime(true);
                        $content = file_get_contents($file['tmp_name']);
                        $phones = explode(PHP_EOL,$content);
                        $phone_numbers = $phone->field('phone')->select();
                        foreach ($phone_numbers as $p){
                            $phone_number[] = $p['phone'];
                        }
                        //自身重复
                        $data['totle'] = count($phones);
                        $phones = array_unique($phones);
                        $data['chong'] = $data['totle'] - count($phones);

                        $data['no'] = $data['rephone'] =0;

                        foreach ($phones as $v){
                            if(!is_numeric($v) || strlen($v) != 11){
                                $data['no'] ++;
                                unset($v);
                            }else{
                                if(in_array($v,$phone_number,true)){
                                    $data['rephone'] ++;
                                    unset($v);
                                }else{
                                    $vv['phone'] = $v;
                                    $list[] = $vv;
                                }
                            }
                        }
                        $time_end = microtime(true);
                        $data['time'] = $time_end - $time_start;

                        $res = M('Phone_temp')->addAll($list);
                        $data['successyes'] = count($list);
                        if($res){
                            $this->ajaxReturn(['statu' => 200, 'msg' => $data,'tip'=>'检测完成']);
                        }else{
                            if($data['rephone'] == $data['totle']){
                                $this->ajaxReturn(['statu' => 202, 'msg' => $data,'tip'=>'号码全部重复，请上传新资源']);
                            }
                            $this->ajaxReturn(['statu' => 202, 'msg' => $data,'tip'=>'没有符合条件的号码']);
                        }
                    }

                }
                //上传
                if($_POST['bhv'] == 'upload'){
//                    $phone = M('Phone');
//                    $phone_temp = M('Phone_temp');
                    $phone_temp_info = $phone_temp->field('phone')->select();
                    $time = time();$k=0;
                    foreach ($phone_temp_info as $v){
                        $v['create_time'] = $time;
                        $list_p[] = $v;
                        $k++;
                    }
                    $c = count($list_p);
                    for($i = 0;$i<$c;$i=$i+10000){
                        $info = array_slice($list_p,$i,10000);
                        $res = $phone->addAll($info);
                    }

                    if($res){
                        $phone_temp->where('1')->delete();
                        $phone_temp->execute("alter table fb_phone_temp AUTO_INCREMENT = 1");
                        $this->ajaxReturn(['statu' => 200, 'msg' => $k,'tip'=>'成功上传']);
                    }else{
                        $this->ajaxReturn(['statu' => 202, 'tip'=>'没有数据被上传']);
                    }

                }
            }
        }else{
            $this->display();
        }
    }
    Public function updata_redis(){
        if(IS_POST){
            set_time_limit(1000);
            $phone = M('Phone');
            $phone_temp = M('Phone_temp');
            if($_POST['type'] == 'txt'){
                //检测
                if($_POST['bhv'] == 'delection'){
                        $file = $_FILES['file'];
                        if($file['error'] == 1){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '上传的文件超过了 php.ini 中 upload_max_filesize选项限制的值']);
                        }else if($file['error'] == 2){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值']);
                        }else if($file['error'] == 3){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '文件只有部分被上传']);
                        }else if($file['error'] == 4){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '没有文件被上传']);
                        }else if($file['error'] == 6){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '找不到临时文件夹']);
                        }else if($file['error'] == 7){
                            $this->ajaxReturn(['statu' => 202, 'tip' => '文件写入失败']);
                            $this->ajaxReturn(['statu' => 202, 'tip' => '文件写入失败']);
                        }

                        //获取执行时间
                        $time_start = microtime(true);
                        //实例化redis
                        $redis = new \Redis;
                        $redis->connect(C('REDIS_HOST'),C('REDIS_PORT'));
                        //密码
                        $redis->auth('storm');
                        //获取数据库总数totle
                        $phone_numbers = $phone->count();
                        //如果数据库没有数据，那么建立一个空的phone键
                        //如果redis中不存在phone键，建立一个空的phone键
                        //如果数据库不为空，phone存在，数据库电话数与redis中不相等，删除redis中所有，把数据库中加入redis
                        //如果数据库不为空，phone存在，数据库中电话和redis中相等，那么跳过此步骤
                        if($phone_numbers){
                            if($redis->exists('phone')){
                                //redis中元素数
                                $redis_count = $redis->sCard('phone');
                                //要是不相等，删除redis中数据取数据库所有数据到 redis
                                if($phone_numbers != $redis_count){
                                    if($redis->del('phone')){
                                        //数据库所有数据
                                        $phones = $phone->field('phone')->select();

                                        foreach ($phones as $s){
                                            $redis->sAdd('phone',$s['phone']);
                                        }
                                    }
                                }
                            }else{
                                $redis->sAdd('phone','');
                            }
                        }else{
                            $redis->sAdd('phone','');
                        }

                        //获取TXT内容
                        $content = file_get_contents($file['tmp_name']);
                        $phones_temp = explode(PHP_EOL,$content);

                        //上传文档中总数
                        $data['totle'] = count($phones_temp);

                        $data['no'] = $data['rephone'] =0;
                        $redis->del('phone_temp');
                        foreach ($phones_temp as $temp){
                            if(!is_numeric($temp) || strlen($temp) != 11){
                                $data['no'] ++;
                                unset($temp);
                            }else{
                                //将纯数字 11 位电话号码插入 redis
                                $redis->sAdd('phone_temp',$temp);
                            }
                        }

                        //插入redis中的号码数
                        $no_rep = $redis->sCard('phone_temp');
                        //自身重复
                        $data['chong']  = $data['totle'] - $data['no'] - $no_rep;
                        //新的上传号码
                    $data['x'] = $redis->sCard('phone');
                    $data['y'] = $redis->sCard('phone_temp');
                        $phone_temp_real = $redis->sDiff('phone_temp','phone');
                        foreach ($phone_temp_real as $l){
                            $redis->sAdd('phone_updata',$l);
                        }
                        //有效号码数
                        $data['successyes'] = count($phone_temp_real);
                        //跟数据库号码重复数
                        $data['rephone'] = $no_rep - $data['successyes'];
                        //检测时间
                        $time_end = microtime(true);
                        $data['time'] = $time_end - $time_start;
                        $redis->del('phone_temp');
                        if($phone_temp_real){
                            $this->ajaxReturn(['statu' => 200, 'msg' => $data,'tip'=>'检测完成']);
                        }else{
                            if($data['rephone'] == $data['totle']){
                                $this->ajaxReturn(['statu' => 202, 'msg' => $data,'tip'=>'号码全部重复，请上传新资源']);
                            }
                            $this->ajaxReturn(['statu' => 202, 'msg' => $data,'tip'=>'没有符合条件的号码']);
                        }
                }
                //上传
                if($_POST['bhv'] == 'upload'){
                    //获取执行时间
                    $time_start = microtime(true);
                    //实例化redis
                    $redis = new \Redis;
                    $redis->connect(C('REDIS_HOST'),C('REDIS_PORT'));
                    //密码
                    $redis->auth('storm');
                    $phone_temp_info = $redis->sMembers('phone_updata');
                    $time = time();
                    $k=0;
                    foreach ($phone_temp_info as $v){
                        $redis->sAdd('phone',$v);
                        $list['phone'] = $v;
                        $list['create_time'] = $time;
                        $list_p[] = $list;
                        $k++;
                    }
                    $c = count($list_p);
                    for($i = 0;$i<$c;$i=$i+10000){
                        $info = array_slice($list_p,$i,10000);
                        $res = $phone->addAll($info);
                    }

                    if($res){
                        $redis->del('phone_updata');
                        $this->ajaxReturn(['statu' => 200, 'msg' => $k,'tip'=>'成功上传']);
                    }else{
                        $this->ajaxReturn(['statu' => 202, 'tip'=>'没有数据被上传']);
                    }

                }
            }
        }else{
            $this->display();
        }
    }

    /**
     * 2019/1/4
     * 15:14
     * anthor liu
     * 号码列表
     */
    Public function phone(){
        $phone = M('Phone');
        $map = 1;
        if($_GET['day']){
            $map = $this->where_map($_GET['day']);
        }
        $count = $phone->where($map)->count();//满足条件的数量
        $page  = new \Think\Page($count, 50);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $list = $phone->where($map)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        $admin = M('Admin')->field('id,nickname')->select();
        foreach ($list as $v){
            if($v['uid'] != 0){
                foreach ($admin as $vv){
                    if($v['uid'] == $vv['id']){
                        $v['nickname'] = $vv['nickname'];
                    }
                }
            }
            $v['weixin'] = $v['weixin'] == 1 ? '未使用' : '已使用';
            $list_r[] = $v;
        }

        //页面统计
        $avg = [];
        //今天
        $today['use_time'] = $this->today();
        $avg['today'] = $phone->where($today)->count();
        //昨天
        $yestoday['use_time'] = $this->yestoday();
        $avg['yestoday'] = $phone->where($yestoday)->count();
        //本月
        $month['use_time'] = $this->month();
        $avg['month'] = $phone->where($month)->count();
        //上月
        $lastmonth['use_time'] = $this->lastmonth();
        $avg['lastmonth'] = $phone->where($lastmonth)->count();
        //总计
        $avg['totle'] = $count;
        //已使用
        $avg['use'] = $phone->where(['weixin'=>2])->count();
        //未使用
        $avg['unused'] = $avg['totle'] - $avg['use'];


        //权限按钮
        $role = M('Role')->where(['id'=>$_SESSION['roleid']])->find();
        $role_ac = $role['role_auth_ac'];
        $action_name = get_action_name($role_ac);
        $this->assign([
            'list'=> $list_r,
            'count'=> $count,
            'avg'=> $avg,
            'page'=> $show,
            'firstRow'=> $page->firstRow,
            'role_ac'=> $role_ac,
            'action_name'=>$action_name
        ]);
        $this->display();
    }

    /**
     * 2019/1/4
     * 17:07
     * anthor liu
     * 删除资源
     */
    Public function del(){
        $id = $_POST['id'];
        $res = M('Phone')->where(['id'=>$id])->delete();
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '成功删除']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "删除出错"]);
        }
    }

    /**
     * 2019/1/5
     * 10:09
     * anthor liu
     * 资源检测 in_array() 5万---1万  16秒
     */
    Public  function detection(){
        if(IS_POST){
            set_time_limit(300);
            $phone = M('Phone');
            if($_POST['type'] == 'txt'){
                //检测
                if($_POST['bhv'] == 'delection'){
                    $file = $_FILES['file'];
                    if($file['error'] == 1){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '上传的文件超过了 php.ini 中 upload_max_filesize选项限制的值']);
                    }else if($file['error'] == 2){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值']);
                    }else if($file['error'] == 3){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '文件只有部分被上传']);
                    }else if($file['error'] == 4){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '没有文件被上传']);
                    }else if($file['error'] == 6){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '找不到临时文件夹']);
                    }else if($file['error'] == 7){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '文件写入失败']);
                    }
                    $content = file_get_contents($file['tmp_name']);
                    $phones = explode(PHP_EOL,$content);
                    $phone_numbers = $phone->field('phone')->select();
                    foreach ($phone_numbers as $p){
                        $phone_number[] = $p['phone'];
                    }

                    //自身重复
                    $data['totle'] = count($phones);
                    $phones = array_unique($phones);
                    $data['chong'] = $data['totle'] - count($phones);

                    $data['no'] = $data['rephone'] =0;
                    $time_start = microtime(true);
                    //array_intersect
                    //array_unique()和array_flip();
                    foreach ($phones as $v){
                        if(!is_numeric($v) || strlen($v) != 11){
                            $data['no'] ++;
                            unset($v);
                        }else{
                            if(in_array($v,$phone_number,true)){
                                $data['rephone'] ++;
                                unset($v);
                            }else{
                                $vv['phone'] = $v;
                                $list[] = $vv;
                            }
                        }
                    }
                    $time_end = microtime(true);
                    $data['time'] = $time_end - $time_start;
                    $data['successyes'] = count($list);

                    if($data['rephone'] == $data['totle']){
                        $this->ajaxReturn(['statu' => 202, 'msg' => $data,'tip'=>'号码全部重复，请上传新资源']);
                    }
                    $this->ajaxReturn(['statu' => 200, 'msg' => $data,'tip'=>'检测完成']);

                }

            }
        }else{
            $this->display();
        }
    }
    //find  5万---1万   38秒
    Public  function detection1(){
        if(IS_POST){
            set_time_limit(300);
            $phone = M('Phone');
            if($_POST['type'] == 'txt'){
                //检测
                if($_POST['bhv'] == 'delection'){
                    $file = $_FILES['file'];
                    if($file['error'] == 1){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '上传的文件超过了 php.ini 中 upload_max_filesize选项限制的值']);
                    }else if($file['error'] == 2){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值']);
                    }else if($file['error'] == 3){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '文件只有部分被上传']);
                    }else if($file['error'] == 4){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '没有文件被上传']);
                    }else if($file['error'] == 6){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '找不到临时文件夹']);
                    }else if($file['error'] == 7){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '文件写入失败']);
                    }
                    $content = file_get_contents($file['tmp_name']);
                    $phones = explode(PHP_EOL,$content);
//                    $phone_numbers = $phone->field('phone')->select();
//                    foreach ($phone_numbers as $p){
//                        $phone_number[] = $p['phone'];
//                    }
                    $data['totle'] = count($phones);

                    $data['no'] = $data['rephone'] =0;
                    $time_start = microtime(true);
                    $j = 0;
                    foreach ($phones as $v){
                        if(!is_numeric($v) || strlen($v) != 11){
                            $data['no'] ++;
                            unset($v);
                        }else{
                            $p = $phone->where(['phone'=>$v])->find();
                            if($p){
                                $data['rephone'] ++;
                                unset($v);
                            }else{
                                $vv['phone'] = $v;
                                $list[] = $vv;
                            }
                        }
                    }

                    //array_intersect
                    //array_unique()和array_flip();
//                    foreach ($phones as $v){
//                        if(!is_numeric($v) || strlen($v) != 11){
//                            $data['no'] ++;
//                            unset($v);
//                        }else{
//                            if(in_array($v,$phone_number,true)){
//                                $data['rephone'] ++;
//                                unset($v);
//                            }else{
//                                $vv['phone'] = $v;
//                                $list[] = $vv;
//                            }
//                        }
//                    }
                    $time_end = microtime(true);
                    $data['time'] = $time_end - $time_start;
                    $data['successyes'] = count($list);

                    if($data['rephone'] == $data['totle']){
                        $this->ajaxReturn(['statu' => 202, 'msg' => $data,'tip'=>'号码全部重复，请上传新资源']);
                    }
                    $this->ajaxReturn(['statu' => 200, 'msg' => $data,'tip'=>'检测完成']);

                }

            }
        }else{
            $this->display();
        }
    }
    //saveall  5万---1万  ---
    Public  function detection2(){
        if(IS_POST){
            set_time_limit(300);
            $phone = M('Phone');
            if($_POST['type'] == 'txt'){
                //检测
                if($_POST['bhv'] == 'delection'){
                    $file = $_FILES['file'];
                    if($file['error'] == 1){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '上传的文件超过了 php.ini 中 upload_max_filesize选项限制的值']);
                    }else if($file['error'] == 2){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值']);
                    }else if($file['error'] == 3){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '文件只有部分被上传']);
                    }else if($file['error'] == 4){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '没有文件被上传']);
                    }else if($file['error'] == 6){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '找不到临时文件夹']);
                    }else if($file['error'] == 7){
                        $this->ajaxReturn(['statu' => 202, 'msg' => '文件写入失败']);
                    }
                    $time_start = microtime(true);
                    $content = file_get_contents($file['tmp_name']);
                    $phones = explode(PHP_EOL,$content);
                    $phone_numbers = $phone->field('phone')->select();
                    foreach ($phone_numbers as $p){
                        $phone_number[] = $p['phone'];
                    }
                    $data['totle'] = count($phones);
                    $phones = array_unique($phones);
                    $data['chong'] = $data['totle'] - count($phones);

                    $data['no'] = $data['rephone'] =0;

                    //array_intersect
                    //array_unique()和array_flip();

                    foreach ($phones as $v){
                        if(!is_numeric($v) || strlen($v) != 11){
                            $data['no'] ++;
                            unset($v);
                        }else{
                            $vv['phone'] = $v;
                            $list[] = $vv;
                            if(in_array($v,$phone_number,true)){
                                $data['rephone'] ++;
                                unset($v);
                            }else{
                                $vv['phone'] = $v;
                                $list[] = $vv;
                            }
                        }
                    }
                    $time_end = microtime(true);
                    $data['time'] = $time_end - $time_start;
                    $data['successyes'] = count($list);

                    if($data['rephone'] == $data['totle']){
                        $this->ajaxReturn(['statu' => 202, 'msg' => $data,'tip'=>'号码全部重复，请上传新资源']);
                    }
                    $this->ajaxReturn(['statu' => 200, 'msg' => $data,'tip'=>'检测完成']);

                }

            }
        }else{
            $this->display();
        }
    }
    //redis
    Public  function detection_redis(){
        if(IS_POST){
            set_time_limit(3600);
            $phone = M('Phone');
            if($_POST['type'] == 'txt'){
                //检测
                if($_POST['bhv'] == 'delection'){
                    $file = $_FILES['file'];
                    if($file['error'] == 1){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '上传的文件超过了 php.ini 中 upload_max_filesize选项限制的值']);
                    }else if($file['error'] == 2){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值']);
                    }else if($file['error'] == 3){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '文件只有部分被上传']);
                    }else if($file['error'] == 4){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '没有文件被上传']);
                    }else if($file['error'] == 6){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '找不到临时文件夹']);
                    }else if($file['error'] == 7){
                        $this->ajaxReturn(['statu' => 202, 'tip' => '文件写入失败']);
                    }
                    //获取执行时间
                    $time_start = microtime(true);
                    //实例化redis
                    $redis = new \Redis;
                    $redis->connect(C('REDIS_HOST'),C('REDIS_PORT'));
                    //密码
                    $redis->auth('storm');
                    //获取数据库总数totle
                    $phone_numbers = $phone->count();
                    //如果数据库没有数据，那么建立一个空的phone键
                    //如果redis中不存在phone键，建立一个空的phone键
                    //如果数据库不为空，phone存在，数据库电话数与redis中不相等，删除redis中所有，把数据库中加入redis
                    //如果数据库不为空，phone存在，数据库中电话和redis中相等，那么跳过此步骤
                    if($phone_numbers){
                        if($redis->exists('phone')){
                            //redis中元素数
                            $redis_count = $redis->sCard('phone');
                            //要是不相等，删除redis中数据取数据库所有数据到 redis
                            if($phone_numbers != $redis_count){
                                if($redis->del('phone')){
                                    //数据库所有数据
                                    $phones = $phone->field('phone')->select();
                                    foreach ($phones as $s){
                                        $redis->sadd('phone',$s['phone']);
                                    }
                                }
                            }
                        }else{
                            $redis->sAdd('phone','');
                        }
                    }else{
                        $redis->sAdd('phone','');
                    }

                    //获取TXT内容
                    $content = file_get_contents($file['tmp_name']);
                    $phones_temp = explode(PHP_EOL,$content);

                    //上传文档中总数
                    $data['totle'] = count($phones_temp);

                    $data['no'] = $data['rephone'] =0;
                    $redis->del('phone_temp');
                    foreach ($phones_temp as $temp){
                        if(!is_numeric($temp) || strlen($temp) != 11){
                            $data['no'] ++;
                            unset($temp);
                        }else{
                            //将纯数字 11 位电话号码插入 redis
                            $redis->sAdd('phone_temp',$temp);
                        }
                    }

                    //插入redis中的号码数
                    $no_rep = $redis->sCard('phone_temp');
                    //自身重复
                    $data['chong']  = $data['totle'] - $data['no'] - $no_rep;
                    //新的上传号码
                    $phone_temp_real = $redis->sDiff('phone_temp','phone');
                    //有效号码数
                    $data['successyes'] = count($phone_temp_real);
                    //跟数据库号码重复数
                    $data['rephone'] = $no_rep - $data['successyes'];
                    //检测时间
                    $time_end = microtime(true);
                    $data['time'] = $time_end - $time_start;
                    $redis->del('phone_temp');
                    if($data['rephone'] == $data['totle']){
                        $this->ajaxReturn(['statu' => 202, 'msg' => $data,'tip'=>'号码全部重复，请上传新资源']);
                    }
                    $this->ajaxReturn(['statu' => 200, 'msg' => $data,'tip'=>'检测完成']);
                }
            }
        }else{
            $this->display();
        }
    }

    public function redis(){
        echo '<pre>';
        $redis = new \Redis;
        $redis->connect(C('REDIS_HOST'),C('REDIS_PORT'));
        //密码
        $redis->auth('storm');
        $phone_temp_info = $redis->sMembers('phone_temp');
//        $arr = ['123',123,234,345];
//        $arr1 = ['123',123,234,345,55,6,4,8,2,2,5,5,1,6666666,5];
//        $redis->sDiff()
//        $redis->sAdd('rrr',$arr);
//        foreach ($arr as $k){
//            $redis->sAdd('rrr',$k);
//        }
//        print_r($redis->sCard('rrr'));
//        $time = time();
//        $k=0;
//        foreach ($phone_temp_info as $v){
//            $v['create_time'] = $time;
//            $list_p[] = $v;
//            $k++;
//        }
//        foreach ($b as $vv){
//            $c['phone'] = $vv;
//            $c['create_time'] = $time;
//            $list_pv[] = $c;
//            $k++;
//        }
//
//        print_r($list_pv);
////        print_r($list_p);
//        exit();
//        $c = count($list_pv);
//        for($i = 0;$i<$c;$i=$i+10000){
//            $info = array_slice($list_p,$i,10000);
//            $res = $phone->addAll($info);
//        }
//        print_r($phone_temp_info);
//        $content = file_get_contents('D:\www\oa\Application\Home\Controller\10000.txt');
//        $content10 = file_get_contents('D:\www\oa\Application\Home\Controller\10wan.txt');
//        $phones = explode(PHP_EOL,$content);
//        $phones10 = explode(PHP_EOL,$content10);

//        print_r($phones);
//        echo '<hr>';
//        $phones = implode(',',$phones);
//        echo $phones;
//        echo '<hr>';
//        $redis = new \Redis;
//        $redis->connect(C('REDIS_HOST'),C('REDIS_PORT'));
//        $redis->auth('storm');
////        foreach ($phones as $s){
//            $redis->sadd('phone',$s);
//        }
//        foreach ($phones10 as $ss){
//            $redis->sadd('phone10',$ss);
//        }
//        print_r($redis->sMembers('phone'));
//        print_r($redis->sMembers('phone10'));
//        echo $redis->sCard('phone');
//        echo $redis->sCard('phone10');
//        $a = $redis->sDiff('phone10','phone');
//        print_r($a);
//        echo $redis->sCard($a);
        $redis->flushAll();
//        $redis->sadd('a1','123');
//        $redis->sadd('a1','123');
//        $redis->sadd('a1','456');
//        $redis->sadd('a1','789');
//        $redis->sadd('a2','a');
//        $redis->sadd('a2','s');
//        $redis->sadd('a2','456');
//        $redis->sadd('a3','');
////        var_dump($redis->exists('a3'));
////        var_dump($redis->del('a2'));
//        $a = $redis->sDiff('a2','a1');
        print_r($a);
//echo $redis->sCard('phone');
    }
    /**
     * 2018/12/4
     * 15:22
     * anthor liu
     * 今日数据
     */
    Public function today(){
        //获取今天00:00时间戳
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        //获取今天24:00时间戳
        $todayend = strtotime(date('Y-m-d'.'00:00:00',time()+3600*24));
        //where条件
        $today = ['between',[$todaystart,$todayend]];
        return $today;
    }
    /**
     * 2018/12/4
     * 16:01
     * @return array
     * anthor liu
     * 昨日数据
     */
    Public function yestoday(){
        //获取昨天00:00时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        //获取昨天24:00时间戳
        $endYesterday=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        //统计昨天订单
        $yesterday = ['between',[$beginYesterday,$endYesterday]];
        return $yesterday;
    }
    /**
     * 2018/12/4
     * 16:05
     * anthor liu
     * 本周数据
     */
    Public function weekday(){
        //获取本周00:00时间戳
        $startthisweek=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
        //获取本周23:59时间戳
        $endToday=mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));
        //统计本周订单
        $weekday = ['between',[$startthisweek,$endToday]];
        return $weekday;
    }
    /**
     * 2018/12/4
     * 16:06
     * anthor liu
     * 本月数据
     */
    Public function month(){
        //获取本月00:00时间戳
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        //获取本月23:59时间戳
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        //统计本月注册的订单
        $month = ['between',[$beginThismonth,$endThismonth]];
        return $month;
    }
    /**
     * 2018/12/4
     * 16:06
     * anthor liu
     * 上月数据
     */
    Public function lastmonth(){
        //获取上月00:00时间戳
        $beginlastmonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        //获取上月23:59时间戳
        $endlastmonth=strtotime(date("Y-m-d 23:59:59", strtotime(-date('d').'day')));
        //统计上月订单
        $lastmonth = ['between',[$beginlastmonth,$endlastmonth]];
        return $lastmonth;
    }

    /**
     * @param $word
     * 2019/1/4
     * 16:31
     * anthor liu
     * 条件判断
     */
    Public function where_map($day){
        switch ($day)
        {
            case 'today':
                $where['use_time'] = $this->today();
                break;
            case 'yestoday':
                $where['use_time'] = $this->yestoday();
                break;
            case 'month':
                $where['use_time'] = $this->month();
                break;
            case 'lastmonth':
                $where['use_time'] = $this->lastmonth();
                break;
            case 'use':
                $where['weixin'] = 2;
                break;
            case 'unused':
                $where['weixin'] = 1;
                break;
            default:
        }
        return $where;
    }

}