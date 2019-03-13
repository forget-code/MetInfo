<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
$backurl="cv.php?lang=".$lang;
$query = "select * from $met_parameter where lang='$lang' and module='6' and type='5' order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)){
$para_list[]=$list;
}
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){

if($met_deleteimg){
foreach($para_list as $key=>$val1){
$imagelist=$db->get_one("select * from $met_plist where lang='$lang' and  paraid='$val1[id]' and listid='$val'");
file_unlink("../".$imagelist[info]);
}
}
$query = "delete from $met_plist where listid='$val' and module='6'";
$db->query($query);
$query = "delete from $met_cv where id='$val'";
$db->query($query);
}
okinfo($backurl,$lang_jsok);
}elseif($action=='deljobs')
{
	$alljobidlist=explode(',',$alljobid);	
	foreach($alljobidlist as $key=>$val){
    if($met_deleteimg){
     foreach($para_list as $key=>$val1){
    $imagelist=$db->get_one("select * from $met_plist where lang='$lang' and  paraid='$val1[id]' and listid='$val'");
    file_unlink("../".$imagelist[info]);
    }
    }
    $query = "delete from $met_plist where listid='$val' and module='6'";
    $db->query($query);	
	$query = "delete from $met_cv where jobid='$val'";
	$db->query($query);
	}
	okinfo("index.php?class1=$class1&lang=$lang",$lang_jsok);
}
elseif($action=='deljob')
{
	$cv_list = $db->get_one("SELECT * FROM $met_cv WHERE jobid='$jobid'");
	if(!$cv_list){
	okinfo("index.php?class1=$class1&lang=$lang",$lang_cvTip5);
	}
    if($met_deleteimg){
     foreach($para_list as $key=>$val){
    $imagelist=$db->get_one("select * from $met_plist where lang='$lang' and  paraid='$val[id]' and listid='$jobid'");
    file_unlink("../".$imagelist[info]);
    }
    }
    $query = "delete from $met_plist where listid='$jobid' and module='6'";
    $db->query($query);	
	$query = "delete from $met_cv where jobid='$jobid'";
	$db->query($query);
	okinfo("index.php?class1=$class1&lang=$lang",$lang_jsok);
}else{
//delete images
if($met_deleteimg){
foreach($para_list as $key=>$val){
$imagelist=$db->get_one("select * from $met_plist where lang='$lang' and  paraid='$val[id]' and listid='$id'");
file_unlink("../".$imagelist[info]);
}
}
$query = "delete from $met_plist where listid='$id' and module='6'";
$db->query($query);
$query = "delete from $met_cv where id='$id'";
$db->query($query);
okinfo($backurl,$lang_jsok);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
