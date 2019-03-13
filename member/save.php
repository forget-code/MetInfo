<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

require_once '../include/common.inc.php';

if($action=="add"){

	//code
     if($met_memberlogin_code==1){
         require_once 'captcha.class.php';
         $Captcha= new  Captcha();
         if(!$Captcha->CheckCode($code)){
         echo("<script type='text/javascript'> alert('$lang_membercode'); window.history.back();</script>");
		       exit;
         }
     }
	 
$admin_if=$db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$yhid'");
if($admin_if){
okinfo('javascript:history.back();',$lang_js15);
}
$checkid=0;
if($met_member_login==1)
{
	$checkid=1;
}

if($met_member_login==2)
{
$array = explode("-",$m_now_date);
$year = $array[0];
$month = $array[1];
$array = explode(":",$array[2]);
$minute = $array[1];
$second = $array[2];
$array = explode(" ",$array[0]);
$day = $array[0];
$hour = $array[1];
$timestamp = mktime($hour,$minute,$second,$month,$day,$year);

$from=$met_fd_usename;
$fromname=$met_fd_fromname;
$to=$email;
$usename=$met_fd_usename;
$usepassword=$met_fd_password;
$smtp=$met_fd_smtp;

$check=md5($timestamp);
$met_webnamearray=explode('--Powered by MetInfo',$met_webname);
$met_webname1=$met_webnamearray[0];
$title=$met_webname1.$lang_js16;
$body="$yhid,<br><br> {$met_memberemail}<br><br><b>{$lang_js17}</b>{$lang_js18}[<a href='{$met_weburl}member/register_include.php?username=$yhid&code=$check&lang=$lang'>{$lang_js16} {$met_weburl}member/register_include.php?username=$yhid&code=$check&lang=$lang</a>] {$lang_js19}<br><div align='right'>$fromname</div> ";
jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp);
}
$pass1=md5($mm);
 $query = "INSERT INTO $met_admin_table SET
                      admin_id           = '$yhid',
                      admin_pass         = '$pass1',
					  admin_tel          = '$lxdh',
					  admin_email        = '$email',
					  admin_modify_ip    = '$m_user_ip',
					  admin_register_date= '$m_now_date',
					  usertype			 = '1',
					  companyname		 = '$companyname',
					  companyaddress     = '$companyaddress',
					  companyfax	     = '$companyfax',
					  companycode	     = '$yzbm',
					  companywebsite     = '$wz',
					  lang               = '$lang',
					  checkid            = '$checkid'";
         $db->query($query);
if($met_member_login==2)
{
	okinfo('login_member.php?lang='.$lang,$lang_js20);
	exit();
}elseif($met_member_login==3){	 
okinfo('login_member.php?lang='.$lang, $lang_js25);
exit();
}
	 
okinfo('login_member.php?lang='.$lang,$lang_js21);
}

if($action=="editor"){

$query = "update $met_admin_table SET
                      admin_id           = '$useid',
					  admin_name         = '$realname',
					  admin_sex          = '$sex',
					  admin_tel          = '$tel',
					  admin_modify_ip    = '$m_user_ip',
					  admin_mobile       = '$mobile',
					  admin_email        = '$email',
					  admin_qq           = '$qq',
					  admin_msn          = '$msn',
					  admin_taobao       = '$taobao',
					  admin_introduction = '$admin_introduction',
					  admin_modify_date  = '$m_now_date',
					  companyname		 = '$companyname',
					  companyaddress     = '$companyaddress',
					  companyfax	     = '$companyfax',
					  companycode	     = '$companycode',
					  companywebsite     = '$companywebsite'";

if($pass1){
$pass1=md5($pass1);
$query .=", admin_pass         = '$pass1'";
}
$query .="  where admin_id='$useid'";
$db->query($query);
okinfo('basic.php?lang='.$lang,$lang_js21);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
