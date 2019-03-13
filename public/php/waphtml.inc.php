<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
function wap_foot_menu(){
	global $weburly,$met_menu_ok,$met_menu_oks,$met_menu_rgb,$met_menu_bg,$met_title,$show,$m_now_year,$navurl,$met_js_access,$met_skin_css,$img_url,$met_webname,$metcms_v,$appscriptcss,$met_ch_lang,$lang,$met_ch_mark,$met_url,$metinfouiok,$classnow,$class_list,$met_headstat;
	global $met_wap,$met_wap_tpa,$met_wap_tpb,$met_webhtm,$met_wap_url,$module,$metinfonow,$met_member_force,$met_weburl,$met_wapshowtype,$lang_foottext1,$lang_foottext2,$lang_foottext3,$lang_foottext4,$lang_footnav_tel,$index_url,$index;
	global $db,$met_wapmenu,$metinfover;
	$menu_ok=$met_menu_ok;
	$types=$met_menu_oks;
	$textbg=$met_menu_rgb;
	if($met_menu_bg==$textbg&&$met_menu_bg){
		$met_menu_bg=str_replace("../","",$met_menu_bg);
		$met_menu_bgs="style='background-image:url(".$weburly.$met_menu_bg.")'";
		$met_sioncss="#footer ul li{ display:-webkit-box; -webkit-box-flex:1; text-align:center; border-right:0px solid rgba(255,255,255,0.2); border-left:0px;}";
	}else{
		$met_menu_bgs="";
		$met_sioncss="";
		}
	
	if($textbg==null){
		$textbg='#014C8D';
	}
	$tbg=str_replace("#","",$textbg);
	$rgb=hex2rgb($tbg);
	$r=$rgb[R]-25;
	$g=$rgb[G]-25;
	$b=$rgb[B]-25;
	if($r<0){
		$r=0;
	}
	if($r<16){
		$r0=0;
	}
	if($g<0){
		$g=9;
	}
	if($g<16){
		$g0=0;
	}
	if($b<0){
		$b=0;
	}
	if($b<16){
		$b0=0;
	}
	$textbgto='#'.$r0.dechex($r).$g0.dechex($g).$b0.dechex($b);
	$query = "SELECT * FROM $met_wapmenu where lang='$lang' ORDER BY sequence asc";
	$menus=$db->query($query);
	while($list = $db->fetch_array($menus)) {
		$menurs[]=$list;
	}
	$amount=count($menurs);
	if($amount==0){
		$menu_ok=0;
	}
	if($amount==1){
		$metinfo="<style type='text/css'>
				div.on:nth-of-type(1) {
				-webkit-transform: translate(70.5px, -70.5px) rotate(720deg) !important;
				}									
			</style>";
	}
	if($amount==2){
		$metinfo="<style type='text/css'>
				div.on:nth-of-type(1) {
				-webkit-transform: translate(33.5px, -90.3px) rotate(720deg) !important;
				}				div.on:nth-of-type(2) {
				-webkit-transform: translate(90.3px, -33.5px) rotate(720deg) !important;
				}					
			</style>";
	}
	if($amount==3){
		$metinfo="<style type='text/css'>
				div.on:nth-of-type(1) {
				-webkit-transform: translate(24.35px, -97.45px) rotate(720deg) !important;
				}				div.on:nth-of-type(2) {
				-webkit-transform: translate(70.5px, -70.5px) rotate(720deg) !important;
				}				div.on:nth-of-type(3) {
				-webkit-transform: translate(97.45px, -24.35px) rotate(720deg) !important;
				}	
			</style>";
	}
	if($amount==4){
		$metinfo="";
	}
	if($menu_ok==1){
		if($types==1){
			$metinfo.="
			<div id='footernav'>
			<div class='footerboxnav'>
			<div id='jisou-info' class='jisou-info' style='display:none;'></div>
			<div class='info-nr' >
			<div id='info-nr-phone' class='info-nr-phone color-orange'>
			<input id='info-nr-btn' type='checkbox' class='info-nr-menu' style='background-color:{$textbg} !important;'>";
			foreach($menurs as $key=>$val){
				if($val[type]==1){
					if($metinfover){
						$metinfo.="<div style='background:{$textbg} !important;'> <a href='tel:{$val[value]}'><i class='fa fa-phone' style='color:{$val[menu_iconrgb]}; font-size:27px; line-height:34px;'></i></a> </div>";
					}else{
						$metinfo.="<div style='background:{$textbg} !important;'> <a href='tel:{$val[value]}'><i class='iconfont' style='color:{$val[menu_iconrgb]}; font-size:35px; line-height:29px; margin-left:-1px;'>&#xe658;</i></a> </div>";
					}
				}
				if($val[type]==2){
					if($metinfover){
						$metinfo.="<div style='background:{$textbg} !important;'> <a href='http://wpa.qq.com/msgrd?v=3&amp;uin={$val[value]}&amp;site=qq&amp;menu=yes' target='_blank'><i class='fa fa-qq' style='color:{$val[menu_iconrgb]}; font-size:20px; line-height:32px;'></i></a> </div>";
					}else{
						$metinfo.="<div style='background:{$textbg} !important;'> <a href='http://wpa.qq.com/msgrd?v=3&amp;uin={$val[value]}&amp;site=qq&amp;menu=yes' target='_blank'><i class='iconfont' style='color:{$val[menu_iconrgb]}; font-size:25px; line-height:28px;'>&#xe601;</i></a> </div>";
					}
				}
				if($val[type]==3){
					if($metinfover){
						$metinfo.="<div style='background:{$textbg} !important;'> <a href='{$navurl}index.php?lang=$lang&map=1&met_mobileok=1&uid={$val[id]}'><i class='fa fa-map-marker' style='color:{$val[menu_iconrgb]}; font-size:25px; line-height:32px;'></i></a> </div>";
					}else{
						$metinfo.="<div style='background:{$textbg} !important;'> <a href='{$navurl}index.php?lang=$lang&map=1&met_mobileok=1&uid={$val[id]}'><span class='icon-map-marker' style='color:{$val[menu_iconrgb]};'></span></a> </div>";
					}
				}
				if($val[type]==4){
					if($metinfover){
						$metinfo.="<div style='background:{$textbg} !important;'> <a href='{$index_url}'><i class='fa fa-home' style='color:{$val[menu_iconrgb]}; font-size:25px; line-height:32px;'></i></a> </div>";
					}else{
						$metinfo.="<div style='background:{$textbg} !important;'> <a href='{$index_url}'><i class='iconfont' style='color:{$val[menu_iconrgb]}; font-size:27px; line-height:32px;'>&#xe64d;</i></a> </div>";
					}
				}
				if($val[type]==5){
					$url_value=$class_list[$val[value]]['url'];
					$url_value=str_replace("../","",$url_value);
					$url_value=$navurl.$url_value;
					if($metinfover){
						$val[size] = '20';$val[lineheight] = '35';$val[marginleft] = '1';
						switch($val[columnicon]){
							case 'icon-mees':
							$val[columnicon]='fa fa-pencil-square-o';
							$val[size] = '23';
							$val[lineheight] = '35';
							$val[marginleft] = '4';
							break;
							case 'icon-pencil':$val[size] = '22';$val[lineheight] = '32';$val[marginleft] = '4';$val[columnicon]='fa fa-pencil';break;
							case 'icon-file-alt':$val[size] = '20';$val[lineheight] = '32';$val[marginleft] = '2';$val[columnicon]='fa fa-file-o';break;
							case 'icon-file':$val[size] = '20';$val[lineheight] = '32';$val[marginleft] = '2';$val[columnicon]='fa fa fa-file';break;
							case 'icon-align-justify':$val[size] = '20';$val[lineheight] = '35';$val[marginleft] = '2';$val[columnicon]='fa fa-align-justify';break;
							case 'icon-user':$val[size] = '20';$val[lineheight] = '35';$val[marginleft] = '2';$val[columnicon]='fa fa-user';break;
							case 'icon-picture':$val[size] = '20';$val[lineheight] = '35';$val[marginleft] = '2';$val[columnicon]='fa fa-picture-o';break;
							case 'icon-food':$val[size] = '20';$val[lineheight] = '35';$val[marginleft] = '2';$val[columnicon]='fa fa fa-cutlery';break;
							case 'icon-warning-sign':$val[size] = '20';$val[lineheight] = '35';$val[marginleft] = '2';$val[columnicon]='fa fa-exclamation-triangle';break;
							case 'icon-facetime-video':$val[size] = '20';$val[lineheight] = '35';$val[marginleft] = '2';$val[columnicon]='fa fa-video-camera';break;
							case 'icon-envelope':$val[size] = '20';$val[lineheight] = '30';$val[marginleft] = '1';break;
						}
						$val[columnicon] = str_replace("icon-","fa fa-",$val[columnicon]);
						$metinfo.="<div style='background:{$textbg} !important;'> <a href='{$url_value}'><i class='{$val[columnicon]}' style='color:{$val[menu_iconrgb]}; font-size:{$val[size]}px; margin-left:{$val[marginleft]}px; line-height:{$val[lineheight]}px;'></i></a> </div>";
					}else{
						if($val[columnicon]=='icon-mees'){
						$metinfo.="<div style='background:{$textbg} !important;'> <a href='{$url_value}'><i class='iconfont' style='color:{$val[menu_iconrgb]}; font-size:32px; line-height:32px;'>&#xe656;</i></a> </div>";
						}else{
						$metinfo.="<div style='background:{$textbg} !important;'> <a href='{$url_value}'><i class='{$val[columnicon]}' style='color:{$val[menu_iconrgb]}; font-size:22px; line-height:32px;'></i></a> </div>";
						}
					}
					
					
				}
			}
			$metinfo.="</div>
			</div>
			</div>
			</div>
			<style type='text/css'>
			.metcont{ padding-bottom:0px!important;}
			</style>";
		}
		
		if($types==2){
			$i=1;
				$metinfo='';
			if(!$metinfover){
				$metinfo="<link rel='stylesheet' type='text/css' href='{$weburly}public/css/wapmenu.css' />";
			}
			$metinfo.="
			<style type='text/css'>
				{$met_sioncss}
				#footer .footerlist.footerlist{background:-webkit-gradient(linear,0 0,0 100%,from({$textbg}),to({$textbgto}), color-stop(100%, {$textbgto})); }												
			</style>";
			$metinfo.="<div id='footer' >
			<div class='footerbox'>
			<div class='footerlist' {$met_menu_bgs}>
			<ul>";
			foreach($menurs as $key=>$val){
				if($val[type]==1){
					if($metinfover){
						$metinfo.="<li style='width:100%;'><a href='tel:{$val[value]}'><i class='fa fa-phone icon' style='color:{$val[menu_iconrgb]};'></i><span class='txt' style='color:{$val[menu_wordrgb]}; '>{$val[name]}</span></a></li>";
					}else{
						$metinfo.="<li style='width:100%;'><a href='tel:{$val[value]}'><i class='iconfont icon' style='color:{$val[menu_iconrgb]}; font-size:35px; line-height:23px;'>&#xe658;</i><span class='txt' style='color:{$val[menu_wordrgb]}; '>{$val[name]}</span></a></li>";
					}
				}
				if($val[type]==2){
					if($metinfover){
						$metinfo.="<li style='width:100%;'><a href='http://wpa.qq.com/msgrd?v=3&amp;uin={$val[value]}&amp;site=qq&amp;menu=yes' target='_blank'><i class='fa fa-qq icon icon' style='color:{$val[menu_iconrgb]};'></i><span  class='txt' style='color:{$val[menu_wordrgb]}; height:50px;'>{$val[name]}</span></a></li>";
					}else{
					$metinfo.="<li style='width:100%;'><a href='http://wpa.qq.com/msgrd?v=3&amp;uin={$val[value]}&amp;site=qq&amp;menu=yes' target='_blank'><i class='iconfont icon' style='color:{$val[menu_iconrgb]}; font-size:25px;'>&#xe601;</i><span  class='txt' style='color:{$val[menu_wordrgb]}; height:50px;'>{$val[name]}</span></a></li>";
					}
				}
				if($val[type]==3){
					if($metinfover){
						$metinfo.="<li style='width:100%;'><a href='{$navurl}index.php?lang=$lang&map=1&met_mobileok=1&uid={$val[id]}'><i class='icon fa fa-map-marker' style='color:{$val[menu_iconrgb]}; '></i><span class='txt' style='color:{$val[menu_wordrgb]};'>{$val[name]}</span></a></li>";
					}else{
					$metinfo.="<li style='width:100%;'><a href='{$navurl}index.php?lang=$lang&map=1&met_mobileok=1&uid={$val[id]}'><span class='icon  icon-map-marker' style='color:{$val[menu_iconrgb]}; font-size:25px;'></span><span class='txt' style='color:{$val[menu_wordrgb]};'>{$val[name]}</span></a></li>";
					}
				}
				if($val[type]==4){
					if($metinfover){
						$metinfo.="<li style='width:100%;'><a href='{$index_url}'><i class='fa fa-home icon' style='color:{$val[menu_iconrgb]}; font-size:27px;'></i><span class='txt' style='color:{$val[menu_wordrgb]};'>{$val[name]}</span></a></li>";
					}else{
					$metinfo.="<li style='width:100%;'><a href='{$index_url}'><i class='iconfont icon' style='color:{$val[menu_iconrgb]}; font-size:27px;'>&#xe64d;</i><span class='txt' style='color:{$val[menu_wordrgb]};'>{$val[name]}</span></a></li>";
					}
				}
				if($val[type]==5){
					$url_value=$class_list[$val[value]]['url'];
					$url_value=str_replace("../","",$url_value);
					$url_value=$navurl.$url_value;
					if($metinfover){
						$val[size] = '20';$val[lineheight] = '35';$val[marginleft] = '1';
						switch($val[columnicon]){
							case 'icon-mees':$val[columnicon]='fa fa-pencil-square-o';break;
							case 'icon-file-alt':$val[columnicon]='fa fa-file-o';break;
							case 'icon-picture':$val[columnicon]='fa fa-picture-o';break;
							case 'icon-food':$val[columnicon]='fa fa fa-cutlery';break;
							case 'icon-warning-sign':$val[columnicon]='fa fa-exclamation-triangle';break;
							case 'icon-facetime-video':$val[columnicon]='fa fa-video-camera';break;
						}
						$val[columnicon] = str_replace("icon-","fa fa-",$val[columnicon]);
						$metinfo.="<li style='width:100%;'><a href='{$url_value}'><i class='icon {$val[columnicon]}' style='color:#fff;  color:{$val[menu_iconrgb]};'></i><span class='txt' style='color:{$val[menu_wordrgb]};'>{$val[name]}</span></a></li>";
					}else{
					if($val[columnicon]=='icon-mees'){
						$metinfo.="<li style='width:100%;'><a href='{$url_value}'><i class='iconfont icon' style='color:{$val[menu_iconrgb]}; font-size:32px;'>&#xe656;</i><span class='txt' style='color:{$val[menu_wordrgb]};'>{$val[name]}</span></a></li>";
					}else{
						$metinfo.="<li style='width:100%;'><a href='{$url_value}'><span class='icon {$val[columnicon]}' style='color:#fff;  color:{$val[menu_iconrgb]}; font-size:22px;'></span><span class='txt' style='color:{$val[menu_wordrgb]};'>{$val[name]}</span></a></li>";
					}
					}
				}
				$i=$i+1;
			}
			$metinfo.="</ul>
			</div>
			</div>
			</div>";
		}
	}else{
		$metinfo="<style type='text/css'>
		.metcont{ padding-bottom:0px!important;}
		</style>";
	}
return $metinfo;
}  
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
