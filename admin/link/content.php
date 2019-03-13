<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=='editor'){
$link_list=$db->get_one("select * from $met_link where id='$id'");
if(!$link_list){
okinfo('index.php?$lang='.$lang,$lang_dataerror);
}
$link_type[$link_list[link_type]]="checked='checked'";
$link_lang[$link_list[link_lang]]="checked='checked'";
$show_ok1=$link_list[show_ok]?"checked='checked'":"";
$com_ok1=$link_list[com_ok]?"checked='checked'":"";
}else{
$link_list[weburl]="http://";
$link_list[weblogo]="http://";
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('link_content');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>