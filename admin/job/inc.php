<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.  
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
$url='../job/inc.php?lang='.$lang;
okinfoh($url,onepagehtm('job','cv',1));
}else{
	$metcv= parse_ini_file(ROOTPATH."job/config_".$lang.".inc.php");
	$query = "SELECT * FROM $met_parameter where module=6 and lang='$lang' order by no_order";
	$result = $db->query($query);
	while($list= $db->fetch_array($result)){
		$cv_para[$list[type]][]=$list;
	}
	$met_cv_type1[$metcv['met_cv_type']]="checked='checked'";
	$met_cv_emtype1[$metcv['met_cv_emtype']]="checked='checked'";
@extract($metcv);
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('job_inc');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>