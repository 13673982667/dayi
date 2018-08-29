<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7
 * Time: 14:00
 *
 *
 */

/**
 * Created by PhpStorm.
 * User: DreamBoy
 * Date: 2016/4/8
 * Time: 20:29
 * order: 修改用户信息
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once '../common/config.php';
include_once '../common/response.php';
include_once '../common/upload.func.php';
include_once './userinfo.php';

$B = json_decode(file_get_contents('userinfo.php'), TRUE); //引入代码文件
$uid = isset($_POST['uId']) ? $_POST['uId'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$sex = isset($_POST['sex']) ? $_POST['sex'] : '';
$pic = trim(isset($_POST['image']) ? $_POST['image'] : '');
$up_dir = './MyFiles/';
if (!file_exists($up_dir)) {
	mkdir($up_dir, 0777);
}
if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $pic, $result)) {

	$type = $result[2];
	if (in_array($type, array('jpeg', 'png', 'gif', 'bmp', 'png'))) {
		$new_file = $up_dir . date('YmdHis') . '.' . $type;
		if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $pic)))) {
			$img_path = str_replace('../../..', '', $new_file);
			$path = substr($img_path, 1);
			$newPath = 'http://' . $_SERVER['HTTP_HOST'] . '/APP/home' . $path;
			mysqli_set_charset($conn, "utf8");
			mysqli_set_charset($conn, "utf8");
			mysqli_query($conn, "update kq_users set nickname = '{$name}', sex = '{$sex}',pic='{$newPath}' where uid = '{$uid}' ");
			$rows = mysqli_affected_rows($conn);
			if ($rows > 0) {
				$code = 0;
				$message = "edit success！";
				$editinfo = array('username' => $end['username'], 'sex' => $end['sex'], 'pic' => $end['pic']);
				response::user($code, $message, $editinfo);
			} else {
				$code = 1;
				$message = "edit filed！";
				$editinfo = array('');
				response::user($code, $message, $editinfo);
			}
			// mysqli_query($conn, "update kq_userinfo set username = '{$name}', sex = '{$sex}',pic='{$newPath}' where uid = '{$B['id']}' ");
			// $rows = mysqli_affected_rows($conn);

			// if ($rows > 0) {
			// 	$sqlinfo = "select username,sex,uid,pic from kq_userinfo where uid = '{$B['id']}'";
			// 	$newname = mysqli_query($conn, $sqlinfo);
			// 	$end = mysqli_fetch_array($newname);

			// 	$arr = array('id' => $end['uid'], 'uid' => $end['uid'], 'username' => $end['username'], 'sex' => $end['sex'], 'pic' => $end['pic']);

			// 	$info = file_put_contents('userinfo.php', json_encode($arr), TRUE);

			// 	$code = 0;
			// 	$message = "edit success！";
			// 	$editinfo = array('username' => $end['username'], 'sex' => $end['sex'], 'pic' => $end['pic']);
			// 	response::user($code, $message, $editinfo);

			// } else {
			// 	$code = 1;
			// 	$message = "edit filed！";
			// 	$editinfo = array('');
			// 	response::user($code, $message, $editinfo);
			// }

		} else {
			echo '新文件保存失败';
		}
	}
}

?>
