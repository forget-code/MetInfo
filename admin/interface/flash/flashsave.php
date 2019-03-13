<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
$rurl='../interface/flash/flash.php?anyid='.$anyid.'&lang='.$lang.'&module='.$module."&kuaijieskin={$kuaijieskin}";
$path=($met_flash_type==2)?"flash_path":"img_path";
if($$path=='')metsave('-1',$lang_js27,$depth);
if($action=="add"){
	$module=$met_clumid_all==10002?'metinfo':$f_columnlist;
	// 添加banner属性img_title_color、img_des、img_des_color、img_text_position（新模板框架v2）
	$query = "INSERT INTO $met_flash SET
		module             = '$module',
		img_path           = '$img_path',
		img_link           = '$img_link',
		img_title          = '$img_title',
		img_title_color    = '$img_title_color',
		img_des            = '$img_des',
		img_des_color      = '$img_des_color',
		img_text_position  = '$img_text_position',
		flash_path         = '$flash_path',
		flash_back         = '$flash_back',
		no_order           = '$no_order',
		width			   = '$width',
		height			   = '$height',
		wap_ok			   = '0',
		lang               = '$lang'";
	$db->query($query);
	metsave($rurl,'',$depth);
}elseif($action=="editor"){
	$module=$met_clumid_all==10002?'metinfo':$f_columnlist;
	// 添加banner属性img_title_color、img_des、img_des_color、img_text_position（新模板框架v2）
	$query = "update {$met_flash} SET
		module             = '$module',
		img_path           = '$img_path',
		img_link           = '$img_link',
		img_title          = '$img_title',
		img_title_color    = '$img_title_color',
		img_des            = '$img_des',
		img_des_color      = '$img_des_color',
		img_text_position  = '$img_text_position',
		flash_path         = '$flash_path',
		flash_back         = '$flash_back',
		no_order           = '$no_order',
		width			   = '$width',
		height			   = '$height',
		wap_ok			   = '0',
		lang               = '$lang'
		where id='$id'";
	$db->query($query);
	metsave($rurl,'',$depth);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
