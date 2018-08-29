<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/18
 * Time: 15:03
 * order:管理员登日志
 */

session_start();
header ( "Content-type: text/html; charset=utf-8" );
include_once("../common/config.php");
if (isset($_SESSION['usernc']) && !empty($_SESSION['usernc'])) {
   $code = isset($_POST['code']) ? $_POST['code'] : "";
   if($code !==null){
       $sql = "select `adminname`,`type`,`ip`,`addtime` from kq_login_records ";
       $query =  mysqli_query($conn,$sql);
       $res =  array();
       while( $jieguo= mysqli_fetch_assoc($query)){
                $res[] = $jieguo;
       }
//       echo json_encode($res);
   }


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
    <script type="text/javascript" src="../common/js/jquery.nestable.min.js"></script>
    <script src="../common/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
    <script src="../common/js/jquery.dataTables.min.js"></script>
    <script src="../common/js/jquery.dataTables.bootstrap.js"></script>
    <script src="../common/js/layer/layer.js" type="text/javascript"></script>
    <script src="../common/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="../common/js/html5shiv.js" type="text/javascript"></script>
    <script src="../common/js/respond.min.js"></script>
    <script src="../common/js/css3-mediaqueries.js"  type="text/javascript"></script>
    <![endif]-->
    <title>栏目</title>
</head>

<body>
<div class="margin" id="page_style">
    <div class="operation">
        <!--<button class="btn button_btn btn-danger" type="button" onclick=""><i class="fa fa-trash-o"></i>&nbsp;删除</button>-->
        <!--<span class="submenu"><a href="javascript:void(0)"class="btn button_btn bg-deep-blue" title="删除"  onclick="a dd_columns()"><i class="fa  fa-edit"></i>&nbsp;删除</a></span>-->
    </div>
    <div class="Columns_list slideBox margin-top" id="Columns_list">
        <div class="hd">
            <ul>
                <li>管理员登录日志</li>
                <!--<li>顶部栏目</li>-->
                <!--<li>底部栏目</li>-->
            </ul>
        </div>
        <div class="bd">
            <ul class="main_column">
                <table class="table table_list table_striped table-bordered  margin-top">
                    <thead>
                    <tr>
                        <th width="10%">管理员名称</th>
                        <th width="9%">登录IP</th>
                        <th width="15%">登录时间</th>
                        <th width="8%">级别</th>
                        <!--<th width="5%">登录时长</th>-->
                        <th width="10%">操作（超级管理员的最高权限）</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="7" class="padding_none">
                            <div class="dd" id="nestable">
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle">
                                            <table style="text-align: center;font-size: 15px;">
                                                <?php
                                                if(!empty($query)) {
                                                    foreach ($res as $value) {
                                                        ?>
                                                        <tbody>
                                                        <tr>
                                                            <td width="10%" id="name"><?php echo $value['adminname']?></td>
                                                            <td width="9%" id="ip"><?php echo $value['ip']?></td>
                                                            <td width="15%" id="time"><?php echo $value['addtime']?></td>
                                                            <td width="8%" id="level"><?php if($value['type'] == 1){ echo "超级管理员";}elseif($value['type'] == 2){echo "医师级别";}?></td>
                                                            <!--<td width="5%"></td>-->
                                                            <td width="10%" class="operating">
                                                                <a href="javascrpit:void()"
                                                                   class="btn btn-white button_btn"
                                                                   onclick="columns_delete(this,'10')">删除</a>
                                                                <!--<a href="" class="btn btn-white button_btn">修改</a>-->
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </ul>
        </div>
    </div>
</div>


</body>
</html>
<script type="text/javascript">
    // $(function(){
    //     var code = 1;
    //     // alert(code);
    //     $.ajax({
    //         type: "POST",
    //         async: false,
    //         url: "../admin/logined-record.php",
    //         dataType: "json",
    //         data: { code: code},
    //         success: function(data){
    //             console.log(data);
    //             $("#name").html(data[0].adminname);
    //             $("#ip").html(data[0].ip);
    //             $("time").html(data[0].addtime);
    //         }
    //     });
    // });

    // /*******滚动条*******/
    // $("body").niceScroll({
    //     cursorcolor:"#888888",
    //     cursoropacitymax:1,
    //     touchbehavior:false,
    //     cursorwidth:"5px",
    //     cursorborder:"0",
    //     cursorborderradius:"5px"
    // });
</script>
