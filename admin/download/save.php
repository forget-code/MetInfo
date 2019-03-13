<?php
# 文件名称:save.php 2009-08-11 16:47:13
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
if($action=="add"){

$query = "SELECT * FROM $met_parameter where type=4 order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
if($list[use_ok]==1)$list_p[]=$list;
}
$query = "INSERT INTO $met_download SET
                      c_title            = '$c_title',
                      e_title            = '$e_title',
					  o_title            = '$o_title',
					  c_keywords         = '$c_keywords',
					  e_keywords         = '$e_keywords',
					  o_keywords         = '$o_keywords',
					  c_description      = '$c_description',
					  e_description      = '$e_description',
					  o_description      = '$o_description',
					  c_content          = '$c_content',
					  e_content          = '$e_content',
					  o_content          = '$o_content',
					  class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',
					  new_ok             = '$new_ok',
					  downloadurl        = '$downloadurl',
					  filesize           = '$filesize',
				      com_ok             = '$com_ok',
					  hits               = '$hits', 
					  issue              = '$metinfo_admin_name',
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime',
					  access         	 = '$access',
					  downloadaccess     = '$downloadaccess',";
foreach($list_p as $key=>$val)
{		  
$tmp="c_$val[name]";
$query = $query."
				  $tmp            	= '{$$tmp}', 
				  ";
$tmp="e_$val[name]";
$query = $query."
				  $tmp            	= '{$$tmp}', 
				  ";
$tmp="o_$val[name]";
$query = $query."
				  $tmp            	= '{$$tmp}', 
				  ";
}
$query = $query." top_ok         	 = '$top_ok'";
         $db->query($query);
//静态页面生成
$later_download=$db->get_one("select * from $met_download where updatetime='$updatetime'");
$id=$later_download[id];
contenthtm($class1,$id,'showdownload');
indexhtm();
classhtm($class1,$class2,$class3);
okinfo('index.php?class1='.$class1,$lang_loginUserAdmin);
}

if($action=="editor"){
$query = "SELECT * FROM $met_parameter where type=4 order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
if($list[use_ok]==1)$list_p[]=$list;
}
$query = "update $met_download SET ";
if($met_c_lang_ok==1){
$query = $query."
                      c_title            = '$c_title',
					  c_keywords         = '$c_keywords',
					  c_description      = '$c_description',
					  c_content          = '$c_content',"
					  ;
	foreach($list_p as $key=>$val)
	{		  
	$tmp="c_$val[name]";
	$query = $query."
					  $tmp            	= '{$$tmp}', 
					  ";			
	}					  
}
if($met_e_lang_ok==1){
$query = $query."
                      e_title            = '$e_title',
					  e_keywords         = '$e_keywords',
					  e_description      = '$e_description',
					  e_content          = '$e_content',"
					  ;
	foreach($list_p as $key=>$val)
	{		  
	$tmp="e_$val[name]";
	$query = $query."
					  $tmp            	= '{$$tmp}', 
					  ";			
	}				  
}
if($met_o_lang_ok==1){
$query = $query."
                      o_title            = '$o_title',
					  o_keywords         = '$o_keywords',
					  o_description      = '$o_description',
					  o_content          = '$o_content',"
					  ;
					  
	foreach($list_p as $key=>$val)
	{		  
	$tmp="o_$val[name]";
	$query = $query."
					  $tmp            	= '{$$tmp}', 
					  ";			
	}
}
$query = $query."
					  class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',
					  new_ok             = '$new_ok',
					  downloadurl        = '$downloadurl',
					  filesize           = '$filesize',
				      com_ok             = '$com_ok',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime', 
					  access         	 = '$access',
					  downloadaccess     = '$downloadaccess',
					  top_ok         	 = '$top_ok'
					  where id='$id'";

$db->query($query);
//静态页面生成
contenthtm($class1,$id,'showdownload');
indexhtm();
classhtm($class1,$class2,$class3);
okinfo('index.php?class1='.$class1,$lang_loginUserAdmin);
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
