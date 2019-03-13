<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dourleditor" target="_self">
<div class="v52fmbx">
	<h3 class="v52fmbx_hr">{$_M['word']['unitytxt_1']}</h3>
	<dl>
		<dt>{$_M['word']['sys_static']}</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input type="radio" name="met_pseudo" value="1" data-checked="{$_M[config][met_pseudo]}" />{$_M[word][open]}</label>
				<label><input type="radio" name="met_pseudo" value="0" />{$_M[word][close]}</label>
			</div>
			<span class="tips">{$_M['word']['simplify_front_desk']}URL{$_M['word']['and_to']}html{$_M['word']['sys_end']}</span>
		</dd>
	</dl>
	<dl>
		<dd class="ftype_description">
			{$_M[word][mod_rewrite_column]}
		</dd>
	</dl>
	<h3 class="v52fmbx_hr">URL{$_M['word']['structure_mode']}</h3>
	<dl>
		<dt>{$_M[word][seotips6]}</dt>
		<dd>
			index-{$_M[word][langmark]}.html（{$_M[word][seotips7]}{$_M['word']['marks']}index-cn.html）
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setskinListPage]}</dt>
		<dd>
			{$_M[word][columndocument]}/list-{$_M[word][seotips8]}-{$_M[word][langmark]}.html（{$_M[word][seotips7]}{$_M['word']['marks']}product/list-1-cn.html）
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][seotips9]}</dt>
		<dd>
			{$_M[word][columndocument]}/{$_M[word][seotips8]}-{$_M[word][langmark]}.html（{$_M[word][seotips7]}{$_M['word']['marks']}product/100-cn.html）
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['pseudo_static']}</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
			<a href="{$_M[url][own_form]}a=dourleditor&pseudo_download=1" target="_blank">{$_M['word']['pseudo_static']}</a>
			</div>
			<span class="tips">{$_M['word']['manually_static_rules']}</span>
		</dd>
	</dl>
	<dl>
		<dd class="ftype_description">
			{$_M['word']['manually_static_rules1']}URL{$_M['word']['manually_static_rules2']}URL{$_M['word']['development_engine']}URL{$_M['word']['static_dynamic']}URL{$_M['word']['sys_good']}<br/>
			{$_M['word']['pure_static_Settings']}
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['indexhtmset']}</dt>
		<dd>
			<div class="fbox">
			<a href="{$_M[url][siteadmin]}seo/sethtm.php?anyid={$_M[form][anyid]}&lang={$_M[lang]}">{$_M['word']['static_page']}</a>
			<span class="tips" style="padding-left:10px;">{$_M['word']['stations_recommended']}</span>
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