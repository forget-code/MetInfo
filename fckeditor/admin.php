<?php
# 文件名称:login_check.php 2009-08-15 14:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once '../include/common.inc.php';
		  session_start();
		  $metinfo_admin_name=$_SESSION['metinfo_admin_name'];
          $metinfo_admin_pass=$_SESSION['metinfo_admin_pass'];

  $admincp_ok = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name' and admin_pass='$metinfo_admin_pass' and usertype='3'");
     if (!$admincp_ok){
		session_unset();
        $met_js_ac="<script type='text/javascript'> alert('".$lang_access."'); location.href='../../../../../'; </script>";
        }
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>

$met_js="<?php echo $met_js_ac;?>";
document.write($met_js) ;