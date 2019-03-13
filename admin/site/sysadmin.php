<?php
require_once '../login/login_check.php';
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
$admin_list = $db->get_one("SELECT * FROM met_admin_table WHERE admin_id='$metinfo_admin_name'");
foreach($admin_list as $_key => $_value) {
$$_key = daddslashes($_value);
}
$SERVER_SIGNATURE1=$_SERVER['SERVER_SIGNATURE'];
$mysql1=mysql_get_server_info();
if(PATH_SEPARATOR!=':')$jmail =( new COM('JMail.Message') )?'<b>√</b>':'<font color=red><b>×</b></font>' ;
$feedback = $db->counter($met_feedback, " where readok=0 ", "*");
$message = $db->counter($met_message, " where readok=0 ", "*"); 
$link = $db->counter($met_link, " where show_ok=0 ", "*");
include template('sysadmin');
footer();
?>