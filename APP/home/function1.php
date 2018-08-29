<?php

/***********************第三方短信验证码类（云之迅）**************************************/

//接受短信验证码

function  phone($phone){

	//导入第三方类库 Ucpaas.class.php
	include_once ("../common/Ucpaas.class.php");
	//初始化必填
	$options['accountsid']='da776c1deccc22c682efce0cdf088ca2';
	$options['token']='ad86c5251867b87a40f9602176c2b854';
	//实例化Ucpaas
	$Ucpaas=new Ucpaas($options);
	// var_dump($Ucpaas);

	//接入产品
	//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
	$appId ="e8501ac72bd0469cb5f0f3cc06030e06";
	//对象终端

	$to = $phone; //应该是获取到的手机号码

	//短信模板id
	$templateId = "96802";
	//参数 (验证码)
	$param=rand(10000,50000);
	//把验证码 session  cookie  缓存
	file_put_contents('./param.php', $param);
	// setcookie("param",$param,180);
	// $_SESSION['id'] = 1;
	// $_SESSION['param'] = $param;
    //原样格式
    	echo $Ucpaas->templateSMS($appId,$to,$templateId,$param);


}











?>