<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="modify"){
	$dltimg=explode('../',$met_wate_img);
	if(count($dltimg)==2){
			$met_wate_img   = "../".$met_wate_img;
	}
	$dltimg1=explode('../',$met_wate_bigimg);
	if(count($dltimg1)==2){
			$met_wate_bigimg   = "../".$met_wate_bigimg;
	}
	require_once 'configsave.php';
	okinfo('img.php?lang='.$lang);
}else{

if($met_img_style==0)$met_img_style0="checked='checked'";
if($met_img_style==1)$met_img_style1="checked='checked'";
if($met_big_wate==1)$met_big_wate1="checked='checked'";
if($met_thumb_wate==1)$met_thumb_wate1="checked='checked'";
if($met_autothumb_ok==1)$met_autothumb_ok1="checked='checked'";
if($met_wate_class==1)$met_wate_class1="checked='checked'";
if($met_wate_class==2)$met_wate_class2="checked='checked'";
if($met_deleteimg==1)$met_deleteimg1="checked='checked'";
switch($met_watermark){
case 0:
$met_watermark0="checked='checked'";
break;
case 1:
$met_watermark1="checked='checked'";
break;
case 2:
$met_watermark2="checked='checked'";
break;
case 3:
$met_watermark3="checked='checked'";
break;
case 4:
$met_watermark4="checked='checked'";
break;
case 5:
$met_watermark5="checked='checked'";
break;
case 6:
$met_watermark6="checked='checked'";
break;
case 7:
$met_watermark7="checked='checked'";
break;
case 8:
$met_watermark8="checked='checked'";
break;
}

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_img');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>