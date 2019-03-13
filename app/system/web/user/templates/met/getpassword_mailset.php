<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$title = $_M['word']['getTip5']; 
require_once $this->template('tem/head');
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
echo <<<EOT
-->
<div class="register_index met-member">
	<div class="container">
	<form class="form-register ui-from" method="post" action="{$_M['url']['password_valid']}">
		<input type="hidden" name="p" value="{$_M['form']['p']}" />
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
				<input type="password" name="password" required class="form-control" placeholder="{$_M['word']['newpassword']}"
				
				data-bv-notempty="true"
				data-bv-notempty-message="{$_M['word']['noempty']}"
				
				data-bv-identical="true"
				data-bv-identical-field="confirmpassword"
				data-bv-identical-message="{$_M['word']['passwordsame']}"
				
				data-bv-stringlength="true"
				data-bv-stringlength-min="3"
				data-bv-stringlength-max="30"
				data-bv-stringlength-message="{$_M['word']['passwordcheck']}"
				
				>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
				<input type="password" name="confirmpassword" required data-password="password" class="form-control" placeholder="{$_M['word']['renewpassword']}"
				
				
				data-bv-identical="true"
				data-bv-identical-field="password"
				data-bv-identical-message="{$_M['word']['passwordsame']}"
				>
			</div>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">{$_M['word']['submit']}</button>
		<div class="login_link"><a href="{$_M['url']['login']}">{$_M['word']['relogin']}</a></div>
	</form>
	</div>
</div>
<!--
EOT;
$page_type = 'getpassword_mailset';
require_once $this->template('tem/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>