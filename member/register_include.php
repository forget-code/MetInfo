<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../include/common.inc.php';
$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
if($met_member_login==0)
{
okinfo('login_member.php?lang='.$lang,"$lang_js3");
exit();
}
if($met_webhtm==0){
$member_index_url="index.php?lang=".$lang;
}else{
$member_index_url="index".$met_htmtype;
}
if($met_member_login==2 && isset($username) && isset($code))
{
$username=daddslashes($username);
$admin_list=$db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$username'");
if(!$admin_list){
okinfo($member_index_url,$lang_js4);
exit();
}


$array = explode("-",$admin_list['admin_register_date']);
$year = $array[0];
$month = $array[1];
$array = explode(":",$array[2]);
$minute = $array[1];
$second = $array[2];
$array = explode(" ",$array[0]);
$day = $array[0];
$hour = $array[1];
$timestamp = mktime($hour,$minute,$second,$month,$day,$year);

if(md5($timestamp)==$code)
{
	$query = "update $met_admin_table SET checkid=1 where admin_id='$username'";
	$db->query($query);
	okinfo($member_index_url,$lang_js5);
	exit();
}
okinfo($member_index_url,$lang_js4);
exit();
}

include templatemember('register');
footermember();

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>