<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
indexhtm();
okinfo('index_set.php?lang='.$lang,$lang_jsok);
}
else
{
$index = $db->get_one("SELECT * FROM $met_index where lang='$lang' ");

$cssfile="../../templates/".$met_skin_user."/images/css/css.inc.php";
if(file_exists($cssfile)){
require_once $cssfile;
}

$online_type1[$index_online_type]="checked='checked'";
$link_ok1[$index_link_ok]="checked='checked'";
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('index_set');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>