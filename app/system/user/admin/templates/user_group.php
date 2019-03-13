<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosave" target="_self">
	<div class="v52fmbx">
		<table class="display dataTable ui-table new_effects" id='user-group-list' data-table-ajaxurl="{$_M[url][own_form]}a=dojson_group_list">
			<thead>
				<tr>
					<th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
					<th width="100">{$_M[word][memberarayname]}</th>
					<th>{$_M[word][usegroupauto1]}</th>
					<th>{$_M[word][usegroupbuy]}</th>
					<th width="40" data-table-columnclass="met-center"><abbr title="{$_M[word][user_tips21_v6]}">{$_M[word][memberpermission]}</abbr></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<th><input name="id" type="checkbox" data-table-chckall="id" value=""></th>
					<th colspan="4" class="formsubmit">
						<input type="submit" name="save" value="{$_M[word][save]}" class="submit" />
						<input type="submit" name="del" value="{$_M['word']['delete']}" class="submit" data-confirm='{$_M[word][js7]}' />
						<a href="#" class="ui-addlist" data-table-addlist="{$_M[url][own_form]}a=doaddlist"><i class="fa fa-plus-circle"></i>{$_M[word][added]}</a>
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