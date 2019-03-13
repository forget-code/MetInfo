<?php
# 文件名称:editor.php 2009-08-07 08:43:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
$column_list = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
$lev=0;//最高权限
if(!$column_list){
okinfo('index.php',$lang_loginNoid);
}
$classtype=1;
$list_order[0]="checked='checked'";
$list_order[$column_list[list_order]]="checked='checked'";
$list_orderok="none";
if($column_list[list_order]!=0)$list_orderok="";
if($column_list[module]==2 || $column_list[module]==3 || $column_list[module]==4 || $column_list[module]==5)$list_orderok="";
$module[$column_list[module]]="selected='selected'";
$nav[$column_list[nav]]="checked='checked'";
$if_in[$column_list[if_in]]="checked='checked'";
$bigclass=$lang_modClass1;
$addtitle=$lang_modClass1;
$foldername="";
$class=$column_list[bigclass];
if($column_list[module]!=1)$filenameok="none";
if($column_list[if_in]==1){$if_in_p="none";}
else{$if_out_p="none";}
if($column_list[new_windows]=="target='_blank'"){$new_windows="checked='checked'";}

if($column_list[bigclass]!=0){
$class2_list = $db->get_one("SELECT * FROM $met_column WHERE id='$column_list[bigclass]'");
$lev=$class2_list['access'];//一二级栏目权限
$bigclass=$class2_list[c_name];
if($class2_list[bigclass]!=0){
$addtitle=$lang_modClass3;
$classtype=3;
}
else{
$addtitle=$lang_modClass2;
$classtype=2;
}
}

switch($column_list['access'])
{
	case '1':$access1="selected='selected'";break;
	case '2':$access2="selected='selected'";break;
	case '3':$access3="selected='selected'";break;
	default:$access0="selected='selected'";break;
}

$level="";
switch(intval($lev))
{
	case 0:$level.="<option value='all' $access0>$lang_access0</option>";
	case 1:$level.="<option value='1' $access1>$lang_access1</option>";
	case 2:$level.="<option value='2' $access2>$lang_access2</option>";
	case 3:$level.="<option value='3' $access3>$lang_access3</option>";
}

$isshowcheck=$column_list['isshow']==1?"checked='checked'":'';
if($column_list['module']!=1) $filenameok="none";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('column_editor');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>