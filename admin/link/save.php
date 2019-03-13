<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="add"){
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
onepagehtm('link','index');
indexhtm();
okinfo('index.php?lang='.$lang,$lang_jsok);
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
onepagehtm('link','index');
indexhtm();
okinfo('index.php?lang='.$lang,$lang_jsok);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
