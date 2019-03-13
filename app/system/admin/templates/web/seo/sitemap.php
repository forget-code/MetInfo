<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<script>
var ownlangtxt = {
	"being_generated":"{$_M[word][being_generated]}",
	"physicalgenok":"{$_M[word][physicalgenok]}"
};
</script>
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dositemapeditor" target="_self">
<div class="v52fmbx" data-gent="{$_M[form][gent]}">
	<h3 class="v52fmbx_hr">{$_M['word']['unitytxt_1']}
	<span class="tips" {$met_agents_display}>
<a href="http://www.metinfo.cn/news/shownews852.htm" target="_blank">{$_M[word][seotips14_1]}</a>	
	</span>
	</h3>
	<dl>
		<dt>{$_M[word][setimgWater]}</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input type="radio" name="met_sitemap_auto" value="1" data-checked="{$_M[config][met_sitemap_auto]}" />{$_M[word][open]}</label>
				<label><input type="radio" name="met_sitemap_auto" value="0" />{$_M[word][close]}</label>
			</div>
			<span class="tips">{$_M[word][unitytxt_77]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][seotips16]}</dt>
		<dd class="ftype_checkbox">
			<div class="fbox">
				<label><input type="checkbox" name="met_sitemap_not1" value="1" data-checked="{$_M[config][met_sitemap_not1]}" /><!--{$_M[word][seotips17]}-->过滤不显示在导航的一级栏目</label>
				<label><input type="checkbox" name="met_sitemap_not2" value="1" data-checked="{$_M[config][met_sitemap_not2]}" />{$_M[word][seotips18]}</label>
				<span class="tips">网站地图生成的栏目仅限一级栏目和显示在导航栏上栏目。<br / >不显示内容与栏目，都不会再网站地图中生成。</span>
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][seotips19]}</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input type="radio" name="met_sitemap_lang" value="1" data-checked="{$_M[config][met_sitemap_lang]}" />{$_M[word][admintips1]}</label>
				<label><input type="radio" name="met_sitemap_lang" value="0" />{$_M[word][seotips20]}</label>
			</div>
			<span class="tips">{$_M[word][seotips21]}</span>
		</dd>
	</dl>
	<dl>
		<dt>Sitemap{$_M['word']['type']}</dt>
		<dd class="ftype_checkbox">
			<div class="fbox">
				<label><input type="checkbox" name="met_sitemap_xml" value="1" data-checked="{$_M[config][met_sitemap_xml]}" />{$_M[word][sethtmsitemap4]}</label>
				<span class="tips">{$_M[word][seotips15_2]}{$_M[word][seotips15]} <a href="{$_M[url][site]}sitemap.xml" target="_blank">{$_M[url][site]}sitemap.xml</a></span>
				<label><input type="checkbox" name="met_sitemap_txt" value="1" data-checked="{$_M[config][met_sitemap_txt]}" />Txt{$_M[word][mod12]}</label>
				<span class="tips">{$_M[word][seotips15_3]}{$_M[word][seotips15]} <a href="{$_M[url][site]}sitemap.txt" target="_blank">{$_M[url][site]}sitemap.txt</a></span>
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