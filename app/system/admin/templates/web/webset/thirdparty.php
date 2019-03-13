<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dotpeditor" target="_self">
<div class="v52fmbx">
	<dl>
		<dd class="ftype_description">
		{$_M[word][unitytxt_36]}
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setheadstat]}</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="met_headstat" style="width:80%;">{$_M[config][met_headstat]}</textarea>
			</div>
			<span class="tips">{$_M[word][unitytxt_37]}</span>
			
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setfootstat]}</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="met_footstat" style="width:80%;">{$_M[config][met_footstat]}</textarea>
			</div>
			<span class="tips">{$_M[word][unitytxt_38]}</span>
			
		</dd>
	</dl>
	<dl class="noborder">
		<dt> </dt>
		<dd>
			<input type="submit" name="submit" value="{$_M['word']['Submit']}" class="submit">
		</dd>
	</dl>
</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>