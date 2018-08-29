<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/4
 * Time: 13:10
 * order: 实现查询预约信息功能
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');

include_once '../common/config.php';

$doctorid = isset($_POST['id']) ? $_POST['id'] : "";
$meet = isset($_POST['meet']) ? $_POST['meet'] : ""; //进行预约的日期
mysqli_set_charset($conn, "utf8");
$sql = "select `truename` from kq_doctor where `id`='{$doctorid}' ";
$query = mysqli_query($conn, $sql);
$res = mysqli_fetch_assoc($query);
$people = $res['truename'];
date_default_timezone_set("PRC");
$date = date("Y-m-d", time()); //今天
$date1 = date("Y-m-d", strtotime("+1 day")); //预约第一天
$date2 = date("Y-m-d", strtotime("+2 day")); //预约第二天
$date3 = date("Y-m-d", strtotime("+3 day")); //预约第三天
$date4 = date("Y-m-d", strtotime("+4 day")); //预约第四天
$date5 = date("Y-m-d", strtotime("+5 day")); //预约第五天

switch ($meet) {
case $date1:
	$meet = 1;
	break;
case $date2:
	$meet = 2;
	break;
case $date3:
	$meet = 3;
	break;
case $date4:
	$meet = 4;
	break;
case $date5:
	$meet = 5;
	break;
default:
	echo '666';
}
//那一天的那个医师
if ($meet !== "err") {
	$sql = "select `AM1`,`AM2`,`PM1`,`PM2` from kq_doctor_time where `uid` = '{$meet}' and `doctor` = '{$people}'";
	$query = mysqli_query($conn, $sql);

	$data = mysqli_fetch_assoc($query);

	$AM1 = $data['AM1'];
	$AM2 = $data['AM2'];
	$PM1 = $data['PM1'];
	$PM2 = $data['PM2'];

	$data = array();
	switch ($AM1) {
	case "1":
		array_push($data, '已预约1人');

		break;
	case "2":
		array_push($data, '已预约2人');
		break;
	case "3":
		array_push($data, '约满');
		break;
	default:
		array_push($data, '已预约0人');
	}

	switch ($AM2) {
	case "1":
		array_push($data, '已预约1人');
		break;
	case "2":
		array_push($data, '已预约2人');
		break;
	case "3":
		array_push($data, '约满');
		break;
	default:
		array_push($data, '已预约0人');
	}

	switch ($PM1) {
	case "1":
		array_push($data, '已预约1人');
		break;
	case "2":
		array_push($data, '已预约2人');
		break;
	case "3":
		array_push($data, '约满');
		break;
	default:
		array_push($data, '已预约0人');
	}

	switch ($PM2) {
	case "1":
		array_push($data, '已预约1人');
		break;
	case "2":
		array_push($data, '已预约2人');
		break;
	case "3":
		array_push($data, '约满');
		break;
	default:
		array_push($data, '已预约0人');
	}

	echo json_encode($data);
}