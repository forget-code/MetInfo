<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('tem/head');

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
		<div  style="float: left;margin-top:2px;">
	<div class="fbox">
			<select name="app_type" data-table-search="1" value="{$_M['form']['type']}" data-checked="{$_M['form']['type']}">
				<option value="0" {$type[0]}>全部应用</option>
				<option value="1" {$type[1]}>免费应用</option>
				<option value="2" {$type[2]}>商业会员应用</option>
				<option value="3" {$type[3]}>收费应用</option>
			</select>
		</div>
		</div>
		<div class="ui-table-search" style="float:right;margin-bottom:9px;">
			<i class="fa fa-search"></i>
			<input name="appinfo" data-table-search="1" type="text" value="" class="ui-input" placeholder="请输入搜索关键词" style="width:140px;">
		</div>
		<div class="applistdiv">
		<table class="display dataTable ui-table" data-table-ajaxurl="{$_M['url']['app_api']}a=dotable_applist_json&info_id={$result['columnid']}&stat_key={$result['value']}&lang={$_M['lang']}&user_key={$_M['config']['met_secret_key']}" data-table-pagelength="20" data-table-datatype="jsonp" data-applist="app1001|app1003">
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