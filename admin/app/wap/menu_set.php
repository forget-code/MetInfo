<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
$depth='../';
require_once $depth.'../login/login_check.php';
require_once $depth.'../include/pager.class.php';

if($action=='modify'){
	if($met_menu_rgb==5){
		if($menu_textbg_metinfo!=null){
		$met_menu_rgb=$menu_textbg_metinfo;
	}else{
		$met_menu_rgb='#014C8D';
		}
	}
	if($met_menu_rgb==6){
		$met_menu_rgb=$met_menu_bg;
	}
	if(!$met_menu_textbg){
		$met_menu_textbg='#ffffff';
	}
    $querys = "UPDATE $met_config SET `value`='$met_menu_ok' where name='met_menu_ok' and lang='$lang'";
	$db->query($querys);
	$querys = "UPDATE $met_config SET `value`='$met_menu_oks' where name='met_menu_oks' and lang='$lang'";
	$db->query($querys);
	$querys = "UPDATE $met_config SET `value`='$met_menu_rgb' where name='met_menu_rgb' and lang='$lang'";
	$db->query($querys);
	$querys = "UPDATE $met_config SET `value`='$met_menu_bg' where name='met_menu_bg' and lang='$lang'";
	$db->query($querys);
	$querys = "UPDATE $met_config SET `value`='$met_menu_textbg' where name='met_menu_textbg' and lang='$lang'";
	$db->query($querys);
metsave('../app/wap/menu_set.php?anyid='.$anyid.'&cs='.$cs.'&lang='.$lang,'操作成功',$depth);
}

$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template('app/wap/menu_set');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>