<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="modify"){
	$met_weburl = ereg_replace(" ","",$met_weburl);
	if(substr($met_weburl,-1,1)!="/")$met_weburl.="/";
	if(!strstr($met_weburl,"http://"))$met_weburl="http://".$met_weburl;
	require_once 'configsave.php';

	$file_basicname =ROOTPATH."config/lang.inc.php";
	if(file_exists($file_basicname)){
		$fp = @fopen($file_basicname, "r") or okinfox('basic.php?lang='.$lang,$lang_Cannotopen.$file_basicname);
		$k=0;
		while ($conf_line = @fgets($fp, 1024)){
			if(!strstr($conf_line, "$"."met_langok[".$lang."][met_weburl")){   
				$linenum = $conf_line;
				$linelist[$k]=$linenum;
				$k++;
			}
		}
	}
	$j=$k-4;
	for($i=0;$i<$k;$i++){
		$lang_save .=$linelist[$i];
		if($j==$i){
			$lang_save .="$"."met_langok[".$lang."][met_weburl]='".$met_weburl."';\n";
		}
	}
	if(!is_writable("../../config/lang.inc.php"))@chmod("../../config/lang.inc.php",0777);
	$fp = fopen("../../config/lang.inc.php",w);
	fputs($fp, $lang_save);
	fclose($fp);
	okinfo('basic.php?lang='.$lang);
}else{
	$localurl="http://";
	$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
	$localurl_a=explode("/",$localurl);
	$localurl_count=count($localurl_a);
	$localurl_admin=$localurl_a[$localurl_count-3];
	$localurl_admin=$localurl_admin."/set/basic";
	$localurl_real=explode($localurl_admin,$localurl);
	$localurl=$localurl_real[0];
	if($met_weburl=="")$met_weburl=$localurl;
	$css_url="../templates/".$met_skin."/css";
	$img_url="../templates/".$met_skin."/images";
	include template('set_basic');
	footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>