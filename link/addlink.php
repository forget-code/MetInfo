<?php
require_once '../include/common.inc.php';
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";

$navtitle=($en=="en")?"Apply Friendly Link":"友情链接申请";
$link_lang=($en=="en")?"en":"ch";
if($action=="add"){
$query = "INSERT INTO $met_link SET
                      c_webname            = '$c_webname',
                      e_webname            = '$e_webname',
					  c_info               = '$c_info',
					  e_info               = '$e_info',
					  link_type            = '$link_type',
					  weburl               = '$weburl',
					  weblogo              = '$weblogo',
					  contact              = '$contact',
					  orderno              = '$orderno',
					  com_ok               = '$com_ok',
					  show_ok              = '$show_ok', 
					  link_lang            = '$link_lang', 
					  addtime              = '$m_now_date'";
         $db->query($query);
if($en=="en"){
		 okinfo('index.php?en=en',"Successfully,Thanks!");
}else{
         okinfo('index.php',"您的网站已成功提交，谢谢！");
}
}
else{


$fdjs="<script language='javascript'>";
$fdjs=$fdjs."function Checklink(){ ";
if($en=="en"){
$fdjs=$fdjs."if (document.myform.e_webname.value.length == 0) {";
$fdjs=$fdjs."alert('WebName is Null');";
$fdjs=$fdjs."document.myform.e_webname.focus();";
}else{
$fdjs=$fdjs."if (document.myform.c_webname.value.length == 0) {";
$fdjs=$fdjs."alert('网站名称不能为空');";
$fdjs=$fdjs."document.myform.c_webname.focus();";
}
$fdjs=$fdjs."return false;}";
$fdjs=$fdjs."if (document.myform.weburl.value.length == 0 || document.myform.weburl.value == 'http://') {";
if($en=="en"){
$fdjs=$fdjs."alert('Web Url is Null');";
}else{
$fdjs=$fdjs."alert('网站地址不能为空');";
}
$fdjs=$fdjs."document.myform.weburl.focus();";
$fdjs=$fdjs."return false;}";
$fdjs=$fdjs."}</script>";

require_once '../include/head.php';
if($en=="en"){
$title_keywords=$e_title_keywords;
$e_title_keywords=$navtitle."--".$e_title_keywords;
include template('e_addlink');
}
else{
$title_keywords=$c_title_keywords;
$c_title_keywords=$navtitle."--".$c_title_keywords;

include template('addlink');
}

footer();
}
?>