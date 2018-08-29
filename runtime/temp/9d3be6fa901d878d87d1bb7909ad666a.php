<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"D:\phpStudy\WWW\APP./application/admin\view\users\dp_list\index.html";i:1532930744;s:62:"D:\phpStudy\WWW\APP./application/admin\view\template\base.html";i:1531361201;s:73:"D:\phpStudy\WWW\APP./application/admin\view\template\javascript_vars.html";i:1530516289;}*/ ?>
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
    
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l">
            <?php if (\Rbac::AccessCheck('delete')) : ?><a href="javascript:;" onclick="del_all('<?php echo \think\Url::build('delete', []); ?>')" class="btn btn-danger radius mr-5"><i class="Hui-iconfont">&#xe6e2;</i> 删除</a><?php endif; ?>
        </span>
        <span class="r pt-5 pr-5">
            共有数据 ：<strong><?php echo isset($count) ? $count :  '0'; ?></strong> 条
        </span>
    </div>
    <table class="table table-border table-bordered table-hover table-bg mt-20">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox"></th>
            <th width="">ID</th>
            <th width="">电话</th>
            <th width="">昵称</th>
            <th width="">头像</th>
            <th width="">店铺名称</th>
            <th width="">地址</th>
            <th width="">状态</th>
            <th width="">创建时间</th>
            <th width="">修改时间</th>
            <th width="70">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><input type="checkbox" name="id[]" value="<?php echo $vo['id']; ?>"></td>
            <td><?php echo $vo['id']; ?></td>
            <td><?php echo $vo['phone']; ?></td>
            <td><?php echo $vo['nickname']; ?></td>
            <td><img src="<?php echo $vo['pic']; ?>" width="100" height="60" alt=""></td>
            <td><?php echo $vo['dp_name']; ?></td>
            <td><?php echo $vo['address']; ?></td>
            <td><?php echo get_status($vo['status']); ?></td>
            <td><?php echo date("Y-m-d",$vo['create_time']); ?></td>
            <td><?php echo date("Y-m-d",$vo['update_time']); ?></td>
            <td class="f-14">
                <?php echo show_status($vo['status'],$vo['id']); ?>
                <!-- <?php if (\Rbac::AccessCheck('edit')) : ?> <a title="编辑" href="javascript:;" onclick="layer_open('编辑','<?php echo \think\Url::build('edit', ['id' => $vo["id"], ]); ?>')" style="text-decoration:none" class="ml-5"><i class="Hui-iconfont">&#xe6df;</i></a><?php endif; ?> -->
            <a href="javascript:;" onclick="layer_open('医师列表','<?php echo url("users/DoctorList",['parent_id'=>$vo['id']]); ?>')" class="label  radius ml-5">医师列表</a>
            <a href="javascript:;" onclick="layer_open('客服列表','<?php echo url("users/KfList",['parent_id'=>$vo['id']]); ?>')" class="label  radius ml-5">客服列表</a>
                <?php if (\Rbac::AccessCheck('deleteforever')) : ?> <a href="javascript:;" onclick="del_forever(this,'<?php echo $vo['id']; ?>','<?php echo \think\Url::build('deleteforever', []); ?>')" class="label label-danger radius ml-5">彻底删除</a><?php endif; ?>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="page-bootstrap"><?php echo isset($page) ? $page :  ''; ?></div>
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layui/layui.js "></script>

</body>
</html>