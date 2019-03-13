<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$tmpincfile=PATH_WEB."templates/{$_M[form][met_skin_user]}/images/css/css.inc.php";
if(file_exists($tmpincfile)){
	require_once $tmpincfile;
}
//备用字段
$infofile=PATH_WEB."templates/{$_M[form][met_skin_user]}/otherinfo.inc.php";
if(file_exists($infofile)){
	require_once($infofile);
	for($i=1;$i<=10;$i++){
		$infonameinfo="infoname".$i;
		$infonameinfo1=$$infonameinfo;
		if($infonameinfo1[0]<>$_M['word']['setotherTip2'] or $infonameinfo1[2])$infoname[$i]=array($infonameinfo1[0],$infonameinfo1[1],'1');
	}
	if($imgurlname1[0]<>$_M['word']['setotherTip2'] or $imgurlname1[2])$imgurlname[1]=array($imgurlname1[0],$imgurlname1[1],'1');
	if($imgurlname2[0]<>$_M['word']['setotherTip2'] or $imgurlname2[2])$imgurlname[2]=array($imgurlname2[0],$imgurlname2[1],'1');
}
$otherinfo = DB::get_one("SELECT * FROM {$_M[table][otherinfo]} where lang='{$_M[lang]}'");
echo <<<EOT
-->
				<div class="v52fmbx">
<input name="met_skin_css" type="hidden" value="{$_M[config][met_skin_css]}" />
<input name="otherinfoid" type="hidden" value="{$otherinfo[id]}">
<!--
EOT;
if($cssnum){
echo <<<EOT
-->				
					<h3 class="v52fmbx_hr">{$_M['word']['style_Settings']}</h3>
					<dl>
						<dd class="theme_color">
<!--
EOT;
foreach($cssnum as $key=>$val){
$val['color'] = $val[2];
if(!$val[2]){
	switch($val[0]){
		case $_M['word']['setimgBlue']:$val['color'] = '#008dde';break;
		case $_M['word']['setimgRed']:$val['color'] = '#de1a00';break;
		case $_M['word']['onlinegreen']:$val['color'] = '#09c200';break;
		case $_M['word']['sys_cyan']:$val['color'] = '#00e5e5';break;
		case $_M['word']['onlinegray']:$val['color'] = '#888';break;
		case $_M['word']['setimgPurple']:$val['color'] = '#A757A8';break;
		case $_M['word']['setimgOrange']:$val['color'] = '#FFA500';break;
	}
}
$val['class']=$_M['config']['met_skin_css']==$val[1]?'now':'';
echo <<<EOT
-->
					<a href="#" class="{$val['class']}" title="{$val[0]}" data-cssname="{$val[1]}" style="background-color:{$val['color']};"></a>
<!--
EOT;
}
echo <<<EOT
-->
						</dd>
					</dl>
<!--
EOT;
}
echo <<<EOT
-->	
	<h3 class="v52fmbx_hr">LOGO</h3>
	<dl>
		<dt>{$_M[word][upfiletips9]}</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="met_logo" type="text" data-upload-type="doupimg" class="text" value="{$_M['config']['met_logo']}">
			</div>
			<span class="tips">{$_M['word']['suggested_size']} 180 * 60 ({$_M['word']['setimgPixel']})</span>
		</dd>
	</dl>
<!--
EOT;
require $this->template('tem/zujian');
echo <<<EOT
-->	
<!--
EOT;
if(!$metinfover){
echo <<<EOT
-->
<h3 class="v52fmbx_hr">{$_M[word][skinindex]}</h3>
	<dl>
		<dd class="ftype_radio ftype_transverse" style="padding-left:15px;">
			<div class="fbox">
				<label><input name="index_hadd_ok" type="radio" value="1" data-checked="{$_M[config][index_hadd_ok]}">{$_M[word][skinindexok]}</label>
				<label><input name="index_hadd_ok" type="radio" value="0">{$_M[word][skinindexno]}</label>
			</div>
		</dd>
	</dl>
<!--
EOT;
}
echo <<<EOT
-->
<h3 class="v52fmbx_hr">{$_M[word][setseotype]}</h3>
	<dl>
		<dd class="ftype_radio ftype_transverse" style="padding-left:15px;">
			<div class="fbox">
				<label><input name="met_urlblank" type="radio" value="0" data-checked="{$_M[config][met_urlblank]}">{$_M[word][setseodopen]}</label>
				<label><input name="met_urlblank" type="radio" value="1">{$_M[word][setseonewopen]}</label>
				<span class="tips">
				{$_M['word']['recruitment_info']}<br/><br/>
				{$_M['word']['sys_navigation']}<br/><br/>
				{$_M['word']['sys_navigation1']}</span>
			</div>
		</dd>
	</dl>
<!--
EOT;
for($i=1;$i<=7;$i++){
if($infoname[$i][2]){
$infoname1="info".$i;
echo <<<EOT
-->
		<dl>
			<dt>{$infoname[$i][0]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input name="info{$i}" type="text" class="text" value="{$otherinfo[$infoname1]}" />
				</div>
				<span class="tips">{$infoname[$i][1]}</span>
			</dd>
		</dl>
<!--
EOT;
}}
if($imgurlname[1][2]){
echo <<<EOT
-->
		<dl>
			<dt>{$imgurlname[1][0]}</dt>
			<dd class="ftype_upload">
				<div class="fbox">
					<input name="imgurl1" type="text" data-upload-type="doupimg" value="{$otherinfo[imgurl1]}">
				</div>
			</dd>
		</dl>
<!--
EOT;
}
if($imgurlname[2][2]){
echo <<<EOT
-->
		<dl>
			<dt>{$imgurlname[2][0]}</dt>
			<dd class="ftype_upload">
				<div class="fbox">
					<input name="imgurl2" type="text" data-upload-type="doupimg" value="{$otherinfo[imgurl2]}">
				</div>
			</dd>
		</dl>
<!--
EOT;
}
if($infoname[8][2]){
echo <<<EOT
-->
		<dl>
			<dt>{$infoname[8][0]}{$infoname[8][1]}</dt>
			<dd class="ftype_textarea">
				<div class="fbox">
					<textarea name="info8">{$otherinfo[info8]}</textarea>
				</div>
			</dd>
		</dl>
<!--
EOT;
}
if($infoname[9][2]){

echo <<<EOT
-->
		<dl>
			<dt>{$infoname[9][0]}{$infoname[9][1]}</dt>
			<dd class="ftype_textarea">
				<div class="fbox">
					<textarea name="info9">{$otherinfo[info9]}</textarea>
				</div>
			</dd>
		</dl>
<!--
EOT;
}
if($infoname[10][2]){
echo <<<EOT
-->
		<h3 class="v52fmbx_hr">{$infoname[10][0]}{$infoname[10][1]}</h3>
		<dl>
			<dd class="ftype_ckeditor_theme">
				<div class="fbox">
					<textarea name="info10" data-ckeditor-type="2" data-ckeditor-y="200">{$otherinfo[info10]}</textarea>
				</div>
			</dd>
		</dl>
<!--
EOT;
}
echo <<<EOT
-->
				</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->