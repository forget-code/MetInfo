<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
//&industry={$_M['form']['industry']}&mince={$_M['form']['mince']}&color={$_M['form']['color']}
require $this->template('tem/head');
echo <<<EOT
-->
<div class="appbox_left">
<div class="appbox_left_box">
<div class="v52fmbx">
	<div class="tem_seach">
	
	<div class="ui-table-search" style="float:right;margin-bottom:9px;">
		<i class="fa fa-search"></i>
		<input name="no" data-table-search="1" data-table-search-tem='1' type="text" value="" class="ui-input" placeholder="{$_M['word']['template_code1']}" style="width:120px;">
		<input name="color" data-table-search="1" type="hidden" value="{$_M['form']['color']}" class="ui-input">
		<input name="mince" data-table-search="1" type="hidden" value="{$_M['form']['mince']}" class="ui-input">
		<input name="industry" data-table-search="1" type="hidden" value="{$_M['form']['industry']}" class="ui-input">
		<input name="temtype" data-table-search="1" type="hidden" value="{$_M['form']['temtype']}" class="ui-input">
	</div>
	<dl class="filtrate">
		<dt>{$_M['word']['template_type']}</dt>
		<dd class="temtype">
			
		</dd>
	</dl>
	<dl class="colordl filtrate" style="display:none;">
		<dt>{$_M['word']['color_filter']}</dt>
		<dd class="color">
			
		</dd>
	</dl>
	<dl class="industrydl filtrate" style="display:none;">
		<span class="more">{$_M['word']['columnmore']}<i class="ico"></i></span>
		<dt>{$_M['word']['industry_screening']}</dt>
		<dd class="industry unfold">
		</dd>
	</dl>
	<dl class="mincedl filtrate" style="display:none;">
		<dt>{$_M['word']['industry_segments']}</dt>
		<dd class="mince">
		</dd>
	</dl>

	</div>
	<div class="applistdiv applistmb">
	<table class="display dataTable ui-table" data-table-ajaxurl="{$_M['url']['app_api']}a=dotable_temlist_json&info_id={$result['columnid']}&stat_key={$result['value']}&lang={$_M['lang']}&user_key={$_M['config']['met_secret_key']}" data-table-pagelength="20" data-table-datatype="jsonp" data-applist="app1001|app1003">
		<thead>
			<tr style="display:none!important;">
				<th width="100" data-table-columnclass="met-center"></th>
				<th data-table-columnclass="met-center"></th>
				<th width="100" data-table-columnclass="met-center"></th>
				<th width="100" data-table-columnclass="met-center"></th>
			</tr>
		</thead>
		<tbody>
		<!--这里的数据由控件自动生成-->
		</tbody>
	</table>
	</div>
</div>
</div>
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>