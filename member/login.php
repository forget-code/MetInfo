<?php
# 文件名称:login.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.

$admin_index=FALSE;
require_once '../include/common.inc.php';
if($met_member_use){
$member_title="<script language='javascript' src='member.php?memberaction=control&lang=".$lang."'></script>";

$admincp_ok = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_member_name' and admin_pass='$metinfo_member_pass' and usertype<3");

if($metinfo_member_name&&$metinfo_member_pass&&$admincp_ok){
Header("Location:$member_index_url");
}
else{
$member_column=$db->get_one("select * from $met_column where module='10'");
$metaccess=$member_column[access];
$classnow=$member_column[id];
require_once '../include/head.php';
$class1_info=$class_list[$classnow];
$class_info=$class1_info;
     $class_info[name]=($lang=="en")?$class_info[e_name]:(($lang=="other")?$class_info[o_name]:$class_info[c_name]);
     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$class_info[name]."--".$met_title;
if($metinfo_member_name<>""){
   $member_title=$metinfo_member_name.$lang_memberIndex2;
 }else{
   $member_title=$lang_memberIndex8;
 }
require_once '../public/php/methtml.inc.php';
 $methtl_membernav.="<ul>\n";
 $methtl_membernav.="<li><a target='main' onfocus='if(this.blur)this.blur();' href='basic.php?lang=".$lang."'>".$lang_memberIndex3."</a></li>\n";
 $methtl_membernav.="<li><a target='main' onfocus='if(this.blur)this.blur();' href='editor.php?lang=".$lang."'>".$lang_memberIndex4."</a></li>\n";
 $methtl_membernav.="<li><a target='main' onfocus='if(this.blur)this.blur();' href='feedback.php?lang=".$lang."'>".$lang_memberIndex5."</a></li>\n";
 $methtl_membernav.="<li><a target='main' onfocus='if(this.blur)this.blur();' href='message.php?lang=".$lang."'>".$lang_memberIndex6."</a></li>\n";
 $methtl_membernav.="<li><a target='main' onfocus='if(this.blur)this.blur();' href='cv.php?lang=".$lang."'>".$lang_memberIndex7."</a></li>\n";
 $methtl_membernav.="<li><a href='login_out.php?lang=".$lang."'>".$lang_memberIndex10."</a></li>\n";
 $methtl_membernav.="</ul>\n";
if(file_exists("../templates/".$met_skin_user."/login.html")){
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
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
