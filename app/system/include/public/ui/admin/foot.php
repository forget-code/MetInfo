<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
defined('IN_MET') or exit('No permission');
if(!$_M['form']['head_no']) require $this->template('ui/footer');
echo <<<EOT
-->
		<div class="clear"></div>
	</div>
</div>
</body>
<script src="{$_M[url][pub]}js/sea.js?{$jsrand}"></script>
</html>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved..
?>-->