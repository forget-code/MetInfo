<?php
$depth='../';
require_once $depth.'../login/login_check.php';
//$action='dimensional';
echo str_replace(array('http',':','/'),$met_wap_url);
if($action == 'dimensional'){
	require_once ROOTPATH.'include/export.func.php';
	$met_file='/dimensional.php';
	//$met_dimensional_logo=$met_weburl.str_replace('../','',$met_dimensional_logo);
	$met_dimensional_logo_file=file_get_contents(ROOTPATH.str_replace('../','',$met_dimensional_logo));
	$met_dimensional_logo_file=urlencode($met_dimensional_logo_file);
	$met_weburl_mobile = $met_weburl;
	if($met_wap_tpb){
		if($met_langok[$lang][link]){
			$met_weburl_mobile = $met_langok[$lang][link];
		}
		if($met_wap_url)$met_weburl_mobile=$met_wap_url;
	}
	$post=array('text'=>$met_weburl_mobile,'w'=>$wap_dimensional_size,'logo'=>$met_dimensional_logo_file);
	$re=curl_post($post,30);
	if(!file_exists('../../../upload/files/'))mkdir('../../../upload/files/');
	file_put_contents('../../../upload/files/dimensional.png',$re);
	require_once $depth.'../include/config.php';
	echo '../../../upload/files/dimensional.png?'.met_rand(4);
	die();
}
if($action == 'modify'){
	if($met_wapshowtype==0){
		$met_wap_ok=0;
	}else{
		$query = "update {$met_column} SET wap_ok = '0' where lang='$lang'";
		$db->query($query);
		if($f_columnlist!=','){
			$allidlist=explode(',',$f_columnlist);
			foreach($allidlist as $key=>$val){
				if($val){
					$query = "update {$met_column} SET wap_ok = '1' where id = '$val' and lang='$lang'";
					$db->query($query);
				}
			}
		}
		if($f_wap_nav_ok&&$f_wap_nav_ok!=','){
			$query = "update {$met_column} SET wap_nav_ok = '0' where lang='$lang'";
			$db->query($query);
			$allidlist=explode(',',$f_wap_nav_ok);
			foreach($allidlist as $key=>$val){
				if($val){
					$query = "update {$met_column} SET wap_nav_ok = '1' where id = '$val' and lang='$lang'";
					$db->query($query);
				}
			}
		}
	}
	if(!$met_wap_tpa)$met_wap_tpa=0;
	if($met_wap_url){
		$met_wap_tpb=1;
	}else{
		$met_wap_tpb=0;
	}
	$met_wap_url = ereg_replace(" ","",$met_wap_url);
	if(substr($met_wap_url,-1,1)!="/")$met_wap_url.="/";
	if(!strstr($met_wap_url,"http://"))$met_wap_url="http://".$met_wap_url;
	if($met_wap_url=='http://'||$met_wap_url=='http:///')$met_wap_url='';
	require_once $depth.'../include/config.php';
	$reload = $_M['config']['met_wap'] == $met_wap ? 0 : 1;
	metsave('../app/wap/wap.php?lang='.$lang.'&anyid='.$anyid.'&reload='.$reload,'',$depth);
}else{
	if($reload == 1){
		echo "<script>parent.window.location.reload();</script>";
		exit();
	}
	$met_wap1[$met_wap]="checked";
	$met_waplink1[$met_waplink]="checked";
	$met_wap_ok1[$met_wap_ok]="checked";
	$met_wap_tpa1[$met_wap_tpa]="checked";
	$met_wap_tpb1[$met_wap_tpb]="checked";
	$met_wapshowtype1[$met_wapshowtype]="checked";
	$webmpa = $_SERVER["PHP_SELF"];
	$webmpa = dirname($webmpa);
	$webmpa = explode('/',$webmpa);
	$wnum = count($webmpa)-2;
	for($i=1;$i<$wnum;$i++){
		$webmp = $i==1?$webmpa[$i]:$webmp.'/'.$webmpa[$i];
	}
	if(substr($webmp,-1,1)!="/")$webmp.="/";
	$webml = 'http://'.$_SERVER['HTTP_HOST'].'/';
	$webwapurl = $webml.$webmp.'wap/';
	$listclass[1]='class="now"';
	$css_url=$depth."../templates/".$met_skin."/css";
	$img_url=$depth."../templates/".$met_skin."/images";
	include template('app/wap/wap');
	footer();
}
?>