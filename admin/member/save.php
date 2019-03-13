<?php
# 文件名称:save.php 2009-08-15 08:32:13
# MetInfo企业网站管理系统
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';

if(!isset($checkid)) $checkid=0;

if($action=="add"){

$admin_if=$db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$useid'");
if($admin_if){
okinfo('javascript:history.back();',$lang_loginUserMudb1);
}
$pass1=md5($pass1);
 $query = "INSERT INTO $met_admin_table SET
                      admin_id           = '$useid',
                      admin_pass         = '$pass1',
					  admin_name         = '$name',
					  admin_sex          = '$sex',
					  admin_tel          = '$tel',
					  admin_mobile       = '$mobile',
					  admin_email        = '$email',
					  admin_qq           = '$qq',
					  admin_msn          = '$msn',
					  admin_taobao       = '$taobao',
					  admin_introduction = '$admin_introduction',
					  admin_register_date= '$m_now_date',
					  admin_approval_date= '$m_now_date',
					  usertype			 = '$usertype',
					  companyname		 = '$companyname',
					  companyaddress     = '$companyaddress',
					  companyfax	     = '$companyfax',
					  companycode	     = '$companycode',
					  companywebsite     = '$companywebsite',
					  checkid            = '$checkid'";
         $db->query($query);
okinfo('index.php',$lang_loginUserAdmin);
}

if($action=="editor"){
if(isset($checkid) && $checkid==1) $approval_date=$m_now_date;
else $approval_date='';
$query = "update $met_admin_table SET
                      admin_id           = '$useid',
					  admin_name         = '$name',
					  admin_sex          = '$sex',
					  admin_tel          = '$tel',
					  admin_mobile       = '$mobile',
					  admin_email        = '$email',
					  admin_qq           = '$qq',
					  admin_msn          = '$msn',
					  admin_taobao       = '$taobao',
					  admin_introduction = '$admin_introduction',
					  admin_approval_date= '$approval_date',
					  usertype			 = '$usertype',
					  companyname		 = '$companyname',
					  companyaddress     = '$companyaddress',
					  companyfax	     = '$companyfax',
					  companycode	     = '$companycode',
					  companywebsite     = '$companywebsite',
					  checkid            = '$checkid'";

if($pass1){
$pass1=md5($pass1);
$query .=", admin_pass         = '$pass1'";
}
$query .="  where id='$id'";
$db->query($query);
if($editorpass!=1){
okinfo('index.php',$lang_loginUserAdmin);
}
else
{
okinfo('editor_pass.php?id='.$id,$lang_loginUserAdmin);
}
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>
