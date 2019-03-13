<?php
# 文件名称:editor.php 2009-08-12 09:06:13
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$job_list=$db->get_one("select * from $met_job where id='$id'");
$job_list1=$db->get_one("SELECT * FROM $met_column where id=$class1 order by no_order");
$lev=$job_list1[access];
switch($job_list['access'])
{
	case '1':$access1="selected='selected'";break;
	case '2':$access2="selected='selected'";break;
	case '3':$access3="selected='selected'";break;
	default:$access0="selected='selected'";break;
}
if($job_list[top_ok]==1)$top_ok="checked='checked'";
if(!$job_list){
okinfo('index.php',$lang_loginNoid);
}

$level="";
switch(intval($lev))
{
	case 0:$level.="<option value='all' $access0>$lang_jobeditorAccess0</option>";
	case 1:$level.="<option value='1' $access1>$lang_jobeditorAccess1</option>";
	case 2:$level.="<option value='2' $access2>$lang_jobeditorAccess2</option>";
	case 3:$level.="<option value='3' $access3>$lang_jobeditorAccess3</option>";
}

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('job_editor');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>