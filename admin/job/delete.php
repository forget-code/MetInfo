<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';

$backurl="index.php?lang=$lang&class1=$class1";
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$query = "delete from $met_job where id='$val'";
$db->query($query);
}
echo "<script language=javascript>{$js}";
echo "if(confirm(user_msg['js32'])) location.href='cv_delete.php?lang=$lang&action=deljobs&alljobid=$allid&class1=$class1'; ";
echo "</script>";
okinfo($backurl,$lang_jsok);
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_job WHERE id='$id'");
$query = "delete from $met_job where id='$id'";
$db->query($query);

echo "<script language=javascript>{$js}";
echo "if(confirm(user_msg['js32'])) location.href='cv_delete.php?lang=$lang&action=deljob&jobid=$id&class1=$class1'; ";
echo "</script>";
okinfo($backurl,$lang_jsok);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
