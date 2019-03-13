<?php
# 文件名称:save.php 2009-08-12 08:00:13
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
if($action=="add"){
$query = "INSERT INTO $met_job SET
                      c_position         = '$c_position',
                      e_position         = '$e_position',
					  o_position         = '$o_position',
					  count              = '$count',
					  c_place            = '$c_place',
					  e_place            = '$e_place',
					  o_place            = '$o_place',
					  c_deal             = '$c_deal',
					  e_deal             = '$e_deal',
					  o_deal             = '$o_deal',
					  c_content          = '$c_content',
					  e_content          = '$e_content',
					  o_content          = '$o_content',
					  useful_life        = '$useful_life',
					  addtime            = '$addtime',
					  access			 = '$access',
					  top_ok             = '$top_ok'";
         $db->query($query);
//静态页面生成		 
$later_job=$db->get_one("select * from $met_job order by id desc");
$id=$later_job[id];
indexhtm();
contenthtm($class1,$id,'showjob',0,'job');
classhtm($class1,0,0);
okinfo('index.php?class1='.$class1,$lang_loginUserAdmin);
}

if($action=="editor"){

$query = "update $met_job SET ";
if($met_c_lang_ok==1){
$query = $query."
                      c_position         = '$c_position',
					  c_place            = '$c_place',
					  c_deal             = '$c_deal',
					  c_content          = '$c_content',
					  ";
}
if($met_e_lang_ok==1){
$query = $query."
                      e_position         = '$e_position',
					  e_place            = '$e_place',
					  e_deal             = '$e_deal',
					  e_content          = '$e_content',
					  ";                   
}
if($met_o_lang_ok==1){
$query = $query."
                      o_position         = '$o_position',
					  o_place            = '$o_place',
					  o_deal             = '$o_deal',
					  o_content          = '$o_content',
					  ";                     
}
$query = $query."
					  count              = '$count',
					  useful_life        = '$useful_life',
					  addtime            = '$addtime',
					  access			 = '$access',
					  top_ok             = '$top_ok'
					  where id='$id'";



$db->query($query);

//静态页面生成
indexhtm();
contenthtm($class1,$id,'showjob',0,'job');
classhtm($class1,0,0);
okinfo('index.php?class1='.$class1,$lang_loginUserAdmin);
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
