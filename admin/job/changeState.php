<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$job_list = $db->get_one("SELECT * FROM $met_job WHERE id='$id'");
if(!$job_list){
return false;
}
$query = "update $met_job SET ";
if(isset($top_ok)){
	$top_ok=$top_ok==1?0:1;
	$text=$top_ok==1?$lang_yes : $lang_no;
	$query = $query."top_ok             = '$top_ok',";
}
$query = $query."id='$id' where id='$id'";
$db->query($query);
okinfo("../job/index.php?lang=$lang&class1=$class1");

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
