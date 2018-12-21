<?php
namespace Home\Controller;
use Home\Common\HomeController;

class MaterialController extends HomeController {
    /**
     * 2018/12/19
     * 18:48
     * anthor liu
     * 图片素材
     */
    Public function index(){
        if(isset($_GET['id'])) $where['class_id'] = $_GET['id'];
        if(isset($_GET['type'])) $where['type_id'] = $_GET['type'];
        if(!isset($_GET['type']) and !isset($_GET['id'])) $where = 1;
        $material = M('Material');
        $count = $material->where($where)->count();//满足条件的数量
        $page  = new \Think\Page($count, 24);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $list = $material->where($where)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        $class = M('Class')->select();
        $pic_type = M('Pic_type')->select();

        $this->assign('list', $list);
        $this->assign('class', $class);
        $this->assign('pic_type', $pic_type);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->display();
    }

    /**
     * 2018/12/20
     * 13:35
     * anthor liu
     * 素材管理
     */
    Public function management(){
        if(isset($_GET['id'])){
            $where['m.class_id'] = $_GET['id'];
            $where_c['class_id'] = $_GET['id'];
        }
        if(isset($_GET['type'])){
            $where['m.type_id'] = $_GET['type'];
            $where_c['type_id'] = $_GET['type'];
        }
        if(!isset($_GET['type']) and !isset($_GET['id'])) $where = 1;
        $material = M('Material');
        $count = $material->where($where_c)->count();//满足条件的数量
        $page  = new \Think\Page($count, 25);//实例化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show  = $page->show();//分页显示输出
        $list = $material
            ->alias('m')
            ->field('*,m.id as mid')
            ->join('__CLASS__ as c ON c.id = m.class_id','left')
            ->join('__PIC_TYPE__ as p ON p.id = m.type_id','left')
            ->where($where)
            ->order('m.id desc')
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();
        $class = M('Class')->select();
        $pic_type = M('Pic_type')->select();
        //排名排序
        $i=$page->firstRow + 1;
        foreach ($list as $v){
            $v['sort'] = $i;
            $i++;
            $list_sort[] = $v;
        }

        $this->assign('list', $list_sort);
        $this->assign('class', $class);
        $this->assign('pic_type', $pic_type);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('firstRow', $page->firstRow);
        $this->display();
    }

    /**
     * 2018/12/20
     * 15:34
     * anthor liu
     * 上传素材
     */
    public function add()
    {
        if (IS_POST) {
            $material = D('Material');
            $data = $_POST;
            $data['create_time'] = time();
            foreach ($data as $k=>$v){
                $str = substr($k,0,12);
                if($str == 'goods_pic_id'){
                    $res = $material->where(['id'=>$v])->save($data);
                }
            }
            if ($res) {
                $this->ajaxReturn(['statu' => 200, 'msg' => '添加成功']);
            } else {
                $this->ajaxReturn(['statu' => 202, 'msg' => '添加失败']);
            }
        } else {
            $class = M('Class')->select();
            $pic_type = M('Pic_type')->select();
            $this->assign('class', $class);
            $this->assign('pic_type', $pic_type);
            $this->display();
        }
    }

    /**
     * 2018/12/21
     * 8:50
     * anthor liu
     * 编辑素材
     */
    Public function edit(){
        if(IS_POST){
            $material = D('Material');
            $data = $_POST;
            $data['create_time'] = time();

            $res = $material->save($data);

            if ($res) {
                $this->ajaxReturn(['statu' => 200, 'msg' => '添加成功']);
            } else {
                $this->ajaxReturn(['statu' => 202, 'msg' => '添加失败']);
            }
        }else{
            $id = $_GET['id'];
            $material = M('Material')->where(['id'=>$id])->find();
            $class = M('Class')->select();
            $pic_type = M('Pic_type')->select();
            $this->assign('class', $class);
            $this->assign('pic_type', $pic_type);
            $this->assign('material', $material);
            $this->display();
        }
    }

    /**
     * 2018/12/21
     * 8:49
     * anthor liu
     * 为组新增图片类型
     */
    Public function type_add(){
        $id = $_GET['id'];
        $info = M('Pic_type')->where(['class_id'=>$id])->select();
        $this->ajaxReturn(['statu' => 200, 'msg' => $info]);
    }

    /**
     * 2018/12/20
     * 15:42
     * anthor liu
     * 图片上传
     */
    public function up_material_img() {
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
                $image->thumb( 300, 300 )->save( $imgSmall );
                //保存在数据库中的路径
                $brandInfo['pic_url'] = "/Public/Uploads/" . $info['file']['savepath'] . $info['file']['savename'];
                $brandInfo['pic_thums_url'] = "/Public/Uploads/" . $info['file']['savepath'] . $fileName . '_s.' . $ext;
                $brandInfo['create_time'] = time();
                $url = "/Public/Uploads/" . $info['file']['savepath'] . $fileName . '_s.' . $ext;
            }else{
                $this->ajaxReturn(array('statu'=>202,'msg'=>"图片过大，请重新上传"));
            }

            $res = M('Material')->add( $brandInfo );
            if( $res !== false ) {
                $this->ajaxReturn(array('statu'=>200,'msg'=>"素材图片上传成功",'url'=>$url,'pic_id'=>$res));
            }else {
                $this->ajaxReturn(array('statu'=>202,'msg'=>'素材图片上传失败'));
            }
        }else {
            $this->ajaxReturn(array('statu'=>202,'msg'=>'素材图片上传错误'));
        }
    }

    /**
     * 2018/12/20
     * 15:45
     * anthor liu
     * 删除图片
     */
    Public function delpic(){
        $picid = $_POST['picid'];
        $goods_pic = M('Material')->where(['picid'=>$picid])->find();
        $delgoodsimg = unlink($_SERVER["DOCUMENT_ROOT"].$goods_pic['goodsimg']);
        $delgoodsthums = unlink($_SERVER["DOCUMENT_ROOT"].$goods_pic['goodsthums']);
        if($delgoodsimg and $delgoodsthums){
            $goods_del = M('Material')->where(['id'=>$picid])->delete();
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
     * 2018/12/20
     * 17:09
     * anthor liu
     * 添加组
     */
    Public function add_class(){
        if(IS_POST){
            $data['class_name'] = trim($_POST['class_name']);
            $data['create_time'] = date('Y-m-d',time());
            $class = M('Class')->add($data);
            if($class){
                $this->ajaxReturn(array('statu'=>200,'msg'=>'添加组成功'));
            }else{
                $this->ajaxReturn(array('statu'=>202,'msg'=>'添加组失败，请重试'));
            }
        }else{
            $this->display();
        }
    }

    /**
     * 2018/12/20
     * 17:20
     * anthor liu
     * 添加类型
     */
    Public function add_pic_type(){
        if(IS_POST){
            $data['type'] = trim($_POST['type']);
            $data['class_id'] = $_POST['class_id'];
            $data['create_time'] = time();
            $pic_type = M('Pic_type')->add($data);
            if($pic_type){
                $this->ajaxReturn(array('statu'=>200,'msg'=>'添加类型成功'));
            }else{
                $this->ajaxReturn(array('statu'=>202,'msg'=>'添加类型失败，请重试'));
            }
        }else{
            $class = M('Class')->select();
            $this->assign('class', $class);
            $this->display();
        }
    }

    /**
     * 2018/12/21
     * 9:35
     * anthor liu
     * 删除素材
     */
    Public function del(){
        $id = $_POST['id'];
        $material = M('Material');
        $info = $material->where(['id'=>$id])->find();
        $delpicimg = true;
        $delpicsthums = true;
        if($info['pic_url']) $delpicimg = unlink($_SERVER["DOCUMENT_ROOT"].$info['pic_url']);
        if($info['pic_thums_url']) $delpicsthums = unlink($_SERVER["DOCUMENT_ROOT"].$info['pic_thums_url']);
        if ($delpicimg && $delpicsthums) {
            $res = $material->where(['id'=>$id])->delete();
            if($res){
                $this->ajaxReturn(['statu' => 200, 'msg' => '成功删除']);
            }else{
                $this->ajaxReturn(['statu' => 202, 'msg' => "删除失败,请重试"]);
            }
        } else {
            $this->ajaxReturn(['statu' => 202, 'msg' => "图片删除失败"]);
        }
    }
}