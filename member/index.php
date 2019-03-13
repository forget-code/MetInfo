<?php
# 文件名称:index.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
$memberindex="metinfo";
require_once 'login_check.php';
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
$member_title="<script language='javascript' src='member.php?memberaction=control&lang=".$lang."'></script>";
require_once '../public/php/methtml.inc.php';
if($met_webhtm==0){
$member_index_url="index.php?lang=".$lang;
}else{
$member_index_url=($lang=="en")?"index".$met_e_htmtype:(($lang=="other")?"index".$met_o_htmtype:"index".$met_c_htmtype);
}
 $methtml_membernav.="<ul>\n";
 $methtml_membernav.="<li><a target='main' onfocus='if(this.blur)this.blur();' href='basic.php?lang=".$lang."'>".$lang_memberIndex3."</a></li>\n";
 $methtml_membernav.="<li><a target='main' onfocus='if(this.blur)this.blur();' href='editor.php?lang=".$lang."'>".$lang_memberIndex4."</a></li>\n";
 $methtml_membernav.="<li><a target='main' onfocus='if(this.blur)this.blur();' href='feedback.php?lang=".$lang."'>".$lang_memberIndex5."</a></li>\n";
 $methtml_membernav.="<li><a target='main' onfocus='if(this.blur)this.blur();' href='message.php?lang=".$lang."'>".$lang_memberIndex6."</a></li>\n";
 $methtml_membernav.="<li><a target='main' onfocus='if(this.blur)this.blur();' href='cv.php?lang=".$lang."'>".$lang_memberIndex7."</a></li>\n";
 $methtml_membernav.="<li><a href='login_out.php?lang=".$lang."'>".$lang_memberIndex10."</a></li>\n";
 $methtml_membernav.="</ul>\n";
 $methtl_membernav=$methtml_membernav;
if(file_exists("../templates/".$met_skin_user."/member.html")){
    include template('member');
}else{
include templatemember('index_metinfo');
 }
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>