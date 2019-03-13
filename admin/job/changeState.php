<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$backurl="index.php?lang=$lang&class1=$class1&class2=$class2&class3=$class3";
$job_list = $db->get_one("SELECT * FROM $met_job WHERE id='$id'");
if(!$job_list){
okinfo($backurl,$lang_dataerror);
}
$query = "update $met_job SET ";
if(isset($top_ok))
{
	$top_ok=$top_ok==1?0:1;
	$query = $query."top_ok             = '$top_ok',";
}

$query = $query."id='$id' where id='$id'";

$db->query($query);
okinfo($backurl,$lang_jsok);


# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
