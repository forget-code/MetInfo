<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
$title = $_M['word']['memberIndex3'];
require_once $this->template('tem/head');
echo <<<EOT
-->
<div class="member-profile met-member">
	<div class="container">
		<div class="member-profile-content">
			<div class="row">
<!--
EOT;
$active['profile'] = 'active';
require_once $this->template('tem/sidebar');
echo <<<EOT
-->
				<div class="col-xs-12 col-sm-9 met-member-index met-member-profile">
<div class="panel panel-default basic">
  <div class="panel-heading">{$_M['word']['memberIndex9']}</div>
  <div class="panel-body">
		<div class="row">
			<div class="col-xs-3">
				{$_M['word']['memberName']}
			</div>
			<div class="col-xs-9">
				{$_M['user']['username']}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3">
				{$_M['word']['memberbasicType']} 
			</div>
			<div class="col-xs-9">
				{$_M['user']['group_name']}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3">
				{$_M['word']['memberbasicLoginNum']}
			</div>
			<div class="col-xs-9">
				{$_M['user']['login_count']}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3">
				{$_M['word']['memberbasicLastIP']} 
			</div>
			<div class="col-xs-9">
				{$_M['user']['login_ip']}
			</div>
		</div>
  </div>
</div>
<!--
EOT;
if(count($this->paralist)){
echo <<<EOT
-->
<form class="met-form" method="post" action="{$_M['url']['info_save']}">
<div class="panel panel-default">
  <div class="panel-heading">{$_M['word']['memberMoreInfo']}</div>
  <div class="panel-body">
		<div class="form-group met-form-choice met-upfile">
			<div class="row">
				<div class="met-form-file-title col-md-3">{$_M[word][memberhead]}</div>
				<div class="col-md-9">
					<input data-url="{$_M[url][site]}app/system/entrance.php?c=uploadify&m=include&lang={$lang}&a=dohead" type="file" name="head" value="{$_M['user']['head']}">
				</div>
			</div>
		</div>
<!--
EOT;
$this->paraclass->parawebtem($_M['user']['id'],10);
echo <<<EOT
-->
		<div class="row" style="border-bottom:none;">
			<div class="col-xs-3">
			</div>
			<div class="col-xs-9">
				<button class="btn btn-primary" type="submit">{$_M['word']['modifyinfo']}</button> 
			</div>
		</div>
  </div>
</div>
</form>
<script> var upfiletext = '{$_M['word']['select']}', uploadUrl = '{$_M[url][site]}app/system/entrance.php?c=uploadify&m=include&lang={$lang}&a=doupfile&type=1'; </script>
<!--
EOT;
}
echo <<<EOT
-->
				</div>
			</div>
		</div>
	</div>
</div>
<!--
EOT;
$page_type = 'profile_index';
require_once $this->template('tem/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>