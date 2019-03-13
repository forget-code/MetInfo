<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';

$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE id='$id'");
if(!$admin_list){
okinfox('../member/index.php?lang='.$lang,$lang_dataerror);
}
switch($admin_list['usertype'])
{
	case '1':$access1="selected='selected'";break;
	case '2':$access2="selected='selected'";break;
	default:$access1="selected='selected'";break;
}
$checkid=$admin_list['checkid']=="1"?$lang_yes:$lang_no;
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('member_detail');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>