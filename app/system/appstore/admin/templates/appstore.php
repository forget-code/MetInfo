<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
require $this->template('own/head');
if(isset($_M['form']['type'])){
	$type[$_M['form']['type']] = 'selected'; 
}else{
	$type[0] = 'selected';
}
echo <<<EOT
-->
<div class="appbox_left">
	<div class="appbox_left_box">
		<div class="v52fmbx">
			<div class="clearfix">
				<div class="fbox pull-left">
					<select name="app_type" data-table-search="1" value="{$_M['form']['type']}" data-checked="{$_M['form']['type']}">
						<option value="0" {$type[0]}>{$_M[word][allapp_v6]}</option>
						<option value="1" {$type[1]}>{$_M[word][freeapp_v6]}</option>
						<option value="2" {$type[2]}>{$_M[word][Business_membersapp_v6]}</option>
						<option value="3" {$type[3]}>{$_M[word][payapp]}</option>
					</select>
				</div>
				<div class="ui-table-search pull-right">
					<i class="fa fa-search"></i>
					<input name="appinfo" data-table-search="1" type="text" value="" class="ui-input" placeholder="{$_M[word][SearchInfo1]}" style="width:140px;">
				</div>
			</div>
			<section class="hotapplist hotlist clearfix" style='margin-top:10px;'>
			</section>
			<div class="applistdiv">
				<table class="display dataTable ui-table" data-table-ajaxurl="{$_M['url']['app_api']}a=dotable_applist_json&info_id={$result['columnid']}&stat_key={$result['value']}&lang={$_M['lang']}&user_key={$_M['config']['met_secret_key']}&table_type=data" data-table-pagelength="15" data-table-datatype="jsonp" data-applist="app1001|app1003" hidden>
					<thead>
						<tr>
							<th width="100" data-table-columnclass="met-center">{$_M['word']['onlineimg']}</th>
							<th width="100">{$_M['word']['application_name']}</th>
							<th width="100" data-table-columnclass="met-center">{$_M['word']['author']}</th>
							<th width="50" data-table-columnclass="met-center">{$_M['word']['number_installation']}</th>
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