<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<div><div><div><div>
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from set-block-form" name="myform" action="{$_M[url][own_form]}a=doeditor" target="_self">
	<input type="hidden" name="met_skin_user" value="{$_M['config']['met_skin_user']}" />
	<div class="v52fmbx set-block">
<!--
EOT;
if(isset($inilist)) require $this->template('tem/zujian');
echo <<<EOT
-->
	</div>
	<input type="submit" value="{$_M['word']['Submit']}" class="submit hide">
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>