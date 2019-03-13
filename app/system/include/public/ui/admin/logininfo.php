<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
$url_sec_login =  urlencode("{$_M['url']['adminurl']}anyid=65&n=appstore&c=member&a=dologinout&returnurl=");
echo <<<EOT
-->
<input id="secret_key" type="hidden" value="{$_M['config']['met_secret_key']}">
<input name="appposition" type="hidden" value="applist">
<div class="appbox_right">
	<div class="login-info">
		<div class="login" style="padding-left:10px;display:none">
			<a href="{$_M['url']['adminurl']}anyid=65&n=appstore&c=member&a=dologin&returnurl=" class="ui-addlist">{$_M['word']['landing']}</a>
			<a href="{$_M['url']['adminurl']}anyid=65&n=appstore&c=member&a=doregister&returnurl=" class="ui-addlist">{$_M['word']['registration']}</a>
		</div>
		<div class="memberinfo" style="padding-left:10px;display:none">
			<ul>
				<li><span class="user_id"></span></li>
				<li class="mi">|</li>
				<li><span class="money"></span>{$_M['word']['smstips9']}</li>
				<li class="mi">|</li>
				<li><a href="{$_M['url']['adminurl']}anyid=65&n=appstore&c=member&a=dorecharge&return_this=1">{$_M['word']['smsrecharge']}</a></li>
				<!--<li class="mi">|</li>
				<li><a href="{$_M['url']['adminurl']}anyid=65&n=appstore&c=member&a=dorecord">{$_M['word']['consumption_record']}</a></li>-->
				<li class="mi">|</li>
				<li><a href="https://account.metinfo.cn" target="_blank">{$_M['word']['account_Settings']}</a></li>
				<li class="mi">|</li>
				<li><a href="{$_M['url']['app_api']}a=dologout&user_key={$_M['config']['met_secret_key']}&return_type=jump&url_sec={$url_sec_login}" class='user-loginout'>{$_M['word']['indexloginout']}</a></li>
			</ul>
		</div>
	</div>
</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>