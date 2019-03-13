<?php
# 文件名称:login_check.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once '../include/common.inc.php';
if($action=="login"){
  $metinfo_member_name     = $login_name;
  $metinfo_member_pass     = $login_pass;
  $metinfo_member_pass     = md5($metinfo_member_pass);  
  if (strstr($_SERVER['HTTP_REFERER'],'login_member.php')){
   $returnurl="basic.php?lang=".$lang;
   }else{
   $returnurl=$member_index_url;
   }
   //登陆验证码判断
     if($met_memberlogin_code==1){
         require_once 'outlogin/captcha.class.php';
         $Captcha= new  Captcha();
         if(!$Captcha->CheckCode($code)){
         echo("<script type='text/javascript'> alert('$lang_membercode'); window.history.back();</script>");
		       exit;
         }
     }
	
   $membercp_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_member_name' and usertype<3");
   
	if (!$membercp_list){
		       echo("<script type='text/javascript'> alert('$lang_membernameno'); window.history.back();</script>");
		       exit;
          }
		  elseif($membercp_list['admin_pass']!==$metinfo_member_pass){
		   echo("<script type='text/javascript'> alert('$lang_memberpassno'); window.history.back();</script>");
		   exit;
		  }elseif($membercp_list['checkid']!=='1'){
		   echo("<script type='text/javascript'> alert('$lang_membernodo'); window.history.back();</script>");
		   exit;
		  }
		  else{ 
		  session_start();
		  $_SESSION['metinfo_member_name'] = $metinfo_member_name;
          $_SESSION['metinfo_member_pass'] = $metinfo_member_pass;
		  $_SESSION['metinfo_member_id'] = $membercp_list[id];
		  $_SESSION['metinfo_member_type']  = $membercp_list['usertype'];
		  $_SESSION['metinfo_member_time'] = $m_now_time;
		  $query="update $met_admin_table set 
		  admin_modify_date='$m_now_date',
		  admin_login=admin_login+1,
		  admin_modify_ip='$m_user_ip'
		  WHERE admin_id = '$metinfo_member_name'";
		  $db->query($query);
		  }
		   
  if($remember==1)
  {
	setcookie("name", $metinfo_member_name, mktime()+86400*7, "/");//周期7天
	setcookie("ps", $metinfo_member_pass, mktime()+86400*7, "/");
  }
  
  Header("Location:$returnurl");
  }
else{

if ($memberindex!="metinfo"){
    $returnurl="login_member.php?lang=".$lang;
  if(!$metinfo_member_name||!$metinfo_member_pass){
     session_unset();
     Header("Location:$returnurl");
     exit;
  }else{
  $membercp_ok = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_member_name' and admin_pass='$metinfo_member_pass'");
    
	 if (!$membercp_ok){
	 	session_unset();
        Header("Location: $returnurl");
        exit;
     }
	
   }
   }
  }
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
