<?php
namespace Home\Controller;
use Home\Common\HomeController;

class GoodsController extends HomeController {

    /**
     * 2018/11/23
     * 9:27
     * anthor liu
     * 商品列表
     */
    Public function index(){
        $where['goodsdelete'] = 1;
        if($_SESSION['username'] != 'admin') $where['status'] = 1;
        if($_GET['stat_date'] and !$_GET['stop_date']) $where['create_time'] = ['egt',strtotime($_GET['stat_date'])];
        if(!$_GET['stat_date'] and $_GET['stop_date']) $where['create_time'] = ['elt',strtotime($_GET['stop_date'])];
        if($_GET['stat_date'] and $_GET['stop_date']) $where['create_time'] = ['between',[strtotime($_GET['stat_date']),strtotime($_GET['stop_date'])]];
        if($_POST['word']){
            $word = '%'.trim($_POST['word']).'%';
            $where['goodsname|goodsprice|goodsstock|goodscount'] =array('like',$word);
        }
        $goods = D('Goods');
        $count = $goods->where($where)->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $list = $goods->where($where)->order('goodsid desc')->limit($page->firstRow . ',' . $page->listRows)->select();

        $goods_pic = M('goods_pic');
        foreach ($list as $v) {
            $where['picid'] = ['in',$v["goods_pic_id"]];
            if($v["goods_pic_id"] != '') $v['goods_pic'] = $goods_pic->where($where)->select();
            $list_r[]     = $v;
        }
        //权限按钮
        $role = M('Role')->where(['id'=>$_SESSION['roleid']])->find();
        $role_ac = $role['role_auth_ac'];
        $action_name = get_action_name($role_ac);
        //获取统计数据
        $statistical = $goods->statistical();
        $this->assign([
            'statistical'=> $statistical,
            'list'=> $list_r,
            'count'=> $count,
            'page'=> $show,
            'firstRow'=> $page->firstRow,
            'role_ac'=> $role_ac,
            'action_name'=>$action_name
        ]);
        $this->display();
    }

    /**
     * 2018/11/23
     * 11:12
     * anthor liu
     * 添加商品
     */
    public function add()
    {
        if (IS_POST) {
            $goods = D('Goods');
            $data = $_POST;
            foreach ($data as $k=>$v){
                $str = substr($k,0,12);
                if($str == 'goods_pic_id'){
                    $data['goods_pic_id'][] = $v;
                }
            }
            $data['goods_pic_id'] = implode(',',$data['goods_pic_id']);
            $data['create_time'] = time();
            if ($goods->add($data)) {
                $this->ajaxReturn(['statu' => 200, 'msg' => '添加成功']);
            } else {
                $this->ajaxReturn(['statu' => 202, 'msg' => '添加失败']);
            }
        } else {
            $this->display();
        }
    }

    /**
     * 2018/11/23
     * 10:23
     * anthor liu
     * 下架商品
     */
    public function stop()
    {
        $id = $_POST['id'];
        $downtime = time();
        $res = M('Goods')->save(['goodsid' => $id,'downtime'=>$downtime,'status'=>0]);
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '已下架']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "下架出错，请重试"]);
        }
    }

    /**
     * 2018/11/23
     * 10:24
     * anthor liu
     * 上架商品
     */
    public function start()
    {
        $id = $_POST['id'];
        $saletime = time();
        $res = M('Goods')->save(['goodsid' => $id,'saletime'=>$saletime,'status'=>1]);
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '已上架']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "上架出错，请重试"]);
        }
    }

    /**
     * 2018/11/23
     * 10:41
     * anthor liu
     * 上传商品图片
     */
    public function up_goods_img() {
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
                $brandInfo['goodsimg'] = "/Public/Uploads/" . $info['file']['savepath'] . $info['file']['savename'];
                $brandInfo['goodsthums'] = "/Public/Uploads/" . $info['file']['savepath'] . $fileName . '_s.' . $ext;
                $brandInfo['create_time'] = time();
                $url = "/Public/Uploads/" . $info['file']['savepath'] . $fileName . '_s.' . $ext;
            }else{
                $this->ajaxReturn(array('statu'=>202,'msg'=>"图片过大，请重新上传"));
            }

            $res = M('Goods_pic')->add( $brandInfo );
            if( $res !== false ) {
                $this->ajaxReturn(array('statu'=>200,'msg'=>"商品图片上传成功",'url'=>$url,'pic_id'=>$res));
            }else {
                $this->ajaxReturn(array('statu'=>202,'msg'=>'商品图片上传失败'));
            }
        }else {
            $this->ajaxReturn(array('statu'=>202,'msg'=>'商品图片上传错误'));
        }
    }

    /**
     * 2018/12/6
     * 10:33
     * anthor liu
     * 删除商品图片
     */
    Public function delpic(){
        $picid = $_POST['picid'];
        $goods_pic = M('Goods_pic')->where(['picid'=>$picid])->find();
        $delgoodsimg = unlink($_SERVER["DOCUMENT_ROOT"].$goods_pic['goodsimg']);
        $delgoodsthums = unlink($_SERVER["DOCUMENT_ROOT"].$goods_pic['goodsthums']);
        if($delgoodsimg and $delgoodsthums){
            $goods_del = M('Goods_pic')->where(['picid'=>$picid])->delete();
            if($goods_del){
                $this->ajaxReturn(array('statu'=>200,'msg'=>'删除成功'));
            }else{
                $this->ajaxReturn(array('statu'=>202,'msg'=>'数据删除出错'));
            }
        }else{
            $this->ajaxReturn(array('statu'=>202,'msg'=>'图片删除出错'));
        }
    }

    /**
     * 2018/12/6
     * 14:18
     * anthor liu
     * 编辑商品
     */
    Public function edit(){
        $goods = M('Goods');
        if(IS_POST){
            $data = $_POST;
            foreach ($data as $k=>$v){
                $str = substr($k,0,12);
                if($str == 'goods_pic_id'){
                    $data['goods_pic_id'][] = $v;
                }
            }
            $data['goods_pic_id'] = implode(',',$data['goods_pic_id']);
            $data['create_time'] = time();
            if ($goods->save($data)) {
                $this->ajaxReturn(['statu' => 200, 'msg' => '保存成功']);
            } else {
                $this->ajaxReturn(['statu' => 202, 'msg' => '保存失败']);
            }
        }else{
            $goodsid = $_GET['id'];
            $info = $goods->where(['goodsid'=>$goodsid])->find();
            $goods_pic = M('goods_pic');
            $where['picid'] = ['in',$info["goods_pic_id"]];
            $info['goods_pic'] = $goods_pic->where($where)->select();
            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 2018/12/6
     * 16:02
     * anthor liu
     * 删除商品
     */
    Public function del(){
        $goodsid = $_POST['goodsid'];
        $res = M('Goods')->save(['goodsid' => $goodsid,'goodsdelete'=>0]);
        if ($res) {
            $this->ajaxReturn(['statu' => 200, 'msg' => '成功删除']);
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "删除出错"]);
        }
    }
}