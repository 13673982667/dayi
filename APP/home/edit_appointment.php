<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/2/6
 * Time: 13:06
 * order: 修改预约信息
 */

    //获取到当前登录用户的信息，数据库查询已经预约的信息，更换要修改的信息，返回确认成功或者失败
        //1. 预约前一个小时禁止修改
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');

include_once ('../common/config.php');
$uid = isset($_POST['uid']) ? $_POST['uid'] : "";
$user = isset($_POST['username']) ? $_POST['username'] : "";  // 用户的姓名 和 UID
$tim = isset($_POST['tim']) ? $_POST['tim'] : "";  //要修改的日期
$dat = isset($_POST['dat']) ? $_POST['dat'] : "";  //要修改的时间段
$doctor = isset($_POST['doctor']) ? $_POST['doctor'] : ""; //要修改的医生
$disease = isset($_POST['disease']) ? $_POST['disease'] : ""; //要修改的疾病
date_default_timezone_set("PRC");
$dat = date("Y-m-d",time()); //当前日期
$tim = strtotime(date("H:i",time()));//当前时间
$AM1 = strtotime('8:00');
$D1 = strtotime('9:00');
$AM2 = strtotime('9:30');
$D2 = strtotime('10:30');
$PM1 = strtotime('13:00');
$D3 =strtotime('14:00');
$PM2 = strtotime('16:00');
$D4 = strtotime('15:00');
if($user == null){
    mysqli_set_charset($conn,"urf8");
    $usersearch = "select `patient_name` ,`tim`,`dat`,`doctor_id` from kq_appointment where `patient_name` ='{$user}'  and `patient_id`='{$uid}'";
    $query= mysqli_query($conn,$usersearch);
    $info =  mysqli_fetch_assoc($query);
    if($info['patient_name'] == $user){
        if($info['dat'] == $dat){
            if($AM1<$tim && $tim<$D1 || $AM2<$tim && $tim<$D2|| $PM1<$tim && $tim<$D3 || $PM2<$tim && $tim<$D4){
                    echo "当前时间禁止禁止取消预约";
            }else{
                $SQL = "update kq_appointment set `doctor` = '{$doctor}',`tim` = '{$tim}',`dat` = '{$dat}',`disease` = '{$disease}',`doctor_id`='{$info['doctor_id']}' where `patient_name` ='{$user}'  and `patient_id`='{$uid}'";
                mysqli_query($conn,$SQL);
                if(mysqli_affected_rows($conn)>0){
                    echo "更新预约修改成功";
                }else{
                    echo "err";
                };
            }
        }
    }

}else{
    echo "未登录";
}

