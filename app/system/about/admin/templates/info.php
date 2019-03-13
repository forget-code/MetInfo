<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<div class="stat_list">
  <ul>
    <li ><a  href="{$_M[url][own_form]}&a=doindex" title="{$_M[word][jobmanagement]}">{$_M[word][jobmanagement]}</a></li>
    <li><a class="now" href="{$_M[url][own_form]}&a=domanageinfo" title="{$_M[word][cvmanagement]}">{$_M[word][cvmanagement]}</a></li>
    <li><a class="syset" href="{$_M[url][site_admin]}index.php?n=parameter&c=parameter_admin&a=doparaset&module=6&lang={$_M[form][lang]}" title="{$_M[word][cvmanagement]}" title="{$_M[word][cvset]}">{$_M[word][cvset]}</a></li>
    <li><a href="{$_M[url][own_form]}&a=dosyset&class1={$class[class1]}" title="{$_M[word][indexcv]}">{$_M[word][indexcv]}</a></li>
  </ul>
</div>
<div style="clear:both;"></div>
<!--
EOT;
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dolistsave&sub_type=editor&cv=1&jobid={$_M['form']['jobid']}" target="_self">
<div class="v52fmbx product_index">
	<div class="v52fmbx-table-top">
		<div class="ui-float-left">
		<a class="btn btn-danger" href="{$_M[url][own_form]}a=doadd" role="button">{$_M[word][mobiletips3]}</a>
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
	<table class="display dataTable ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_list1&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}&cv=1&jobid={$_M['form']['jobid']}"  data-table-pageLength="20">
		<thead>
			<tr>
				<th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
				<th data-table-columnclass="met-center" width="70">
				{$_M[word][cvPosition]}
				</th>
				<th data-table-columnclass="met-center" width="160">
				{$_M[word][cvName]}
				</th>
				<th width="120">
					<select name="search_type" data-table-search="1">
						<option value="0">{$_M[word][smstips64]}</option>
						<option value="1">{$_M[word][feedbackClass2]}</option>
						<option value="2">{$_M[word][feedbackClass3]}</option>
					</select>
				</th>
				<th data-table-columnclass="met-center" width="160">
	            {$_M[word][messageTime]}
				</th>
				<th data-table-columnclass="met-center" width="160">
	            {$_M[word][read]}
				</th>
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