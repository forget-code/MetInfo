<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="modify"){ 
$filename=preg_replace("/\s/","_",trim($filename)); 
if($filename!='' && $filename != $filenameold){
	$filenameok = $db->get_one("SELECT * FROM $met_column WHERE filename='$filename'");
	if($filenameok)okinfox('../about/about.php?lang='.$lang.'&id='.$id,$lang_modFilenameok);
}
$query = "update $met_column SET 
                      content     = '$content',
					  keywords    = '$keywords',
					  filename    = '$filename',
					  ctitle      = '$ctitle',
					  description = '$description'
					  where id='$id'";
$db->query($query);
okinfoh('../about/about.php?lang='.$lang.'&id='.$id,showhtm($id));
}
else{
$about = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
if(!$about){
okinfox('../site/sysadmin.php?lang='.$lang,$lang_dataerror);
}
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('about');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>