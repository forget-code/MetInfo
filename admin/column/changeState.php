<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$backurl="../column/index.php?lang=$lang";
$admin_list = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
if(!$admin_list){
okinfox($lang_loginNoid,$backurl);
}
$query = "update $met_column SET ";
if(isset($wap_ok))
{
	$wap_ok=$wap_ok==1?0:1;
	$query = $query."wap_ok             = '$wap_ok',";
}

$query = $query."id='$id' where id='$id'";
$db->query($query);
okinfo($backurl);

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
