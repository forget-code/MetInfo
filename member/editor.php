<?php
# 文件名称:editor.php 2009-08-17 20:04:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 ( http://www.metinfo.cn ). All rights reserved.
require_once 'login_check.php';
$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_member_name' ");
if(!$admin_list){
okinfo($member_index_url,$lang_loginNoid);
}
$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('editor');
footermember();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 ( http://www.metinfo.cn). All rights reserved.
?>