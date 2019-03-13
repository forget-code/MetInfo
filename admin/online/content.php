<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=='editor'){
$online_list=$db->get_one("select * from $met_online where id='$id'");
if(!$online_list){
okinfo('index.php?lang='.$lang,$lang_dataerror);
}
$lang_onlineaddTitle=$lang_onlineeditorTitle;
}
echo $lang_onlineTip2;
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('online_content');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>