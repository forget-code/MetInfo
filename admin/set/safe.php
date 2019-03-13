<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$adminfile=$url_array[count($url_array)-2];
if($action=="delete"){
	if($filename=='update')@chmod('../../update/install.lock',0777);
	function deldirs($dir){
	  $dh=opendir($dir);
	  while ($file=readdir($dh)) {
		if($file!="." && $file!="..") {
		  $fullpath=$dir."/".$file;
		  if(!is_dir($fullpath)) {
			  unlink($fullpath);
		  } else {
			  deldir($fullpath);
		  }
		}
	}

	  closedir($dh);
	  if($dir!='../../upload'){
		if(rmdir($dir)) {
		return true;
		} else {
		return false;
		}
		}
	} 
	$dir='../../'.$filename;
	deldirs($dir);
	okinfo('safe.php?lang='.$lang);
}

if($action=="modify"){
	$langp=$lang;
	require_once 'configsave.php';
	$con_save   = "<?php
                   /*
                   con_db_host = \"$con_db_host\"
                   con_db_id   = \"$con_db_id\"
                   con_db_pass = \"$con_db_pass\"
                   con_db_name = \"$con_db_name\"
                   tablepre    = \"$tablepre\"
				   met_sqlreplace = \"$met_sqlreplace\";
                   db_charset  = \"$db_charset\";
                  */
                  ?>";
	@chmod('../../config/config_db.php',0777);
	$fpd = fopen("../../config/config_db.php",w);
	fputs($fpd, $con_save);
	fclose($fpd);
	@chmod('../../config/config_db.php',0554);
	if($met_adminfile!=""&&$met_adminfile!=$adminfile){
		Header("Location: ../index.php?lang=".$lang."&action=renameadmin&met_adminfile=".$met_adminfile);
		//okinfo("../index.php?lang=$lang&action=renameadmin&met_adminfile=$met_adminfile",'admin');
	}else{
		okinfo('safe.php?lang='.$lang);
	}
}
else{
if(is_dir('../../install')){
//$installstyle="display:block;";
 }else{
 $installstyle="display:none;";
 }
 if(is_dir('../../update')){
//$updatestyle="display:block;";
 }else{
 $updatestyle="display:none;";
 }
$met_sqlreplace=intval($met_sqlreplace);
$met_login_code1[$met_login_code]="checked='checked'";
$met_memberlogin_code1[$met_memberlogin_code]="checked='checked'";
$met_submit_type1[$met_submit_type]="checked='checked'";
$met_sqlreplace1[$met_sqlreplace]="checked='checked'";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_safe');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>