<?php
require_once '../login/login_check.php';
if($action=="add"){
$query = "INSERT INTO $met_news SET
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
					  img_ok             = '$img_ok',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',
				      com_ok             = '$com_ok',
					  issue              = '$issue',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime'";
         $db->query($query);
//静态页面生成
$later_news=$db->get_one("select * from $met_news where updatetime='$updatetime'");
$id=$later_news[id];
$folder=$db->get_one("select * from $met_column where id='$class1'");
if($met_webhtm==1){
$fromurl=$met_weburl.$folder[foldername]."/shownews.php?id=".$id;
$filename="../../".$folder[foldername]."/"."shownews".$id.".htm";
createhtm($fromurl,$filename);
if($met_en_lang==1){
$fromurl=$met_weburl.$folder[foldername]."/shownews.php?en=en&id=".$id;
$filename="../../".$folder[foldername]."/"."shownews".$id."_en.htm";
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
$query = "update $met_news SET
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
					  img_ok             = '$img_ok',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',
				      com_ok             = '$com_ok',
					  issue              = '$issue',
					  hits               = '$hits',
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime'
					  where id='$id'";
}else{
$query = "update $met_news SET
                      c_title            = '$c_title',
					  c_keywords         = '$c_keywords',
					  c_description      = '$c_description',
					  c_content          = '$c_content',
					  class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',
					  img_ok             = '$img_ok',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',
				      com_ok             = '$com_ok',
					  issue              = '$issue',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime'
					  where id='$id'";
}
$db->query($query);
//静态页面生成
$folder=$db->get_one("select * from $met_column where id='$class1'");
if($met_webhtm==1){
$fromurl=$met_weburl.$folder[foldername]."/shownews.php?id=".$id;
$filename="../../".$folder[foldername]."/"."shownews".$id.".htm";
createhtm($fromurl,$filename);
if($met_en_lang==1){
$fromurl=$met_weburl.$folder[foldername]."/shownews.php?en=en&id=".$id;
$filename="../../".$folder[foldername]."/"."shownews".$id."_en.htm";
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
