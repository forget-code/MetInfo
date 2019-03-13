<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('tem/head');
echo <<<EOT
-->
<input name="user_key" type="hidden" value="{$_M['config']['met_secret_key']}" />
<input name="btnok" type="hidden" value="{$_M['form']['btnok']}" />
<div class="v52fmbx support">
	<h3 class="v52fmbx_hr">技术支持 服务开通/续费</h3>
	<dl>
		<dt>服务范围</dt>
		<dd style="color:#444;">
			<ol>
				<li style="margin-bottom:8px;">
					MetInfo产品服务（安装、升级、搬家、故障排查与处理、服务器调试）；
					<ul style="list-style:disc; margin-left:15px;padding:5px;">
						<li>直接帮忙操作。</li>
						<li>服务器调试：首次搭建服务器环境以及与MetInfo故障有关的服务器环境问题处理。</li>
					</ul>
				</li>
				<li style="margin-bottom:8px;">
					专业解答（产品使用/技巧、SEO优化、网络营销）；
					<ul style="list-style:disc; margin-left:15px;padding:5px;">
						<li>帮助分析，提供解决方案和指导，不提供操作服务。</li>
					</ul>
				</li>
			</ol>
			服务范围谨遵上述内容，如未标明则说明不提供相应服务。
			<h3 class="text-danger" style="margin:20px 0px 10px;font-size:16px;">以下情况无法提供服务</h3>
			<ol>
				<li style="margin-bottom:4px;">自行修改或使用非原始 MetInfo 程序代码产生的问题；</li>
				<li style="margin-bottom:4px;">非官方开发的应用插件、制作的模板造成的问题（应用商店上架的第三方应用/模板属于服务范围）；</li>
				<li style="margin-bottom:4px;">服务器、虚拟主机原因造成的系统故障；</li>
				<li style="margin-bottom:4px;">未购买商业授权非法去除版权信息；</li>
				<li style="margin-bottom:4px;">不含网站内容维护、图片处理、源码修改。</li>
			</ol>
		</dd>
	</dl>
	<dl>
		<dt>服务方式</dt>
		<dd style="color:#444;">
			<ul>
				<li style="margin-bottom:4px;">提交工单：故障处理、问题咨询（每天）；</li>
				<li style="margin-bottom:4px;">在线咨询：问题咨询（仅工作日在线，在线时间：08:30 - 17:30）；</li>
			</ul>
			<p class="text-muted">应用商店账号登录MetInfo官网也可以获得工单、在线咨询服务（无法访问网站后台的情况下推荐使用）。</p>
		</dd>
	</dl>
	<dl>
		<dt>选择服务时长</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input name="tlength" type="radio" value="1">一个月 (300元)</label>
				<label><input name="tlength" type="radio" value="3">三个月 (500元)</label>
				<label><input name="tlength" type="radio" value="12" checked>一年 (1000元)</label>
			</div>
		</dd>
	</dl>
	<dl>
		<dt><a href="http://wpa.qq.com/msgrd?v=3&uin=2714459811&site=qq&menu=yes" target="_blank"><img alt="QQ销售咨询" border="0" src="http://wpa.qq.com/pa?p=2:2714459811:47" title="QQ销售咨询"></a></dt>
		<dd style="color:#444;">
			<p style="margin-top:7px;">可咨询QQ了解服务详情</p>
			<p>单次服务价格：网站搬家200元/次，网站安装100元/次，网站升级100元起，故障处理100元起</p>
		</dd>
	</dl>
	<dl>
		<dt>登陆密码</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="password" name="user_passpay" value="" placeholder="登录密码" style="width:200px;" />
			</div>
			<span class="tips">应用商店账号的登录密码</span>
		</dd>
	</dl>
	<dl>
		<dt></dt>
		<dd class="ftype_checkbox">
			<div class="fbox">
				<label><input name="svcdesc" type="checkbox" value="1" data-required="1">清楚且遵守上述服务范围与服务方式</label>
			</div>
		</dd>
	</dl>
	<dl class="noborder">
		<dt> </dt>
		<dd>
			<input type="submit" name="submit" value="立即开通/续费" class="submit">
		</dd>
	</dl>
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>