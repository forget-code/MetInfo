<?php
# 文件名称:cv_editor.php 2009-08-13 14:13:13
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once 'login_check.php';


if($action=="edit"){

	//登陆验证码判断
     if($met_memberlogin_code==1){
         require_once 'captcha.class.php';
         $Captcha= new  Captcha();
         if(!$Captcha->CheckCode($code)){
         echo("<script type='text/javascript'> alert('$lang_membercode'); window.history.back();</script>");
		       exit;
         }
     }

$query = "SELECT * FROM $met_parameter where use_ok='1' and type=10000 order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
if($list[use_ok]==1)$list_p[]=$list;
}
require_once '../job/uploadfile_save.php';
$customerid=$metinfo_member_name!=''?$metinfo_member_name:0;
$query = "update $met_cv SET ";
$query = $query." addtime = '$m_now_date',jobid=$jobid ";

	foreach($list_p as $key=>$val)
	{
	$tmp="$val[name]";
	$value = $$tmp;
	if($val[maxsize]==255 && $value=='')
	continue;
	$value = htmlspecialchars($value);
	$query = $query." ,$tmp = '$value'	  ";			
	}			  
$query = $query." where id='$id' ";
    $db->query($query);
okinfo('cv.php?lang='.$lang,$lang_js21);
}else{


$cv_list=$db->get_one("select * from $met_cv where id='$id'");
if(!$cv_list){
okinfo('cv.php?lang='.$lang,$lang_loginNoid);
}
$query = "SELECT * FROM $met_parameter where use_ok='1' and type=10000 order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
if($list[wr_ok]=='1')
{
	$list[wr_must]="*";
	$fdwr_list[]=$list;
}
$tmp=intval($list[id])-46;
$para="para".$tmp;
if($list[maxsize]==255 && $cv_list[$para]!='')
{
	$cv_list[$para]="<a href='../upload/file/$cv_list[$para]'>$lang_memberFile</a>";
}

$list[content]=$cv_list[$para];
$list[mark]=$lang=="en"?$list['e_mark']:($lang=="other"?$list['o_mark']:$list['c_mark']);
$cv_para[]=$list;
}

$selectjob = "";
	$serch_sql=" where 1=1 ";
	$item=($lang=="en")?"e_position":($lang=="other"?"o_position":"c_position");
	$serch_sql .=" and $item<>'' ";
	if(!isset($metinfo_member_type)) $metinfo_member_type=0;
	$query = "SELECT id,$item FROM $met_job $serch_sql and  access <= $metinfo_member_type and ((TO_DAYS(NOW())-TO_DAYS(`addtime`)< useful_life) OR useful_life=0)";

	$result = $db->query($query);
	 while($list= $db->fetch_array($result)){
	 $selectok=$cv_list[jobid]==$list[id]?"selected='selected'":"";	 
	 $selectjob.="<option value='$list[id]' $selectok>{$list[$item]}</option>";
	 }


$fdjs="<script language='javascript'>";
$fdjs=$fdjs."function Checkcv(){ ";
foreach($fdwr_list as $key=>$val){
$fdjs=$fdjs."if (document.myform.$val[name].value.length == 0) {";
 if($lang=="en"){
 $fdjs=$fdjs."alert('$val[e_mark] $lang_Empty');";
  }else if($lang=="other"){
  $fdjs=$fdjs."alert('$val[o_mark] $lang_Empty');";
  }else
  {
  $fdjs=$fdjs."alert('$val[c_mark] $lang_Empty');";
  }
 $fdjs=$fdjs."document.myform.$val[name].focus();";
 $fdjs=$fdjs."return false;}";
}
$fdjs=$fdjs."}</script>";

$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('cv_editor');
footermember();}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>