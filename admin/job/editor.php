<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$job_list=$db->get_one("select * from $met_job where id='$id'");
if(!$job_list){
okinfo('index.php',$lang[noid]);
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('job_editor');
footer();
?>