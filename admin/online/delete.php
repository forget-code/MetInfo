<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$backurl="index.php?lang=".$lang;
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$query = "delete from $met_online where id='$val'";
$db->query($query);
}
okinfo($backurl,$lang_jsok);
}
else{
$query = "delete from $met_online where id='$id'";
$db->query($query);
okinfo($backurl,$lang_jsok);
}
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
?>
