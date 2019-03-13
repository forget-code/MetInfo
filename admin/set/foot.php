<?php
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
okinfo('foot.php',$lang[user_admin]);
}
else{
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_foot');
footer();
}
?>