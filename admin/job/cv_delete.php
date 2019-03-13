<?php
# 文件名称:cv_delete.php 2009-08-13 15:15:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
$backurl="cv.php";
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$query = "delete from $met_cv where id='$val'";
$db->query($query);
}
okinfo($backurl,$lang_loginUserAdmin);
}elseif($action=='deljobs')
{
	$alljobidlist=explode(',',$alljobid);	
	foreach($alljobidlist as $key=>$val){
	$query = "delete from $met_cv where jobid='$val'";
	$db->query($query);
	}
	okinfo("index.php?class1=$class1",$lang_loginUserAdmin);
}
elseif($action=='deljob')
{
	$cv_list = $db->get_one("SELECT * FROM $met_cv WHERE jobid='$jobid'");
	if(!$cv_list){
	okinfo("index.php?class1=$class1",$lang_cvTip5);
	}
	$query = "delete from $met_cv where jobid='$jobid'";
	$db->query($query);
	okinfo("index.php?class1=$class1",$lang_loginUserAdmin);
}
else{
$cv_list = $db->get_one("SELECT * FROM $met_cv WHERE id='$id'");
if(!$cv_list){
okinfo($backurl,$lang_loginNoid);
}
$query = "delete from $met_cv where id='$id'";
$db->query($query);
okinfo($backurl,$lang_loginUserAdmin);
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>
