<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$tmpincfile=PATH_WEB."templates/{$_M[form][met_skin_user]}/images/css/css.inc.php";
if(file_exists($tmpincfile)){
	require_once $tmpincfile;
}
$_M['config']['met_skin_css']  = $_M['config']['wap_skin_css'];
echo <<<EOT
-->
				<div class="v52fmbx">
<input name="met_skin_css" type="hidden" value="{$_M[config][met_skin_css]}" />
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
		case $_M['word']['sys_orange']:$val['color'] = '#de6300';break;
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
				<input name="met_wap_logo" type="text" data-upload-type="doupimg" class="text" value="{$_M['config']['met_wap_logo']}">
			</div>
			<span class="tips">为空则调用电脑版LOGO，推荐尺寸：130*50 (像素)</span>
		</dd>
	</dl>
<!--
EOT;
require $this->template('tem/zujian');
echo <<<EOT
-->
				<h3 class="v52fmbx_hr">{$_M['word']['menu_settings']}</h3>
<div class="moretemp">
<a href='{$_M[url][site_admin]}app/wap/custommenu.php?lang={$_M[lang]}&anyid=77&cs=5' target='_blank'>{$_M['word']['settings_page']}</a>
</div>
				</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->