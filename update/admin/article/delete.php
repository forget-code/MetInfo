<?php
require_once '../login/login_check.php';
$backurl="index.php?class1=$class1&class2=$class2&class3=$class3";
$folder=$db->get_one("select * from $met_column where id='$class1'");
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$filename="../../".$folder[foldername]."/"."shownews".$val.".htm";
if(file_exists($filename))@unlink($filename);
$filename="../../".$folder[foldername]."/"."shownews".$val."_en.htm";
if(file_exists($filename))@unlink($filename);

$query = "delete from $met_news where id='$val'";
$db->query($query);
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


okinfo($backurl,$lang[user_admin]);
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_news WHERE id='$id'");
if(!$admin_list){
okinfo($backurl,$lang[noid]);
}
$query = "delete from $met_news where id='$id'";
$db->query($query);
$filename="../../".$folder[foldername]."/"."shownews".$id.".htm";
if(file_exists($filename))@unlink($filename);
$filename="../../".$folder[foldername]."/"."shownews".$id."_en.htm";
if(file_exists($filename))@unlink($filename);


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


okinfo($backurl,$lang[user_admin]);
}
?>
