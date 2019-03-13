<?php
# 文件名称:register.php 2009-08-17 08:57:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
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
$member_index_url=($lang=="en")?"index".$met_e_htmtype:(($lang=="other")?"index".$met_o_htmtype:"index".$met_c_htmtype);
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

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>