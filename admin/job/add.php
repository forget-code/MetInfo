<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('job_add');
footer();
?>