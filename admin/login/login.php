<?php
# 文件名称:login.php 2009-08-15 16:05:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
$admin_index=FALSE;
require_once '../include/common.inc.php';
$admincp_ok = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name' and admin_pass='$metinfo_admin_pass'");
if($metinfo_admin_name&&$metinfo_admin_pass&&$admincp_ok){
Header("Location: ../index.php");
}
else{
if($met_admin_type_ok==0)$met_admin_type_display="none";
$met_admin_type_select[$langusenow]="selected='selected'";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('login');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>