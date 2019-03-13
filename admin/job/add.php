<?php
# 文件名称:add.php 2009-08-12 06:01:13
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");

$job_list=$db->get_one("SELECT * FROM $met_column where id=$class1 order by no_order");
$lev=$job_list[access];

$level="";
switch(intval($lev))
{
	case 0:$level.="<option value='all' >$lang_access0</option>";
	case 1:$level.="<option value='1' >$lang_access1</option>";
	case 2:$level.="<option value='2' >$lang_access2</option>";
	case 3:$level.="<option value='3' >$lang_access3</option>";
}

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('job_add');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>