<?php
require_once '../login/login_check.php';
$backurl="index.php?class1=$class1&class2=$class2&class3=$class3";
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$query = "delete from $met_download where id='$val'";
$db->query($query);
}
okinfo($backurl,$lang[user_admin]);
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_download WHERE id='$id'");
if(!$admin_list){
okinfo($backurl,$lang[noid]);
}
$query = "delete from $met_download where id='$id'";
$db->query($query);
okinfo($backurl,$lang[user_admin]);
}
?>
