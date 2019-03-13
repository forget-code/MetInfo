<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$flashrec=$db->get_one("SELECT * FROM $met_flash where id='$val'");
if($met_deleteimg){
file_unlink("../".$flashrec[img_path]);
file_unlink("../".$flashrec[flash_path]);
file_unlink("../".$flashrec[flash_back]);
}
$query = "delete from $met_flash where id='$val'";
$db->query($query);
}
okinfo('../flash/flash.php?lang='.$lang.'&flashmode='.$flashmode);
}
else{
$flashrec=$db->get_one("SELECT * FROM $met_flash where id='$id'");
if($met_deleteimg){
file_unlink("../".$flashrec[img_path]);
file_unlink("../".$flashrec[flash_path]);
file_unlink("../".$flashrec[flash_back]);
}
$query = "delete from $met_flash where id='$id'";
$db->query($query);
okinfo('../flash/flash.php?lang='.$lang.'&flashmode='.$flashmode);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
