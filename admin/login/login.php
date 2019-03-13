<?php
$admin_index=FALSE;
require_once '../include/common.inc.php';
$admincp_ok = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name' and admin_pass='$metinfo_admin_pass'");
if($metinfo_admin_name&&$metinfo_admin_pass&&$admincp_ok){
Header("Location: ../index.php");
}
else{
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('login');
footer();
}