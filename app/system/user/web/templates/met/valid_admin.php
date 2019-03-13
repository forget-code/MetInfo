<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
require_once $this->template('tem/head');
echo <<<EOT
-->
<div class="valid-email met-member">
	<div class="container">
		<div class="valid-email-content">
			<p class="text-center"><strong>{$_M['user']['username']}</strong></p>
			<p class="text-center">{$_M['word']['membernodo']}</p>
			<p class="text-center"></p>
		</div>
	</div>
</div>
<!--
EOT;
$page_type = 'valid_admin';
require_once $this->template('tem/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>