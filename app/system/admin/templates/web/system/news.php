<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<div class="appbox_left">
<div class="appbox_left_box">
<form method="POST" name="myform" class="ui-from" action="{$_M['url']['own_form']}a=donews_submit" target="_self">
	<div class="v52fmbx">
<table class="display dataTable ui-table" data-table-ajaxurl="{$_M['url']['own_form']}a=donews_info&search_type={$_M['form']['search_type']}" >
    <thead>
        <tr>      
            <th data-table-columnclass="met-left">{$_M['word']['title']}</th>
            <th width="135" data-table-columnclass="met-center">{$_M['word']['statips27']}</th>
        </tr>
    </thead>
	<tbody>
	</tbody>
	<tfoot>
        <tr>
			<th colspan="2" class="formsubmit">
				<a href="{$_M['url']['own_form']}a=donews_del" class="ui-addlist" data-confirm="{$_M['word']['messages_restore']}">{$_M['word']['All_empty_message']}</a>
			</th>
        </tr>
    </tfoot>
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