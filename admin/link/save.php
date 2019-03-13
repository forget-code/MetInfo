<?php
# 文件名称:save.php 2009-08-15 16:43:57
# MetInfo企业网站管理系统
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
if($action=="add"){
if($link_lang=="")$link_lang="1";
$query = "INSERT INTO $met_link SET
                      c_webname            = '$c_webname',
                      e_webname            = '$e_webname',
					  o_webname            = '$o_webname',
					  c_info               = '$c_info',
					  e_info               = '$e_info',
					  o_info               = '$o_info',
					  link_type            = '$link_type',
					  weburl               = '$weburl',
					  weblogo              = '$weblogo',
					  contact              = '$contact',
					  orderno              = '$orderno',
					  com_ok               = '$com_ok',
					  show_ok              = '$show_ok', 
					  link_lang            = '$link_lang', 
					  addtime              = '$m_now_date'";
         $db->query($query);
onepagehtm('link','index');
indexhtm();
okinfo('index.php',$lang_loginUserAdmin);
}

if($action=="editor"){
$query = "update $met_link SET ";
if($met_c_lang_ok==1){
$query = $query."
                      c_webname            = '$c_webname',
					  c_info               = '$c_info',";
}                                         
if($met_e_lang_ok==1){
$query = $query."
                      e_webname            = '$e_webname',
					  e_info               = '$e_info',";
}
if($met_o_lang_ok==1){
$query = $query."
                      o_webname            = '$o_webname',
					  o_info               = '$o_info',";
}                                         
$query = $query."
					  link_type            = '$link_type',
					  weburl               = '$weburl',
					  weblogo              = '$weblogo',
					  contact              = '$contact',
					  orderno              = '$orderno',
					  com_ok               = '$com_ok',
					  show_ok              = '$show_ok', 
					  link_lang            = '$link_lang', 
					  addtime              = '$m_now_date'
					  where id='$id'";

$db->query($query);
onepagehtm('link','index');
indexhtm();
okinfo('index.php',$lang_loginUserAdmin);
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>
