<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';

$backurl="../job/index.php?lang=$lang&class1=$class1";
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$query = "delete from $met_job where id='$val'";
$db->query($query);
}
okinfo($backurl);
}elseif($action=="editor"){
	$allidlist=explode(',',$allid);
	foreach($allidlist as $key=>$val){
		$no_order = "no_order_$val";
		$no_order = $$no_order;
		$query = "update $met_job SET
			no_order       	 = '$no_order',
			lang               = '$lang'
			where id='$val'";
		$db->query($query);
	}
	okinfo($backurl);
}else{
$admin_list = $db->get_one("SELECT * FROM $met_job WHERE id='$id'");
$query = "delete from $met_job where id='$id'";
$db->query($query);

$meturn="../job/cv_delete.php?lang=$lang&action=deljob&jobid=$id&class1=$class1";
okinfot($backurl,$meturn,$lang_js32);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
