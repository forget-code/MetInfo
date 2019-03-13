<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="modify"){
if($met_en_lang==1){
$query = "update $met_index SET
                      c_content     = '$c_content',
					  e_content     = '$e_content',
					  online_type   = '$online_type',
					  news_no       = '$news_no',
					  product_no    = '$product_no',
					  download_no   = '$download_no',
					  link_ok       = '$link_ok',
					  link_img      = '$link_img',
					  link_text     = '$link_text',
					  img_no        = '$img_no'
					  where id='$id'";}
else{
$query = "update $met_index SET
                      c_content     = '$c_content',
					  online_type   = '$online_type',
					  news_no       = '$news_no',
					  product_no    = '$product_no',
					  download_no   = '$download_no',
					  link_ok       = '$link_ok',
					  link_img      = '$link_img',
					  link_text     = '$link_text',
					  img_no        = '$img_no'
					  where id='$id'";
}
$db->query($query);
if($met_index_type){

if($met_webhtm==1){
$fromurl=$met_weburl."/index.php?en=en";
$filename="../../index.htm";
createhtm($fromurl,$filename);
if($met_en_lang==1){
$fromurl=$met_weburl."/index.php?ch=ch";
$filename="../../index_ch.htm";
createhtm($fromurl,$filename);
}}

}else{
if($met_webhtm==1){
$fromurl=$met_weburl."/index.php";
$filename="../../index.htm";
createhtm($fromurl,$filename);
if($met_en_lang==1){
$fromurl=$met_weburl."/index.php?en=en";
$filename="../../index_en.htm";
createhtm($fromurl,$filename);
}
}
}
okinfo('index_set.php',$lang[user_admin]);

}
else
{
$index = $db->get_one("SELECT * FROM $met_index order by id desc");
if(!$index){
okinfo('../site/sysadmin.php',$lang[noid]);
}
$online_type1[$index[online_type]]="checked='checked'";
$link_ok1[$index[link_ok]]="checked='checked'";
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('index_set');
footer();
?>