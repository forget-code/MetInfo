<?php
$admin_index=FALSE;
require_once '../include/common.inc.php';
if($metinfo_admin_name&&$metinfo_admin_pass){
Header("Location: ../index.php");
}
else{
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('login');
footer();
}