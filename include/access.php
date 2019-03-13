<?php
# 文件名称:access.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once 'common.inc.php';
if($met_webhtm==0){
$member_login_url="login.php?lang=".$lang;
$member_register_url="register.php?lang=".$lang;
}else{
$member_login_url=($lang=="en")?"login".$met_e_htmtype:(($lang=="other")?"login".$met_o_htmtype:"login".$met_c_htmtype);
$member_register_url=($lang=="en")?"register".$met_e_htmtype:(($lang=="other")?"register".$met_o_htmtype:"register".$met_c_htmtype);
}

$met_js_ac="<script type='text/javascript'> alert('".$lang_access."'); location.href='../member/".$member_index_url."'; </script>";
if($met_member_use!=0){
switch($metuser){
default:
if(intval($metinfo_member_type)>=intval($metaccess)){
    $met_js_ac="";
  }else{
session_unset();
$_SESSION['metinfo_member_name']=$metinfo_member_name;
$_SESSION['metinfo_member_pass']=$metinfo_member_pass;
$_SESSION['metinfo_member_type']=$metinfo_member_type;
$_SESSION['metinfo_admin_name']=$metinfo_admin_name;
  }
break;
case 'para':
if(intval($metinfo_member_type)>=intval($metaccess)){
$listinfo=codetra($listinfo,0);
$met_js_ac=authcode($listinfo, 'DECODE', $met_memberforce);
}else{
  if($paraid<=10){
    $met_js_ac="【<a href='../member/$member_login_url'>$lang_login</a>】【<a href='../member/$member_register_url'>$lang_register</a>】";
	}else{
	 $met_js_ac="../public/images/metinfo.gif";
	}
}
break;

case 'down':
if(intval($metinfo_member_type)>=intval($metaccess)){
$listinfo=codetra($listinfo,0);
$met_js_ac=authcode($listinfo, 'DECODE', $met_memberforce);
}else{
  if($paraid<=10){
    $met_js_ac="【<a href='../member/$member_login_url'>$lang_login</a>】【<a href='../member/$member_register_url'>$lang_register</a>】";
	}else{
	 $met_js_ac="../public/images/metinfo.gif";
	}
}
break;
}
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
$met_js="<?php echo $met_js_ac; ?>";
document.write($met_js) 