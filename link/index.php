<?php
require_once '../include/common.inc.php';
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";
$navtitle=($en=="en")?"Friendly Link":"友情链接";
if($en=="en"){
    $query = "SELECT * FROM $met_link where link_lang!='ch' and show_ok='1' order by orderno desc";
	}else{
	$query = "SELECT * FROM $met_link where link_lang!='en' and show_ok='1' order by orderno desc";
	}
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	if($list[link_type]=="0"){
	if($list[com_ok]=="1")$link_text_com[]=$list;
	$link_text[]=$list;
	}
	
	if($list[link_type]=="1"){
	if($list[com_ok]=="1")$link_img_com[]=$list;
	$link_img[]=$list;
	}
	if($list[com_ok]=="1")$link_com[]=$list;
	$link[]=$list;
	}

require_once '../include/head.php';
if($en=="en"){
$e_title_keywords=$navtitle."--".$e_title_keywords;
include template('e_link_index');
}
else{
$c_title_keywords=$navtitle."--".$c_title_keywords;
include template('link_index');
}

footer();
?>