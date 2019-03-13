<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once 'login_check.php';
$message_list=$db->get_one("select * from $met_message where id='$id'");
if(!$message_list){
okinfo('message.php?lang='.$lang,$lang_js1);
}
$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('message_detail');
footermember();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>