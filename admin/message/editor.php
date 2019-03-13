<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="editor"){
$query = "update $met_message SET
                      info               = '$info',
					  useinfo            = '$useinfo',
					  readok             = '$readok'
					  where id='$id'";
$db->query($query);
okinfo('index.php',$lang[user_admin]);
}
else
{
$db->query($query);
$message_list=$db->get_one("select * from $met_message where id='$id'");
if(!$message_list){
okinfo('index.php',$lang[noid]);
}
$met_readok=($message_list[readok])?"checked='checked'":"";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('message_editor');
footer();
}
?>