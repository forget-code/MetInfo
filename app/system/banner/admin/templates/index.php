<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<script>
function showclass(id) {
	var dom = $('[id^=class_' + id + '_]').parents('tr');
	dom.is(':hidden') ? dom.show() : dom.hide();
}
</script>
<div class="stat_list">
	<ul>
		<li class="now" ><a href="{$_M[url][own_form]}a=doindex" title="{$_M[word][indexflashset]}">{$_M[word][indexflashset]}</a></li>
		<li ><a href="{$_M[url][own_form]}a=domanage" title="{$_M[word][indexflash]}">{$_M[word][indexflash]}</a></li>
	</ul>
</div>
<!--
EOT;
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dolistsave&sub_type=editor" target="_self">
  <div class="v52fmbx">
	<table class="display dataTable ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_list&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}">
		<thead>
			<tr>
				<th width="300">
					{$_M[word][setflashcolumn]}
				</th>
				<th data-table-columnclass="met-center" width="70">
			       {$_M[word][flashMode]}
				</th>
				<th data-table-columnclass="met-center" width="160">
				   {$_M[word][setflashHeight]}({$_M[word][setflashPixel]})
				</th>
				<th data-table-columnclass="met-center" width="160">
				 {$_M[word][preview]}
				</th>
				<th data-table-columnclass="met-center" width="40">{$_M[word][unitytxt_2]}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="5" class="formsubmit" style="text-align:left!important;">	
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