<?php
namespace Home\Common;
use Think\Controller;
class HomeController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $admin_id = session('userid');
        $admin_name = session('username');
        $nowAC = CONTROLLER_NAME."-".ACTION_NAME;
        if(empty($admin_name)){
            $allow_auth = "Manage-login,Manage-logout,Manage-verifyImg,Manage-verifyCode";
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
            $have_auth = $roleinfo['role_auth_ac'];
            //$allow_auth = "Manage-login,Admin-logout,Index-index,Manage-verifyImg,Manage-verifyCode,System-update_avatar";
            $allow_auth = "Manage-login,Admin-logout,Index-index,System-update_avatar";

            if(strpos($have_auth,$nowAC) == false && strpos($allow_auth,$nowAC) == false && $admin_name != 'admin'){
//                $js = <<<EOF
//                    <script>
//                        layer.alert('没有访问权限,请联系管理员', {icon: 2},function () {
//                                  return false;
//                        });
//                    </script>
//EOF;
//                echo $js;
                echo  "没有访问权限,请联系管理员";
                return false;
                $this->ajaxReturn(array('statu' => 202, 'msg' => "没有访问权限,请联系管理员"));
            }
        }
    }
}