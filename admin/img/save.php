<?php
require_once '../login/login_check.php';
if($action=="add"){
$query = "INSERT INTO $met_img SET
                      c_title            = '$c_title',
                      e_title            = '$e_title',
					  c_keywords         = '$c_keywords',
					  e_keywords         = '$e_keywords',
					  c_description      = '$c_description',
					  e_description      = '$e_description',
					  c_content          = '$c_content',
					  e_content          = '$e_content',
					  class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',
					  new_ok             = '$new_ok',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',
				      com_ok             = '$com_ok',
					  hits               = '$hits', 
					  issue              = '$metinfo_admin_name',
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime', 
					  c_para1            = '$c_para1', 
					  c_para2            = '$c_para2',
					  c_para3            = '$c_para3',
					  c_para4            = '$c_para4',
					  c_para5            = '$c_para5',
					  c_para6            = '$c_para6',
					  c_para7            = '$c_para7',
					  c_para8            = '$c_para8',
					  c_para9            = '$c_para9',
					  c_para10           = '$c_para10',
					  e_para1            = '$e_para1', 
					  e_para2            = '$e_para2',
					  e_para3            = '$e_para3',
					  e_para4            = '$e_para4',
					  e_para5            = '$e_para5',
					  e_para6            = '$e_para6',
					  e_para7            = '$e_para7',
					  e_para8            = '$e_para8',
					  e_para9            = '$e_para9',
					  e_para10           = '$e_para10'";
         $db->query($query);
//静态页面生成
$later_img=$db->get_one("select * from $met_img where updatetime='$updatetime'");
$id=$later_img[id];
$folder=$db->get_one("select * from $met_column where id='$class1'");
if($met_webhtm==1){
$fromurl=$met_weburl.$folder[foldername]."/showimg.php?id=".$id;
$filename="../../".$folder[foldername]."/"."showimg".$id.".htm";
createhtm($fromurl,$filename);
if($met_en_lang==1){
$fromurl=$met_weburl.$folder[foldername]."/showimg.php?en=en&id=".$id;
$filename="../../".$folder[foldername]."/"."showimg".$id."_en.htm";
createhtm($fromurl,$filename);
}
}
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
okinfo('index.php?class1='.$class1,$lang[user_admin]);
}

if($action=="editor"){
if($met_en_lang==1){
$query = "update $met_img SET
                      c_title            = '$c_title',
                      e_title            = '$e_title',
					  c_keywords         = '$c_keywords',
					  e_keywords         = '$e_keywords',
					  c_description      = '$c_description',
					  e_description      = '$e_description',
					  c_content          = '$c_content',
					  e_content          = '$e_content',
					  class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',
					  new_ok             = '$new_ok',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',
				      com_ok             = '$com_ok',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime', 
					  c_para1            = '$c_para1', 
					  c_para2            = '$c_para2',
					  c_para3            = '$c_para3',
					  c_para4            = '$c_para4',
					  c_para5            = '$c_para5',
					  c_para6            = '$c_para6',
					  c_para7            = '$c_para7',
					  c_para8            = '$c_para8',
					  c_para9            = '$c_para9',
					  c_para10           = '$c_para10',
					  e_para1            = '$e_para1', 
					  e_para2            = '$e_para2',
					  e_para3            = '$e_para3',
					  e_para4            = '$e_para4',
					  e_para5            = '$e_para5',
					  e_para6            = '$e_para6',
					  e_para7            = '$e_para7',
					  e_para8            = '$e_para8',
					  e_para9            = '$e_para9',
					  e_para10           = '$e_para10'
					  where id='$id'";
}else{
$query = "update $met_img SET
                      c_title            = '$c_title',
					  c_keywords         = '$c_keywords',
					  c_description      = '$c_description',
					  c_content          = '$c_content',
					  class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',
					  new_ok             = '$new_ok',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',
				      com_ok             = '$com_ok',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime', 
					  c_para1            = '$c_para1', 
					  c_para2            = '$c_para2',
					  c_para3            = '$c_para3',
					  c_para4            = '$c_para4',
					  c_para5            = '$c_para5',
					  c_para6            = '$c_para6',
					  c_para7            = '$c_para7',
					  c_para8            = '$c_para8',
					  c_para9            = '$c_para9',
					  c_para10           = '$c_para10' 
					  where id='$id'";
}
$db->query($query);
//静态页面生成
$folder=$db->get_one("select * from $met_column where id='$class1'");
if($met_webhtm==1){
$fromurl=$met_weburl.$folder[foldername]."/showimg.php?id=".$id;
$filename="../../".$folder[foldername]."/"."showimg".$id.".htm";
createhtm($fromurl,$filename);
if($met_en_lang==1){
$fromurl=$met_weburl.$folder[foldername]."/showimg.php?en=en&id=".$id;
$filename="../../".$folder[foldername]."/"."showimg".$id."_en.htm";
createhtm($fromurl,$filename);
}
}
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
okinfo('index.php?class1='.$class1,$lang[user_admin]);
}
?>
