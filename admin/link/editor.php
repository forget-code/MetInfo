<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$link_list=$db->get_one("select * from $met_link where id='$id'");
if(!$link_list){
okinfo('index.php',$lang[noid]);
}
$link_type[$link_list[link_type]]="checked='checked'";
$link_lang[$link_list[link_lang]]="checked='checked'";
$show_ok1=$link_list[show_ok]?"checked='checked'":"";
$com_ok1=$link_list[com_ok]?"checked='checked'":"";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('link_editor');
footer();
?>