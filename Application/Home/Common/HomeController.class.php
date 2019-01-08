<?php
namespace Home\Common;
use Think\Controller;
class HomeController extends Controller
{
    function __construct()
    {
        parent::__construct();
        if(session('login_time')){
            $online_time=mktime() - session('login_time');
            if($online_time > 14400){
                session(null);
                $js = <<<eof
                    <script>
                        parent.window.location.href = "/index.php/Home/Manage/login";
                    </script>
eof;
                echo $js;
            }else{
                session('login_time', mktime());
            }
        }
        $admin_id = session('userid');
        $admin_name = session('username');
        $nowAC = CONTROLLER_NAME."-".ACTION_NAME;
        if(empty($admin_name)){
            $allow_auth = "Manage-login,Manage-logout,Manage-verifyImg,Manage-verifyCode,Goods-up_goods_img,Goods-delpic,Material-up_material_img,Material-delpic,Customer-goods_add_card";
            if(strpos($allow_auth,$nowAC) === false && !IS_POST){
                $js = <<<eof
                    <script>
                        window.location.href = "/index.php/Home/Manage/login";
                    </script>
eof;
                echo $js;
            }
        }else{

            $roleinfo = M('Admin')
                ->alias('m')
                ->join('__ROLE__ as r on m.role_id = r.id')
                ->field('role_auth_ac')
                ->where(array('m.id'=>$admin_id))
                ->find();
            $have_auth = 'admin'.$roleinfo['role_auth_ac'];
            //$allow_auth = "Manage-login,Admin-logout,Index-index,Manage-verifyImg,Manage-verifyCode,System-update_avatar";
            $allow_auth = "Manage-login,Admin-logout,Index-index,System-update_avatar,Goods-up_goods_img,Goods-delpic,Material-up_material_img,Material-type_add,Material-delpic,System-update_avatar,Customer-goods_add_card,Index-storm";

            if(strpos($have_auth,$nowAC) == false && strpos($allow_auth,$nowAC) == false && $admin_name != 'admin'){
                echo  "没有访问权限,请联系管理员";
                return false;
//                $this->ajaxReturn(array('statu' => 202, 'msg' => "没有访问权限2,请联系管理员"));
            }
        }
    }
}