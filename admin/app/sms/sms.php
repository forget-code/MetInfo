<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
require_once ROOTPATH.'include/export.func.php';
if($action=='modify'){
	if(!$message || !$phone){
		echo $lang_sms1;
		die();
	}
	$phone = implode(',',array_unique(array_filter(explode(',',str_replace("\n",",",$phone)))));/*去除重复|空值*/
	$sms = sendsms($phone,$message,1);
	echo $sms;
	die;
}elseif($action=='membertel'){
	$query = "SELECT admin_mobile FROM $met_admin_table where usertype<3 && checkid=1";
	$result = $db->query($query);
	$member_list='';
	while($list= $db->fetch_array($result)){
		if($list['admin_mobile']!='' && eregi("^1[0-9]{9}",$list['admin_mobile']) && strlen($list['admin_mobile'])==11){
			$member_list.=$list['admin_mobile'].'|';
		}
	}
	echo substr($member_list, 0, -1);
}elseif($action=='usertype'){
	$cost = uservarcode()?0.06:0.1;
	echo $cost;
}else{
	$total_passok = $db->get_one("SELECT * FROM $met_otherinfo WHERE lang='met_sms'");
	$met_file='/sms/remain.php';
	$post=array('total_pass'=>$total_passok['authpass']);
	$balance = $total_passok['authpass']?curl_post($post,30):'0.00';
	$css_url=$depth."../templates/".$met_skin."/css";
	$img_url=$depth."../templates/".$met_skin."/images";
	include template('app/sms/sms');footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>