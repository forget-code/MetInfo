<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doanchortablesave" target="_self">
<div class="v52fmbx">
	<dl style="border-bottom:0;">
		<dd class="ftype_description">
		{$_M['word']['applies_paper']}
		</dd>
	</dl>
	<table class="display dataTable ui-table new_effects" data-table-ajaxurl="{$_M[url][own_form]}a=doanchor_json"  data-table-pageLength="20">
		<thead>
			<tr>
				<th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
				<th width="18%">{$_M['word']['labelOld']}</th>
				<th width="18%">{$_M['word']['labelNew']}</th>
				<th width="18%">Title</th>
				<th width="18%">{$_M['word']['labelUrl']}</th>
				<th width="50" data-table-columnclass="met-center">{$_M['word']['labelnum']}</th>
				<th>{$_M['word']['operate']}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th><input name="id" type="checkbox" data-table-chckall="id" value=""></th>
				<th colspan="6" class="formsubmit">
					<input type="submit" name="save" value="{$_M['word']['Submit']}" class="submit" />
					<input type="submit" name="del" value="{$_M['word']['delete']}" class="submit" data-confirm='{$_M[word][js7]}' />
					<a href="javascript:;" class="ui-addlist" data-table-addlist="{$_M[url][own_form]}a=doanchor_add"><i class="fa fa-plus-circle"></i>{$_M['word']['anchor_text']}</a>
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