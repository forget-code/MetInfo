<?php
require_once '../login/login_check.php';
$adminno = $db->counter($met_admin_table, "", "*");
if($adminno<=1)okinfo('index.php',"请先添加管理员再删除！");
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$query = "delete from $met_admin_table where id='$val'";
$db->query($query);
}
okinfo('index.php',$lang[user_admin]);
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE id='$id'");
if(!$admin_list){
okinfo('index.php',$lang[noid]);
}
$query = "delete from $met_admin_table where id='$id'";
$db->query($query);
okinfo('index.php',$lang[user_admin]);
}
?>
