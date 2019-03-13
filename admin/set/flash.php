<?php
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
okinfo('flash.php',$lang[user_admin]);
}
else{
if($met_flash_ok==1)$met_flash_ok1="checked='checked'";
if($met_flash_type==0){
$met_flash_type0="checked='checked'";
}else{
$met_flash_type1="checked='checked'";
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_flash');
footer();
}
?>