<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('tem/head');
echo <<<EOT
-->
<div class="appbox_left">
<div class="appbox_left_box">
	<div class="v52fmbx">
		<div class="applistdiv">
		<table class="display dataTable ui-table" data-table-ajaxurl="{$_M['url']['app_api']}a=dotable_servicelist_json&info_id={$result['columnid']}&stat_key={$result['value']}&lang={$_M['lang']}&user_key={$_M['config']['met_secret_key']}" data-table-pagelength="20" data-table-datatype="jsonp" data-applist="app1001|app1003">
			<thead>
				<tr>
					<th width="100" data-table-columnclass="met-center">{$_M['word']['onlineimg']}</th>
					<th>服务名称</th>
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