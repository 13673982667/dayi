<?PHP

session_start();
if (!isset($_SESSION['usernc']) && empty($_SESSION['usernc'])) {
    echo "<script>alert('您未登录!');window.location.href='login.html';</script>";

}else{
    include_once("../common/config.php");
    include_once ("../common/page.php");
    mysqli_set_charset($conn, "utf8");
    $query="select kq_login.id,kq_login.phone,kq_login.addtime,kq_userinfo.uid,kq_userinfo.pic,kq_userinfo.username,kq_userinfo.sex,kq_userinfo.store from kq_login,kq_userinfo where kq_login.id = kq_userinfo.uid;" ;
    //总会员数量
    $total = mysqli_query($conn,$query);

    $result = array();
    while($res = mysqli_fetch_assoc($total)){
        $result[] = $res;
    };
}
//echo "<pre>";
//var_dump($result);
?>

<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../common/css/shop.css" type="text/css" rel="stylesheet" />
<link href="../common/css/Sellerber.css" type="text/css"  rel="stylesheet" />
<link href="../common/css/bkg_ui.css" type="text/css"  rel="stylesheet" />
<link href="../common/font/font-awesome.min.css"  rel="stylesheet" type="text/css" />
<script src="../common/js/jquery-1.9.1.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="../common/js/jquery.cookie.js"></script>
<script src="../common/js/shopFrame.js" type="text/javascript"></script>
<script src="../common/js/Sellerber.js" type="text/javascript"></script>
<script src="../common/js/layer/layer.js" type="text/javascript"></script>
<script src="../common/js/laydate/laydate.js" type="text/javascript"></script>
<title>会员管理</title>
</head>
<!--[if lt IE 9]>
  <script src="../common/js/html5shiv.js"></script>
  <script src="../common/js/respond.min.js"></script>
  <script src="../common/js/css3-mediaqueries.js"  type="text/javascript"></script>
  <![endif]-->
<body>
<div class="margin" id="page_style">
   <div class="operation clearfix">
    <ul class="choice_search">
     <li class="clearfix col-xs-2 col-lg-2 col-ms-3 "><label class="label_name ">会员名称：</label><input name="username" type="text"  class="form-control col-xs-6 col-lg-5"/></li>
      <li class="clearfix col-xs-4 col-lg-5 col-ms-5 "><label class="label_name ">注册时间：</label> 
     <input class="laydate-icon col-xs-4 col-lg-3" id="start" style=" margin-right:10px; height:28px; line-height:28px; float:left">
      <span  style=" float:left; padding:0px 10px; line-height:32px;">至</span>
      <input class="laydate-icon col-xs-4 col-lg-3" id="end" style="height:28px; line-height:28px; float:left"></li>
     <button class="btn button_btn bg-deep-blue " onclick=""  type="button"><i class="fa  fa-search"></i>&nbsp;搜索</button>
    </ul>
    </div>
<div class="bkg_List_style">
 <div class="bkg_List_operation clearfix">
  <ul class="bkg_List_Button_operation">
   <li class="btn btn-danger"><a href="javascrpt:void()" class="btn_add"><em class="bkg_List_icon icon_add"></em>删除用户</a></li>
   <li class="btn bg-deep-blue"><a href="javascrpt:void()" class="btn_add"><em class="bkg_List_icon icon_modify"></em>修改用户</a></li>
   <!--<li class="btn bg-deep-blue"><a href="javascrpt:void()" class="btn_add"><em class="bkg_List_icon icon_delete"></em>添加用户</a></li>-->
   <li class="btn btn-Dark-success"><a href="javascrpt:void()" class="btn_add"><em class="bkg_List_icon icon_close"></em>关闭用户</a></li>
  </ul>
 </div>
 <div class="bkg_List clearfix">
  <table class="table  table_list table_striped table-bordered">
   <thead>
    <tr>
     <th  width="40"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
     <th>用户UID</th>
     <th>昵称</th>
     <th>头像</th>
     <th>电话</th>
     <th>性别</th>

<!--     <th>地址</th>-->
     <th>加入时间</th>
     <th>等级</th>
     <th>状态</th>
    </tr>
   </thead>
   <tbody>
   <?php
   if(!empty($query)){
   foreach($result as $value){
   ?>
    <tr>
     <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
     <td><?php  echo $value['uid']?></td>
     <td><?php  echo $value['username']?></td>
     <td><img src="<?php  echo $value['pic']?>" alt="" style="width: 50px;height: 50px;"></td>
     <td><?php  echo $value['phone']?></td>
     <td><?php  if($value['sex'] == 1){echo "男";}else{echo "女";}?></td>
     <td><?php  echo $value['addtime']?></td>
     <td><?php  echo $value['store']?></td>
     <td>启用</td>
    </tr>
       <?php
   }
   }
   ?>
   </tbody>
  </table>
 </div>
</div>
</div>
</body>
</html>
<script>
/*******滚动条*******/
$("body").niceScroll({  
	cursorcolor:"#888888",  
	cursoropacitymax:1,  
	touchbehavior:false,  
	cursorwidth:"5px",  
	cursorborder:"0",  
	cursorborderradius:"5px"  
});
/******时间设置*******/
  var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
   // min: laydate.now(), //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};
var end = {
    elem: '#end',
    format: 'YYYY-MM-DD',
    //min: laydate.now(),
    max: '2099-06-16',
    istime: true,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，重置开始日的最大日期
    }
};
laydate(start);
laydate(end);
/********************列表操作js******************/
$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
</script>
