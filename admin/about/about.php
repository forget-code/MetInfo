<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="modify"){
if($met_en_lang==1){
$query = "update $met_column SET
                      c_content     = '$c_content',
					  c_keywords    = '$c_keywords',
					  c_description = '$c_description',
					  e_content     = '$e_content',
					  e_keywords    = '$e_keywords',
					  e_description = '$e_description'
					  where id='$id'";}
else{
$query = "update $met_column SET
                      c_content     = '$c_content',
					  c_keywords    = '$c_keywords',
					  c_description = '$c_description'
					  where id='$id'";
}
$db->query($query);
$folder=$db->get_one("select * from $met_column where id='$id'");
if($met_webhtm==1){
$fromurl=$met_weburl.$folder[foldername]."/show.php?id=".$id;
$filename="../../".$folder[foldername]."/".$folder[filename].".htm";
createhtm($fromurl,$filename);
if($met_en_lang==1){
$fromurl=$met_weburl.$folder[foldername]."/show.php?en=en&id=".$id;
$filename="../../".$folder[foldername]."/".$folder[filename]."_en.htm";
createhtm($fromurl,$filename);
}
}
okinfo('about.php?id='.$id,$lang[user_admin]);

}
else{
$about = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
if(!$about){
okinfo('../site/sysadmin.php',$lang[noid]);
}
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('about');
footer();
?>