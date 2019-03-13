<?php
# 文件名称:basic.php 2009-08-17 17:33:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once 'login_check.php';

$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_member_name' ");

if(!$admin_list){
     session_unset();
  if (strstr($_SERVER['HTTP_REFERER'],'member/index.php')){
   $returnurl="login.php?lang=".$lang;
   }else{
   $returnurl="login_member.php?lang=".$lang;
   }
header("Location: $returnurl");
exit();
}


switch($admin_list['usertype'])
{
	case '1':$access=$lang_memberbasicType1;break;
	case '2':$access=$lang_memberbasicType2;break;
	case '3':$access=$lang_memberbasicType3;break;
	default:$access=$lang_memberbasicType1;break;
}
$feedback_totalcount = $db->counter($met_feedback, " where customerid='$metinfo_member_name' ", "*");
$feedback_totalcount_readyes = $db->counter($met_feedback, " where customerid='$metinfo_member_name' and readok='1' ", "*");
$feedback_totalcount_readno = $db->counter($met_feedback, " where customerid='$metinfo_member_name' and readok='0' ", "*");

$message_totalcount = $db->counter($met_message, " where customerid='$metinfo_member_name' ", "*");
$message_totalcount_readyes = $db->counter($met_message, " where customerid='$metinfo_member_name' and readok='1' ", "*");
$message_totalcount_readno = $db->counter($met_message, " where customerid='$metinfo_member_name' and readok='0' ", "*");

$cv_totalcount = $db->counter($met_cv, " where customerid='$metinfo_member_name' ", "*");
$cv_totalcount_readyes = $db->counter($met_cv, " where customerid='$metinfo_member_name' and readok='1' ", "*");
$cv_totalcount_readno = $db->counter($met_cv, " where customerid='$metinfo_member_name' and readok='0' ", "*");

$met_membercontrol=$lang=="en"?$met_e_membercontrol:($lang=="other"?$met_o_membercontrol:$met_c_membercontrol);

$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('basic');
footermember();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>