<?php
# 文件名称:sysadmin.php 2009-08-15 16:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
$admin_list = $db->get_one("SELECT * FROM met_admin_table WHERE admin_id='$metinfo_admin_name'");
foreach($admin_list as $_key => $_value) {
$$_key = daddslashes($_value);
}
$SERVER_SIGNATURE1=$_SERVER['SERVER_SIGNATURE'];
$mysql1=mysql_get_server_info();
//if(PATH_SEPARATOR!=':')$jmail =( new COM('JMail.Message') )?'<b>√</b>':'<font color=red><b>×</b></font>' ;
$feedback = $db->counter($met_feedback, " where readok=0 ", "*");
$message = $db->counter($met_message, " where readok=0 ", "*"); 
$link = $db->counter($met_link, " where show_ok=0 ", "*");
$member = $db->counter($met_admin_table, " where admin_approval_date is null and usertype<3 ", "*");
include template('sysadmin');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>