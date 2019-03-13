<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require $this->template('ui/head');
if($labtype==2)$title="{$_M[word][dataexplain3]}";
if(1){
echo <<<EOT
-->
<div class="v52fmbx">
	<h3 class="v52fmbx_hr metsliding">{$_M[word][dataexplain5]}</h3>
	<div class="v52fmbx_dlbox v52fmbx_detabes">
		<dl>
			<dt>{$_M[word][dataexplain10]}{$_M[word][marks]}</dt>
			<dd class="detabes">
				<input type="submit" url="{$_M[url][own_form]}a=dopackdata" class="submit" value="{$_M[word][databackup4]}" onclick="return metdatabase($(this))" />
				<span class="tips"></span>
				<a href="{$_M[url][own_form]}a=doselecttable" title="{$_M[word][databackup5]}">{$_M[word][databackup5]}</a>
			</dd>
		</dl>
	</div>
	<h3 class="v52fmbx_hr metsliding">{$_M[word][dataexplain6]}</h3>
	<div class="v52fmbx_dlbox v52fmbx_detabes">
		<dl>
			<dt>{$_M[word][databackup6]}{$_M[word][marks]}</dt>
			<dd class="detabes">
				<input type="submit" url="{$_M[url][own_form]}a=dopackupload" class="submit" value="{$_M[word][databackup4]}" onclick="return metdatabase($(this))" />
				<span class="tips"></span>
			</dd>
		</dl>
	</div>
	<h3 class="v52fmbx_hr metsliding">{$_M[word][dataexplain7]}</h3>
	<div class="v52fmbx_dlbox v52fmbx_mo v52fmbx_detabes">
		<dl>
			<dt>{$_M[word][databackup7]}{$_M[word][marks]}</dt>
			<dd class="detabes">
				<input type="submit" url="{$_M[url][own_form]}a=doallfile" class="submit" value="{$_M[word][databackup8]}" onclick="return metdatabase($(this))" />
				<span class="tips"></span>
			</dd>
		</dl>
	</div>
</div>
<!--
EOT;
}elseif($labtype==2){
echo <<<EOT
-->
<div class="v52fmbx">
	<form method="POST" name="myform" action="index.php?anyid={$anyid}&action=allbase&lang={$lang}" target="_self">
		<table cellpadding="2" cellspacing="1" class="table">
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
			<tr class="mouse click">
		        <td class="list-text"></td>
		        <td class="list-text list_left" colspan="3">
					{$_M[word][setdbEveryoneSize]}
					<select name="sizelimit">
						<option value="2048">2 Mb</optioin>
						<option value="4096">4 Mb</optioin>
						<option value="8192">8 Mb</optioin>
					</select>
					<span class="tips">{$_M[word][setdbTip4]}</span>
				</td>
			</tr>
			<tr>
				<td class="list"><input name='chkAll' type='checkbox' onclick="CheckAllx($(this),'myform','tables[]')" value='check' checked /></td>
				<td class="list list_left" colspan="3">
					<input type="submit" name="dosubmit" value="{$_M[word][setdbStart]}" class="submit" onclick="return Smit($(this),'myform')" />
				</td>
			</tr>
		</table>
<!--
EOT;
}
echo <<<EOT
-->
	</form>
</div>
<script>var dataexplain4='{$_M[word][dataexplain4]}';</script>
<!--
EOT;

require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>