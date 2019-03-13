<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
foreach($config_list as $key=>$val){
	if($val['sliding']){
echo <<<EOT
-->
<h3 class="v52fmbx_hr">{$val['inputhtm']}</h3>
<!--
EOT;
	}else{
		if(strpos($val['inputhtm'], '<select')!==false){
			$val['inputhtm']=str_replace('<select', '<div class="fbox"><select', $val['inputhtm']);
			$val['inputhtm']=str_replace('select>', 'select></div>', $val['inputhtm']);
		}
echo <<<EOT
-->
<dl>
	<dt>{$val['uip_title']}</dt>
	<dd class="{$val['ftype']}">{$val['inputhtm']}</dd>
</dl>
<!--
EOT;
	}
}
echo <<<EOT
-->
<h3 class="v52fmbx_hr">{$_M['word']['tab_settings']}</h3>
<dl>
	<dt>{$_M['word']['setskinListPage']}{$_M[word][setskindatelist]}</dt>
	<dd class="ftype_select">
		<div class="fbox">
			<select name="met_listtime" data-checked="{$_M[config][met_listtime]}">
				{$time_html}
			</select>
		</div>
	</dd>
</dl>
<h3 class="v52fmbx_hr">{$_M['word']['page_setup_details']}</h3>
<dl>
	<dt>{$_M['word']['content']}{$_M[word][setskindatecontent]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<select name="met_contenttime" data-checked="{$_M[config][met_contenttime]}">
				{$time_html}
			</select>
		</div>
	</dd>
</dl>
<dl>
	<dt>{$_M['word']['setpnorder']}</dt>
	<dd class="ftype_radio">
		<div class="fbox">
			<label><input name="met_pnorder" type="radio" value="0" data-checked="{$_M[config][met_pnorder]}" />{$_M[word][settopcolumns]}{$_M[word][skinunder]}</label>
			<label><input name="met_pnorder" type="radio" value="1" />{$_M[word][setequivalentcolumns]}{$_M[word][skinunder]}</label>
		</div>
	</dd>
</dl>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->