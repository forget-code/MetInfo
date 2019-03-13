<?php
# 文件名称:editor.php 2009-08-15 16:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$link_list=$db->get_one("select * from $met_link where id='$id'");
if(!$link_list){
okinfo('index.php',$lang_loginNoid);
}
$link_type[$link_list[link_type]]="checked='checked'";
$link_lang[$link_list[link_lang]]="checked='checked'";
$show_ok1=$link_list[show_ok]?"checked='checked'":"";
$com_ok1=$link_list[com_ok]?"checked='checked'":"";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('link_editor');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>