<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
$memberindex="metinfo";
require_once 'login_check.php';
if(!$metid)$metid='index';
if($metid!='index'){
require_once $metid.'.php';
}else{
$member_column=$db->get_one("select * from $met_column where module='10' and lang='$lang'");
$metaccess=$member_column[access];
$classnow=$member_column[id];
require_once '../include/head.php';
$class1_info=$class_list[$classnow];
$class_info=$class1_info;
     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$met_title?$class_info['name'].'-'.$met_title:$class_info['name'];
	 if($class_info['ctitle']!='')$met_title=$class_info['ctitle'];
$member_title="<script language='javascript' src='member.php?memberaction=control&lang=".$lang."'></script>";
require_once '../public/php/methtml.inc.php';
if($met_webhtm==0){
$member_index_url="index.php?lang=".$lang;
}else{
$member_index_url="index".$met_htmtype;
}
require_once 'list.php';
if(file_exists("../templates/".$met_skin_user."/member.".$dataoptimize_html)){
    include template('member');
}else{
include templatemember('index_metinfo');
 }
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>