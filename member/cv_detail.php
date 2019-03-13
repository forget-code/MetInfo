<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once 'login_check.php';

$cv_list=$db->get_one("select * from $met_cv where id='$id'");
if(!$cv_list){
okinfo('cv.php',$lang_NoidJS);
}
$query = "SELECT * FROM $met_parameter where lang='$lang' and module=6  order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$value_list=$db->get_one("select * from $met_plist where paraid=$list[id] and listid=$id ");
if($list[type]==5)
{
	$value_list[info]="<a href='$value_list[info]'>$value_list[info]</a>";
}

$list[content]=$value_list[info];
$cv_para[]=$list;
}

$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('cv_detail');
footermember();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>