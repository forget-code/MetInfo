<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doregsetsave" target="_self">
	<div class="v52fmbx">
		<h3 class="v52fmbx_hr">注册设置</h3>
		<dl>
			<dt>会员注册</dt>
			<dd class="ftype_radio ftype_transverse">
				<div class="fbox">
					<label><input name="met_member_register" type="radio" value="1" data-checked="{$_M['config']['met_member_register']}">开启</label>
					<label><input name="met_member_register" type="radio" value="0">关闭</label>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>注册验证</dt>
			<dd class="ftype_radio">
				<div class="fbox">
					<label><input name="met_member_vecan" type="radio" value="1" data-checked="{$_M['config']['met_member_vecan']}"><abbr title="邮箱为用户名">邮件验证</abbr><span class="tips" style="padding-left:10px;">需设置系统发件箱（设置-基本信息-邮件发送设置）</span></label>
					<label><input name="met_member_vecan" type="radio" value="2">后台审核</label>
					<label><input name="met_member_vecan" type="radio" value="3"><abbr title="手机号码为用户名">手机短信验证</abbr><span class="tips" style="padding-left:10px;">需开通短信服务（我的应用-短信功能）</span></label>
					<label><input name="met_member_vecan" type="radio" value="4">不验证</label>
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">前台显示</h3>
		<dl>
			<dt>背景颜色</dt>
			<dd class="ftype_color">
				<div class="fbox">
					<input type="text" name="met_member_bgcolor" value="{$_M['config']['met_member_bgcolor']}">
				</div>
				<span class="tips">中间横屏背景颜色</span>
			</dd>
		</dl>
		<dl>
			<dt>背景图片</dt>
			<dd class="ftype_upload">
				<div class="fbox">
					<input 
						name="met_member_bgimage" 
						type="text" 
						data-upload-type="doupimg"
						value="{$_M['config']['met_member_bgimage']}" 
					/>
				</div>
				<span class="tips">登录界面中间横屏背景（建议尺寸 1920 * 800 宽 * 高 ）</span>
			</dd>
		</dl>
		<dl class="none">
			<dt>强制浏览密钥</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_member_force" value="{$_M['config']['met_member_force']}">
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