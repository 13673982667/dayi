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
        <div class="search  clearfix">
            <label class="label_name"></label><input  style="width:650px;height: 30px;" name="search" type="text" placeholder="请输入文章标题" class="form-control col-lg-10"/><button class="btn button_btn bg-deep-blue " id="submit"   type="button"><i class="fa  fa-search"></i>&nbsp;搜索</button>
        </div>
    </div>
    <!--列表展示-->
    <div class="list_Exhibition margin-sx" id="search">
        <table class="table table_list table_striped table-bordered" id="sample-table" >
            <thead>
            <tr style="text-align: center">
                <!--          <th width="30"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>-->
                <th width="30">序号</th>
                <th width="25">文章名称</th>
                <th width="40">简介</th>
                <th width="50">图片</th>
                <th width="30">内容</th>
                <th width="80">分类</th>
                <th width="50">添加日期</th>
<!--                <th width="120">操作</th>-->
            </tr>
            </thead>
            <tbody id="table">
                    <tr id="tr" style="text-align: center;" >
                        <th id="id1" style="text-align: center;">xx</th>
                        <th id="title1" style="text-align: center;">xx</th>
                        <th id="description1" style="text-align: center;">xx</th>
                        <th  style="text-align: center;"><img id="pic1" src="" alt="" style="width: 50px;height: 50px;"></th>
                        <th id="cont1" style="text-align: center;">xx</th>
                        <th id="keyword1" style="text-align: center;">xx</th>
                        <th id="addtime1" style="text-align: center;">xx</th>
<!--                        <th style="text-align: center;"><button class="btn button_btn btn-danger" type="button" onclick=""><i class="fa fa-trash-o"></i>&nbsp;<a href="../admin/del-article.php?id=--><?php //  echo $value['id']?><!--&keyword=--><?php //echo $value['keyword']?><!--">删除</a></button><button class="btn button_btn  btn-info" type="button" onclick="">&nbsp;<a href="update_Articile.php?id=--><?php //  echo $value['id']?><!--">修改</a></button></th>-->
                    </tr>
            </tbody>
        </table>
    </div>
    <div style="text-align: center;background:burlywood; font-size:initial;font-weight:bold;">
<!--        --><?php
//        echo showPage($page,$totalPage);
//        echo"<hr/>";
//        ?>
    </div>
</div>
</body>
<script>
    $(function(){
        // $("#search").css('display','none');
        $("#submit").click(function(){
            $("#search").css('display','block');
            var cont = $("input[name='search']").val();
            $.ajax({
                type: "POST",
                async: false,
                url: "../admin/search_article.php",
                dataType:'JSON',
                data: { title: cont},
                success: function(data){
                        console.log(data);
                    // $.each(data,function(index,value){
                    //     $.each(value,function(value,val){
                    //         $("#id1").html(val.id);
                    //             // $("#title").html(data[0].title);
                    //             // $("#description").html(data[0].description);
                    //             // $("#pic").attr("src",data[0].pic);
                    //             // $("#cont").html(data[0].cont);
                    //             // $("#keyword").html(data[0].keyword);
                    //             // $("#addtime").html(data[0].addtime);
                    //             // $("#tr").css('display','block');
                    //         // console.log("下标:"+value+"值:"+val);
                    //     });
                    //     // console.log("下标:"+index+"值:"+value);
                    // });



                    // $.each(data, function(i, item) {
                    //     alert(item[0]);
                    // });
                    // alert(data[0]);
                    // console.log(data);
                    // if(data !== null){
                    //     console.log(data);
                    //     $.each(data,function(i,item){
                    //         alert(item[0])
                    //     });
                    //     // $("#sample-table").css('display','block');
                    //     // console.log(data);
                         $("#id1").html(data[0].id);
                         $("#title1").html(data[0].title);
                         $("#description1").html(data[0].description);
                         $("#cont1").html(data[0].cont);
                         $("#pic1").attr("src",data[0].pic);
                         $("#keyword1").html(data[0].keyword);
                         $("#addtime1").html(data[0].addtime);
                     // $("#tr").css('display','block');
                    // }else{s
                    //     $("#tr").attr('display','none');
                    // }



                }

            })
        })


    })

</script>
</html>


