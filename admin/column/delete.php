<?php
require_once '../login/login_check.php';
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
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
$query = "delete from $met_column where id='$id'";
$db->query($query);
okinfo('index.php',$lang[user_admin]);
}
?>
