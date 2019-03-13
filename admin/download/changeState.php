<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$backurl="index.php?lang=$lang&class1=$class1&class2=$class2&class3=$class3";
if($action=="moveto")
{
	$allidlist=explode(',',$allid);
	$k=count($allidlist)-1;

	$query= "select * from $met_column where id='$class1'";
	$result1=$db->get_one($query);
	
	$query= "select * from $met_column where bigclass='$class1' and classtype=2 ";
	$result2=$db->get_one($query);
	
	$query= "select * from $met_column where bigclass='$class2' and classtype=3 ";
	$result3=$db->get_one($query);
	
	if(!$result1 || ($result2 && $class2==0) || ($result3 && $class3==0)) 
	
	{
		okinfo($backurl,$lang_dataerror);
		exit();
	}
	for($i=0;$i<$k; $i++){
	$query = "update $met_download SET";
	$query = $query."
                      class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3'";
	$query = $query." where id='$allidlist[$i]'";
	$db->query($query);
	}
okinfo($backurl,$lang_jsok);
}else
{
$admin_list = $db->get_one("SELECT * FROM $met_download WHERE id='$id'");
if(!$admin_list){
okinfo($backurl,$lang_loginNoid);
}
$query = "update $met_download SET ";
if(isset($new_ok))
{
	$new_ok=$new_ok==1?0:1;
	$query = $query."new_ok             = '$new_ok',";
}
if(isset($com_ok))
{
	$com_ok=$com_ok==1?0:1;
	$query = $query."com_ok             = '$com_ok',";
}
if(isset($top_ok))
{
	$top_ok=$top_ok==1?0:1;
	$query = $query."top_ok             = '$top_ok',";
}

$query = $query."id='$id' where id='$id'";
$db->query($query);

okinfo($backurl,$lang_jsok);
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
