<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$filename=preg_replace("/\s/","_",trim($filename)); 
$filenameold=preg_replace("/\s/","_",trim($filenameold));    
if($action=="add"){
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
					  issue              = '$issue',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime',
					  access          	 = '$access',
					  filename       	 = '$filename',
					  lang          	 = '$lang',
					  top_ok             = '$top_ok'";
         $db->query($query);
//html
$later_news=$db->get_one("select * from $met_news where updatetime='$updatetime' and lang='$lang'");
$id=$later_news[id];
contenthtm($class1,$id,'shownews',$filename);
indexhtm();
classhtm($class1,$class2,$class3);

okinfo('index.php?lang='.$lang.'&class1='.$class1,$lang_jsok);
}

if($action=="editor"){
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
					  lang               = '$lang'
					  where id='$id'";
$db->query($query);
//html
contenthtm($class1,$id,'shownews',$filename);
indexhtm();
classhtm($class1,$class2,$class3);
if($filenameold<>$filename and $metadmin[pagename])deletepage($met_class[$class1][foldername],$id,'shownews',$updatetimeold,$filenameold);
okinfo('index.php?lang='.$lang.'&class1='.$class1,$lang_jsok);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
