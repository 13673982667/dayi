<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/12/11
 * Time: 13:59
 * order: 检测手机号码
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
$pwd = isset($_POST['password']) ? MD5($_POST['password']) : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$uid = isset($_POST['uid']) ? $_POST['uid'] : '';
/*检测手机号码是否是本人*/
$sql = "select `password`,`phone` from kq_users where uid = '{$uid}'";
$query = mysqli_query($conn, $sql);
$res = mysqli_fetch_array($query);

/*检测新手机号码是否注册*/
$sql = "select `phone` from kq_users where phone = '{$phone}'";
$que = mysqli_query($conn, $sql);
$shouji = mysqli_fetch_array($que);
if ($res['password'] === $pwd && $phone !== null && $res['phone'] !== $phone) {

	phone($phone);

} elseif ($res['phone'] == $phone) {
	$code = 1;
	$message = "手机号码未更换";
	$data = array('code' => $code, 'message' => $message);
	echo json_encode($data);
} elseif ($shouji['phone'] !== null) {
	$code = 3;
	$message = "此手机号码已经注册请更换";
	$data = array('code' => $code, 'message' => $message);
	echo json_encode($data);
} elseif ($res['password'] !== $pwd) {
	$code = 4;
	$message = "密码不正确";
	$data = array('code' => $code, 'message' => $message);
	echo json_encode($data);
}

// $codes = isset($_POST['code']) ? md5($_POST['code']) : '';

// if($phone !== '' && $codes !== ''){
//     //更换掉当前用户的手机号  要知道当前用户的uid  和手机号 和新手机号
//     $update = "update kq_login set phone = '{$phone}' where id = {$A['id']},codes = '{$codes}'";
//     $query1 = mysqli_query($conn,$update);
//     $result1 =  mysqli_fetch_array($query1);
//     $code = 0;
//     $message = "edit succ";
//     $data = array();
//     response::user($code,$message,$data);
// }else{
//     $code = 0;
//     $message = "edit field";
//     $data = array();
//     response::user($code,$message,$data);
// }