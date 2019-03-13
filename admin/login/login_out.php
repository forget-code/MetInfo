<?php
# 文件名称:login_out.php 2009-08-15 14:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
session_start();
		  $_SESSION['metinfo_admin_name'] ='';
          $_SESSION['metinfo_admin_pass'] ='';
		  $_SESSION['metinfo_admin_time'] ='';
		  $_SESSION['metinfo_admin_pop']  ='';
		  $_SESSION['metinfo_admin_type'] ='';
		  if(isset($_COOKIE['PHPSESSID'])) setcookie("PHPSESSID", "", mktime()-86400*7, "/");
Header("Location: login.php");
exit;
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>
