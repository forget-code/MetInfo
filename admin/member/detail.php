<?php
# 文件名称:detail.php 2009-08-15 09:31:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';

$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE id='$id'");
if(!$admin_list){
okinfo('index.php',$lang_loginNoid);
}
switch($admin_list['usertype'])
{
	case '1':$access1="selected='selected'";break;
	case '2':$access2="selected='selected'";break;
	default:$access1="selected='selected'";break;
}
$checkid=$admin_list['checkid']=="1"?$lang_YES:$lang_NO;
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('member_detail');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>