<?php
# 文件名称:add.php 2009-08-07 08:43:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
$bigclass=$lang_modClass1;
$addtitle=$lang_modClass1;
$class=0;
$foldername="";
$filenameok="";
$list_orderok="none";
$list_order[0]="checked='checked'";
$classtype=1;
if($class1!=""){
$class1_list = $db->get_one("SELECT * FROM $met_column WHERE id='$class1'");

$lev=$class1_list[access];


if(!$class1_list){
okinfo('index.php',$lang_loginNoid);
}
$list_order[$class1_list[list_order]]="checked='checked'";
if($class1_list[list_order]!=0)$list_orderok="";
$bigclass=$class1_list[c_name];
$addtitle=$lang_modClass2;
$class=$class1;
$class_list[module]=$class1_list[module];
$foldername=$class1_list[foldername];
$module[$class1_list[module]]="selected='selected'";
$foldername1="disabled='disabled'";
$module1="disabled='disabled'";

if($class1_list[module]!=1)$filenameok="none";
$classtype=2;
}
if($class2!=""){
$class2_list = $db->get_one("SELECT * FROM $met_column WHERE id='$class2'");
$lev=$class2_list[access];
if(!$class2_list){
okinfo('index.php',$lang_loginNoid);
}
$list_order[$class2_list[list_order]]="checked='checked'";
if($class2_list[list_order]!=0)$list_orderok="";
$bigclass=$class2_list[c_name];
$addtitle=$lang_modClass3;
$class=$class2;
$class_list[module]=$class2_list[module];
$foldername=$class2_list[foldername];
$module[$class2_list[module]]="selected='selected'";
$foldername1="disabled='disabled'";
$module1="disabled='disabled'";
if($class2_list[module]!=1)$filenameok="none";
$classtype=3;
}

$level="";
switch(intval($lev))
{
	case 0:$level.="<option value='all' >$lang_access0</option>";
	case 1:$level.="<option value='1' >$lang_access1</option>";
	case 2:$level.="<option value='2' >$lang_access2</option>";
	case 3:$level.="<option value='3' >$lang_access3</option>";
}

if($foldername=="")$foldername="about";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('column_add');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>