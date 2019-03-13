<?php
if($admin_index){
require_once 'include/common.inc.php';
}
elseif($fckeditor){
require_once '../../../../../include/common.inc.php';
}
else{
require_once '../include/common.inc.php';
}
if($force_index!="metinfo"){
if(!$admin_index){
if (!strstr($_SERVER['HTTP_REFERER'],$_SERVER ['HTTP_HOST'])){
die($lang[nomeet]);
} }

if($action=="login"){
$metinfo_admin_name     = $login_name;
$metinfo_admin_pass     = $login_pass;
$metinfo_admin_pass=md5($metinfo_admin_pass);
$met_login_code=1;
//登陆验证码判断
     if($met_login_code==1){
         require_once '../include/captcha.class.php';
         $Captcha= new  Captcha();
         if(!$Captcha->CheckCode($code)){
         echo("<script type='text/javascript'> alert('$lang[login_code]');location.href='login.php';</script>");
		       exit;
         }
     }

$admincp_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name'");
          if (!$admincp_list){
		       echo("<script type='text/javascript'> alert('$lang[login_name]');location.href='login.php';</script>");
		       exit;
          }
		  elseif($admincp_list['admin_pass']!==$metinfo_admin_pass){
		   echo("<script type='text/javascript'> alert('$lang[login_pass]');location.href='login.php';</script>");
		   exit;
		  }
		  else{ 
		  session_start();
		  $_SESSION['metinfo_admin_name'] = $metinfo_admin_name;
          $_SESSION['metinfo_admin_pass'] = $metinfo_admin_pass;
		  $_SESSION['metinfo_admin_id'] = $admincp_list[id];
		  $_SESSION['metinfo_admin_pop']  = $admincp_list['admin_type'];
		  $_SESSION['metinfo_admin_time'] = $m_now_time;
		  $query="update $met_admin_table set 
		  admin_modify_date='$m_now_date',
		  admin_login=admin_login+1,
		  admin_modify_ip='$m_user_ip'
		  WHERE admin_id = '$metinfo_admin_name'";
		  $db->query($query);
		  }
Header("Location: ../");
}
else{
if(!$metinfo_admin_name||!$metinfo_admin_pass){
if($admin_index){
Header("Location: login/login.php");
}
else{
Header("Location: ../login/login.php");
}
exit;
}else{
$admincp_ok = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name' and admin_pass='$metinfo_admin_pass'");
if (!$admincp_ok){
if($admin_index){
Header("Location: login/login.php");
}
else{
Header("Location: ../login/login.php");
}
exit;
}
}
}
}
?>
