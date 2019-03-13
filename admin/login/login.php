<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$admin_index=FALSE;
require_once '../include/common.inc.php';
$countpoint=substr_count($_SERVER[HTTP_HOST],'.');
 
   if(strstr($_SERVER[HTTP_HOST],'www') || $countpoint==1){
   	     //说明是一级域名
   	   if(strstr($met_weburl,'https')){
            $httphost="https://".$_SERVER[HTTP_HOST]."/";
   	   }else{
   	   	    $httphost="http://".$_SERVER[HTTP_HOST]."/";
   	   }
   	 
      if($httphost!=$met_weburl){

	    echo "<script>alert('请将您网站后台基本信息-网站网址修改为正式域名')</script>";   
	    
       }
   
    }else{
     	if(strstr($met_weburl,'www')){
     	  echo "<script>alert('请采用正式域名进行访问')</script>";
     	}
     }
$admincp_ok = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name' and admin_pass='$metinfo_admin_pass'");
if($metinfo_admin_name&&$metinfo_admin_pass&&$admincp_ok){
Header("Location: ../index.php");
}else{
if($met_admin_type_ok==0)$met_admin_type_display="none";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
$metinfo_mobile=false;
if($metinfo_mobile){
include template('mobile/login');
}else{
include template('login');
}
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>