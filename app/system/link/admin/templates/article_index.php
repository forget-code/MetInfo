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
		<a class="btn btn-danger" href="{$_M[url][own_form]}a=doadd" role="button">{$_M[word][mobiletips3]}</a>
		</div>
		<div class="ui-float-right">
			<select name="search_type" data-table-search="1">
				<option value="0">{$_M[word][smstips64]}</option>
				<option value="1">{$_M[word][linkType1]}</option>
				<option value="2">{$_M[word][linkType2]}</option>
				<option value="3">{$_M[word][linkType4]}</option>
				<option value="4">{$_M[word][linkType5]}</option>
			</select>
			<div class="ui-table-search">
				<i class="fa fa-search"></i>
				<input name="keyword" data-table-search="1" type="text" value="" class="ui-input" placeholder="{$_M[word][search]}">
			</div>
		</div>
	</div>
	<input id="class1id" name="class1" data-table-search="1" value="{$_M['form']['class1']}" class="ui-input" type="hidden" />
	<input id="class2id" name="class2" data-table-search="1" value="{$_M['form']['class2']}" class="ui-input" type="hidden" />
	<input id="class3id" name="class3" data-table-search="1" value="{$_M['form']['class3']}" class="ui-input" type="hidden" />
	<table class="display dataTable ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_list&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}"  data-table-pageLength="20">
		<thead>
			<tr>
				<th width="20" data-table-columnclass="met-center">{$_M[word][selected]}</th>
				<th width="40" data-table-columnclass="met-center">
				{$_M[word][sort]}
				</th>
				<th width="100" data-table-columnclass="met-center">
					{$_M[word][linkType]}
				</th>
				<th width="200">
				    {$_M[word][linkName]}
				</th>
				<th width="400">
                    {$_M[word][linkUrl]}
				</th>
				<th width="50" data-table-columnclass="met-center">
				{$_M[word][linkCheck]}
				</th>
				<th width="50" data-table-columnclass="met-center">
				{$_M[word][recom]}
				</th>
				<th>{$_M[word][operate]}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th><input name="id" type="checkbox" data-table-chckall="id" value=""></th>
				<th colspan="7" class="formsubmit" style="text-align:left!important;">
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