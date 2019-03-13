<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
echo <<<EOT
-->
<div class="col-sm-3 sidebar ">
	<div class="sidebar-box">
		<div class="list-group">
			<a href="{$_M['url']['profile']}" class="list-group-item {$active['profile']}" title="{$_M['word']['memberIndex9']}">{$_M['word']['memberIndex9']}</a>
			<a href="{$_M['url']['profile_safety']}" class="list-group-item {$active['safety']}" title="{$_M['word']['accsafe']}">{$_M['word']['accsafe']}</a>
<!--
EOT;
foreach($_M['html']['app_sidebar'] as $key=>$val){
echo <<<EOT
-->
	<a href="{$val['url']}" class="list-group-item" title="{$val['title']}">{$val['title']}</a>
<!--
EOT;
}
echo <<<EOT
-->
		</div>
	</div>
</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>