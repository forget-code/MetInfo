<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

$admin_index=FALSE;
require_once '../include/common.inc.php';
if($met_member_use){
$member_title="<script language='javascript' src='member.php?memberaction=control&lang=".$lang."'></script>";
$admincp_ok = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_member_name' and admin_pass='$metinfo_member_pass' and usertype<3");
if($metinfo_member_name&&$metinfo_member_pass&&$admincp_ok){
Header("Location:$member_index_url");
}else{
$member_column=$db->get_one("select * from $met_column where module='10' and lang='$lang' ");
$metaccess=$member_column[access];
$classnow=$member_column[id];
require_once '../include/head.php';
$class1_info=$class_list[$classnow];
$class_info=$class1_info;
     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$met_title?$class_info['name'].'-'.$met_title:$class_info['name'];
if($metinfo_member_name<>""){
   $member_title=$metinfo_member_name.$lang_memberIndex2;
 }else{
   $member_title=$lang_memberIndex8;
 }
 require_once '../public/php/methtml.inc.php';
 require_once 'list.php';
if(file_exists("../templates/".$met_skin_user."/login.".$dataoptimize_html)){
    include template('login');
}else{
include templatemember('login_metinfo');
 }
footer();
}
}else{
okinfo('../',$lang_memberclose);
exit;
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>