<?php
$depth='../';
require_once $depth.'../login/login_check.php';
if($action == 'modify'){
	require_once $depth.'../include/config.php';
	metsave('../app/wap/content.php?lang='.$lang.'&anyid='.$anyid,'',$depth);
}else{
	$listclass[4]='class="now"';
	$css_url=$depth."../templates/".$met_skin."/css";
	$img_url=$depth."../templates/".$met_skin."/images";
	include template('app/wap/content');
	footer();
}
?>