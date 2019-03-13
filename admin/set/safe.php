<?php
# 文件名称:safe.php 2009-08-01 21:01:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
$adminfile=$url_array[count($url_array)-2];
if($action=="delete"){

function deldir($dir) {
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
deldir($dir);
okinfo('safe.php',$lang_loginUserAdmin);
}

if($action=="modify"){
require_once 'configsave.php';
 if($met_adminfile!=""&&$met_adminfile!=$adminfile){
 Header("Location: ../index.php?action=renameadmin&met_adminfile=".$met_adminfile);
 }else{
  okinfo('safe.php',$lang_loginUserAdmin);
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
$met_login_code1[$met_login_code]="checked='checked'";
$met_memberlogin_code1[$met_memberlogin_code]="checked='checked'";
$met_submit_type1[$met_submit_type]="checked='checked'";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_safe');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>