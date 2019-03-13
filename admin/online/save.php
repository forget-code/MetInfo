<?php
require_once '../login/login_check.php';
if($action=="add"){
$query = "INSERT INTO $met_online SET
                      c_name         = '$c_name',
                      e_name         = '$e_name',
					  no_order       = '$no_order',
					  qq             = '$qq',
					  msn            = '$msn',
					  taobao         = '$taobao',
					  alibaba        = '$alibaba',
					  skype          = '$skype'";
         $db->query($query);
okinfo('index.php',$lang[user_admin]);
}

if($action=="editor"){
if($met_en_lang==1){
$query = "update $met_online SET
                      c_name         = '$c_name',
                      e_name         = '$e_name',
					  no_order       = '$no_order',
					  qq             = '$qq',
					  msn            = '$msn',
					  taobao         = '$taobao',
					  alibaba        = '$alibaba',
					  skype          = '$skype'
					  where id='$id'";
}else{
$query = "update $met_online SET
                      c_name         = '$c_name',
					  no_order       = '$no_order',
					  qq             = '$qq',
					  msn            = '$msn',
					  taobao         = '$taobao',
					  alibaba        = '$alibaba',
					  skype          = '$skype'
					  where id='$id'";
}
$db->query($query);
okinfo('index.php',$lang[user_admin]);
}
?>