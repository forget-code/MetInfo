<?php
# 文件名称:save.php 2009-08-08 13:45:13
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
if($action=="add"){
$query = "INSERT INTO $met_news SET
                      c_title            = '$c_title',
                      e_title            = '$e_title',
					  o_title            = '$o_title',
					  c_keywords         = '$c_keywords',
					  e_keywords         = '$e_keywords',
					  o_keywords         = '$o_keywords',
					  c_description      = '$c_description',
					  e_description      = '$e_description',
					  o_description      = '$o_description',
					  c_content          = '$c_content',
					  e_content          = '$e_content',
					  o_content          = '$o_content',
					  class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',
					  img_ok             = '$img_ok',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',
				      com_ok             = '$com_ok',
					  issue              = '$issue',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime',
					  access          	 = '$access',
					  top_ok             = '$top_ok'";

         $db->query($query);
//静态页面生成
$later_news=$db->get_one("select * from $met_news where updatetime='$updatetime'");
$id=$later_news[id];
contenthtm($class1,$id,'shownews');
indexhtm();
classhtm($class1,$class2,$class3);

okinfo('index.php?class1='.$class1,$lang_loginUserAdmin);
}

if($action=="editor"){
$query = "update $met_news SET ";
if($met_c_lang_ok==1){
$query = $query."
                      c_title            = '$c_title',
					  c_keywords         = '$c_keywords',
					  c_description      = '$c_description',
					  c_content          = '$c_content',"
					  ;
}					  
if($met_e_lang_ok==1){
$query = $query."
                      e_title            = '$e_title',
					  e_keywords         = '$e_keywords',
					  e_description      = '$e_description',
					  e_content          = '$e_content',"
					  ;
}					  
if($met_o_lang_ok==1){
$query = $query."
                      o_title            = '$o_title',
					  o_keywords         = '$o_keywords',
					  o_description      = '$o_description',
					  o_content          = '$o_content',"
					  ;
}					  
$query = $query."
                      class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',
					  img_ok             = '$img_ok',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',
				      com_ok             = '$com_ok',
					  issue              = '$issue',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime',
					  access			 = '$access',
					  top_ok             = '$top_ok'
					  where id='$id'";


$db->query($query);
//静态页面生成
contenthtm($class1,$id,'shownews');
indexhtm();
classhtm($class1,$class2,$class3);
okinfo('index.php?class1='.$class1,$lang_loginUserAdmin);
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
