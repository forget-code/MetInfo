<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<div class="appbox_left">
<div class="appbox_left_box">
<form method="POST" name="myform" class="ui-from" action="" target="_self">
	<div class="v52fmbx">
		<dl>
		<dt>{$_M['word']['setbasictopic']}</dt>
		<dd>{$info['newstitle']}</dd>
		</dl>
		<dl>
		<dt>{$_M['word']['statips27']}</dt>
		<dd>{$time}</dd>
		</dl>
		<dl>
		<dt>{$_M['word']['content']}</dt>
		<dd>{$info['content']}</dd>
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