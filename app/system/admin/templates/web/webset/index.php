<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');

$disabled='';
$weburltext = "{$_M[word][upfiletips10]}{$_M[url][site]}";
if($_M[langlist][web][$_M[lang]][link]){
	$met_weburl = $_M[langlist][web][$_M[lang]][link];
	$disabled = 'disabled';
	$weburltext = "{$_M[word][unitytxt_8]}";
}
if($_M[config][met_weburl]=='')$_M[config][met_weburl]=$_M[url][site];
$data_key = md5(md5(substr($_M['config']['met_webkeys'],0,8))); 
$time = time();
   if(!strstr('https',$_M[url][own_form])){
	 $_M[url][own_form]=str_replace('http:','',$_M[url][own_form]);
  }

echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doseteditor" target="_self">
<div class="v52fmbx" data-gent="{$_M[form][gent]}" data-webset-record="{$record}">
	<h3 class="v52fmbx_hr">{$_M['word']['setbasicWebInfoSet']}</h3>
	<dl>
		<dt>{$_M[word][setbasicWebName]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_webname" type="text" value="{$_M[config][met_webname]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][upfiletips9]}</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="met_logo" type="text" data-upload-type="doupimg" class="text" value="{$_M['config']['met_logo']}">
			</div>
			<span class="tips">{$_M['word']['suggested_size']} 180 * 60 ({$_M['word']['setimgPixel']})</span>
		</dd>
	</dl>
	<dl>
		<dt>地址栏图标</dt>
		<dd class="ftype_upload">
			<div class="fbox">
				<input name="met_ico" type="text" data-upload-key="{$data_key}" data-upload-type="doupico" class="text" value="../favicon.ico?{$time}">
			</div>
			<span class="tips">{$_M['word']['suggested_size']} 32 * 32 ({$_M['word']['setimgPixel']})的.ico文件。<a href="https://www.baidu.com/s?wd=ico%E5%9B%BE%E6%A0%87%E5%88%B6%E4%BD%9C" target="_blank">点击制作ICO</a>
			<br />
			如果无法正常显示新上传图标，清空浏览器缓存后访问。
			</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setbasicWebSite]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_weburl" type="text" value="{$_M[config][met_weburl]}" {$disabled} />
			</div>
			<span class="tips">{$weburltext}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][upfiletips12]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_keywords" type="text" value="{$_M[config][met_keywords]}" />
			</div>
			<span class="tips">{$_M[word][upfiletips13]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][upfiletips14]}</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="met_description">{$_M[config][met_description]}</textarea>
			</div>
			<span class="tips">{$_M[word][upfiletips15]}（{$_M[word][current_input]} <span class="met_description_tips"></span> {$_M[word][sys_characters]}）</span>
			
		</dd>
	</dl>
	<h3 class="v52fmbx_hr">{$_M[word][unitytxt_13]}</h3>
	<dl>
		<dt>{$_M[word][setfootVersion]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_footright" type="text" value="{$_M[config][met_footright]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setfootAddressCode]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_footaddress" type="text" value="{$_M[config][met_footaddress]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setfootContact]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_foottel" type="text" value="{$_M[config][met_foottel]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setfootOther]}</dt>
		<dd class="ftype_ckeditor">
			<div class="fbox">
				<textarea name="met_footother" data-ckeditor-type="2" data-ckeditor-y="100">{$_M['config']['met_footother']}</textarea>
			</div>
		</dd>
	</dl>
	<dl class="noborder">
		<dt> </dt>
		<dd>
			<input type="submit" name="submit" value="{$_M['word']['Submit']}" class="submit">
		</dd>
	</dl>
</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>