<?php
# 文件名称:index_set.php 2009-08-14 12:01:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="modify"){
$query = "update $met_index SET
					  online_type   = '$online_type',
					  news_no       = '$news_no',
					  product_no    = '$product_no',
					  download_no   = '$download_no',
					  job_no        = '$job_no',
					  link_ok       = '$link_ok',
					  link_img      = '$link_img',
					  link_text     = '$link_text',
					  img_no        = '$img_no'
					  where id='$id'";
$db->query($query);
require_once 'configsave.php';
indexhtm();
okinfo('index_set.php',$lang_loginUserAdmin);
}
else
{
$index = $db->get_one("SELECT * FROM $met_index order by id desc");
if(!$index){
okinfo('../site/sysadmin.php',$lang_loginNoid);
}

$cssfile="../../templates/".$met_skin_user."/images/css/css.inc.php";
if(file_exists($cssfile)){
require_once $cssfile;
}

$online_type1[$index[online_type]]="checked='checked'";
$link_ok1[$index[link_ok]]="checked='checked'";
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('index_set');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>