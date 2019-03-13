<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="modify"){ 
$query = "update $met_column SET 
                      content     = '$content',
					  keywords    = '$keywords',
					  description = '$description'
					  where id='$id'";
$db->query($query);
//html
showhtm($id);
okinfo('about.php?lang='.$lang.'&id='.$id,$lang_jsok);
}
else{
$about = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
if(!$about){
okinfo('../site/sysadmin.php?lang='.$lang,$lang_dataerror);
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