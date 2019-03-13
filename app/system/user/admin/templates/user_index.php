<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M['url']['own_form']}a=dodellist" target="_self">
<div class="v52fmbx">
	<div class="v52fmbx-table-top">
		<div class="ui-float-right">
			<div class="ui-table-search">
				<i class="fa fa-search"></i>
				<input name="keyword" data-table-search="1" type="text" value="" class="ui-input" placeholder="{$_M['word']['logintips']}">
			</div>
		</div>
	</div>
	<table class="display dataTable ui-table new_effects" data-table-ajaxurl="{$_M['url']['own_form']}a=dojson_user_list"  data-table-pageLength="20">
		<thead>
			<tr>
				<th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
				<th>{$_M['word']['loginusename']}</th>
				<th data-table-columnclass="met-center" width="100">
<select name="groupid" data-table-search="1">
	<option value="">{$_M['word']['membergroup']}</option>
<!--
EOT;
foreach($this->grouplist as $val){
echo <<<EOT
-->
	<option value="{$val['id']}">{$val['name']}</option>
<!--
EOT;
}
echo <<<EOT
-->
</select>
				</th>
				<th data-table-columnclass="met-center">{$_M['word']['membertips1']}</th>
				<th data-table-columnclass="met-center">{$_M['word']['lastactive']}</th>
				<th data-table-columnclass="met-center" width="50">{$_M['word']['adminLoginNum']}</th>
				<th data-table-columnclass="met-center" width="50">{$_M['word']['memberCheck']}</th>
				<th data-table-columnclass="met-center" width="50">{$_M['word']['rnvalidate']}
                    <select name="idvalid" data-table-search="">
                    <option value="">{$_M['word']['cvall']}</option>
                    <option value="1">{$_M['word']['yes']}</option>
                    <option value="2">{$_M['word']['no']}</option>
                    </select>				
				</th>
				<th data-table-columnclass="met-center" width="80">{$_M['word']['source']}</th>
				<th>{$_M['word']['operate']}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th><input name="id" type="checkbox" data-table-chckall="id" value=""></th>
				<th colspan="9" class="formsubmit">
					<input type="submit" name="del" value="{$_M['word']['delete']}" class="submit" data-confirm='{$_M['word']['js7']}' />
					<a href="{$_M['url']['own_form']}a=doadd" class="ui-addlist"><i class="fa fa-plus-circle"></i>{$_M['word']['memberAdd']}</a>
					<a href="{$_M['url']['own_form']}a=dousercsv" class="btn btn-info pull-right usercsv" title="{$_M['word']['user_tips22_v6']}">{$_M['word']['user_Exportmember_v6']}</a>
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