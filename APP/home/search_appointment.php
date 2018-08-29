<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/2/28
 * Time: 9:53
 * order: 遍历预约信息(待完成)到个人中心
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once ('../common/config.php');
$A = json_decode(file_get_contents('./userinfo.php'),TRUE);

if($A['username'] && $A['id'] !== null){
    //查询客户是否已经预约过了,
    $secrch = "select `id`,`dat`,`tim`,`doctor`,`disease`,`patient_id` from kq_appointment where `patient_name` = '{$A['username']}' and `patient_id` = '{$A['id']}' and `status` = 1";
    $query= mysqli_query($conn,$secrch);
    $res=mysqli_fetch_assoc($query);
    echo json_encode($res);
}else{
    $code = 3;
    echo json_encode($code); //未登录
}

