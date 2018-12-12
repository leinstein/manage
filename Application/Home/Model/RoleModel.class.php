<?php
namespace Home\Model;
use Think\Model;

class RoleModel extends Model{
    /**
     * @param $role_id 角色ID
     * @param $auth_id 权限ID
     * 2018/11/19
     * 9:19
     * 保存到数据表
     * @return bool
     * anthor liu
     */
    function saveAuth($role_id,$auth_id){
        $auth_ids = implode(',',$auth_id);

        $authinfo = D('Auth')->where(
            array(
                'auth_level'=>array('gt',0),
                'auth_id'=>array('in',$auth_ids))
        )->select();

        foreach($authinfo as $k=>$v){
            $s[] = $v['auth_c'].'-'.$v['auth_a'];
        }
        $ac = implode(',',$s);
        $arr = array(
            'id' => $role_id,
            'role_auth_ids' => $auth_ids,
            'role_auth_ac' => $ac
        );
        return $this->save($arr);
    }
}