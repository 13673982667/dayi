<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/2/6
 * Time: 14:33
 * order:删除预约信息
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once ('../common/config.php');

    //删除预约信息的时候，判断传入的时间和用户ID，根据时间来删除

$uid = isset($_POST['uid']) ? $_POST['uid'] : "";
$user = isset($_POST['username']) ? $_POST['username'] : "";  // 用户的姓名 和 UID
$tim = isset($_POST['tim']) ? $_POST['tim'] : "";  //要删除的时间段
$dat = isset($_POST['dat']) ? $_POST['dat'] : "";  //要删除的日期

date_default_timezone_set("PRC");
$datt = date("Y-m-d",time()); //当前日期
$timm = strtotime(date("H:i",time()));//当前时间
$AM1 = strtotime('8:00');
$D1 = strtotime('9:00');
$AM2 = strtotime('9:30');
$D2 = strtotime('10:30');
$PM1 = strtotime('13:00');
$D3 =strtotime('14:00');
$PM2 = strtotime('16:00');
$D4 = strtotime('15:00');


   if($AM1<$timm && $timm<$D1 || $AM2<$timm && $timm<$D2|| $PM1<$timm && $timm<$D3 || $PM2<$timm && $timm<$D4){
       //禁止取消预约
       $code = 2;
       echo json_encode($code);
}else{
       if ($uid !== null && $user !== null && $tim !== null && $dat !== null) {
           mysqli_set_charset($conn, "urf8");
           $userdel = "select `patient_name` ,`tim`,`dat`,`doctor_id`,`disease`,`doctor`,`id` from kq_appointment where `patient_name` ='{$user}' and `patient_id`='{$uid}'and `tim`= '{$tim}' and `dat` = '{$dat}'";
           $query = mysqli_query($conn, $userdel);
           $info = mysqli_fetch_assoc($query);
           if ($info['patient_name'] == $user) {
                //删除预约表中的数据
               $SQL = "delete from kq_appointment  where `patient_name` ='{$user}'  and `patient_id`='{$uid}'";
               mysqli_query($conn, $SQL);
               if (mysqli_affected_rows($conn) > 0) {
                   //修改医生表中的数据
                  
                   $code = 1;
                   echo json_encode($code);

               } else {
                   echo "err";
               };
           }

       } else {
           echo "err";

       }
   }




