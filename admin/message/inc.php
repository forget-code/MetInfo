<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
onepagehtm('message','message');
classhtm('message',0,0);
okinfo('inc.php?lang='.$lang,$lang_jsok);
}
else{
$settings = parse_ini_file('../../message/config_'.$lang.'.inc.php');
@extract($settings);
$met_fd_email1=($met_fd_email)?"checked='checked'":"";
$met_fd_type1=($met_fd_type)?"checked='checked'":"";
$met_fd_back1=($met_fd_back)?"checked='checked'":"";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('message_inc');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
}
?>