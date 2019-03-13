<?php
# 文件名称:other_info.php 2009-08-03 15:48:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="modify"){
$query = "update $met_otherinfo SET ";
if($met_c_lang_ok==1){
     $query =$query. "c_info1       = '$c_info1',
					  c_info2       = '$c_info2',
					  c_info3       = '$c_info3',
					  c_info4       = '$c_info4',
					  c_info5       = '$c_info5',
					  c_info6       = '$c_info6',
					  c_info7       = '$c_info7',
					  c_info8       = '$c_info8',
					  c_info9       = '$c_info9',
					  c_info10      = '$c_info10',
					  c_imgurl1     = '$c_imgurl1',
					  c_imgurl2     = '$c_imgurl2',";}
if($met_e_lang_ok==1){
     $query =$query. "e_info1       = '$e_info1',
					  e_info2       = '$e_info2',
					  e_info3       = '$e_info3',
					  e_info4       = '$e_info4',
					  e_info5       = '$e_info5',
					  e_info6       = '$e_info6',
					  e_info7       = '$e_info7',
					  e_info8       = '$e_info8',
					  e_info9       = '$e_info9',
					  e_info10      = '$e_info10',
					  e_imgurl1     = '$e_imgurl1',
					  e_imgurl2     = '$e_imgurl2',";}
if($met_o_lang_ok==1){
     $query =$query. "o_info1       = '$o_info1',
					  o_info2       = '$o_info2',
					  o_info3       = '$o_info3',
					  o_info4       = '$o_info4',
					  o_info5       = '$o_info5',
					  o_info6       = '$o_info6',
					  o_info7       = '$o_info7',
					  o_info8       = '$o_info8',
					  o_info9       = '$o_info9',
					  o_info10      = '$o_info10',
					  o_imgurl1     = '$o_imgurl1',
					  o_imgurl2     = '$o_imgurl2',";}

$query =$query. " id=id where id=$id";			  
$db->query($query);
okinfo('other_info.php',$lang_loginUserAdmin);

}
else
{
$otherinfo = $db->get_one("SELECT * FROM $met_otherinfo order by id desc");
if(!$otherinfo){
okinfo('../site/sysadmin.php',$lang_loginNoid);
}
}
$infofile="../../templates/".$met_skin_user."/otherinfo.inc.php";
if(!file_exists($infofile)){
$infoname1=array($lang_setotherTip2,'');
$infoname2=array($lang_setotherTip2,'');
$infoname3=array($lang_setotherTip2,'');
$infoname4=array($lang_setotherTip2,'');
$infoname5=array($lang_setotherTip2,'');
$infoname6=array($lang_setotherTip2,'');
$infoname7=array($lang_setotherTip2,'');
$infoname8=array($lang_setotherTip2,'');
$infoname9=array($lang_setotherTip2,'');
$infoname10=array($lang_setotherTip2,'');
$imgurlname1=array($lang_setotherTip2,'');
$imgurlname2=array($lang_setotherTip2,'');
}else{
require_once($infofile);
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('otherinfo');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>