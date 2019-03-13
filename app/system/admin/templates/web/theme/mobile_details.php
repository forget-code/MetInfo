<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
				<div class="v52fmbx">
<!--
EOT;
require $this->template('tem/zujian');
echo <<<EOT
-->	
<!--
EOT;
if($metinfover){
echo <<<EOT
-->
<h3 class="v52fmbx_hr">{$_M['word']['tab_settings']}</h3>
	<dl>
		<dt>{$_M['word']['display_number']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<select name="met_productTabok" data-checked="{$_M[config][met_productTabok]}">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<span class="tips">{$_M['word']['corresponding_products']}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['tab_title1']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_productTabname" value="{$_M[config][met_productTabname]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['tab_title2']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_productTabname_1" value="{$_M[config][met_productTabname_1]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['tab_title3']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_productTabname_2" value="{$_M[config][met_productTabname_2]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['tab_title4']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_productTabname_3" value="{$_M[config][met_productTabname_3]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['tab_title5']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_productTabname_4" value="{$_M[config][met_productTabname_4]}" />
			</div>
		</dd>
	</dl>
<!--
EOT;
}
echo <<<EOT
-->
				</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->