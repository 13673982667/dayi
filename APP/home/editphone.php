<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/12/11
 * Time: 13:59
 * order: 修改手机号码
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once '../common/config.php';
include_once './function.php';
$A = json_decode(file_get_contents('./userinfo.php'), TRUE);

if (!$conn) {
	echo "mysqli_errno()";
}
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$codes = isset($_POST['code']) ? md5($_POST['code']) : '';
$uid = isset($_POST['uid']) ? md5($_POST['uid']) : '';

if ($phone !== '' && $codes !== '') {
	//更换掉当前用户的手机号  要知道当前用户的uid  和手机号 和新手机号
	// $update = "update kq_login set `phone` = '{$phone}',`token`='{$code}' where `id` = {$A['id']}";
	$update = "UPDATE kq_login SET `phone` = '{$phone}'  WHERE `uid` = {$uid} AND `password` = '{$code}' ";
	mysqli_query($conn, $update);
	$rows = mysqli_affected_rows($conn);
	if ($rows > 0) {
		$code = 1;
		$message = "edit succ";
		$data = array('code' => $code, 'message' => $message);
		echo json_encode($data);
	}

} else {
	$code = 0;
	$message = "edit field";
	$data = array('code' => $code, 'message' => $message);
	echo json_encode($data);
}