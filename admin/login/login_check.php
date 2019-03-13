<?php
# 文件名称:login_check.php 2009-08-15 14:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if($admin_index){
require_once 'include/common.inc.php';
}
elseif($fckeditor){
require_once '../../../../../include/common.inc.php';
}
else{
require_once '../include/common.inc.php';
}
$force_index="";
if($force_index!="metinfo"){
  if(!$admin_index){
  if (!strstr($_SERVER['HTTP_REFERER'],$_SERVER ['HTTP_HOST'])){
  die($lang_loginNomeet);
  } }

  if($action=="login"){
  $metinfo_admin_name     = $login_name;
  $metinfo_admin_pass     = $login_pass;
  $metinfo_admin_pass=md5($metinfo_admin_pass);
   //登陆验证码判断
     if($met_login_code==1){
         require_once '../include/captcha.class.php';
         $Captcha= new  Captcha();
         if(!$Captcha->CheckCode($code)){
         echo("<script type='text/javascript'> alert('$lang_loginCode');location.href='login.php';</script>");
		       exit;
         }
     }

   $admincp_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name' and usertype='3' ");
          if (!$admincp_list){
		       echo("<script type='text/javascript'> alert('$lang_loginName');location.href='login.php';</script>");
		       exit;
          }
		  elseif($admincp_list['admin_pass']!==$metinfo_admin_pass){
		   echo("<script type='text/javascript'> alert('$lang_loginPass');location.href='login.php';</script>");
		   exit;
		  }
		  else{ 
		  session_start();
		  $_SESSION['metinfo_admin_name'] = $metinfo_admin_name;
          $_SESSION['metinfo_admin_pass'] = $metinfo_admin_pass;
		  $_SESSION['metinfo_admin_id'] = $admincp_list[id];
		  $_SESSION['metinfo_admin_type']  = $admincp_list['usertype'];
		  $_SESSION['metinfo_admin_pop']  = $admincp_list['admin_type'];
		  $_SESSION['metinfo_admin_time'] = $m_now_time;
	      //$_SESSION['languser'] = $langset;
		  $query="update $met_admin_table set 
		  admin_modify_date='$m_now_date',
		  admin_login=admin_login+1,
		  admin_modify_ip='$m_user_ip'
		  WHERE admin_id = '$metinfo_admin_name'";
		  $db->query($query);
		  }
echo("<script type='text/javascript'> var nowurl=parent.location.href; var metlogin=(nowurl.split('login')).length-1; if(metlogin==0)location.href='../site/sysadmin.php'; if(metlogin!=0)location.href='../index.php';</script>");
  }
  else{  
  if(!$metinfo_admin_name||!$metinfo_admin_pass){
    if($admin_index){
	session_unset();
     Header("Location: login/login.php");
     }
     else{
	 session_unset();
     Header("Location: ../login/login.php");
     }
     exit;
  }else{
  $admincp_ok = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name' and admin_pass='$metinfo_admin_pass' and usertype='3'");
     if (!$admincp_ok){
        if($admin_index){
		session_unset();
        Header("Location: login/login.php");
        }else{
		session_unset();
        Header("Location: ../login/login.php");
        }
        exit;
     }
  //权限判断开始
  if($admin_power!="metinfo"){
    if(!strstr($admincp_ok[admin_op], "metinfo")){
	  if(strstr($_SERVER['REQUEST_URI'], "delete.php")){
	  if(!strstr($admincp_ok[admin_op], "del"))okinfo('javascript:window.history.back();',$lang_loginTip8);
	  }
      switch($action){
	  case "add";
	  if(!strstr($admincp_ok[admin_op], "add"))okinfo('javascript:window.history.back();',$lang_loginTip9);
	  break;
	  case "editor";
	  if(!strstr($admincp_ok[admin_op], "editor"))okinfo('javascript:window.history.back();',$lang_loginTip10);
	  break;
	  case "modify";
	  if(!strstr($admincp_ok[admin_op], "editor"))okinfo('javascript:window.history.back();',$lang_loginTip10);
	  break;
	  case "Modify";
	  if(!strstr($admincp_ok[admin_op], "editor"))okinfo('javascript:window.history.back();',$lang_loginTip10);
	  break;
	  case "del";
	  if(!strstr($admincp_ok[admin_op], "del"))okinfo('javascript:window.history.back();',$lang_loginTip8);
	  break;
	  case "delete";
	  if(!strstr($admincp_ok[admin_op], "del"))okinfo('javascript:window.history.back();',$lang_loginTip8);
	  break;
	  }
	  if(($admincp_ok[admin_op]=='---' or $admincp_ok[admin_op]=='') and $action<>'')okinfo('javascript:window.history.back();',$lang_loginTip11);
    }
  }
  //权限判断结束
   }
  }
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>
