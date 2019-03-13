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
				可用参数，下列参数在邮件内容中会被转意为可变参数。<br />
				{webname} 网站标题<br />
				{weburl} 网站地址<br />
				{opurl} 邮件下一操作的URL地址，必填项。比如找回密码邮件，这个地址就是找回密码的链接。<br />
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">注册邮件</h3>
		<dl>
			<dt>标题</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_member_email_reg_title" value="{$_M['config']['met_member_email_reg_title']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>内容</dt>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="met_member_email_reg_content">{$_M['config']['met_member_email_reg_content']}</textarea>
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">密码找回邮件</h3>
				<dl>
			<dt>标题</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_member_email_password_title" value="{$_M['config']['met_member_email_password_title']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>内容</dt>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="met_member_email_password_content">{$_M['config']['met_member_email_password_content']}</textarea>
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">修改绑定邮箱</h3>
		<dl>
			<dt>标题</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_member_email_safety_title" value="{$_M['config']['met_member_email_safety_title']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>内容</dt>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="met_member_email_safety_content">{$_M['config']['met_member_email_safety_content']}</textarea>
				</div>
			</dd>
		</dl>
		

		<dl class="noborder">
			<dt>&nbsp;</dt>
			<dd>
				<input type="submit" name="submit" value="保存" class="submit" />
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