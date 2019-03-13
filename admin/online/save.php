<?php
# 文件名称:save.php 2009-08-15 14:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
if($action=="add"){
$query = "INSERT INTO $met_online SET
                      c_name         = '$c_name',
                      e_name         = '$e_name',
					  o_name         = '$o_name',
					  no_order       = '$no_order',
					  qq             = '$qq',
					  msn            = '$msn',
					  taobao         = '$taobao',
					  alibaba        = '$alibaba',
					  skype          = '$skype'";
         $db->query($query);
okinfo('index.php',$lang_loginUserAdmin);
}

if($action=="editor"){
$query = "update $met_online SET ";
if($met_c_lang_ok==1){
$query = $query."    c_name         = '$c_name',";
}
if($met_e_lang_ok==1){
$query = $query."    e_name         = '$e_name',";
}
if($met_o_lang_ok==1){
$query = $query."    o_name         = '$o_name',";
}
$query = $query."
					  no_order       = '$no_order',
					  qq             = '$qq',
					  msn            = '$msn',
					  taobao         = '$taobao',
					  alibaba        = '$alibaba',
					  skype          = '$skype'
					  where id='$id'";

$db->query($query);
okinfo('index.php',$lang_loginUserAdmin);
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>