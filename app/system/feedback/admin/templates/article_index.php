<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<div style="clear:both;"></div>
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dolistsave&sub_type=editor" target="_self">
	<div class="v52fmbx product_index">
		<div class="v52fmbx-table-top">
			<div class="ui-float-right">
				<div class="ui-table-search">
					<i class="fa fa-search"></i>
					<input name="keyword" data-table-search="1" type="text" value="" class="ui-input" placeholder="{$_M[word][search]}">
				</div>
			</div>
			<div class="ui-float-right" style="display:none">
				<div class="ftype_select-linkage" pclass='{$_M['form']['class1']}' purl='{$_M[url][own_form]}a=doindex&lang={$_M['lang']}'>
					<div class="fbox" data-selectdburl="{$_M[url][own_form]}a=docolumnjson&type=1">
						<select name="class1_select" class="prov" data-table-search="1" data-checked="{$_M['form']['class1']}"></select>
						<select name="class2_select" class="city" data-table-search="1" data-checked="{$_M['form']['class2']}"></select>
						<select name="class3_select" class="dist" data-table-search="1" data-checked="{$_M['form']['class3']}"></select>
					</div>
				</div>
			</div>
		</div>
		<input id="class1id" name="class1" data-table-search="1" value="{$_M['form']['class1']}" class="ui-input" type="hidden" />
		<input id="class2id" name="class2" data-table-search="1" value="{$_M['form']['class2']}" class="ui-input" type="hidden" />
		<input id="class3id" name="class3" data-table-search="1" value="{$_M['form']['class3']}" class="ui-input" type="hidden" />
		<table class="display dataTable ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_list&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}"  data-table-pageLength="20">
			<thead>
				<tr>
					<th width="10" data-table-columnclass="met-center">{$_M[word][selected]}</th>
					<th width="10">ID</th>
					<!--<th data-table-columnclass="met-center" width="10">{$_M[word][title]}</th>-->
					<th width="10">
						<select name="search_type" data-table-search="0">
							<option value="0">{$_M[word][smstips64]}</option>
							<option value="1">{$_M[word][feedbackClass2]}</option>
							<option value="2">{$_M[word][feedbackClass3]}</option>
						</select>
					</th>
					<!--<th data-table-columnclass="met-center" width="20">{$_M[word][feedbackID]}</th>-->
EOT;
foreach ($showcol as $row){
echo <<<EOT
                    <th data-table-columnclass="met-center" width="20">{$row[name]}</th>
EOT;
}
echo <<<EOT
					<th data-table-columnclass="met-center" width="20">{$_M[word][feedbackTime]}</th>
					<th width="20">{$_M[word][operate]}</th>
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