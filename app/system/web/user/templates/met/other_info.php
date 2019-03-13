<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加

require_once $this->template('tem/head');

echo <<<EOT
-->
<div class="register_index met-member">
	<div class="container">
		<form class="form-register met-form" method="post" action="{$_M['url']['login_other_register']}">
			<input type="hidden" name="type" value="{$_M['form']['type']}"/>
			<input type="hidden" name="other_id" value="{$_M['form']['other_id']}"/>
			<div class="form-group">
				<input type="text" name="username" class="form-control" placeholder="{$_M['word']['memberbasicUserName']}">
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">{$_M['word']['memberRegister']}</button>
		</form>
	</div>
</div>
<!--
EOT;
require_once $this->template('tem/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>