<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="add"){
if($link_type=='')okinfox('content.php?action=add&lang='.$lang,$lang_linkTypenonull);
$query = "INSERT INTO $met_link SET
                      webname              = '$webname',
					  info                 = '$info',
					  link_type            = '$link_type',
					  weburl               = '$weburl',
					  weblogo              = '$weblogo',
					  contact              = '$contact',
					  orderno              = '$orderno',
					  com_ok               = '$com_ok',
					  show_ok              = '$show_ok',  
					  lang                 = '$lang', 
					  addtime              = '$m_now_date'";
         $db->query($query);
$htmljs = onepagehtm('link','index');
$htmljs.= indexhtm();
okinfoh('../link/index.php?lang='.$lang,$htmljs);
}
if($action=="lco"){
  $linksqok = "ok";
  die($linksqok);
}
if($action=="editor"){
$query = "update $met_link SET 
                      webname              = '$webname',
					  info                 = '$info',
					  link_type            = '$link_type',
					  weburl               = '$weburl',
					  weblogo              = '$weblogo',
					  contact              = '$contact',
					  orderno              = '$orderno',
					  com_ok               = '$com_ok',
					  show_ok              = '$show_ok', 
					  addtime              = '$m_now_date'
					  where id='$id'";

$db->query($query);
$htmljs = onepagehtm('link','index');
$htmljs.= indexhtm();
okinfoh('../link/index.php?lang='.$lang,$htmljs);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
