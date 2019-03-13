<?php
# 文件名称:index_content.php 2009-08-15 16:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="modify"){
$query = "update $met_index SET ";
if($met_c_lang_ok==1){
$query =$query." c_content     = '$c_content', ";  
}
if($met_e_lang_ok==1){
$query =$query." e_content     = '$e_content', ";  
}
if($met_o_lang_ok==1){
$query =$query." o_content     = '$o_content', ";  
}
$query =$query." id=$id where id='$id'";
$db->query($query);
indexhtm();
okinfo('index_content.php',$lang_loginUserAdmin);
}
else
{
$index = $db->get_one("SELECT * FROM $met_index order by id desc");
if(!$index){
okinfo('../site/sysadmin.php',$lang_loginNoid);
}
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('index_content');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>