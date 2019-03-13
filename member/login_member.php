<?php
# 文件名称:login.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.

$admin_index=FALSE;
session_start();
$metinfo_member_name     =($_SESSION['metinfo_admin_name']=="")?$_SESSION['metinfo_member_name']:$_SESSION['metinfo_admin_name'];
$metinfo_member_pass     =($_SESSION['metinfo_admin_pass']=="")?$_SESSION['metinfo_member_pass']:$_SESSION['metinfo_admin_pass'];
$metinfo_member_type     =($_SESSION['metinfo_admin_type']=="")?$_SESSION['metinfo_member_type']:$_SESSION['metinfo_admin_type'];
$metinfo_admin_name     =$_SESSION['metinfo_admin_name'];
session_unset();
$_SESSION['metinfo_member_name']=$metinfo_member_name;
$_SESSION['metinfo_member_pass']=$metinfo_member_pass;
$_SESSION['metinfo_member_type']=$metinfo_member_type;
$_SESSION['metinfo_admin_name']=$metinfo_admin_name;
require_once '../include/common.inc.php';
$admincp_ok = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_member_name' and admin_pass='$metinfo_member_pass' and usertype<3");
if($metinfo_member_name&&$metinfo_member_pass&&$admincp_ok){
     session_unset();
Header("Location:basic.php?lang=$lang");
}
else{
$css_url="templates/met/css";
$img_url="templates/met/images";
include templatemember('login');

footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
}