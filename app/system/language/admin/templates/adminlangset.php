<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<script type="text/javascript">
function linkSmit(my, type, txt) {
	text = txt ? txt: '';
	var tp = type != 1 ? 1: confirm(text) ? 1: '';
	if (tp == 1) {
		return true;
	}
	return false;
}
</script>
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=adlangsave" target="_self">
<div class="v52fmbx">
	<table class="display dataTable ui-table new_effects" data-table-ajaxurl="{$_M[url][own_form]}a=doadmin_lang_list"  data-table-pageLength="20">
		<thead>
			<tr>
				<th data-table-columnclass="met-center" width="10">{$_M[word][sort]}</th>
				<th data-table-columnclass="met-center" width="10">{$_M[word][langname]}</th>
				<th data-table-columnclass="met-center" width="10">{$_M[word][open]}</th>
				<th data-table-columnclass="met-center" width="10">{$_M[word][langhome]}</th>
				<th data-table-columnclass="met-center" width="50">{$_M[word]['sys_lang_operate']}</th>
				<th data-table-columnclass="met-center" width="50">{$_M[word]['app_lang_operate']}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="6" class="formsubmit">
					<a href="{$_M[url][own_form]}a=doadminlangadd" class="ui-addlist"><i class="fa fa-plus-circle"></i>{$_M['word']['langadd']}</a>
				</th>
			</tr>
		</tfoot>
	</table>
</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>