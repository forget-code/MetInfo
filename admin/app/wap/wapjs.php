<?php
if($pcok=='pc'){
	if($met_wap_tpb){
		$met_wap_url=$met_wap_url.'index.php?pcok=wap&met_mobileok=1';
	}else{
		$met_wap_url=$met_index_type==$lang?$index_url.'wap/index.php?pcok=wap&met_mobileok=1':$navurl.'wap/index.php?lang='.$lang.'pcok=wap&met_mobileok=1';
	}
	$met_wap_tpb=1;
}
$wap_footertext.="<div class='metpcmobile'>";
$wap_footertext.="<a href=\"http://".htmlentities("{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}")."?".str_replace(array('&met_mobileok=1','&pcok=wap','&pcok=pc'),'',htmlentities($_SERVER['QUERY_STRING']))."&pcok=pc\">{$lang_foottext5}</a>";
$wap_footertext.="<span>|</span>";
$wap_footertext.="<a href=\"http://".htmlentities("{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}")."?".str_replace(array('&met_mobileok=1','&pcok=wap','&pcok=pc'),'',htmlentities($_SERVER['QUERY_STRING']))."&pcok=wap&met_mobileok=1\">{$lang_foottext6}</a>";
$wap_footertext.="</div>";
if($pcok=='wap'){
//$met_foottext.="<a href=\"http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}?".str_replace(array('&met_mobileok=1','&pcok=wap','&pcok=pc'),'',$_SERVER['QUERY_STRING'])."&met_mobileok=1&pcok=wap\">{$lang_foottext6}</a>";
	$methtml_foot.="<a href=\"http://".htmlentities("{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}")."?".str_replace(array('&met_mobileok=1','&pcok=wap','&pcok=pc'),'',htmlentities($_SERVER['QUERY_STRING']))."&met_mobileok=1&pcok=wap\">{$lang_foottext6}</a>";
}

if($pcok=='pc'&&$pad!=1){
$met_foottext.="<a href=\"http://".htmlentities("{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}")."?".str_replace(array('&met_mobileok=1','&pcok=wap','&pcok=pc'),'',htmlentities($_SERVER['QUERY_STRING']))."&met_mobileok=1&pcok=wap\">{$lang_foottext6}</a>";
$methtml_foot.="<a href=\"http://".htmlentities("{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}")."?".str_replace(array('&met_mobileok=1','&pcok=wap','&pcok=pc'),'',htmlentities($_SERVER['QUERY_STRING']))."&met_mobileok=1&pcok=wap\">{$lang_foottext6}</a>";
}

if($met_mobileok!=1){
	$wap_footertext="";
}
?>