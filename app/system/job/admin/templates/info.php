<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dolistsave&sub_type=editor&cv=1&jobid={$_M['form']['jobid']}" target="_self">
<div class="v52fmbx product_index">
	<input id="class1id" name="class1" data-table-search="1" value="{$_M['form']['class1']}" class="ui-input" type="hidden" />
	<input id="class2id" name="class2" data-table-search="1" value="{$_M['form']['class2']}" class="ui-input" type="hidden" />
	<input id="class3id" name="class3" data-table-search="1" value="{$_M['form']['class3']}" class="ui-input" type="hidden" />
	<table class="display dataTable ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_list1&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}&cv=1&jobid={$_M['form']['jobid']}"  data-table-pageLength="20">
		<thead>
			<tr>
				<th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
				<th data-table-columnclass="met-center" width="150">
				{$_M[word][cvPosition]}
				</th>
				<!--<th data-table-columnclass="met-center" width="160">
				{$_M[word][cvName]}
				</th>-->
				<th width="70" data-table-columnclass="met-center">
					<select name="search_type" data-table-search="1">
						<option value="0">{$_M[word][smstips64]}</option>
						<option value="1">{$_M[word][unread]}</option>
						<option value="2">{$_M[word][read]}</option>
					</select>
				</th>
<!--
EOT;
foreach ($showcol as $row){
echo <<<EOT
-->
                <th data-table-columnclass="met-center">{$row[name]}</th>
<!--
EOT;
}
echo <<<EOT
-->
				<th data-table-columnclass="met-center" width="150">
	            {$_M[word][cvAddtime]}
				</th>
				<th>{$_M[word][operate]}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th><input name="id" type="checkbox" data-table-chckall="id" value=""></th>
				<th colspan="{$colnum}" class="formsubmit" style="text-align:left!important;">
<!--
EOT;
require $this->template('own/mod_batchoption');
echo <<<EOT
-->
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