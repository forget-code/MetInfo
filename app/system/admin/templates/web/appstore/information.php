<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('tem/head');
echo <<<EOT
-->
<div class="appbox_left">
<div class="appbox_left_box">
<input id="secret_key" type="hidden" value="{$_M['config']['met_secret_key']}">
<input name="appposition_1" type="hidden" value="memberinfo">
<form method="POST" class="ui-from" name="myform" action="{$_M['url']['app_api']}a=domember_modify&user_id={$_M['form']['user_id']}&user_mobile={$_M['form']['user_mobile']}&user_email={$_M['form']['user_email']}'&user_qq='{$_M['form']['user_qq']}&return_type=jump&admin_url={$_M['url']['site_admin']}&user_pass_old={$_M['form']['user_pass_old']}" target="_self">
<input type="hidden" name="url_sec" value="{$url_sec}" />
<input type="hidden" name="url_fai" value="{$url_fai}" />
	<div class="v52fmbx">
		<h3 class="v52fmbx_hr">{$_M['word']['account_information']}</h3>
		<dl>
		<dt>{$_M['word']['loginusename']}</dt>
			<dd class="ftype_input">
				<span class="user_id"></span>
				<input type="hidden" name="user_id" value="{$info['user_id']}" placeholder="{$_M['word']['Prompt_user']}">
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['memberCell']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="user_mobile" data-mobile="1" data-required="1" value="{$info['user_mobile']}" placeholder="{$_M['word']['Prompt_mobile']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['mailbox']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="user_email" data-email="1" data-required="1" value="{$info['user_email']}" placeholder="{$_M['word']['Prompt_email']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>QQ</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="user_qq" value="{$info['user_qq']}" placeholder="QQ{$_M['word']['account']}" autocomplete="off">
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M['word']['login_password1']}</h3>
		<dl>
			<dt>{$_M['word']['adminpassword']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input name="user_autocomplete" style="display:none">
					<input name="user_autocomplete" style="display:none">
					<input type="password" name="user_pass_old" value="" data-required="1" placeholder="{$_M['word']['please_password']}">
				</div>
				<span class="tips">{$_M['word']['account_password']}</span>
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
</div>
</div>
<!--
EOT;
require $this->template('ui/foot');

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>