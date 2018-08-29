<?php
/**
 * 用户登录操作
 * 请求方式：post
 * 接受参数：
 * @param $username 用户名
 * @param $pwd      加密密码     -- 可逆,同时定义一个加密规则
 * @param $code     状态码
 * return json
 * {"code":int,"message":string,"data":array}
 * 注意事项：
 *
 */

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods:GET,POST");
	include_once ('../common/config.php');
	include_once ('../common/response.php');
	//连接数据库
	if(!$conn){
		echo "mysqli_erron()";
	}
		//验证用户信息
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $pwd   = isset($_POST['password']) ? MD5($_POST['password']) : '';
		if($phone !== null && $pwd !== null)
		{
            mysqli_set_charset($conn, "utf8");
            $login = "select id,phone,password from kq_login where phone = '{$phone}' and password = '{$pwd}'";
            $que  =  mysqli_query($conn,$login);
            $res  =  mysqli_fetch_assoc($que);
            $uid = $res['id'];
            if($res['phone'] == $phone && $res['password'] == $pwd && $uid !== null){
                mysqli_set_charset($conn, "utf8");
                $user = "select uid,pic,sex,username from kq_userinfo where uid = '{$uid}'";
                $que  =  mysqli_query($conn,$user);
                $end  =  mysqli_fetch_assoc($que);
                $data = array(
                    'id' => $res['id'],
                    'uid' => $end['uid'],
                    'username' => $end['username'],
                    'pic' => $end['pic'],
                    'sex' => $end['sex'],
                    'phone' => $res['phone']
                );
                $filename = "userinfo.php";
                if(!file_exists("$filename")){file_put_contents('userinfo.php',json_encode($data),TRUE);};
                if(filesize($filename)!==0){
                    $code = 0;
                    $message = " succ";
                    $userinfo = array('code' => $code, 'message' => 'succ', 'phone' => $res['phone'], 'username' => $end['username']);

                    echo json_encode($userinfo );
                }

            }else  {$message = " 账号或者密码错误";echo  json_encode($message );}
        }

        else  {$message = "请输入用户名和密码";echo  json_encode($message );}


