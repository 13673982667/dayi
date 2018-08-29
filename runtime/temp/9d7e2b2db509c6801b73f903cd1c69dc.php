<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"D:\phpStudy\WWW\APP./application/admin\view\Article\video\edit.html";i:1532333099;s:62:"D:\phpStudy\WWW\APP./application/admin\view\template\base.html";i:1531361201;s:73:"D:\phpStudy\WWW\APP./application/admin\view\template\javascript_vars.html";i:1530516289;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title><?php echo \think\Config::get('site.title'); ?></title>
    <link rel="Bookmark" href="__ROOT__/favicon.ico" >
    <link rel="Shortcut Icon" href="__ROOT__/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__LIB__/html5.js"></script>
    <script type="text/javascript" src="__LIB__/respond.min.js"></script>
    <script type="text/javascript" src="__LIB__/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/layui/css/layui.css">
    
    
    <!--[if IE 6]>
    <script type="text/javascript" src="__LIB__/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--定义JavaScript常量-->
<script>
    window.THINK_ROOT = '<?php echo \think\Request::instance()->root(); ?>';
    window.THINK_MODULE = '<?php echo \think\Url::build("/" . \think\Request::instance()->module(), "", false); ?>';
    window.THINK_CONTROLLER = '<?php echo \think\Url::build("___", "", false); ?>'.replace('/___', '');
</script>
</head>
<body>

<nav class="breadcrumb">
    <div id="nav-title"></div>
    <a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:;" title="刷新"><i class="Hui-iconfont"></i></a>
</nav>


<div class="page-container">
    <form class="form form-horizontal" id="form" method="post" action="<?php echo \think\Request::instance()->baseUrl(); ?>">
        <input type="hidden" name="id" value="<?php echo isset($vo['id']) ? $vo['id'] :  ''; ?>">
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">标题：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="标题" name="title" value="<?php echo isset($vo['title']) ? $vo['title'] :  ''; ?>" >
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
       
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">描述：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="描述" name="description" value="<?php echo isset($vo['description']) ? $vo['description'] :  ''; ?>" >
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
       <!--  <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">文章日期：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="文章日期" name="addtime" value="<?php echo isset($vo['addtime']) ? $vo['addtime'] :  ''; ?>" >
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div> -->

         <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">封面：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div id="drag" class="" title="" style="border: 0;">
                    <label for="fileupload" title="点击上传">
                        <button type="button" class="btn btn-default radius ml-20">点击上传</button>
                    </label>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">预览图：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="pic" value="<?php echo isset($vo['pic']) ? $vo['pic'] :  ''; ?>">
                <img class="yl-img" src="<?php echo isset($vo['pic']) ? $vo['pic'] :  ''; ?>" style="max-height: 200px; max-width: 200px;">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>

        

        <div class="row cl" style="display: ">
            <label class="form-label col-xs-3 col-sm-3">类型：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="类型" name="keyword" value="1" >
                <input type="text" class="input-text" placeholder="类型" name="type" value="1" >
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">状态：</label>
            <div class="formControls col-xs-6 col-sm-6 skin-minimal">
                <div class="radio-box">
                    <input type="radio" name="status" id="status-1" value="1">
                    <label for="status-1">启用</label>
                </div>
                <div class="radio-box">
                    <input type="radio" name="status" id="status-0" value="0">
                    <label for="status-0">禁用</label>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
         <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">视频：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div id="video" class="" title="" style="border: 0;">
                    <label for="fileupload" title="点击上传">
                        <button type="button" class="btn btn-default radius ml-20">点击上传</button>
                    </label>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"></label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="v_url" value="<?php echo isset($vo['v_url']) ? $vo['v_url'] :  ''; ?>">
                <div class="yl-video">
                    <video id="media" autobuffer autoloop loop controls style="max-height: 200px; max-height: 200px">
                        <source id="v1" src="<?php echo isset($vo['v_url']) ? $vo['v_url'] :  ''; ?>">
                        <source id="v2" src="<?php echo isset($vo['v_url']) ? $vo['v_url'] :  ''; ?>">
                    </video>
                </div>

            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>


        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <button type="submit" class="btn btn-primary radius">&nbsp;&nbsp;提交&nbsp;&nbsp;</button>
                <button type="button" class="btn btn-default radius ml-20" onClick="layer_close();">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>

    </form>
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layui/layui.js "></script>

<script type="text/javascript" src="__LIB__/Validform/5.3.2/Validform.min.js"></script>
<!-- <script type="text/javascript" charset="utf-8" src="__LIB__/ueditor/1.4.3/ueditor.config.js"></script> -->
<!-- <script type="text/javascript" charset="utf-8" src="__LIB__/ueditor/1.4.3/ueditor.all.min.js"> </script> -->
<!-- <script type="text/javascript" charset="utf-8" src="__LIB__/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script> -->
<!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container',{
            initialFrameHeight:500,
        });
    </script>
<script>
    $(function () {
        $("[name='status'][value='<?php echo isset($vo['status']) ? $vo['status'] :  ''; ?>']").prop("checked", true);

        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form").Validform({
            tiptype: 2,
            ajaxPost: true,
            showAllError: true,
            callback: function (ret){
                ajax_progress(ret);
            }
        });

        layui.use('upload', function(){
          var upload = layui.upload;
            
          //执行实例
          var uploadInst = upload.render({
            elem: '#drag' //绑定元素
            ,url: '<?php echo \think\Url::build("api/upload/upload_file_img"); ?>' //上传接口
            ,done: function(res){
              //上传完毕回调
                if(res.code == 1){
                    $('.yl-img').attr('src',res.data);
                    $('input[name="pic"]').val(res.data);
                }
            }
            ,error: function(){
              //请求异常回调
            }
          });
        });

        //伤传视频
        layui.use('upload', function(){
          var upload = layui.upload;
            
          //执行实例
          var uploadInst = upload.render({
            elem: '#video' //绑定元素
            ,url: '<?php echo \think\Url::build("api/upload/upload_file_img"); ?>' //上传接口
            ,exts:'mp4'
            ,done: function(res){
              //上传完毕回调
                if(res.code == 1){
                    $('#v1').attr('src',res.data);
                    $('#v2').attr('src',res.data);
                    $('input[name="v_url"]').val(res.data);
                    document.getElementById("media").load();
                }
            }
            ,error: function(){
              //请求异常回调
            }
          });
        });
    })
</script>

</body>
</html>