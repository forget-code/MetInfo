<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
$title = $_M['word']['emailcheck'];
require_once $this->template('tem/head');
echo <<<EOT
-->
<div class="valid-email met-member">
	<div class="container">
		<div class="valid-email-content">
			<p class="text-center">{$_M['word']['emailchecktips1']}</p>
			<p class="text-center"><strong>{$_M['user']['username']}</strong></p>
			<p class="text-center">{$_M['word']['emailchecktips2']}</p>
		</div>
		<ol class="breadcrumb">
			<li class="active"><strong>{$_M['word']['emailchecktips3']}</strong></li>
			<li class="active">{$_M['word']['emailchecktips4']}</li>
			<li><a href="{$_M['url']['valid_email_repeat']}" class="send_email">{$_M['word']['emailchecktips5']}</a></li>
		</ol>
	</div>
</div>
<!--
EOT;
$page_type = 'valid_email';
require_once $this->template('tem/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>