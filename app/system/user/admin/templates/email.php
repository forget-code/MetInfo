<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doemailsetsave" target="_self">
	<div class="v52fmbx">
		<dl>
			<dd class="ftype_description">
				{$_M[word][user_tips5_v6]}<br />
				{webname}{$_M[word][linkName]}<br />
				{weburl}{$_M[word][linkUrl]}<br />
				{opurl}{$_M[word][user_tips6_v6]}<br />
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][user_Registeredmail_v6]}</h3>
		<dl>
			<dt>{$_M[word][title]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_member_email_reg_title" value="{$_M['config']['met_member_email_reg_title']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][content]}</dt>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="met_member_email_reg_content">{$_M['config']['met_member_email_reg_content']}</textarea>
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][user_tips7_v6]}</h3>
				<dl>
			<dt>{$_M[word][title]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_member_email_password_title" value="{$_M['config']['met_member_email_password_title']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][content]}</dt>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="met_member_email_password_content">{$_M['config']['met_member_email_password_content']}</textarea>
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][modifyaccemail]}</h3>
		<dl>
			<dt>{$_M[word][title]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_member_email_safety_title" value="{$_M['config']['met_member_email_safety_title']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][content]}</dt>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="met_member_email_safety_content">{$_M['config']['met_member_email_safety_content']}</textarea>
				</div>
			</dd>
		</dl>
		

		<dl class="noborder">
			<dt>&nbsp;</dt>
			<dd>
				<input type="submit" name="submit" value="{$_M[word][save]}" class="submit" />
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