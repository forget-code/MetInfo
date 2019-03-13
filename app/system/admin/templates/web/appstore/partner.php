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
	<div class="v52fmbx tempservice">
		<div class="" style="border:1px solid #ddd; border-bottom:0; height:70px; padding:10px;"><strong>MetInfo{$_M['word']['metinfoapp3']}</strong>：{$_M['word']['metinfoapptext3']}</div>
		<div class="applistdiv">
        <table class="display dataTable ui-table" data-table-ajaxurl="{$_M['url']['app_api']}a=dotable_partnerlist_json&info_id={$result['columnid']}&stat_key={$result['value']}&lang={$_M['lang']}&user_key={$_M['config']['met_secret_key']}" data-table-pageLength="1000" data-table-datatype="jsonp">
		<thead>
			<tr style="padding:0px 0px" >
				<th width="20%" style="padding:0px 0px"></th>
				<th width="20%" style="padding:0px 0px"></th>
				<th width="20%" style="padding:0px 0px"></th>
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

<style type="text/css">
	.dataTables_paginate {
		display: none;
	}
	.dataTables_info {
	    display: none;
	}
</style>

<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>