<?php
# 文件名称:delete.php 2009-08-11 17:53:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
$backurl="index.php?class1=$class1&class2=$class2&class3=$class3";
$folder=$db->get_one("select * from $met_column where id='$class1'");
if($action=="del"){
$allidlist=explode(',',$allid);
$k=count($allidlist)-1;
for($i=0;$i<$k; $i++){
if($met_htmpagename==1)$news_list=$db->get_one("select * from $met_download where id='$allidlist[$i]'");
$updatetime=date('Ymd',strtotime($news_list[updatetime]));
deletepage($folder[foldername],$allidlist[$i],'showdownload',$updatetime);
$query = "delete from $met_download where id='$allidlist[$i]'";
$db->query($query);
}
indexhtm();
classhtm($class1,$class2,$class3);
  if($met_webhtm==2){
   okinfo($backurl,$lang_delall);
   }else{
   okinfo($backurl,$lang_loginUserAdmin);
   }
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_download WHERE id='$id'");
if(!$admin_list){
okinfo($backurl,$lang_loginNoid);
}
$query = "delete from $met_download where id='$id'";
$db->query($query);
$updatetime=date('Ymd',strtotime($admin_list[updatetime]));
deletepage($folder[foldername],$id,'showdownload',$updatetime);
indexhtm();
$class1=$admin_list[class1];
$class2=$admin_list[class2];
$class3=$admin_list[class3];
classhtm($class1,$class2,$class3);
okinfo($backurl,$lang_loginUserAdmin);
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>
