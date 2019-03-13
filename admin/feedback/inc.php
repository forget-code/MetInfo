<?php
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
okinfo('inc.php',$lang[user_admin]);
}
else{
$settings = parse_ini_file('../../feedback/config.inc.php');
@extract($settings);
$met_weburl=substr($met_weburl, 0, -1);
$met_fd_type1[$met_fd_type]="checked='checked'";
$met_fd_back1=($met_fd_back)?"checked='checked'":"";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('fd_inc');
footer();
}
?>