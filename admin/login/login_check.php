<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

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
   //code
     if($met_login_code==1){
         require_once '../include/captcha.class.php';
         $Captcha= new  Captcha();
         if(!$Captcha->CheckCode($code)){
         echo("<script type='text/javascript'> alert('$lang_logincodeerror');location.href='login.php?langset=$langset';</script>");
		       exit;
         }
     }

   $admincp_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name' and usertype='3' ");
          if (!$admincp_list){
		       echo("<script type='text/javascript'> alert('$lang_loginname');location.href='login.php';</script>");
		       exit;
          }
		  elseif($admincp_list['admin_pass']!==$metinfo_admin_pass){
		   echo("<script type='text/javascript'> alert('$lang_loginpass');location.href='login.php';</script>");
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
		  $_SESSION['metinfo_admin_lang'] = $admincp_list[langok];
		  $query="update $met_admin_table set 
		  admin_modify_date='$m_now_date',
		  admin_login=admin_login+1,
		  admin_modify_ip='$m_user_ip'
		  WHERE admin_id = '$metinfo_admin_name'";
		  $db->query($query);
		  }
  $adminlang=explode('-',$admincp_list[langok]);
  if($admincp_list[langok]<>'metinfo' and (!strstr($admincp_list[langok],"-".$met_index_type."-")))$lang=$adminlang[1];
echo("<script type='text/javascript'> var nowurl=parent.location.href; var metlogin=(nowurl.split('login')).length-1; if(metlogin==0)location.href='../site/sysadmin.php?lang=$lang'; if(metlogin!=0)location.href='../index.php?lang=$lang';</script>");
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
  //power start
  if($admin_power!="metinfo"){
    if(!strstr($admincp_ok[admin_op], "metinfo")){
	  if(strstr($_SERVER['REQUEST_URI'], "delete.php")){
	  if(!strstr($admincp_ok[admin_op], "del"))okinfo('javascript:window.history.back();',$lang_logindelete);
	  }
	  if(strstr($_SERVER['REQUEST_URI'], "changeState.php")){
	  if(!strstr($admincp_ok[admin_op], "editor"))okinfo('javascript:window.history.back();',$lang_loginedit);
	  }
	  if(strstr($_SERVER['REQUEST_URI'], "/htm.php")){
	  if(!strstr($admincp_ok[admin_op], "editor"))okinfo('javascript:window.history.back();',$lang_loginedit);
	  }
      switch($action){
	  case "add";
	  if(!strstr($_SERVER['REQUEST_URI'], "/content.php")){
	  if(!strstr($admincp_ok[admin_op], "add"))okinfo('javascript:window.history.back();',$lang_loginadd);
	  }
	  break;
	  case "editor";
	   if(!strstr($_SERVER['REQUEST_URI'], "/content.php")){
	  if(!strstr($admincp_ok[admin_op], "editor"))okinfo('javascript:window.history.back();',$lang_loginedit);
	  }
	  break;
	  case "modify";
	  if(!strstr($admincp_ok[admin_op], "editor"))okinfo('javascript:window.history.back();',$lang_loginedit);
	  break;
	  case "Modify";
	  if(!strstr($admincp_ok[admin_op], "editor"))okinfo('javascript:window.history.back();',$lang_loginedit);
	  break;
	  case "del";
	  if(!strstr($admincp_ok[admin_op], "del"))okinfo('javascript:window.history.back();',$lang_logindelete);
	  break;
	  case "delete";
	  if(!strstr($admincp_ok[admin_op], "del"))okinfo('javascript:window.history.back();',$lang_logindelete);
	  break;
	  }
	  if(($admincp_ok[admin_op]=='---' or $admincp_ok[admin_op]=='') and $action<>'' and (!strstr($_SERVER['REQUEST_URI'], "/content.php")) )okinfo('javascript:window.history.back();',$lang_loginall);
    }
  }
    $adminlang=explode('-',$admincp_ok[langok]);
  if($admincp_ok[langok]<>'metinfo' and (!strstr($admincp_ok[langok],$lang)))okinfo('javascript:window.history.back();',$lang_loginalllang);
  //power end
   }
  }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
