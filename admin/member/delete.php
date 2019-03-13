<?php
# 文件名称:delete.php 2009-08-15 9:30:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
$adminno = $db->counter($met_admin_table, "", "*");
if($adminno<=1)okinfo('index.php',$lang_deleteJS);
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$query = "delete from $met_admin_table where id='$val'";
$db->query($query);
}
okinfo('index.php',$lang_loginUserAdmin);
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE id='$id'");
if(!$admin_list){
okinfo('index.php',$lang_loginNoid);
}
$query = "delete from $met_admin_table where id='$id'";
$db->query($query);
okinfo('index.php',$lang_loginUserAdmin);
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>
