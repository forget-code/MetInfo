<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.  
require_once '../login/login_check.php';
	$fnam=$db->get_one("SELECT * FROM $met_column WHERE id='$class1' and lang='$lang'");
	$foldename = $fnam['foldername'];
if($action=="modify"){	
	require_once 'configsave.php';
	onepagehtm($foldename,'index',1,$htmpack,$fnam['filename'],$class1);
	okinfo('../feedback/inc.php?lang='.$lang.'&class1='.$class1);
}else{
	$settings = parse_ini_file('../../'.$foldename.'/config_'.$lang.'.inc.php');
	@extract($settings);
	$query = "SELECT * FROM $met_parameter where module=8 and lang='$lang' and class1='$class1' order by no_order";
	$result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$fd_para[$list[type]][]=$list;
	}
	$met_fd_type1[$met_fd_type]="checked='checked'";
	$met_fd_back1=($met_fd_back)?"checked='checked'":"";
	$css_url="../templates/".$met_skin."/css";
	$img_url="../templates/".$met_skin."/images";
	include template('fd_inc');
	footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>