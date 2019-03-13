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
<form method="POST" class="ui-from" name="myform" action="{$_M['url']['app_api']}a=domember_modify&user_id={$_M['form']['user_id']}&user_pass={$_M['form']['user_pass']}&return_type=jump&admin_url={$_M['url']['site_admin']}&user_pass_old={$_M['form']['user_pass_old']}&user_key={$_M['config']['met_secret_key']}" target="_self">
<input type="hidden" name="url_sec" value="{$url_sec}" />
<input type="hidden" name="url_fai" value="{$url_fai}" />
	<div class="v52fmbx">
		<dl>
			<dt>{$_M['word']['original_passwords']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="password" name="user_pass_old" value="" data-required="1" placeholder="{$_M['word']['original_passwords1']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['login_password_new']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="password" name="user_pass" value="" data-size="6-18"  data-required="1"  placeholder="{$_M['word']['please_enter']}">
				</div>
				<span class="tips">{$_M['word']['password_length']}6~18{$_M['word']['the_bit']}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['Repeat_password']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="password" name="repassword" value=""  data-password="user_pass" placeholder="{$_M['word']['verify_password']}">
				</div>
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