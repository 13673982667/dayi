<?PHP
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/29
 * Time: 19:45
 * order:修改医生个人信息
 */
session_start();
header ( "Content-type: text/html; charset=utf-8" );
include_once("../common/config.php");
if (isset($_SESSION['usernc']) && !empty($_SESSION['usernc'])) {
    mysqli_set_charset($conn, "utf8");
    $sql = "select * from kq_doctor where `id` = '{$_SESSION['id']}'";
    $query =  mysqli_query($conn,$sql);
    $res = mysqli_fetch_assoc($query);
}else{
    $echo ="<script>alert('您还没有登录,请登录!');";
    $echo .="window.location.href='../index.html';";
    $echo .="</script>";
    echo $echo;
}

?>

<!DOCTYPE html >
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../common/css/shop.css" type="text/css" rel="stylesheet" />
<link href="../common/css/Sellerber.css" type="text/css"  rel="stylesheet" />
<link href="../common/css/bkg_ui.css" type="text/css"  rel="stylesheet" />
<link href="../common/font/font-awesome.min.css"  rel="stylesheet" type="text/css" />
<script src="../common/js/jquery-1.9.1.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="../common/js/Validform/Validform.min.js"></script>
<script type="text/javascript" src="../common/js/jquery.cookie.js"></script>
<script src="../common/js/shopFrame.js" type="text/javascript"></script>
<script src="../common/js/Sellerber.js" type="text/javascript"></script>
<script src="../common/js/layer/layer.js" type="text/javascript"></script>
    <script src="../common/js/ajaxfileupload.js" type="text/javascript"></script>
<title>添加管理员</title>
</head>
<!--[if lt IE 9]>
  <script src="../common/js/html5shiv.js"></script>
  <script src="../common/js/respond.min.js"></script>
  <script src="../common/js/css3-mediaqueries.js"  type="text/javascript"></script>
  <![endif]-->
<body>
<div class="margin add_administrator" id="page_style">
    <div class="add_style add_administrator_style">
    <div class="title_name">补充医师信息<font size="2px;">(点击图片可以更换头像哦)</font></div>
    <form  id="form-admin-add">
    <ul>

     <li class="clearfix">
     <label class="label_name col-xs-2 col-lg-2"><i>*</i>用户昵称：</label>
     <div class="formControls col-xs-6">
         <div class="formControls col-xs-6">
             <input type="hidden" class="input-text col-xs-12" value="<?php echo $res['id']?>" placeholder="" readonly="readonly" id="user-name" name="ID" datatype="*2-16" nullmsg="用户ID"></div>
     <input type="text" class="input-text col-xs-12" value="<?php echo $res['doc_username']?>" placeholder=""  id="user-name" name="doc_username" datatype="*2-16" nullmsg="用户名不能为空"></div>
    <div class="col-4"> <span class="Validform_checktip"></span></div>
     </li>
     <li class="clearfix">
     <label class="label_name col-xs-2 col-lg-2"><i class="c-red">*</i>真实姓名：</label>
	 <div class="formControls col-xs-6">
	 <input type="text" placeholder="" name="truename" autocomplete="off" value="<?php if($res['truename']){echo $res['truename'];}else{echo "";}?>" class="input-text col-xs-12" datatype="*6-20" nullmsg="密码不能为空">
	</div>
     <div class="col-4"> <span class="Validform_checktip"></span></div>
     </li>
     <li class="clearfix">
      <label class="label_name col-xs-2 col-lg-2"><i class="c-red">*</i>性&nbsp;别：</label>
      <div class="formControls  skin-minimal col-xs-6">
<!--		    <label><input name="sex" type="radio" class="ace" value="2" ><span class="lbl">保密</span></label>&nbsp;&nbsp;-->
            <label><input name="sex" type="radio" class="ace"  value="1"><span class="lbl">男</span></label>&nbsp;&nbsp;
            <label><input name="sex" type="radio" class="ace"  value="0"><span class="lbl">女</span></label>
	  </div>
     </li>
        <li class="clearfix">
            <label class="label_name col-xs-2 col-lg-2"><i class="c-red">*</i>用户头像：</label>
            <div class="formControls col-xs-6">
                <img src="<?php if($res['pic'] !== null){echo $res['pic'];}else{echo "../admin/upload/mm.png";}?>" style="height: 100px;width: 200px;" alt="" id="oldpic" >
                <input type="file" name="file" id="file" style="display: none;"/>
            </div>
            <div class="col-4"> <span class="Validform_checktip"></span></div>
        </li>
     <li class="clearfix">
      <label class="label_name col-xs-2 col-lg-2"><i class="c-red">*</i>手&nbsp;机：</label>
      <div class="formControls col-xs-6">
		<input type="text" class="input-text col-xs-12" value="<?php if($res['iphone'] !== null){echo $res['iphone'];}else{echo "";}?>" placeholder="" id="user-tel" name="iphone" datatype="m" nullmsg="">
	  </div>
	 <div class="col-4"> <span class="Validform_checktip"></span></div>
     </li>
        <li class="clearfix">
            <label class="label_name col-xs-2 col-lg-2"><i class="c-red">*</i>Q&nbsp;Q：</label>
            <div class="formControls col-xs-6">
                <input type="text" class="input-text col-xs-12" value="<?php if($res['QQ'] !== null){echo $res['QQ'];}else{echo "";}?>" placeholder="" id="user-tel" name="QQ" datatype="m" nullmsg="">
            </div>
            <div class="col-4"> <span class="Validform_checktip"></span></div>
        </li>
        <li class="clearfix">
            <label class="label_name col-xs-2 col-lg-2"><i class="c-red">*</i>微&nbsp;信：</label>
            <div class="formControls col-xs-6">
                <input type="text" class="input-text col-xs-12" value="<?php if($res['wechat']){echo $res['wechat'];}else{echo "";}?>" placeholder="" id="user-tel" name="wechat" datatype="m" nullmsg="">
            </div>
            <div class="col-4"> <span class="Validform_checktip"></span></div>
        </li>
     <li class="clearfix">
      <label class="label_name col-xs-2 col-lg-2">邮&nbsp;箱：</label>
      <div class="formControls col-xs-6">
		<input type="text" class="input-text col-xs-12" placeholder="@" name="Email" id="email" value="<?php if($res['Email']){echo $res['Email'];}else{echo "";}?>" datatype="e" nullmsg="请输入邮箱！">
	   </div>
		<div class="col-4"> <span class="Validform_checktip"></span></div>
     </li>
     <li class="clearfix">
			<label class="label_name col-xs-2 col-lg-2"><i class="c-red">*</i>技&nbsp;能：</label>
			<div class="formControls col-xs-6">
				<textarea name="jineng" cols="" rows="" id="jin" class="textarea col-xs-12" placeholder=" "><?php  if($res['jineng']){echo $res['jineng'];}else{echo "";}?></textarea>
<!--				<span class="wordage">剩余字数：<span id="sy" style="color:Red;">100</span>字</span>-->
			</div>
		</li>
         <li class="clearfix">
			<div class="col-xs-2 col-lg-2">&nbsp;</div>
			<div class="col-xs-6">
	  <input class="btn button_btn bg-deep-blue " type="submit" id="Add_Administrator" value="提交补充">
      <input name="reset" type="reset" class="btn button_btn btn-gray" value="取消重置" />
      <a href="javascript:ovid()" onclick="javascript :history.back(-1);" class="btn btn-info button_btn"><i class="fa fa-reply"></i> 返回上一步</a>
			</div>
		</li>
    </ul>
    </form>
    </div>
    <div class="split_line"></div>
    <div class="Notice_style l_f">
      
    </div>
</div>
</body>
</html>
<script>

    $(document).ready(function() {

        $("input[name='truename']").blur(function () {
            var truename = $("input[name='truename']").val();
            var pattern = /[\u4e00-\u9fa5]+/g;
                content = truename.match(pattern);
                console.log(content);
                if(truename == ""){
                    alert("姓名不能为空");
                    return false;
                }
                if ( content == null) {
                    alert("请输入全中文");
                }
                return false;
        });

        $("input[name='sex']").click(function () {
            var sex = $('input:radio:checked').val();
            if(sex == ""){
                    alert('请选择性别');
                return false;
                }

        });

        $("input[name='iphone']").blur(function () {
            var iphone = $("input[name='iphone']").val();
            var pattern = /^[1][3,4,5,7,8][0-9]{9}$/;
                content = pattern.test(iphone);
                console.log(content);
                    if(iphone == ""){
                        alert("手机号码不能为空");
                        return false;
                    }
                    if (content == false) {
                        alert("手机号码不符合规范");
                    }
                    return false;
        });


        $("input[name='Email']").blur(function () {
            var Email = $("input[name='Email']").val();
            var pattern = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
            content = Email.match(pattern);
            console.log(content);
            if (content == null) {
                alert("邮箱不符合规范");
            }
            return false;
        });

        $("#jin").blur(function () {
           var jin = $("#jin").val();

                if(jin == ""){
                    alert("此栏目不能为空");

                }
            return false;
        });

        //更换头像

            $("#oldpic").click(function () {
                $("#file").click();
                $("#file").on("change",function () {
                    if($("#file").val().length>0){
                        ajaxFileUpload();

                    }
                })
            })

        function ajaxFileUpload() {
            $.ajaxFileUpload
            (
                {
                    url: '../admin/edit_doctor_pic.php', //用于文件上传的服务器端请求地址
                    secureuri: false, //一般设置为false
                    fileElementId: 'file', //文件上传空间的id属性  <input type="file" id="file" name="file" />
                    dataType: 'JSON', //返回值类型 一般设置为json
                    success: function (data)  //服务器成功响应处理函数
                    {
                        console.log(data);
                        $("#oldpic").attr("src", data);
                        window.location.reload();
                        // function myrefresh()
                        // {
                        //
                        // }
                        // setTimeout('myrefresh()',1000); //指定1秒刷新一次

                    },
                    error: function (data)//服务器响应失败处理函数
                    {
                        alert('dd');
                    }
                }
            );
            return false;
        }

        $("#Add_Administrator").click(function () {
            var doc_username = $("input[name='doc_username']").val();
            var ID = $("input[name='ID']").val();
            var truename = $("input[name='truename']").val();
            var sex =$('input:radio:checked').val();
            var iphone = $("input[name='iphone']").val();
            var QQ = $("input[name='QQ']").val();
            var wechat = $("input[name='wechat']").val();
            var Email = $("input[name='Email']").val();
            var jin = $("#jin").val();


            $.ajax({
                url:'../admin/edit_doctor.php',
                type:"POST",
                data:{ID:ID,doc:doc_username,truename:truename,sex:sex,iphone:iphone,QQ:QQ,wechat:wechat,Email:Email,jin:jin},
                async:'false',
                dataType:'JSON',
                success:function (date) {
                    console.log(date);
                    if(date.code==3){
                        alert("登录失败");
                        window.location.href="./doctor_login.html";
                    }else if(date.code==2){
                        alert("资料未完整填写");
                    }else if(date.code==1){
                        alert("修改失败");
                    }else if(date.code==0){
                        alert("修改完成");
                        window.location.href="./Personal_info.php";
                    }

                }
            })

        })
    })
</script>
