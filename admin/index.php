<?php
$admin_index=TRUE;
$force_index="metinfo";
require_once 'login/login_check.php';
$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include template('index');
footer();
?>