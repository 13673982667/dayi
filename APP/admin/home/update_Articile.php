<?php
include_once("../common/config.php");
mysqli_set_charset($conn, "utf8");
$id = $_GET['id'];
$sql = "select * from kq_article where id = '$id'" ;
$query = mysqli_query($conn,$sql);
$data = mysqli_fetch_assoc($query);
$pic = '/APP/admin/'.$data['pic'];
?>


<!DOCTYPE html >
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
    <script type="text/javascript" src="../common/utf8-php/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="../common/utf8-php/ueditor.all.js"></script>
    <script src="../common/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="../common/js/html5shiv.js" type="text/javascript"></script>
    <script src="../common/js/respond.min.js"></script>
    <script src="../common/js/css3-mediaqueries.js"  type="text/javascript"></script>

    <![endif]-->
    <title>修改文章</title>
</head>

<body>
<div class="margin" id="page_style">
    <div class="add_style">
        <ul>
            <form action="../admin/edit-article.php" method="post" enctype="multipart/form-data">
                <li class="clearfix"><label class="label_name col-xs-1"><i></i>&nbsp;&nbsp;</label><div class="Add_content col-xs-11"><input name="id" type="hidden"  value="<?php echo $data['id']?>" class="col-xs-6"/></div>  </li>
                <li class="clearfix"><label class="label_name col-xs-1"><i>*</i>文章标题：&nbsp;&nbsp;</label><div class="Add_content col-xs-11"><input name="title" type="text" value="<?php echo $data['title']?>"  class="col-xs-6"/></div>  </li>
                <li class="clearfix">
                    <label class="label_name col-xs-1"><i>*</i>所属分类：&nbsp;&nbsp;</label>
                    <div class="Add_content col-xs-11">
                        <span class="classification_name l_f"><label ><input type="radio" name="keyword" checked="checked"  value="left"><span class="lbl"><?php  if($data['keyword'] == "mouth"){echo "口腔百科" ;}elseif($data['keyword'] == "teeth"){echo "牙齿美白";}elseif($data['keyword'] == "news"){echo "咨询";} ?></span></label></span>
                </li>
                <li class="clearfix"><label class="label_name col-xs-1"><i>*</i>文章简介：&nbsp;&nbsp;</label><div class="Add_content col-xs-11"><input name="description" type="text" value="<?php echo $data['description']?>" class="col-xs-4"/></div>
                </li>
                <li class="clearfix"><label class="label_name col-xs-1"><i>*</i>原&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;图：&nbsp;&nbsp;</label><div class="Add_content col-xs-11">
                        <img src="<?php  echo $pic;?>" alt="" style="width: 120px; height: 80px;"><input type="hidden" name="file1" value="<?php echo $data['pic']?>"></div>
                </li>
                <li class="clearfix"><label class="label_name col-xs-1"><i>*</i>更换图片：&nbsp;&nbsp;</label><div class="Add_content col-xs-11">  <span class="classification_name l_f"><label ><input type="radio" name="attr"  value="YES" class="ace"><span class="lbl">YES</span></label></span>
                        <span class="classification_name l_f"><label ><input type="radio" name="attr"  value="NO" class="ace"><span class="lbl">NO</span></label></span><input name="file" type="file"  id='hid' class="col-xs-4"/></div>
                </li>

                <li class="clearfix"><label class="label_name col-xs-1"><i>*</i>内&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;容：&nbsp;&nbsp;</label><div class="Add_content col-xs-11"><textarea   id="container" name="content" type="text/plain"  rows="40" cols="120" style="width:1100px;height:240px"><?php echo $data['content']?>
</textarea></div>
                </li>
        </ul>
        <div class="Button_operation btn_width">
            <button class="btn button_btn bg-deep-blue" type="submit">提交修改</button>
            <a href="Article_list.php"><button class="btn button_btn bg-gray" type="button">取消修改</button></a>
        </div>
        </form>
    </div>
</div>
</body>
<script type="text/javascript">
    var ue = UE.getEditor('container');
    setTimeout(function () {
        editor.execCommand('drafts');
    }, 500); //注意一定要延时。要等这玩意载入成功。

    $(function () {
        $("input[name = 'attr']").click(function () {

            ii = $("input[name='attr']:checked").val();
            if(ii == 'NO'){
                $("#hid").attr("disabled","disabled");
                $("#hid").hide();
            }else if(ii == 'YES'){
                $("#hid").removeAttr("disabled");
                $("#hid").show();
            }


        })

    })
</script>
</html>

