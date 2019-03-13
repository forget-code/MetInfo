<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once 'mobile_detect.php';
if($pcok=='deleted' || $pcok=='\de\leted')$pcok='';
if($pcok){
	if($pcok!='wap'&&$pcok!='pc'){
		header("location:404.html");die;
	}
}

if($met_mobileok){
	$pattern='/^[1-9]?\d$/';
	if(!preg_match($pattern,$met_mobileok)){
		header("location:404.html");die;
	}
}
$detect = new mobile_detect;
function toHex($N) {
    if ($N==NULL) return "00";
    if ($N==0) return "00";
    $N=max(0,$N);
    $N=min($N,255);
    $N=round($N);
    $string = "0123456789ABCDEF";
    $val = (($N-$N%16)/16);
    $s1 = $string{$val};
    $val = ($N%16);
    $s2 = $string{$val};
    return $s1.$s2;
}

function rgb2hex($r,$g,$b){
    return toHex($r).toHex($g).toHex($b);
}

function hex2rgb($N){
    $dou = str_split($N,2);
    return array(
        "R" => hexdec($dou[0]),
        "G" => hexdec($dou[1]),
        "B" => hexdec($dou[2])
    );
}
function mobilejump($tp){
	global $met_wap_tpa,$met_wap_tpb,$met_wap_url,$met_wap,$met_mobileok,$lang,$index,$db;
	$met_mobileok=$tp?$met_mobileok:0;
	if($met_wap&&!$met_mobileok){
		//$Loaction = $index?'wap/index.php?lang='.$lang:'../wap/index.php?lang='.$lang;
         $Loaction  ='index.php?lang='.$lang.'&met_mobileok=1';
		if($met_wap_tpa==1){
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			if($_SERVER['HTTP_USER_AGENT']){
				$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile|wap|Android|ucweb)/i";
				if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap')){
					if (!empty($Loaction)){
						//if($met_wap_tpb==1&&$met_wap_url!='') $Loaction=$met_wap_url.$Loaction;
						$Loaction = trim($Loaction);
						header("Location: $Loaction");
						exit;
					}
				}
			}
		}
		if($met_wap_tpb==1){
			$localurl="http://";
			$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
			$localurl=dirname($localurl);
			if(substr($localurl,-1,1)!="/")$localurl.="/";
			if(strstr($localurl,$met_wap_url)){
				header("Location: $Loaction\n");
				exit;
			}
		}
	}
}
met_setcookie("pcok",$pcok,0);
$isTablet=$detect->isTablet();
if($isTablet&&$pcok!='wap'){
		$pcok='pc';
		$met_webhtm=0;
		$met_pseudo=0;
		$met_mobileok=0;
		$pad=1;
}
if($isTablet&&(substr($_SERVER['HTTP_REFERER'],-5)=='.html'||substr($_SERVER['HTTP_REFERER'],-4)=='.htm')){
		$pcok='pc';
		$met_webhtm=0;
		$met_pseudo=0;
		$met_mobileok=0;
		$pad=1;
		met_setcookie("pcok",'pc',0);
}
if($pcok!='pc'){
	if(!$met_wap_url)$met_wap_url=$met_index_url[$lang];

	if(($met_mobileok||!$index)&&strstr($_SERVER['HTTP_USER_AGENT'],"UCWEB/2.0")){
		$met_mobileok='';
		mobilejump(1);
	}
	if($index=='index'&&$met_wap&&!$met_mobileok)mobilejump(1);
	if($index!='index'&&$met_wap&&!$met_mobileok){
		$met_mobileok=0;
		if($met_wap_tpa==1){
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			if($_SERVER['HTTP_USER_AGENT']){
				$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile|wap|Android|ucweb)/i";
				if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap')){
					if (!empty($wap_skin_user)){
						if($met_wap_tpb&&$met_wap_url){
							$localurl="http://";
							$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
							$localurl=dirname($localurl);
							if(substr($localurl,-1,1)!="/")$localurl.="/";
							if(!strstr($localurl,$met_wap_url)){
								$mobile_prefix=request_uri();
								$mobile_prefix=str_replace($met_weburl,$met_wap_url,$mobile_prefix);
								header("Location: $mobile_prefix\n");
								exit;
							}
						}
						$met_mobileok = 1;
					}
				}
			}
		}
		if($met_wap_tpb==1){
			$localurl="http://";
			$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
			$localurl=dirname($localurl);
			if(substr($localurl,-1,1)!="/")$localurl.="/";
			if(strstr($localurl,$met_wap_url)){
				$met_mobileok = 1;
			}
		}
	}
	$mobilesql='';
	if($met_mobileok){
		$met_skin_user = $wap_skin_user;
		$_M[config][met_skin_user] = $_M[config][wap_skin_user];
		$met_urlblank = 0;
		$met_online_type=3;
		$met_memberlogin_code=0;
		$met_news_list = $wap_news_list;
		$met_product_list = $wap_product_list;
		$met_download_list = $wap_download_list;
		$met_img_list = $wap_img_list;
		$met_job_list = $wap_job_list;
		$met_message_list = $wap_message_list;
		$met_search_list = $wap_search_list;
		
		$met_footright ='';
		$met_footstat ='';
		$met_footaddress ='';
		$met_foottel ='';
		$met_footother ='';
		$met_foottext ='';
		
		if($metinfover){
		$wap_footertext.="
		<script src=\"../public\ui\mobile\js\ini.js\" type=\"text/javascript\"></script>\n
		<link rel=\"stylesheet\" type=\"text/css\" href=\"../public/ui/v1/js/effects/video-js/video-js.css\" />\n
		<script src=\"../public/ui/v1/js/effects/video-js/video_hack.js\" type=\"text/javascript\"></script>\n
		";
		}
		
		$met_flasharraytd = array();
		foreach($met_flasharray as $key=>$val){
			$val[type] = $val[wap_type];
			$val[y]    = $val[wap_y];
			$met_flasharraytd[$key] = $val;
		}
		$met_flasharray = $met_flasharraytd;
		if($wap_title){
			$met_hometitle=$wap_title;
			$met_webname=$wap_title;
			$met_title_type=2;
		}
		if($met_wap_url){
			$met_weburl=$met_wap_url;
		}
		if($met_wap_logo)$met_logo=$met_wap_logo;
		$mobilesql = $met_wap_ok?"and wap_ok='1'":'';
		$met_skin_css=$wap_skin_css;
		$met_webhtm=0;
		$met_pseudo=0;
		}
}else{
	if($pcok=='wap'){
		$met_webhtm=0;
		$met_pseudo=0;
	}
	$met_mobileok=0;
}
$suffix = substr($_SERVER['REQUEST_URI'],-5);
if($suffix == '.html'){
	$met_pseudo=$db->get_one("SELECT value FROM $met_config WHERE name='met_pseudo' AND lang='$lang'");
	$met_pseudo=$met_pseudo['value'];
}
include ROOTPATH.'public/php/waphtml.inc.php';
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>