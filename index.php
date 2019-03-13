<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
$url=$_SERVER['PHP_SELF'];
$turnurl=dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]);
$resstr=strstr($url,'index.php/');
if($resstr){  
  $turnurl=str_replace('index.php','404.html',$turnurl);
  header("location:".$turnurl);
}
if(!file_exists('./config/install.lock')){
	if(file_exists('./install/index.php')){
		header("location:./install/index.php");exit;
	}
	else{
		header("Content-type: text/html;charset=utf-8");
		echo "安装文件不存在，请上传安装文件。如已安装过，请新建config/install.lock文件。";
		die();
	}
}
if(file_exists('./update')&&!file_exists('./update/install.lock')){
	header("location:./update/index.php");exit;
}
$index="index";
require_once 'include/common.inc.php';
require_once 'include/head.php';
$index=array();
$index[index]='index';
$index[content]=$met_index_content;
$index[lang]=$lang;
$index[news_no]=$index_news_no;
$index[product_no]=$index_product_no;
$index[download_no]=$index_download_no;
$index[img_no]=$index_img_no;
$index[job_no]=$index_job_no;
$index[link_ok]=$index_link_ok;
$index[link_img]=$index_link_img;
$index[link_text]=$index_link_text;
$show['description']=$met_description;
$show['keywords']=$met_keywords;
require_once 'public/php/methtml.inc.php';
if($met_indexskin=="" or (!file_exists("templates/".$met_skin_user."/".$met_indexskin.".".$dataoptimize_html)))$met_indexskin='index';
if($map&&$met_mobileok&&is_numeric($uid)) {
	if($wap_skin_user != 'wap001' && $wap_skin_user != 'mobile_001' && $wap_skin_user != 'mobile_002' && $wap_skin_user != 'mobile_003' && $wap_skin_user != 'mobile_004' && $wap_skin_user != 'mobile_005' && $wap_skin_user != 'mobile_006') {
		$met_indexskin = 'map';
	} 
}
include template($met_indexskin);
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>