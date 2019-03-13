<?php
# 文件名称:about.php 2009-08-12 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="modify"){
$query = "update $met_column SET ";
if($met_c_lang_ok==1){
$query = $query."
                      c_content     = '$c_content',
					  c_keywords    = '$c_keywords',
					  c_description = '$c_description',
					  ";
}
if($met_e_lang_ok==1){
$query = $query."
                      e_content     = '$e_content',
					  e_keywords    = '$e_keywords',
					  e_description = '$e_description',
					  ";
}
if($met_o_lang_ok==1){
$query = $query."
                      o_content     = '$o_content',
					  o_keywords    = '$o_keywords',
					  o_description = '$o_description',
					  ";               
}

$query = $query."
					  id 			= '$id'
					  where id='$id'";

$db->query($query);
//静态页面生成
showhtm($id);
okinfo('about.php?id='.$id,$lang_loginUserAdmin);

}
else{
$about = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
$about[name]=$langusenow=="en"?$about['e_name']:($langusenow=="other"?$about['o_name']:$about['c_name']);
if($langusenow=="en" && $met_e_lang_ok!=1) $about['name']=$met_c_lang_ok==1?$about['c_name']:$about['o_name'];
if($langusenow=="cn" && $met_c_lang_ok!=1) $about['name']=$met_e_lang_ok==1?$about['e_name']:$about['o_name'];
if($langusenow=="other" && $met_o_lang_ok!=1) $about['name']=$met_c_lang_ok==1?$about['c_name']:$about['e_name'];
if(!$about){
okinfo('../site/sysadmin.php',$lang_loginNoid);
}
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('about');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>