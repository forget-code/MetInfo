<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$backurl="../feedback/index.php?lang=".$lang;
$query = "select * from $met_parameter where lang='$lang' and module='8' and type='5' order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)){
$para_list[]=$list;
}
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
//delete images
if($met_deleteimg){
foreach($para_list as $key=>$val1){
$imagelist=$db->get_one("select * from $met_flist where lang='$lang' and  paraid='$val1[id]' and listid='$val'");
file_unlink("../../upload/file/".$imagelist[info]);
}
}
$query = "delete from $met_flist where listid='$val' and module='8'";
$db->query($query);
$query = "delete from $met_feedback where id='$val'";
$db->query($query);
}
okinfo($backurl);
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_feedback WHERE id='$id'");
if(!$admin_list){
okinfo($backurl,$lang_dataerror);
}
//delete images
if($met_deleteimg){
foreach($para_list as $key=>$val){
$imagelist=$db->get_one("select * from $met_flist where lang='$lang' and  paraid='$val[id]' and listid='$id'");
file_unlink("../../upload/file/".$imagelist[info]);
}
}
$query = "delete from $met_flist where listid='$id' and module='8'";
$db->query($query);
$query = "delete from $met_feedback where id='$id'";
$db->query($query);
okinfox($backurl);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.	
?>
