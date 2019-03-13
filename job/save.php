<?php
# 文件名称:save.php 2009-08-18 11:46:13
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';

if($action=="add"){

	//登陆验证码判断
     if($met_memberlogin_code==1){
         require_once 'captcha.class.php';
         $Captcha= new  Captcha();
         if(!$Captcha->CheckCode($code)){
         echo("<script type='text/javascript'> alert('$lang_membercode');window.history.back();</script>");
		       exit;
         }
     }

$query = "SELECT * FROM $met_parameter where use_ok='1' and type=10000 order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
if($list[use_ok]==1)$list_p[]=$list;
}
require_once 'uploadfile_save.php';
$customerid=$metinfo_member_name!=''?$metinfo_member_name:0;
$query = "INSERT INTO $met_cv SET	addtime = '$m_now_date', customerid = '$customerid',jobid=$jobid ";

	foreach($list_p as $key=>$val)
	{		  
	$tmp="$val[name]";
	$value = $$tmp;
	$value = htmlspecialchars($value);
	$query = $query." ,$tmp = '$value'	  ";			
	}					  

    $db->query($query);
okinfo('../member/'.$member_index_url,$lang_js21);
}

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
