<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dolistsave&sub_type=editor" target="_self">
<div class="v52fmbx product_index">
	<div class="v52fmbx-table-top">
		<div class="ui-float-left">
		<a class="btn btn-danger" href="{$_M[url][own_form]}a=doadd" role="button">{$_M[word][publish]}</a>
		</div>
		<div class="ui-float-right">
			<div class="ui-table-search">
				<i class="fa fa-search"></i>
				<input name="keyword" data-table-search="1" type="text" value="" class="ui-input" placeholder="{$_M[word][search]}">
			</div>
		</div>
		<div class="ui-float-right">
			<div class="ftype_select-linkage">
				<div class="fbox" data-selectdburl="{$_M[url][own_form]}a=docolumnjson">
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
	<table class="display dataTable ui-table new_effects" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_list&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}"  data-table-pageLength="20">
		<thead>
			<tr>
				<th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
				<th width="300">{$_M[word][goods]}</th>
				<th data-table-columnclass="met-center" width="70">
					<a href="javascript:;" class="orderby-link">{$_M[word][visitcount]}</a>
					<input name="orderby_hits" data-table-search="1" type="hidden">
				</th>
				<th data-table-columnclass="met-center" width="160">
					<a href="javascript:;" class="orderby-link">{$_M[word][updated_date]}</a>
					<input name="orderby_updatetime" data-table-search="1" type="hidden">
				</th>
				<th width="120">
					<select name="search_type" data-table-search="1">
						<option value="">{$_M[word][state]}</option>
						<option value="1">{$_M[word][displaytype2]}</option>
						<option value="2">{$_M[word][recom]}</option>
					</select>
				</th>
				<th data-table-columnclass="met-center" width="40"><abbr title="{$_M[word][article4]}">{$_M[word][sort]}</abbr></th>
				<th>{$_M[word][operate]}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th><input name="id" type="checkbox" data-table-chckall="id" value=""></th>
				<th colspan="6" class="formsubmit" style="text-align:left!important;">	
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