<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doseoeditor" target="_self">
<div class="v52fmbx">
	<h3 class="v52fmbx_hr">{$_M[word][columnmtitle]}{$_M[word][unitytxt_39]}</h3>
	<dl>
		<dt>{$_M[word][setseohomeKey]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_hometitle" type="text" value="{$_M[config][met_hometitle]}" />
			</div>
			<span class="tips">{$_M[word][setseoTip10]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setseotitletype]}</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input type="radio" name="met_title_type" value="0" data-checked="{$_M[config][met_title_type]}" />{$_M[word][setseotitletype1]}</label>
				<label><input type="radio" name="met_title_type" value="1" />{$_M[word][setseotitletype3]}</label>
				<label><input type="radio" name="met_title_type" value="2" />{$_M[word][setseotitletype2]}</label>
				<label><input type="radio" name="met_title_type" value="3" />{$_M[word][setseotitletype4]}</label>
			</div>
			<span class="tips">{$_M[word][setseoTip14]}</span>
		</dd>
	</dl>
	<h3 class="v52fmbx_hr">{$_M['word']['unitytxt_25']}</h3>
	<dl>
		<dt>{$_M[word][setseoKey]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_keywords" type="text" value="{$_M[config][met_keywords]}" />
			</div>
			<span class="tips">{$_M[word][seotips1]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setseoTip6]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_alt" type="text" value="{$_M[config][met_alt]}" />
			</div>
			<span class="tips">{$_M[word][setseoTip7]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setseoTip8]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_atitle" type="text" value="{$_M[config][met_atitle]}" />
			</div>
			<span class="tips">{$_M[word][setseoTip9]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setseoFriendLink]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_linkname" type="text" value="{$_M[config][met_linkname]}" />
			</div>
			<span class="tips">{$_M[word][setseoTip13]}</span>
		</dd>
	</dl>
	<h3 class="v52fmbx_hr">{$_M[word][unitytxt_26]}</h3>
	<dl>
		<dt>{$_M[word][setseoFoot]}</dt>
		<dd class="ftype_ckeditor">
			<div class="fbox">
				<textarea name="met_foottext" data-ckeditor-type="1">{$_M['config']['met_foottext']}</textarea>
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setseoTip4]}</dt>
		<dd class="ftype_ckeditor">
			<div class="fbox">
				<textarea name="met_seo" data-ckeditor-type="1">{$_M['config']['met_seo']}</textarea>
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