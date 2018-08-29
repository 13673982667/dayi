<?PHP

session_start();
if (!isset($_SESSION['usernc']) && empty($_SESSION['usernc'])) {
    echo "<script>alert('您未登录!');window.location.href='../login.html';</script>";

}else{
    include_once("../common/config.php");
    include_once ("../common/page.php");
    mysqli_set_charset($conn, "utf8");
    $pageSize=3;        //每页显示的记录数
    $query="select * from kq_products  order by addtime desc" ;
    //总记录数
    $C = mysqli_query($conn,$query);
    $totalRows = mysqli_affected_rows($conn);

    //总页数
    $totalPage = ceil($totalRows/$pageSize);
    //$totalRows=$conn->getResultNum($sql);   //总记录数
    //$totalPage=ceil($totalRows/$pageSize);  //总页数
    $page=isset($_REQUEST['page'])?(int)$_REQUEST['page']:1;//当前页数
    if($page<1||$page==null||!is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;

    $sql="select * from kq_products order by addtime desc limit {$offset},{$pageSize}";
    $que= mysqli_query($conn,$sql);
    $result = array();
    while($res = mysqli_fetch_assoc($que)){
        $result[] = $res;
    };
}

    ?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../common/css/shop.css" type="text/css" rel="stylesheet" />
    <link href="../common/css/Sellerber.css" type="text/css"  rel="stylesheet" />
    <link href="../common/css/bkg_ui.css" type="text/css"  rel="stylesheet" />
    <link href="../common/font/css/font-awesome.min.css"  rel="stylesheet" type="text/css" />
    <script src="../common/js/jquery-1.9.1.min.js" type="text/javascript" ></script>
<script src="../common/js/Sellerber.js" type="text/javascript"></script>
<script type="text/javascript" src="../common/js/jquery.cookie.js"></script>
<script src="../common/js/shopFrame.js" type="text/javascript"></script>
<script src="../common/js/jquery.dataTables.min.js"></script>
<script src="../common/js/jquery.dataTables.bootstrap.js"></script>
<script src="../common/js/layer/layer.js" type="text/javascript"></script>
<script src="../common/js/laydate/laydate.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="../common/js/html5shiv.js" type="text/javascript"></script>
<script src="../common/js/respond.min.js"></script>
<script src="../common/js/css3-mediaqueries.js"  type="text/javascript"></script>
<![endif]-->
<title>文章列表</title>
</head>

<body>
<div class="margin" id="page_style">
 <div class="operation clearfix">
<!--  <button class="btn button_btn btn-danger" type="button" onclick=""><i class="fa fa-trash-o"></i>&nbsp;删除</button>-->
  <span class="submenu"><a href="../home/add_Products.html" name="add_Article.php" class="btn button_btn bg-deep-blue" title="添加文章"><i class="fa  fa-edit"></i>&nbsp;添加项目分类</a></span>
 </div>
 <!--列表展示-->
 <div class="list_Exhibition margin-sx" id="play">
  <table class="table table_list table_striped table-bordered" id="sample-table" >
      <thead id="thead">
      <tr style="text-align: center" >
<!--          <th width="30"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>-->
          <th width="30">序号</th>
          <th width="25">项目名称</th>
         
          <th width="50">图片</th>
          <th width="30">内容</th>
       <!--    <th width="80">分类</th> -->
          <th width="50">添加日期</th>
          <th width="120">操作</th>
      </tr>
      </thead>
   <tbody id="table">
   <?php
       if(!empty($que)){
            foreach($result as $value){
			
    ?>
   <tr id="tr" style="text-align: center;" >
    <th id="id" style="text-align: center;"><?php  echo $value['id']?></th>
    <th id="title" style="text-align: center;"><?php  echo $value['title']?></th>
   <!--  <th id="description" style="text-align: center;"><?php  echo $value['description']?></th> -->
    <th id="pic" style="text-align: center;"><img src="<?php echo $value['pic'] ?>" alt="" style="width:70px;height: 50px;"><?php  ?></th>
    <th id="cont" style="text-align: center;"><?php  echo $value['content']?></th>
<!--     <th id="keyword" style="text-align: center;"><?php  if($value['keyword'] == "mouth"){echo "口腔百科" ;}elseif($value['keyword'] == "teeth"){echo "牙齿美白";}elseif($value['keyword'] == "news"){echo "资讯";} ?></th>
 -->    <th id="addtime" style="text-align: center;"><?php  echo $value['addtime']?></th>
    <th style="text-align: center;"><button class="btn button_btn btn-danger" type="button" onclick=""><i class="fa fa-trash-o"></i>&nbsp;<a href="../admin/del-products.php?id=<?php   echo $value['id']?>">删除</a></button><button class="btn button_btn  btn-info" type="button" onclick="">&nbsp;<a href="update_Products.php?id=<?php   echo $value['id']?>">修改</a></button></th>
   </tr>
   <?php
        }
     }
?>
   </tbody>
  </table>
 </div>
 <div style="text-align: center;background:burlywood; font-size:initial;font-weight:bold;" id="page">
  <?php
        echo showPage($page,$totalPage);
        echo"<hr/>";
  ?>
 </div>
</div>
</body>
</html>


