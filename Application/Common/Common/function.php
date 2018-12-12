<?php
/**
 * 2018/11/17
 * 15:18
 * anthor liu
 * 权限列表
 */

/***********递归方式获取上下级"权限"信息****************/
function generateTree($data){
    $items = array();
    foreach($data as $v){
        $items[$v['auth_id']] = $v;
    }
    $tree = array();
    foreach($items as $k => $item){
        if(isset($items[$item['auth_pid']])){
            $items[$item['auth_pid']]['son'][] = &$items[$k];
        }else{
            $tree[] = &$items[$k];
        }
    }
    return getTreeData($tree);
}

function getTreeData($tree,$level=0){
    static $arr = array();
    foreach($tree as $t){
        $tmp = $t;
        unset($tmp['son']);
        $tmp['level'] = $level;
        $arr[] = $tmp;
        if(isset($t['son'])){
            getTreeData($t['son'],$level+1);
        }
    }
    return $arr;
}

/**
 * @param $number
 * 2018/12/1
 * 10:26
 * 将数字转化为大写
 * @return mixed
 * anthor liu
 */
function number_zi($number){
    $arr = [1=>'一', 2=>'二', 3=>'三', 4=>'四', 5=>'五', 6=>'六', 7=>'七', 8=>'八', 9=>'九', 10=>'十'];
    foreach ($arr as $k=>$v){
        if($k == $number){
            return $v;
        }
    }
}
/**
 * @param      $url
 * @param null $data
 * 2018/12/6
 * 16:48
 * POST请求函数
 * @return mixed
 * anthor liu
 */
function https_request($url,$data = null){
    $curl = curl_init();

    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);

    if(!empty($data)){//如果有数据传入数据
        curl_setopt($curl,CURLOPT_POST,1);//CURLOPT_POST 模拟post请求
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);//传入数据
    }

    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    $output = curl_exec($curl);
    curl_close($curl);

    return $output;
}

/**
 * @param string $ip
 * 2018/12/6
 * 16:49
 * 获取地址信息
 * @return mixed
 * anthor liu
 */
function get_area($ip = ''){
    if($ip == ''){
        $ip = GetIp();
    }
    $url = "http://ip.taobao.com/service/getIpInfo.php?ip={$ip}";
    $ret = https_request($url);
    $arr = json_decode($ret,true);
    return $arr;
}
