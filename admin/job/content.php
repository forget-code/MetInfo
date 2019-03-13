<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$settingse = parse_ini_file('../../job/config_'.$lang.'.inc.php');
@extract($settingse);
$job_list=$db->get_one("select * from $met_job where id='$id'");
$job_list1=$db->get_one("SELECT * FROM $met_column where id=$class1 order by no_order");
if($met_member_use){
$lev=$job_list1[access];
switch($job_list['access'])
{
	case '1':$access1="selected='selected'";break;
	case '2':$access2="selected='selected'";break;
	case '3':$access3="selected='selected'";break;
	default:$access0="selected='selected'";break;
}
}
if($job_list[top_ok]==1)$top_ok="checked='checked'";

if($met_member_use){
$level="";
switch(intval($lev))
{
	case 0:$level.="<option value='0' $access0>$lang_access0</option>";
	case 1:$level.="<option value='1' $access1>$lang_access1</option>";
	case 2:$level.="<option value='2' $access2>$lang_access2</option>";
	case 3:$level.="<option value='3' $access3>$lang_access3</option>";
}
}
//
$term=0;
foreach($column_lang[6] as $key=>$val){
    if($val[lang]!=$lang)$term++;
}
if($action=="add")$lang_editinfo=$lang_addinfo;
if($action=="add")$job_list[addtime]=$m_now_counter;
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('job_content');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>