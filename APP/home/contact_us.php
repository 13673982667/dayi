<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/11/29
 * Time: 14:17
 * order:联系我们页面
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once '../common/config.php';
include_once '../common/response.php';

if (!$conn) {
	echo "mysqli_erron()";
}
$icon = isset($_POST['icon']) ? $_POST['icon'] : '';
if ($icon != '') {
	mysqli_set_charset($conn, "utf8");
	$sql = "select address,WeChat,QRcode,telephone,storename from kq_contact_us";
	$query = mysqli_query($conn, $sql);
	$data = array();
	while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$data[] = $result;
	}
	;

	$code = 1;
	$message = " succ";
	Response::user($code, $message, $data);
}
