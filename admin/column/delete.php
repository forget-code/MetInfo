<?php
require_once '../login/login_check.php';
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
if($val!=0){
$admin_list2=$db->get_one("SELECT * FROM $met_column WHERE bigclass='$val'");
if($admin_list2){
okinfo('index.php',$lang[bigclass1]);
}
}
$query = "delete from $met_column where id='$val'";
$db->query($query);
}
okinfo('index.php',$lang[user_admin]);
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
if(!$admin_list){
okinfo('index.php',$lang[noid]);
}
$admin_list2=$db->get_one("SELECT * FROM $met_column WHERE bigclass='$admin_list[id]'");
if($admin_list2){
okinfo('index.php',$lang[bigclass]);
}
$query = "delete from $met_column where id='$id'";
$db->query($query);
okinfo('index.php',$lang[user_admin]);
}
?>
