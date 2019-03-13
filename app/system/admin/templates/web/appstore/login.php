<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<script>
var ownlangtxt = '';
</script>
<input id="secret_key" type="hidden" value="{$_M['config']['met_secret_key']}">
<input id="position" type="hidden" value="lr">
<form method="POST" class="ui-from" name="myform" action="{$_M['url']['app_api']}a=dologin&domain={$_M['url']['site']}&user_id={$_M['form']['user_id']}&user_pass={$_M['form']['user_pass']}&admin_url={$_M['url']['site_admin']}&return_type=jump" target="_self">
<input type="hidden" name="url_sec" value="{$url_sec}" />
<input type="hidden" name="url_fai" value="{$url_fai}" />
<input type="hidden" name="returnurl" value="{$returnurl}"/>
	<div class="v52fmbx">
		<h3 class="v52fmbx_hr">{$_M['word']['application_market']}</h3>
		<dl>
			<dt>{$_M['word']['loginusename']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="user_id" data-required="1" value="" placeholder="{$_M['word']['Prompt_user']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['loginpassword']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="password" name="user_pass" data-required="1" value=""  placeholder="{$_M['word']['Prompt_password']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dd class="ftype_description">
				{$_M['word']['website_manually']}
			</dd>
		</dl>
		<dl class="noborder">
			<dt> </dt>
			<dd>
				<input type="submit" name="submit" value="{$_M['word']['landing']}" class="submits">
				<a href="{$_M[url][site_admin]}index.php?lang={$_M['lang']}&anyid={$_M['form']['anyid']}&n=appstore&c=member&a=doregister" style="height: 34px;line-height: 42px;display: inline-block;">{$_M['word']['registration']}</a>
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