<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<input type="hidden" id="applist" value="{$applist}" />
<form method="POST" class="ui-from">
<div class="appbox_left">
<div class="appbox_left_box">
	<section class="myapplist">
		<h3>{$_M['word']['myapp']}</h3>
		<ul>
<!--
EOT;

foreach($appl as $key=>$val){
echo <<<EOT
-->
	<li>
		<dl>
			<dt>
				<a href="{$val['url']}" title="{$val[appname]}">
				<img src="{$val['ico']}">	
			</a>
			</dt>
			<dd>
				<h4>{$val[appname]}</h4>
				<h6>
<!--
EOT;
if($val['update'] && $_M['config']['met_agents_app'] && ($privilege['navigation'] == 'metinfo' || strstr($privilege['navigation'], '1507'))){
echo <<<EOT
-->				
				<span style="display:none" id="{$val['no']}" data-ver="{$val['ver']}"><a href="{$val['update']}">{$_M['word']['appupgrade']}</a></span>
<!--
EOT;
}
if($val['uninstall'] && $_M['config']['met_agents_app'] && ($privilege['navigation'] == 'metinfo' || strstr($privilege['navigation'], '1507'))){
echo <<<EOT
-->				
				
				<a href="{$val['uninstall']}" data-confirm="{$_M['word']['app_datele']}">{$_M['word']['dlapptips6']}</a>
				</h6>
<!--
EOT;
}
echo <<<EOT
-->						
			</dd>
		</dl>
	</li>
<!--
EOT;
}
echo <<<EOT
-->
		</ul>
		<div class="clear"></div>
	</section>
</div>
</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>