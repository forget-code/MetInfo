<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$backurl="../link/index.php?lang=".$lang;
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$query = "delete from $met_link where id='$val'";
$db->query($query);
}
$htmljs = onepagehtm('link','index');
$htmljs.= indexhtm();
okinfoh($backurl,$htmljs);
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_link WHERE id='$id'");
if(!$admin_list){
okinfox($backurl,$lang_dataerror);
}
$query = "delete from $met_link where id='$id'";
$db->query($query);
$htmljs = onepagehtm('link','index');
$htmljs.= indexhtm();
okinfoh($backurl,$htmljs);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
