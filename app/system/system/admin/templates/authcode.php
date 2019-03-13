<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M['url']['site_admin']}index.php?lang={$_M['lang']}&n=system&c=authcode&a=doauth" target="_self">
	<div class="v52fmbx">
	<h3 class="v52fmbx_hr">{$_M['word']['upfiletips35']}</h3>
	<dl>
		<dt>{$_M[word][authKey]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="authpass" type="text" data-required="1" value="{$info['metkey']}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][authAuthorizedCode]}</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="authcode" data-required="1" >{$info['metcode']}</textarea>
			</div>
		</dd>
	</dl>
	<dl>
		<dt> </dt>
		<dd>
			<input type="submit" name="submit" value="{$_M[word][upfiletips6]}" class="submit">
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