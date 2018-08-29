<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/2/2
 * Time: 21:59
 * order:实现预约功能
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once ('../common/config.php');

$num = isset($_POST['people']) ? $_POST['people'] : "";  //已预约人数
$number = preg_replace('/\D/s', '', $num);  //数字
$doctor = isset($_POST['doctor']) ? $_POST['doctor'] : ""; //医生姓名
$meet = isset($_POST['meet']) ? $_POST['meet'] : "";  //进行预约的日期
$disease = isset($_POST['li']) ? $_POST['li'] : ""; //预约疾病
$icon = isset($_POST['icon']) ? $_POST['icon'] : "";  //进行预约的时间
$patient_name = isset($_POST['truename']) ? $_POST['truename'] : ""; //预约患者姓名
$patient_id = isset($_POST['trueid']) ? $_POST['trueid'] : ""; //预约患者的ID;
date_default_timezone_set("PRC");
$date = date("Y-m-d:H:i:s",time());  //今天

switch ($disease)
{
    case 0:
        $disease = '牙疼';
    break;
    case 1:
        $disease = "洗牙";
        break;
    case 2:
        $disease = "矫正";
        break;
    case 3:
        $disease = "儿童";
        break;
    case 4:
        $disease = "美白";
        break;
    case 5:
        $disease = "修复";
        break;
    case 6:
        $disease = "拔牙";
        break;
    case 7:
        $disease = "补牙";
        break;
    case 8:
        $disease = "种植";
        break;
    case 9:
        $disease = "牙龈出血";
        break;
    default:
        $disease = "到店检查";
}
    mysqli_set_charset($conn,"utf8");
    $sql = "select `id` from kq_doctor where `doc_username` = '{$doctor}'";
    $query=  mysqli_query($conn,$sql);
    $doc =mysqli_fetch_assoc($query); //医生的ID
    $docuid = $doc['id'];
if($doctor && $meet && $icon && $patient_name !== null){
        //查询客户是否已经预约过了,
        $secrch = "select `id`,`dat`,`tim`,`doctor`,`disease` from kq_appointment where `patient_name` = '{$patient_name}' and `status` = 1";
        $query= mysqli_query($conn,$secrch);
        $res = mysqli_fetch_assoc($query);
        //结果为空说明未曾预约
    if($res == null){
        mysqli_set_charset($conn,"utf8");
        $sql = "insert into kq_appointment (`dat`,`tim`,`doctor`,`disease`,`patient_name`,`patient_id`,`doctor_id`,`addtime`) VALUE ('{$meet}','{$icon}','{$doctor}','{$disease}','{$patient_name}','{$patient_id}','{$docuid}','{$date}')";
        mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn)>0){
            $date1 = date("Y-m-d",strtotime("+1 day"));  //预约第一天
            $date2 = date("Y-m-d",strtotime("+2 day"));  //预约第二天
            $date3 = date("Y-m-d",strtotime("+3 day"));  //预约第三天
            $date4 = date("Y-m-d",strtotime("+4 day"));  //预约第四天
            $date5 = date("Y-m-d",strtotime("+5 day"));  //预约第五天
            switch ($meet)
            {
                case $date1:
                    $uid=1;
                    break;
                case $date2:
                    $uid=2;
                    break;
                case$date3:
                    $uid=3;
                    break;
                case $date4:
                    $uid=4;
                    break;
                case $date5:
                    $uid=5;
                    break;
            }
            $A=1;
            $BB = $A+$number;
            if($icon == "上午9:30"){

                $sql = " update kq_doctor_time set  `AM1` ='{$BB}' where `doctor` = '{$doctor}' and `uid` = '{$uid}'";
                mysqli_query($conn,$sql);
                if(mysqli_affected_rows($conn)>0){  $code=1;    echo json_encode($code);}//预约成功

            }else if($icon == "上午10:30"){

                $sql = " update kq_doctor_time set  `AM2` ='{$BB}' where `doctor` = '{$doctor}' and `uid` = '{$uid}'";
                mysqli_query($conn,$sql);
                if(mysqli_affected_rows($conn)>0){  $code=1;    echo json_encode($code);}//预约成功

            }else if($icon == "下午2:00"){

                $sql = " update kq_doctor_time set  `PM1` ='{$BB}' where `doctor` = '{$doctor}' and `uid` = '{$uid}'";
                mysqli_query($conn,$sql);
                if(mysqli_affected_rows($conn)>0){  $code=1;    echo json_encode($code);}//预约成功

            }else if($icon == "下午4:00"){

                $sql = " update kq_doctor_time set  `PM2` ='{$BB}' where `doctor` = '{$doctor}' and `uid` = '{$uid}'";
                mysqli_query($conn,$sql);
                if(mysqli_affected_rows($conn)>0){  $code=1;    echo json_encode($code);}//预约成功
            }

        }else{
            $code=0;   //预约失败
            echo json_encode($code);
        };
    }else{
        $code=2;   //预约过了
        echo json_encode($code);
    }

}else{
    $code=33;      // 信息不完整
    echo json_encode($code);
}