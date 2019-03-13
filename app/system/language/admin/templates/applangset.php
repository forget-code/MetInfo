<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=adlangsave" target="_self">
<div class="v52fmbx">
	<table class="display dataTable ui-table new_effects" data-table-ajaxurl="{$_M[url][own_form]}a=dogetapplist&langsite={$site}&langeditor={$langeditor}"  data-table-pageLength="20">
		<thead>
			<tr>
				<!--<th data-table-columnclass="met-center" width="10">{$_M[word][sort]}</th>-->
				<th data-table-columnclass="met-center" width="10">{$_M[word][appname_appno]}</th>
				<th data-table-columnclass="met-center" width="50">{$_M[word][operate]}&nbsp;({$_M[word][langappinfotext]}) </th>
			
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>