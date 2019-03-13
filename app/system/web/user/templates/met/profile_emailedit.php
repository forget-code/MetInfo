<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
$title = $_M['word']['modifyaccemail'];
require_once $this->template('tem/head');
echo <<<EOT
-->
<div class="register_index met-member">
	<div class="container">
		<form class="form-register met-form" method="post" action="{$_M['url']['mailedit']}">
			<input type="hidden" name="p" value="{$_M['form']['p']}" />
<div class="page-header" style="margin-top:0px;">
  <h2 style="margin-top:0px;"><small>{$_M['word']['emailnow']}{$_M['user']['email']}</small></h2>
</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" name="email" required class="form-control" placeholder="{$_M['word']['newemail']}"
					data-bv-notempty="true"
					data-bv-notempty-message="{$_M['word']['noempty']}"
					data-bv-remote="true"
					data-bv-remote-url="{$_M['url']['maileditok']}" 
					data-bv-remote-message="{$_M['word']['emailuse']}">
				</div>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">{$_M['word']['submit']}</button>
		</form>
	</div>
</div>
<!--
EOT;
$page_type = 'profile_emailedit';
require_once $this->template('tem/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>