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
		<a class="btn btn-danger" href="{$_M[url][own_form]}a=doadd" role="button">{$_M['word']['add']}{$_M['word']['metadmin']}</a>
		</div>
		<div class="ui-float-right">
			<div class="ui-table-search">
				<i class="fa fa-search"></i>
				<input name="keyword" data-table-search="1" type="text" value="" class="ui-input" placeholder="{$_M['word']['adminusername']}">
			</div>
		</div>
	</div>
	<table class="display dataTable ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_list"  data-table-pageLength="20">
		<thead>
			<tr>
				<th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
				<th width="150">
					{$_M['word'][adminusername]}
				</th>
				<th data-table-columnclass="met-center">
				{$_M['word'][admintips5]}
				</th>
        <th data-table-columnclass="met-center">
        {$_M['word'][adminname]}
        </th>
        <th data-table-columnclass="met-center" width="100">
        {$_M['word'][adminLoginNum]}
        </th>
        <th data-table-columnclass="met-center" width="100">
        {$_M['word'][adminLastLogin]}
        </th>
        <th data-table-columnclass="met-center" width="100">
        {$_M['word'][adminLastIP]}
        </th>
				<th>{$_M['word'][operate]}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th><input name="id" type="checkbox" data-table-chckall="id" value=""></th>
				<th colspan="7" class="formsubmit" style="text-align:left!important;">
        <button type="submit" name="del" class="btn btn-default" style="margin-left:2px;" data-toggle="popover">{$_M['word'][delete]}</button>
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
