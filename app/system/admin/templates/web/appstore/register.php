<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
$adm = admin_information();
echo <<<EOT
-->
<script>
var ownlangtxt = '';
</script>
<input id="secret_key" type="hidden" value="{$_M['config']['met_secret_key']}">
<input id="position" type="hidden" value="lr">
<form method="POST" class="ui-from" name="myform" action="{$_M['url']['app_api']}a=domember_registration&user_type={$_M['form']['user_type']}&user_id={$_M['form']['user_id']}&user_pass={$_M['form']['user_pass']}&user_mobile={$_M['form']['user_mobile']}&user_email={$_M['form']['user_email']}'&user_passpay={$_M['form']['user_passpay']}&return_type=jump&admin_url={$_M['url']['site_admin']}" target="_self">
<input type="hidden" name="url_sec" value="{$url_sec}" />
<input type="hidden" name="url_fai" value="{$url_fai}" />
	<div class="v52fmbx">
		<h3 class="v52fmbx_hr">{$_M['word']['create_account']}</h3>
		<dl>
			<dt>{$_M['word']['loginusename']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="user_id" data-required="1" value="" placeholder="{$_M['word']['Prompt_user']}" data-ajaxcheck-url="{$_M['url']['own_form']}&a=doverifica">
				</div>
				<span class="tips">可用 www.metinfo.cn 官网用户中心账号登录，无需重复注册</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['sys_password']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="password" name="user_pass" data-size="6-18" data-norepeat="nrp1" value=""  placeholder="{$_M['word']['Prompt_password']}">
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
		<h3 class="v52fmbx_hr">{$_M['word']['personal_information']}</h3>
		<dl>
			<dt>{$_M['word']['memberCell']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="user_mobile" data-mobile="1" value="{$adm['admin_mobile']}" placeholder="{$_M['word']['Prompt_mobile']}" data-ajaxcheck-url="{$_M['url']['own_form']}&a=doverifica">
				</div>
				<span class="tips">{$_M['word']['services_future']}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['mailbox']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="user_email" data-email="1" value="{$adm['admin_email']}" placeholder="{$_M['word']['Prompt_email']}" data-ajaxcheck-url="{$_M['url']['own_form']}&a=doverifica">
				</div>
				<span class="tips">{$_M['word']['services_future']}</span>
			</dd>
		</dl>
		<!--
		<h3 class="v52fmbx_hr">{$_M['word']['set_password']}</h3>
		<dl>
			<dt>{$_M['word']['pay_password']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="password" name="user_passpay" data-norepeat="nrp1" data-size="6-18" value=""  placeholder="{$_M['word']['please_enter']}">
				</div>
				<span class="tips">{$_M['word']['password_length']}6~18{$_M['word']['login_password']}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['repeat_password']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="password" name="repasswordpay" value=""  data-password="user_passpay" placeholder="{$_M['word']['verify_password']}">
				</div>
			</dd>
		</dl>	
		-->
		<dl class="noborder">
			<dt> </dt>
			<dd>
				<input type="submit" name="submit" value="{$_M['word']['registration']}" class="submit">
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