<?php
# 文件名称:delete.php 2009-08-07 08:43:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
if($val!=0){
$admin_list2=$db->get_one("SELECT * FROM $met_column WHERE bigclass='$val'");
if($admin_list2){
okinfo('index.php',$lang_modBigclass1);
}
}
$admin_list = $db->get_one("SELECT * FROM $met_column WHERE id='$val'");
$classtype="class".$admin_list[classtype];
switch ($admin_list[module]){
case 2;
$listok=$db->get_one("SELECT * FROM $met_news WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"{$lang_deleteTip1}$admin_list[c_name]{$lang_deleteTip2}");
break;
case 3;
$listok=$db->get_one("SELECT * FROM $met_product WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"{$lang_deleteTip1}$admin_list[c_name]{$lang_deleteTip2}");
break;
case 4;
$listok=$db->get_one("SELECT * FROM $met_download WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"{$lang_deleteTip1}$admin_list[c_name]{$lang_deleteTip2}");
break;
case 5;
$listok=$db->get_one("SELECT * FROM $met_img WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"{$lang_deleteTip1}$admin_list[c_name]{$lang_deleteTip2}");
break;
case 6;
$listok=$db->get_one("SELECT * FROM $met_job WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"{$lang_deleteTip1}$admin_list[c_name]{$lang_deleteTip2}");
break;
}
$query = "delete from $met_column where id='$val'";
$db->query($query);
 if($admin_list[module]==1){
 $filename="../../".$admin_list[foldername]."/".$admin_list[filename].".htm";
 if(file_exists($filename))@unlink($filename);
 $filename="../../".$admin_list[foldername]."/".$admin_list[filename]."_en.htm";
 if(file_exists($filename))@unlink($filename);
 }
 
}
echo "<script type='text/javascript'>parent.setCookie('colunmid', 'metinfo'); parent.location.reload();</script>";
//okinfo('index.php',$lang_loginUserAdmin);
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
if(!$admin_list){
okinfo('index.php',$lang_loginNoid);
}
$classtype="class".$admin_list[classtype];
switch ($admin_list[module]){
case 2;
$listok=$db->get_one("SELECT * FROM $met_news WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"{$lang_deleteTip1}$admin_list[c_name]{$lang_deleteTip2}");
break;
case 3;
$listok=$db->get_one("SELECT * FROM $met_product WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"{$lang_deleteTip1}$admin_list[c_name]{$lang_deleteTip2}");
break;
case 4;
$listok=$db->get_one("SELECT * FROM $met_download WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"{$lang_deleteTip1}$admin_list[c_name]{$lang_deleteTip2}");
break;
case 5;
$listok=$db->get_one("SELECT * FROM $met_img WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"{$lang_deleteTip1}$admin_list[c_name]{$lang_deleteTip2}");
break;
case 6;
$listok=$db->get_one("SELECT * FROM $met_job WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"{$lang_deleteTip1}$admin_list[c_name]{$lang_deleteTip2}");
break;
}
$admin_list2=$db->get_one("SELECT * FROM $met_column WHERE bigclass='$admin_list[id]'");
if($admin_list2){
okinfo('index.php',$lang_modBigclass);
}
$query = "delete from $met_column where id='$id'";
$db->query($query);
 if($admin_list[module]==1){
 $filename="../../".$admin_list[foldername]."/".$admin_list[filename].".htm";
 if(file_exists($filename))@unlink($filename);
 $filename="../../".$admin_list[foldername]."/".$admin_list[filename]."_en.htm";
 if(file_exists($filename))@unlink($filename);
 }
echo "<script type='text/javascript'>parent.setCookie('colunmid', 'metinfo'); parent.location.reload();</script>";
//okinfo('index.php',$lang_loginUserAdmin);
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
