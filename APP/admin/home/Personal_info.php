<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/29
 * Time: 19:45
 * order:医生个人信息
 */
session_start();
header ( "Content-type: text/html; charset=utf-8" );
include_once("../common/config.php");
if (isset($_SESSION['usernc']) && !empty($_SESSION['usernc'])) {
    mysqli_set_charset($conn, "utf8");
    $sql = "select * from kq_doctor where `id`='{$_SESSION['id']}'";
    $query =  mysqli_query($conn,$sql);
    $res = mysqli_fetch_assoc($query);
}else{
    $echo ="<script>alert('您还没有登录,请登录!');";
    $echo .="window.location.href='../index.html';";
    $echo .="</script>";
    echo $echo;
}
?>
<!DOCTYPE >
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../common/css/shop.css" type="text/css" rel="stylesheet" />
    <link href="../common/css/Sellerber.css" type="text/css"  rel="stylesheet" />
    <link href="../common/css/bkg_ui.css" type="text/css"  rel="stylesheet" />
    <link href="../common/font/css/font-awesome.min.css"  rel="stylesheet" type="text/css" />
    <script src="../common/js/jquery-1.9.1.min.js" type="text/javascript" ></script>
    <script type="text/javascript" src="../common/js/jquery.cookie.js"></script>
    <script src="../common/js/shopFrame.js" type="text/javascript"></script>
    <script src="../common/js/Sellerber.js" type="text/javascript"></script>
    <script src="../common/js/layer/layer.js" type="text/javascript"></script>
    <script src="../common/js/laydate/laydate.js" type="text/javascript"></script>
    <script type="text/javascript" src="../common/js/json2.js"></script>
    <script src="../common/js/jquery.dataTables.min.js"></script>
    <script src="../common/js/jquery.dataTables.bootstrap.js"></script>
    <title>个人信息</title>
</head>
<!--[if lt IE 9]>
<script src="../common/js/html5shiv.js"></script>
<script src="../common/js/respond.min.js"></script>
<script src="../common/js/css3-mediaqueries.js"  type="text/javascript"></script>
<![endif]-->
<body>
<div class="margin" id="page_style">
    <div class="personal_info">
        <div class="add_style clearfix border_style">
            <form id="user_info" action="../common/json/test_user.json" method="post">
                <div class="clearfix">
                    <div class="form-group clearfix col-xs-3">
                        <label class="col-xs-3 label_name" for="form-field-1">用户头像：</label>
                        <div class="col-xs-9 line_height1"><img src="<?php if($res['pic'] !== ""){echo $res['pic'];}else{echo "../admin/upload/mm.png";}?>" style="height: 35px;width: 90px;" alt="" id="oldpic" ></div>
                    </div>
                    <div class="form-group clearfix col-xs-3">
                        <label class="col-xs-3 label_name" for="form-field-1">用户昵称：</label>
                        <div class="col-xs-9 line_height1"><input type="text" name="username" data-name="用户昵称" id="username" value="<?php  echo $res['doc_username']?>" class="col-xs-7 text_info" disabled="disabled"></div>
                    </div>
                    <div class="form-group clearfix col-xs-3">
                        <label class="col-xs-3 label_name" for="form-field-1">真实姓名：</label>
                        <div class="col-xs-9 line_height1"><input type="text" name="surname" data-name="真实姓名" id="surname" value="<?php if($res['truename']){echo $res['truename'];}else{echo "请填写";}?>" class="col-xs-7 text_info" disabled="disabled"></div>
                    </div>
                    <div class="form-group clearfix col-xs-3"><label class="col-xs-3 label_name" for="form-field-1">性别： </label>
                        <div class="col-xs-9 line_height1">
                            <span class="sex"><?php if($res['sex'] ==1){echo "男";}elseif($res['sex']==2){echo "女";}else{echo "保密";}?></span>

                        </div>
                    </div>

                    <div class="form-group clearfix col-xs-3"><label class="col-xs-3 label_name" for="form-field-1">移动电话： </label>
                        <div class="col-xs-9 line_height1"><input type="text" name="phone" data-name="移动电话" id="phone" value="<?php if($res['iphone']){echo $res['iphone'];}else{echo "请填写";}?>" class="col-xs-7 text_info" disabled="disabled"></div>
                    </div>
                    <div class="form-group clearfix col-xs-3"><label class="col-xs-3 label_name" for="form-field-1">电子邮箱： </label>
                        <div class="col-xs-9 line_height1"><input type="text" name="mailbox"  data-name="电子邮箱" id="mailbox" value="<?php if($res['Email']){echo $res['Email'];}else{echo "请填写";}?>" class="col-xs-7 text_info" disabled="disabled"></div>
                    </div>
                    <div class="form-group clearfix col-xs-3"><label class="col-xs-3 label_name" for="form-field-1">QQ： </label>
                        <div class="col-xs-9 line_height1"><input type="text" name="QQ" id="QQ" data-name="QQ"  value="<?php if($res['QQ']){echo $res['QQ'];}else{echo "请填写";}?>" class="col-xs-7 text_info" disabled="disabled"> </div>
                    </div>
                    <div class="form-group clearfix col-xs-3"><label class="col-xs-3 label_name" for="form-field-1">权限： </label>
                        <div class="col-xs-9 line_height1"> <span>普通管理员</span></div>
                    </div>
                    <div class="form-group clearfix col-xs-3"><label class="col-xs-3 label_name" for="form-field-1">注册时间： </label>
                        <div class="col-xs-9 line_height1"> <span><?php echo $res['addtime']?></span></div>
                    </div>
                    <div class="form-group clearfix col-xs-3"><label class="col-xs-3 label_name" for="form-field-1">技能简述： </label>
                        <div class="col-xs-9 line_height1"> <span><?php if($res['jineng']){echo $res['jineng'];}else{echo "请填写";}?></span></div>
                    </div>
                </div>

                <div class="Button_operation clearfix">
                    <a href="add_administrator.php" class="btn button_btn bg-deep-blue" title="补充个人信息"><i class="fa  fa-edit"></i>&nbsp;补充个人信息</a>
                </div>
            </form>
        </div><div id="text_name"></div>
    </div>
</div>


</body>
<script>
    $(document).ready(function() {

        $(function() {
            $("#oldpic").click(function () {
                $("#upload").click(); //隐藏了input:file样式后，点击头像就可以本地上传
                $("#upload").on("change",function(){
                    // var objUrl = getObjectURL(this.files[0]) ; //获取图片的路径，该路径不是图片在本地的路径
                    // if (objUrl) {
                    //      $("#oldpic").attr("src", objUrl) ; //将图片路径存入src中，显示出图片
                    // }
                });
            });
        });

//建立一個可存取到該file的url
        function getObjectURL(file) {
            var url = null ;
            if (window.createObjectURL!=undefined) { // basic
                url = window.createObjectURL(file) ;
            } else if (window.URL!=undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file) ;
            } else if (window.webkitURL!=undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file) ;
            }
            return url ;
        }

        function ajaxFileUpload() {
            $.ajaxFileUpload
            (
                {
                    url: './eq.php', //用于文件上传的服务器端请求地址
                    secureuri: false, //一般设置为false
                    fileElementId: 'file1', //文件上传空间的id属性  <input type="file" id="file" name="file" />
                    dataType: 'JSON', //返回值类型 一般设置为json
                    success: function (data)  //服务器成功响应处理函数
                    {
                        console.log(data);
                        alert(data);
                        $("#img1").attr("src", data);
                        // if (typeof (data.error) != 'undefined') {
                        //     if (data.error != '') {
                        //         alert(data.error);
                        //     } else {
                        //         alert(data.msg);
                        //     }
                        // }
                    },
                    error: function (data)//服务器响应失败处理函数
                    {
                        alert('dd');
                    }
                }
            )
            return false;
        }

        $("#submit").click(function () {
            alert('ss');
            // var pic=$("#oldpic")[0].src;
            // alert(pic);
            // $.ajax({
            //     url:'../admin/touxiang.php',
            //     type:"POST",
            //     data:{pic:pic},
            //     async:'false',
            //     success:function(date){
            //         layer.open({
            //             content: '保存成功!',
            //             skin: 'msg',
            //             time: 2 //2秒后自动关闭
            //         });
            //         return false;
            //     }
            // })
        })


    })
</script>
</html>


