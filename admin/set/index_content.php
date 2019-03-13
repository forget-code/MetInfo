<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="modify"){
$query = "update $met_index SET content= '$content' where id='$id'";
if($id=="")$query = "INSERT INTO $met_index SET content= '$content', lang='$lang'";
$db->query($query);
okinfoh('index_content.php?lang='.$lang,indexhtm());
}else{
$index = $db->get_one("SELECT * FROM $met_index where lang='$lang' ");
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('index_content');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>