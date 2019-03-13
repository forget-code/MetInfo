<?php
# 文件名称:login_out.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
if($met_webhtm==0){
$member_index_url="login.php?lang=".$lang;
}else{
$member_index_url=($lang=="en")?"login".$met_e_htmtype:(($lang=="other")?"login".$met_o_htmtype:"login".$met_c_htmtype);
}
session_start();
		  $_SESSION['metinfo_admin_name'] ='';
          $_SESSION['metinfo_admin_pass'] ='';
		  $_SESSION['metinfo_admin_time'] ='';
		  $_SESSION['metinfo_admin_type'] ='';
		  $_SESSION['metinfo_admin_pop']  ='';
		  $_SESSION['metinfo_member_name'] ='';
          $_SESSION['metinfo_member_pass'] ='';		  
		  $_SESSION['metinfo_member_type'] ='';
		  if(isset($_COOKIE['ps'])) setcookie("ps", "", mktime()-86400*7, "/");
Header("Location: $member_index_url");
exit;
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
