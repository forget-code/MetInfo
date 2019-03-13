<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<script>
var chartdata = '{$chartdata}';
var ownlangtxt = {"installations":"{$_M[word][installations]}"};
</script>
<!--[if lte IE 8]><script src="{$_M[url][own_tem]}js/excanvas.js"></script><![endif]-->
<input id="met_automatic_upgrade" type="hidden" value="{$_M['config']['met_automatic_upgrade']}" />
<div class="index_box">
	<section class="index_point">
		<h3>{$_M['word']['new_guidelines']}<a href="http://edu.metinfo.cn/" target="_blank" {$met_agents_display}>{$_M['word']['extension_school']}<i class="fa fa-angle-right"></i></a></h3>
		<ul>
			<li class="speed"><a href="{$_M[url][site_admin]}index.php?n=webset&c=webset&a=doindex&anyid=57&lang={$_M[lang]}" target="_blank"><div class="d"><div class="Sector"> <div class="center" data-value="10">10%</div> <div class="mask"></div> <div class="partO"></div> <div class="partT"></div> </div> <i class="x"></i> </div> <i class="fa fa-newspaper-o"></i> {$_M['word']['upfiletips7']} </a></li>
			<li class="speed"><a href="{$_M[url][site_admin]}column/index.php?anyid=25&lang={$_M[lang]}" target="_blank"><div class="d"><div class="Sector"> <div class="center" data-value="30">30%</div> <div class="mask"></div> <div class="partO"></div> <div class="partT"></div> </div> <i class="x"></i></div><i class="fa fa-sitemap"></i>{$_M['word']['configuration_section']}</a></li>
			<li class="speed"><a href="{$_M[url][site_admin]}index.php?n=theme&c=theme&a=doindex&anyid=18&lang={$_M[lang]}" target="_blank"><div class="d"><div class="Sector"> <div class="center" data-value="50">50%</div> <div class="mask"></div> <div class="partO"></div> <div class="partT"></div> </div><i class="x"></i></div><i class="fa fa-tachometer"></i>{$_M['word']['debug_appearance']}</a></li>
			<li class="speed"><a href="{$_M[url][site_admin]}index.php?n=content&c=content&a=doadd&anyid=68&lang={$_M[lang]}" target="_blank"><div class="d"><div class="Sector"> <div class="center" data-value="70">70%</div> <div class="mask"></div> <div class="partO"></div> <div class="partT"></div> </div><i class="x"></i></div><i class="fa fa-plus"></i>{$_M['word']['publish_content']}</a></li>
			<li class="speed"><a href="{$_M[url][site]}" target="_blank"><div class="d"><div class="Sector"> <div class="center" data-value="100">100%</div> <div class="mask"></div> <div class="partO"></div> <div class="partT"></div></div></div></a><div class="bdsharebuttonbox" 
			data-bdUrl="{$_M[config][met_weburl]}" 
			data-bdText="{$_M['word']['sys_use']} MetInfo {$_M['word']['build_site']} {$_M[config][met_weburl]} {$_M['word']['everyone_see']}" 
			data-bdPic="{$_M[url][site]}templates/{$_M[config][met_skin_user]}/view.jpg" 
			data-bdCustomStyle="{$_M[url][own_tem]}css/metinfo.css" 
			data-tag="share_1"> <a href="#" class="bds_more" data-cmd="more"><i class="fa fa-share-alt"></i>{$_M['word']['share_mood']}</a></div></li>
		</ul>
	</section>
	<section class="index_stat">
		<h3>{$_M['word']['upfiletips30']}</h3>
		<dl>
			<dd class="index_stat_chart">
			<div class="index_stat_chart_tips">
				<ul>
					<li><i class="ip"></i>IP</li>
					<li><i class="uv"></i>{$_M['word']['statvisitors']}</li>
					<li><i class="pv"></i>{$_M['word']['sys_views']}（PV）</li>
				</ul>
				{$_M['word']['sys_nearly']}8{$_M['word']['Traffic_trends']}
			</div>
			<canvas id="myChart" width="550" height="200"></canvas>
			</dd>
			<dd class="index_stat_table">
<table cellpadding="0" cellspacing="1" class="stat_table">
	<tr>
		<th width="25%">{$_M['word']['statips35']}</th>
		<th width="25%">PV</th>
		<th width="25%">{$_M['word']['statvisitors']}</th>
		<th width="25%">IP</th>
	</tr>
<!--
EOT;
foreach($stat as $key=>$val){
echo <<<EOT
-->
	<tr>
		<td>{$val[day]}</td>
		<td>{$val[pv]}</td>
		<td>{$val[alone]}</td>
		<td>{$val[ip]}</td>
	</tr>
<!--
EOT;
}
echo <<<EOT
-->
</table>
			</dd>
		</dl>
		<div class="clear"></div>
	</section>
	<section class="index_myapp none">
		<h3>{$_M['word']['myapp']}</h3>
		<ul>
<!--
EOT;
foreach($app_in as $key=>$val){
if(strstr($val[name], "lang_")) {
	$name = str_replace('lang_','',$val[name]);
	$val[name] = $_M['word'][$name];
}
echo <<<EOT
-->
	<li>
		<a href="{$val[url]}" title="{$val[name]}">
			<img src="{$_M[url][tem]}myapp/images/{$val[icon]}">
			<h4>{$val[name]}</h4>
		</a>
	</li>
<!--
EOT;
}
echo <<<EOT
-->
		</ul>
		<div class="clear"></div>
	</section>
<!--
EOT;
if(($privilege['navigation'] == 'metinfo' || strstr($privilege['navigation'], '1507')) && $_M['config']['met_agents_app']) {
echo <<<EOT
-->
	<section class="index_hotapp index_hot">
		<h3>{$_M['word']['recommended']}<a href="{$_M[url][site_admin]}index.php?lang={$_M[lang]}&anyid=65&n=appstore&c=appstore&a=doindex">{$_M['word']['more_applications']}<i class="fa fa-angle-right"></i></a></h3>
		<ul>
		</ul>
		<div class="clear"></div>
	</section>
<!--
EOT;
}
if ($_M['config']['met_agents_type'] < 2) {
echo <<<EOT
-->
	<section class="index_news">
		<h3>MetInfo {$_M['word']['upfiletips37']}<a href="http://www.metinfo.cn/" target="_blank">{$_M['word']['columnmore']}<i class="fa fa-angle-right"></i></a></h3>
		<div id="newslist" data-newslisturl="http://www.metinfo.cn/metv5news.php?fromurl={$_M[config][met_weburl]}&action=json&listnum=6">
		</div>
	</section>
<!--
EOT;
}
echo <<<EOT
-->
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>