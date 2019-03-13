<?php
require_once '../login/login_check.php';
$infofile="../../templates/".$met_skin_user."/info.html";
if(!file_exists($infofile))die("该模板没有相关的配置说明！");

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template1('info');
footer();

function template1($template,$EXT="html"){
	global $met_skin_name,$met_skin_user;
	unset($GLOBALS[con_db_id],$GLOBALS[con_db_pass],$GLOBALS[con_db_name]);
	$path = ROOTPATH."templates/$met_skin_user/$template.$EXT";
	!file_exists($path) && $path=ROOTPATH."templates/met/$template.$EXT";
	return  $path;
}
?>