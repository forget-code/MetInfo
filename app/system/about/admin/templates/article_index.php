<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');

echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}anyid=25&a=dolistsave&sub_type=editor" target="_self">
<div class="v52fmbx product_index">
	<div class="v52fmbx-table-top">
		<div class="ui-float-left">
		<a class="btn btn-danger" href="{$_M[url][adminurl]}anyid=25&n=column&c=index&a=doindex" role="button">{$_M[word][configuration_section]}</a><span style=" color:#999;padding-left:10px">{$_M[word][js76]}</span>
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
	<table class="display dataTable ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_list&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}"  data-table-pageLength="20">
		<thead>
			<tr>
				<th data-table-columnclass="met-center" width="80"><abbr title="{$_M['word']['article4']}">{$_M['word']['sort']}</abbr></th>
				<th data-table-columnclass="met-center" width="570">
				{$_M['word']['title']}
				</th>
				<th>{$_M['word']['operate']}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				
				
<!--
EOT;
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