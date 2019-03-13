<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doopensave" target="_self">
	<div class="v52fmbx">
		<h3 class="v52fmbx_hr">QQ</h3>
		<dl>
			<dd>
				<span class="tips">{$_M[word][user_tips8_v6]} <a href="http://connect.qq.com/" target="_blank">{$_M[word][user_QQinterconnect_v6]}</a> {$_M[word][user_tips9_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][qqlogin]}</dt>
			<dd class="ftype_radio ftype_transverse">
				<div class="fbox">
					<label><input name="met_qq_open" type="radio" value="1" data-checked="{$_M['config']['met_qq_open']}">{$_M[word][open]}</label>
					<label><input name="met_qq_open" type="radio" value="0">{$_M[word][close]}</label>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>App ID</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_qq_appid" value="{$_M['config']['met_qq_appid']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>App Key</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_qq_appsecret" value="{$_M['config']['met_qq_appsecret']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][user_backurl_v6]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
						{$_M['url']['site']}member/login.php
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][pay_WeChat_v6]}</h3>
		<dl>
			<dt>{$_M[word][weixinlogin]}</dt>
			<dd class="ftype_radio ftype_transverse">
				<div class="fbox">
					<label><input name="met_weixin_open" type="radio" value="1" data-checked="{$_M['config']['met_weixin_open']}">{$_M[word][open]}</label>
					<label><input name="met_weixin_open" type="radio" value="0">{$_M[word][close]}</label>
				</div>
			</dd>
		</dl>
		<dl>
			<dd>
				<span class="tips">{$_M[word][user_tips8_v6]}<a href="https://open.weixin.qq.com/cgi-bin/frame?t=home/web_tmpl&lang=zh_CN" target="_blank">{$_M[word][user_tips10_v6]}</a> {$_M[word][user_Apply_v6]}</span>
				<br /><span class="tips">{$_M[word][user_tips11_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][user_Openplatform_v6]}App ID</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_weixin_appid" value="{$_M['config']['met_weixin_appid']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][user_Openplatform_v6]}App Secret</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_weixin_appsecret" value="{$_M['config']['met_weixin_appsecret']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dd>
				<span class="tips">{$_M[word][user_tips8_v6]}<a href="https://mp.weixin.qq.com/cgi-bin/frame?t=home/web_tmpl&lang=zh_CN" target="_blank">{$_M[word][user_publicplatform_v6]}</a>{$_M[word][user_Apply_v6]}</span>
			    <br/><span class="tips">{$_M[word][user_tips12_v6]}</span>
				<br/><span class="tips">{$_M[word][user_tips13_v6]}<span style="color:red">{$_M[word][user_tips14_v6]}</span></span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][user_publicplatform_v6]}App ID</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_weixin_gz_appid" value="{$_M['config']['met_weixin_gz_appid']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][user_publicplatform_v6]}App Secret</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_weixin_gz_appsecret" value="{$_M['config']['met_weixin_gz_appsecret']}">
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][user_tips15_v6]}</h3>
		<dl>
			<dd>
				<span class="tips">{$_M[word][user_tips8_v6]}<a href="http://open.weibo.com/authentication/" target="_blank">{$_M[word][user_tips16_v6]}</a> {$_M[word][user_Apply_v6]} {$_M[word][user_tips17_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][sinalogin]}</dt>
			<dd class="ftype_radio ftype_transverse">
				<div class="fbox">
					<label><input name="met_weibo_open" type="radio" value="1" data-checked="{$_M['config']['met_weibo_open']}">{$_M[word][open]}</label>
					<label><input name="met_weibo_open" type="radio" value="0">{$_M[word][close]}</label>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>App Key</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_weibo_appkey" value="{$_M['config']['met_weibo_appkey']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>App Secret</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_weibo_appsecret" value="{$_M['config']['met_weibo_appsecret']}">
				</div>
			</dd>
		</dl>
		<dl class="noborder">
			<dt>&nbsp;</dt>
			<dd>
				<input type="submit" name="submit" value="{$_M[word][save]}" class="submit" />
			</dd>
		</dl>
	</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>