<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('tem/head');
echo <<<EOT
-->
<div class="appbox_left">
<div class="appbox_left_box">
<input id="secret_key" type="hidden" value="{$_M['config']['met_secret_key']}">
<input id="position" type="hidden" value="memberinfo">
<form method="POST" name="myform" class="ui-from" action="" target="_self">
	<div class="v52fmbx">
<table class="display dataTable ui-table" data-table-datatype="jsonp" data-table-ajaxurl="{$_M['url']['app_api']}a=dotable_finance_json&search_type=2&user_key={$_M['config']['met_secret_key']}">
    <thead>
        <tr>
            
            <th width="120" data-table-columnclass="met-center">{$_M['word']['smstips18']}</th>
			<th width="80" data-table-columnclass="met-center">{$_M['word']['amount_of']}({$_M['word']['smstips9']})</th>
			<th width="80" data-table-columnclass="met-center">{$_M['word']['smstips22']}</th>
            <th width="200" data-table-columnclass="met-center">{$_M['word']['smstips24']}</th>

        </tr>
    </thead>
	<tbody>
	</tbody>

</table>
	</div>
</form>
</div>
</div>
<!--
EOT;
require $this->template('ui/foot');

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>