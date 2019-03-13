<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$online_list=$db->get_one("select * from $met_online where id='$id'");
if(!$online_list){
okinfo('index.php',$lang[noid]);
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('online_editor');
footer();
?>