<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
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
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>

$met_js="<?php echo $met_js_ac;?>";
document.write($met_js) ;