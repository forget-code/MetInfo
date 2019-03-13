<?php
require_once '../login/login_check.php';
if($action=="add"){
if($link_lang=="")$link_lang="ch";
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
okinfo('index.php',$lang[user_admin]);
}

if($action=="editor"){
if($met_en_lang==1){
$query = "update $met_link SET
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
					  addtime              = '$m_now_date'
					  where id='$id'";
}else{
$query = "update $met_link SET
                      c_webname            = '$c_webname',
					  c_info               = '$c_info',
					  link_type            = '$link_type',
					  weburl               = '$weburl',
					  weblogo              = '$weblogo',
					  contact              = '$contact',
					  orderno              = '$orderno',
					  com_ok               = '$com_ok',
					  show_ok              = '$show_ok', 
					  link_lang            = '$link_lang', 
					  addtime              = '$m_now_date'
					  where id='$id'";
}
$db->query($query);
okinfo('index.php',$lang[user_admin]);
}
?>
