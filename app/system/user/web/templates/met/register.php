<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
$title = $_M['word']['memberReg'];
require_once $this->template('tem/head');
echo <<<EOT
-->
<div class="register_index met-member">
	<div class="container">
		<form class="form-register met-form" method="post" action="{$_M['url']['register_save']}">
		
<!--
EOT;
if($_M['config']['met_member_vecan']==1){
require_once $this->template('tem/register_email');
}elseif($_M['config']['met_member_vecan']==3){
require_once $this->template('tem/register_phone');
}else{
require_once $this->template('tem/register_ord');
}
echo <<<EOT
-->
<!--
EOT;
if(count($this->paralist)){
echo <<<EOT
-->
			<div class="form-group met-more text-muted">
				<hr />
				<span>{$_M['word']['memberMoreInfo']}</span>
			</div>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
$this->paraclass->parawebtem($_M['user']['id'],10,1);
echo <<<EOT
-->
			<button class="btn btn-lg btn-primary btn-block" type="submit">{$_M['word']['memberRegister']}</button>
			<div class="login_link"><a href="{$_M['url']['login']}">{$_M['word']['acchave']}</a></div>
		</form>
	</div>
</div>
<script> var upfiletext = '{$_M['word']['select']}', uploadUrl = '{$_M[url][site]}app/system/entrance.php?c=uploadify&m=include&lang={$lang}&a=doupfile&type=1'; </script>
<!--
EOT;
$page_type = 'register';
require_once $this->template('tem/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>