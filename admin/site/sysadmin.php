<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
$admin_list = $db->get_one("SELECT * FROM met_admin_table WHERE admin_id='$metinfo_admin_name'");
foreach($admin_list as $_key => $_value) {
$$_key = daddslashes($_value);
}
$SERVER_SIGNATURE1=$_SERVER['SERVER_SIGNATURE'];
$mysql1=mysql_get_server_info();
$feedback = $db->counter($met_feedback, " where readok=0 and lang='$lang' ", "*");
$message = $db->counter($met_message, " where readok=0 and lang='$lang' ", "*"); 
$link = $db->counter($met_link, " where show_ok=0 and lang='$lang' ", "*");
$member = $db->counter($met_admin_table, " where admin_approval_date is null and lang='$lang' and usertype<3 ", "*");
include template('sysadmin');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>