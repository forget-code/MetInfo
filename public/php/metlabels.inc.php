<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
function metlabel_head($closure=1,$iehack=1,$mobileto=''){
	global $met_mobileok,$met_title,$show,$classnow,$id,$class_list,$navurl,$met_js_access,$img_url;
	global $appscriptcss;
	global $_M;
	$met_skin_css = $_M['config']['met_skin_css']==''?'metinfo.css':$_M['config']['met_skin_css'];
	$closure = $closure?"\n</head>":'';
	if($met_mobileok){
		$metinfo="
<!DOCTYPE HTML>
<html>
<head>
<meta charset=\"utf-8\" />
<title>{$met_title}</title>
<meta name=\"description\" content=\"{$show['description']}\" />
<meta name=\"keywords\" content=\"{$show['keywords']}\" />
<meta name=\"renderer\" content=\"webkit\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
<meta content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\" name=\"viewport\" />
<meta name=\"generator\" content=\"MetInfo {$_M[config][metcms_v]}\"  data-variable=\"{$_M[config][met_weburl]}|{$_M[lang]}|{$classnow}|{$id}|{$class_list[$classnow][module]}|{$_M[config][met_skin_user]}|mobile\" />
<meta content=\"yes\" name=\"apple-mobile-web-app-capable\" />
<meta content=\"black\" name=\"apple-mobile-web-app-status-bar-style\" />
<meta content=\"telephone=no\" name=\"format-detection\" />
<link href=\"favicon.ico\" rel=\"apple-touch-icon-precomposed\" />
<link href=\"favicon.ico\" rel=\"shortcut icon\" type=\"image/x-icon\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"{$img_url}css/{$met_skin_css}\" />{$met_js_access}{$closure}";
	}else{
		$iehack = $iehack?"<!--[if IE]><script src=\"{$navurl}public/js/html5.js\" type=\"text/javascript\"></script><![endif]-->":'';
		$metinfo="
<!DOCTYPE HTML>
<html>
<head>
<meta charset=\"utf-8\" />{$mobileto}
<title>{$met_title}</title>
<meta name=\"description\" content=\"{$show['description']}\" />
<meta name=\"keywords\" content=\"{$show['keywords']}\" />
<meta name=\"renderer\" content=\"webkit\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
<meta content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\" name=\"viewport\" />
<meta name=\"generator\" content=\"MetInfo {$_M[config][metcms_v]}\"  data-variable=\"{$_M[config][met_weburl]}|{$_M[lang]}|{$classnow}|{$id}|{$class_list[$classnow][module]}|{$_M[config][met_skin_user]}\" />
<link href=\"{$navurl}favicon.ico\" rel=\"shortcut icon\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"{$img_url}css/{$met_skin_css}\" />
{$_M['html_plugin']['head_script']}{$appscriptcss}{$iehack}{$met_js_access}{$_M[config][met_headstat]}{$closure}";
	}
	return $metinfo;
}
function metlabel_topnav($dt='',$tp=1,$lok=1){
	global $met_langok,$met_langok,$met_lang_mark,$met_index_url,$app_file,$met_adminfile,$met_index_type,$index_url,$navurl,$met_lang_mark,$met_wap_url;
	global $_M;
	/*手机版链接*/
	if($_M['config']['met_waplink'] && $_M['config']['met_wap']){
		if($met_wap_url){
			$indurl = $met_wap_url;
		}else{
			//$indurl = $met_index_type==$_M[lang]?$index_url.'wap/':$navurl.'wap/index.php?lang='.$_M[lang];
			$indurl = $met_index_type==$_M[lang]? $index_url.'index.php?lang='.$_M[lang].'&met_mobileok=1':$navurl.'index.php?lang='.$_M[lang].'&met_mobileok=1';
			if($_M['config']['met_wap_tpb']&&$_M['config']['met_wap_url'])$indurl = $_M['config']['met_wap_url'];
		}
		$mobile = "<li><a href='{$indurl}' title='{$_M['word']['wap']}'>{$_M['word']['wap']}</a></li>{$dt}";
	}
	/*JS繁体中文*/
	if($_M['config']['met_ch_lang'] and $_M['lang']=='cn'){
		if(count($met_langok)>1&&$met_lang_mark){
			$chjs="<ol><li class='line'>|</li></ol>";
		}
		$chjs.="<li><a href=\"#\" class=\"StranBody\" >{$_M['word']['chchinese']}</a></li>";
	}
	/*多语言*/
	if($lok&&$met_lang_mark){
		foreach($met_langok as $key=>$val){
			$flag = $tp==2?"<img src='{$val[flag]}'/>":'';
			$urlnew=$val['newwindows']?"target='_blank'":"";
			if($val['useok'])$langlist.="{$dt}<li><a href='{$met_index_url[$val[mark]]}' {$urlnew}>{$flag}{$val[name]}</a></li>";
		}
	}
	$metinfo = "<ol>{$sethome}{$addFavorite}{$mobile}{$chjs}{$langlist}</ol>";
	$metinfo = str_replace($dt.$dt, $dt, $metinfo);
	/*应用*/
	$file_site = explode('|',$app_file[4]);
	foreach($file_site as $keyfile=>$valflie){
		if(file_exists(ROOTPATH."$met_adminfile".$valflie)&&!is_dir(ROOTPATH."$met_adminfile".$valflie)&&((file_get_contents(ROOTPATH."$met_adminfile".$valflie))!='metinfo')){require_once ROOTPATH."$met_adminfile".$valflie;}
	}

	return $metinfo;

}
function metlabel_form($list,$type){
	global $fdjs,$lang,$lang_Nolimit,$lang_memberPosition,$selectjob,$cv_para,$paravalue,$met_memberlogin_code,$lang_memberImgCode,$lang_memberTip1,$lang_Submit,$navurl;
	$lista=array();
	foreach($list as $key=>$val){
		$metinfo="";
		$val[des]=$val[description];//增加描述赋值给新属性
		switch($val[type]){
			case 1:
				$val[type_class]='ftype_input';
				$wr_ok = $val[wr_ok]?'data-required=1':'';
				$val[dataname]=$type=='cv'?$val[para]:"para{$val[id]}";
				$val[type_html]="<input name='{$val[dataname]}' type='text' placeholder='{$val[description]}' {$wr_ok} />";
				$val[description]='';
			break;
			case 2:
				$val[type_class]='ftype_select';
				$wr_ok = $val[wr_ok]?'data-required=1':'';
				$metinfo.="<select name='para{$val[id]}' {$wr_ok}><option value=''>{$lang_Nolimit}</option>";
				foreach($paravalue[$val[id]] as $key=>$val1){
				$metinfo.="<option value='{$val1[info]}'>{$val1[info]}</option>";
				}
				$metinfo.="</select>";
				$val[type_html]=$metinfo;
			break;
			case 3:
				$wr_ok = $val[wr_ok]?'data-required=1':'';
				$val[type_class]='ftype_textarea';
				$val[dataname]=$type=='cv'?$val[para]:"para{$val[id]}";
				$val[type_html]="<textarea name='{$val[dataname]}' {$wr_ok} placeholder='{$val[description]}'></textarea>";
				$val[description]='';
			break;
			case 4:
				$val[type_class]='ftype_checkbox';
				$i=0;
				foreach($paravalue[$val[id]] as $key=>$val1){
				$i++;
				$wr_ok = $val[wr_ok]&&$i==1?'data-required=1':'';
				$metinfo.="<label><input name='para{$val[id]}_{$i}' {$wr_ok} type='checkbox' value='{$val1[info]}' />{$val1[info]}</label>";
				}
				$val[type_html]=$metinfo;
			break;
			case 5:
				$val[type_class]='ftype_upload';
				$wr_ok = $val[wr_ok]?'data-required=1':'';
				$val[dataname]=$type=='cv'?$val[para]:"para{$val[id]}";
				$val[type_html]="<input name='{$val[dataname]}' {$wr_ok} type='file' />";
			break;
			case 6:
				$val[type_class]='ftype_radio';
				$i=0;
				foreach($paravalue[$val[id]] as $key=>$val2){
				$i++;
				$wr_ok = $val[wr_ok]&&$i==1?'data-required=1':'';
				$checked=$i==1?'checked':'';
				$metinfo.="<label><input name='para{$val[id]}' {$wr_ok} type='radio' value='{$val2[info]}' {$checked} />{$val2[info]}</label>";
				}
				$val[type_html]=$metinfo;
			break;
		}
		$lista[]=$val;
	}
	if($met_memberlogin_code==1){
		$val[name] = $lang_memberImgCode;
		$val[type_class] = 'ftype_input ftype_code';
		$val[type_html] = "<input name='code' data-required='1' type='text' /><img align='absbottom' src='{$navurl}/member/ajax.php?action=code' onclick=this.src='../member/ajax.php?action=code&'+Math.random() alt={$lang_memberTip1}'/>";
		$val[description] = '';
		$lista[] = $val;
	}
	$metinfo = $lista;
	return $metinfo;
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>