<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
$filename=preg_replace("/\s/","_",trim($filename)); 
$filenameold=preg_replace("/\s/","_",trim($filenameold)); 
if($action=="add"){
if($filename!=''){
	$filenameok = $db->get_one("SELECT * FROM $met_job WHERE filename='$filename'");
	if($filenameok)okinfox('../job/content.php?lang='.$lang."&action=$action&class1=$class1",$lang_modFilenameok);
}
$query = "INSERT INTO $met_job SET
                    position           = '$position',
					count              = '$count',
					place              = '$place',
					deal               = '$deal',
					content            = '$content',
					useful_life        = '$useful_life',
					addtime            = '$addtime',
					access			   = '$access',
					lang			   = '$lang',
					no_order		   = '$no_order',
					filename           = '$filename',
					email              = '$email',
					wap_ok             = '$wap_ok',
					top_ok             = '$top_ok'";
         $db->query($query);
//HTML		 
$later_job=$db->get_one("select * from $met_job where lang='$lang' order by id desc");
$id=$later_job[id];
$htmjs =indexhtm();
$htmjs.=contenthtm($class1,$id,'showjob',$filename,0,'job');
$htmjs.=classhtm($class1,0,0);
okinfoh('../job/index.php?lang='.$lang.'&class1='.$class1,$htmjs);
}

if($action=="editor"){
if($filename!='' && $filename != $filenameold){
	$filenameok = $db->get_one("SELECT * FROM $met_job WHERE filename='$filename'");
	if($filenameok)okinfox('../job/content.php?lang='.$lang."&action=$action&id=$id",$lang_modFilenameok);
}
$query = "update $met_job SET 
                      position           = '$position',
					  place              = '$place',
					  deal               = '$deal',
					  content            = '$content',
					  count              = '$count',
					  useful_life        = '$useful_life',
					  addtime            = '$addtime',
					  access			 = '$access',
					  no_order		     = '$no_order',";
if($metadmin[pagename])$query .= "
					  filename       	 = '$filename',";
					  $query .= "
					  email              = '$email',
					  wap_ok             = '$wap_ok',
					  top_ok             = '$top_ok'
					  where id='$id'";
$db->query($query);

//HTML
$htmjs =indexhtm();
$htmjs.=contenthtm($class1,$id,'showjob',$filename,0,'job');
$htmjs.=classhtm($class1,0,0);
if($filenameold<>$filename and $metadmin[pagename])deletepage($met_class[$class1][foldername],$id,'showjob',$updatetimeold,$filenameold);
okinfoh('../job/index.php?lang='.$lang.'&class1='.$class1,$htmjs);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
