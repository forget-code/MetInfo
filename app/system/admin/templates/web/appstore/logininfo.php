<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$url_sec_login =  urlencode("{$_M['url']['own_form']}&c=member&a=dologinout");
echo <<<EOT
-->

<input id="secret_key" type="hidden" value="{$_M['config']['met_secret_key']}">
<input name="appposition" type="hidden" value="applist">
<div class="appbox_right">
	<div class="login" style="padding-left:10px;display:none">
		<a class="ui-addlist" href="{$_M['url']['own_form']}c=member&a=dologin">{$_M['word']['landing']}</a>
		<a class="ui-addlist" href="{$_M['url']['own_form']}c=member&a=doregister">{$_M['word']['registration']}</a>
	</div>
	
	<div class="memberinfo" style="padding-left:10px;display:none">
		<ul>
			<li><span class="user_id"></span></li>
			<li class="mi">|</li>
			<li><span class="money"></span> {$_M['word']['smstips9']}</li>
			<li class="mi">|</li>
			<li><a href="{$_M['url']['own_form']}c=member&a=dorecharge&return_this={$return_this}">{$_M['word']['smsrecharge']}</a></li>
			<li class="mi">|</li>
			<li><a href="{$_M['url']['own_form']}c=member&a=dorecord">{$_M['word']['consumption_record']}</a></li>
			<li class="mi">|</li>
			<li><a href="https://account.metinfo.cn" target="_blank">{$_M['word']['account_Settings']}</a></li>
			<li class="mi">|</li>
			<li><a href="{$_M['url']['app_api']}a=dologout&user_key={$_M['config']['met_secret_key']}&url_sec={$url_sec_login}&return_type=jump">{$_M['word']['indexloginout']}</a></li>
		</ul>
	</div>
</div>

<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>