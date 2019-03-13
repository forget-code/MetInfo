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
	<form class="form-register ui-from" method="post" action="{$_M['url']['password_email']}">
		<div class="form-group">
			<input type="text" name="username" required class="form-control" placeholder="{$_M['word']['getpasswordtips']}"
			data-bv-notempty="true"
			data-bv-notempty-message="{$_M['word']['noempty']}"
			>
		</div>
		<div class="row login_code">
			<div class="col-xs-7">
				<div class="form-group">
					<input type="text" name="code" required class="form-control" placeholder="{$_M['word']['memberImgCode']}" 
					data-bv-notempty="true"
					data-bv-notempty-message="{$_M['word']['noempty']}"
					>
				</div>
			</div>
			<div class="col-xs-5 login_code_img">
				<img src="{$_M[url][entrance]}?m=include&c=ajax_pin&a=dogetpin" class="img-responsive" id="getcode" title="{$_M['word']['memberTip1']}" align="absmiddle">
			</div>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">{$_M['word']['next']}</button>
		<div class="login_link"><a href="{$_M['url']['login']}">{$_M['word']['relogin']}</a></div>
	</form>
	</div>
</div>
<!--
EOT;
$page_type = 'getpassword';
require_once $this->template('tem/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>