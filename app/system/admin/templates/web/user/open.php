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
				<span class="tips">需要到 <a href="http://connect.qq.com/" target="_blank">QQ互联</a> 申请 （管理中心-登录-创建引用-网站）</span>
			</dd>
		</dl>
		<dl>
			<dt>QQ登录</dt>
			<dd class="ftype_radio ftype_transverse">
				<div class="fbox">
					<label><input name="met_qq_open" type="radio" value="1" data-checked="{$_M['config']['met_qq_open']}">开启</label>
					<label><input name="met_qq_open" type="radio" value="0">关闭</label>
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
			<dt>回调地址</dt>
			<dd class="ftype_input">
				<div class="fbox">
						{$_M['url']['site']}member/login.php
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">微信</h3>
		<dl>
			<dt>微信登录</dt>
			<dd class="ftype_radio ftype_transverse">
				<div class="fbox">
					<label><input name="met_weixin_open" type="radio" value="1" data-checked="{$_M['config']['met_weixin_open']}">开启</label>
					<label><input name="met_weixin_open" type="radio" value="0">关闭</label>
				</div>
			</dd>
		</dl>
		<dl>
			<dd>
				<span class="tips">需要到 <a href="https://open.weixin.qq.com/cgi-bin/frame?t=home/web_tmpl&lang=zh_CN" target="_blank">微信开放平台</a> 申请</span>
				<br /><span class="tips">用于PC端会员登录</span>
			</dd>
		</dl>
		<dl>
			<dt>开放平台App ID</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_weixin_appid" value="{$_M['config']['met_weixin_appid']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>开放平台App Secret</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_weixin_appsecret" value="{$_M['config']['met_weixin_appsecret']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dd>
				<span class="tips">需要到 <a href="https://mp.weixin.qq.com/cgi-bin/frame?t=home/web_tmpl&lang=zh_CN" target="_blank">微信公众平台</a> 申请</span>
				<br /><span class="tips">用于微信端会员登录，移动端非微信的其他浏览器访问暂不支持微信登陆</span>
				<br /><span class="tips">需要获取网页授权功能，并设置授权域名为您的网站域名。<span style="color:red">并且将此微信公众号添加至开放平台账号下。</span></span>
			</dd>
		</dl>
		<dl>
			<dt>公众平台App ID</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_weixin_gz_appid" value="{$_M['config']['met_weixin_gz_appid']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>公众平台App Secret</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_weixin_gz_appsecret" value="{$_M['config']['met_weixin_gz_appsecret']}">
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">新浪微博</h3>
		<dl>
			<dd>
				<span class="tips">需要到 <a href="http://open.weibo.com/authentication/" target="_blank">微博开放平台</a> 申请 （注意：请申请网站不要申请应用）</span>
			</dd>
		</dl>
		<dl>
			<dt>微博登录</dt>
			<dd class="ftype_radio ftype_transverse">
				<div class="fbox">
					<label><input name="met_weibo_open" type="radio" value="1" data-checked="{$_M['config']['met_weibo_open']}">开启</label>
					<label><input name="met_weibo_open" type="radio" value="0">关闭</label>
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
		<dl>
			<dt>回调地址</dt>
			<dd class="ftype_input">
				<div class="fbox">
						{$_M['url']['site']}member/login.php?a=doother_login&type=weibo
				</div>
			</dd>
		</dl>
		<dl class="noborder">
			<dt>&nbsp;</dt>
			<dd>
				<input type="submit" name="submit" value="保存" class="submit" />
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