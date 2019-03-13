<?php
# 文件名称:index.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
$message_column=$db->get_one("select * from $met_column where module='9'");
$metaccess=$message_column[access];
$class1=$message_column[id];
require_once '../include/head.php';
$class1_info=$class_list[$class1];
$navtitle=($lang=="en")?$message_column[e_name]:(($lang=="other")?$message_column[o_name]:$message_column[c_name]);
	$addlink_c_url=$met_webhtm?"addlink".$met_c_htmtype:"addlink.php";
	$addlink_e_url=$met_webhtm?"addlink".$met_e_htmtype:"addlink.php?lang=en";
	$addlink_o_url=$met_webhtm?"addlink".$met_o_htmtype:"addlink.php?lang=other";
	$addlink_url=($lang=="en")?$addlink_e_url:(($lang=="other")?$addlink_o_url:$addlink_c_url);
	
require_once '../public/php/methtml.inc.php';
if(file_exists("templates/".$met_skin_user."/e_link_index.html")){
   if($lang=="en"){
     $show[e_description]=$class_info[e_description]?$class_info[e_description]:$met_e_keywords;
     $show[e_keywords]=$class_info[e_keywords]?$class_info[e_keywords]:$met_e_keywords;
     $e_title_keywords=$navtitle."--".$met_e_webname;
     include template('e_link_index');
	}else{
	 $show[c_description]=$class_info[c_description]?$class_info[c_description]:$met_c_keywords;
     $show[c_keywords]=$class_info[c_keywords]?$class_info[c_keywords]:$met_c_keywords;
     $c_title_keywords=$navtitle."--".$met_c_webname;
	 include template('link_index');
	 }
}else{
include template('link_index');
}
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>