<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" name="myform" action="{$_M[url][own_form]}a=dopacktable" target="_self">
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<table cellpadding="2" cellspacing="1" class="ui-table display dataTable" data-noajax='1'>
	<tr>
        <td width="40" class="list">{$_M[word][selected]}</td>
		<td width="60" class="list">{$_M[word][setdbItems]}</td>
		<td width="90" class="list">{$_M[word][setdbSize]}<br/><span class="color390">[{$_M[word][setdbAll]} {$totalsize} M]</span></td>
        <td class="list list_left">{$_M[word][setdbTable]}</td>
	</tr>
<!--
EOT;
foreach($tables as $k => $val){
echo <<<EOT
-->
	<tr class="mouse click">
        <td class="list-text"><input type="checkbox" name="tables[]" value="$val" checked /></td>
        <td class="list-text">$bkresults[$k]</td>
		<td class="list-text">$size[$k] M</td>
        <td class="list-text list_left">$val</td>
	</tr>
<!--
EOT;
}
echo <<<EOT
-->

	<tr>
		<td class="list"><input name='chkAll' type='checkbox' onclick="CheckAllx($(this),'myform','tables[]')" value='check' checked /></td>
		<td class="list list_left" colspan="3">
			<input type="submit" name="dosubmit" value="{$_M[word][setdbStart]}" class="submit" onclick="return Smit($(this),'myform')" />
		</td>
	</tr>
</table>
</div>
</div>
</form>
<script>var adminurls="{$adminurl}";</script>
<!--
EOT;
require_once $this->template('ui/foot');
?>