<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$backurl="../article/content.php?lang=$lang";
$filename=preg_replace("/\s/","_",trim($filename)); 
$filenameold=preg_replace("/\s/","_",trim($filenameold));    
if($action=="add"){
if($filename!=''){
	$filenameok = $db->get_one("SELECT * FROM $met_news WHERE class1='$class1' and filename='$filename'");
	if($filenameok)okinfox($backurl."&action=$action&class1=$class1",$lang_modFilenameok);
}
$access=$access<>""?$access:"0";
$query = "INSERT INTO $met_news SET
                      title              = '$title',
					  keywords           = '$keywords',
					  description        = '$description',
					  content            = '$content',
					  class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',
					  img_ok             = '$img_ok',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',
				      com_ok             = '$com_ok',
				      wap_ok             = '$wap_ok',
					  issue              = '$issue',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime',
					  access          	 = '$access',
					  filename       	 = '$filename',
					  no_order       	 = '$no_order',
					  lang          	 = '$lang',
					  top_ok             = '$top_ok'";
         $db->query($query);
//html
$later_news=$db->get_one("select * from $met_news where updatetime='$updatetime' and lang='$lang'");
$id=$later_news[id];
$htmjs = contenthtm($class1,$id,'shownews',$filename);
$htmjs.= indexhtm();
$htmjs.= classhtm($class1,$class2,$class3);
okinfoh('../article/index.php?lang='.$lang.'&class1='.$class1,$htmjs);
}

if($action=="editor"){
if($filename!='' && $filename != $filenameold){
	$filenameok = $db->get_one("SELECT * FROM $met_news WHERE class1='$class1' and filename='$filename'");
	if($filenameok)okinfox($backurl."&action=$action&id=$id",$lang_modFilenameok);
}
$query = "update $met_news SET 
                      title              = '$title',
					  keywords           = '$keywords',
					  description        = '$description',
					  content            = '$content',
                      class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',";
if($metadmin[newsimage])$query .= "					  
					  img_ok             = '$img_ok',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',";
if($metadmin[newscom])$query .= "	
				      com_ok             = '$com_ok',";
					  $query .= "
					  wap_ok             = '$wap_ok',
					  issue              = '$issue',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime',";
if($met_member_use)  $query .= "
					  access			 = '$access',";
if($metadmin[pagename])  $query .= "
					  filename       	 = '$filename',";
					  $query .= "
					  top_ok             = '$top_ok',
					  no_order       	 = '$no_order',
					  lang               = '$lang'
					  where id='$id'";
$db->query($query);
//html
$htmjs = contenthtm($class1,$id,'shownews',$filename);
$htmjs.= indexhtm();
$htmjs.= classhtm($class1,$class2,$class3);
if($filenameold<>$filename and $metadmin[pagename])deletepage($met_class[$class1][foldername],$id,'shownews',$updatetimeold,$filenameold);
okinfoh('../article/index.php?lang='.$lang.'&class1='.$class1,$htmjs);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
