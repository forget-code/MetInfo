<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('tem/head');
echo <<<EOT
-->
<div class="appbox_left">
<div class="appbox_left_box">
	<section class="hotapplist hotlist">
		<h3>{$_M['word']['popular_application']}</h3>
		<ul>
		</ul>
		<div class="clear"></div>
	</section>
	<section class="hotmblist hotlist">
		<h3>{$_M['word']['popular_template']}</h3>
		<ul>
		</ul>
		<div class="clear"></div>
	</section>
</div>
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>