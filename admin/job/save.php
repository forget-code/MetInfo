<?php
require_once '../login/login_check.php';
if($action=="add"){
$query = "INSERT INTO $met_job SET
                      c_position         = '$c_position',
                      e_position         = '$e_position',
					  count              = '$count',
					  c_place            = '$c_place',
					  e_place            = '$e_place',
					  c_deal             = '$c_deal',
					  e_deal             = '$e_deal',
					  c_content          = '$c_content',
					  e_content          = '$e_content',
					  useful_life        = '$useful_life',
					  addtime            = '$addtime'";
         $db->query($query);
okinfo('index.php?class1='.$class1,$lang[user_admin]);
}

if($action=="editor"){
if($met_en_lang==1){
$query = "update $met_job SET
                      c_position         = '$c_position',
                      e_position         = '$e_position',
					  count              = '$count',
					  c_place            = '$c_place',
					  e_place            = '$e_place',
					  c_deal             = '$c_deal',
					  e_deal             = '$e_deal',
					  c_content          = '$c_content',
					  e_content          = '$e_content',
					  useful_life        = '$useful_life',
					  addtime            = '$addtime'
					  where id='$id'";
}else{
$query = "update $met_job SET
                      c_position         = '$c_position',
					  count              = '$count',
					  c_place            = '$c_place',
					  c_deal             = '$c_deal',
					  c_content          = '$c_content',
					  useful_life        = '$useful_life',
					  addtime            = '$addtime'
					  where id='$id'";
}
$db->query($query);
okinfo('index.php?class1='.$class1,$lang[user_admin]);
}
?>
