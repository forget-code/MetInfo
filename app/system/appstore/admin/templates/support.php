<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('own/head');
echo <<<EOT
-->
<input name="user_key" type="hidden" value="{$_M['config']['met_secret_key']}" />
<input name="btnok" type="hidden" value="{$_M['form']['btnok']}" />
<div class="v52fmbx support">
	<h3 class="v52fmbx_hr">{$_M[word][appstore_descript1_v6]}</h3>
	<dl>
		<dt>{$_M[word][appstore_Servicescope_v6]}</dt>
		<dd style="color:#444;">
			<ol>
				<li style="margin-bottom:8px;">
					{$_M[word][appstore_descript2_v6]}；
					<ul style="list-style:disc; margin-left:15px;padding:5px;">
						<li>{$_M[word][appstore_descript3_v6]}。</li>
						<li>{$_M[word][appstore_descript4_v6]}</li>
					</ul>
				</li>
				<li style="margin-bottom:8px;">
					{$_M[word][appstore_descript5_v6]}；
					<ul style="list-style:disc; margin-left:15px;padding:5px;">
						<li>{$_M[word][appstore_descript6_v6]}</li>
					</ul>
				</li>
			</ol>
			{$_M[word][appstore_descript7_v6]}
			<h3 class="text-danger" style="margin:20px 0px 10px;font-size:16px;">{$_M[word][appstore_descript8_v6]}</h3>
			<ol>
				<li style="margin-bottom:4px;">{$_M[word][appstore_descript9_v6]}；</li>
				<li style="margin-bottom:4px;">{$_M[word][appstore_descript10_v6]}；</li>
				<li style="margin-bottom:4px;">{$_M[word][appstore_descript11_v6]}；</li>
				<li style="margin-bottom:4px;">{$_M[word][appstore_descript12_v6]}；</li>
				<li style="margin-bottom:4px;">{$_M[word][appstore_descript13_v6]}</li>
			</ol>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][appstore_servicemode_v6]}</dt>
		<dd style="color:#444;">
			<ul>
				<li style="margin-bottom:4px;">{$_M[word][appstore_descript14_v6]}；</li>
				<li style="margin-bottom:4px;">{$_M[word][appstore_descript15_v6]}；</li>
			</ul>
			<p class="text-muted">{$_M[word][appstore_descript16_v6]}</p>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][appstore_descript17_v6]</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input name="tlength" type="radio" value="1">{$_M[word][appstore_descript18_v6]}</label>
				<label><input name="tlength" type="radio" value="3">{$_M[word][appstore_descript19_v6]}</label>
				<label><input name="tlength" type="radio" value="12" checked>{$_M[word][appstore_descript20_v6]}</label>
			</div>
		</dd>
	</dl>
	<dl>
		<dt><a href="http://wpa.qq.com/msgrd?v=3&uin=2714459811&site=qq&menu=yes" target="_blank"><img alt="{$_M[word][appstore_QQsalesconsulting_v6]}" border="0" src="http://wpa.qq.com/pa?p=2:2714459811:47" title="{$_M[word][appstore_QQsalesconsulting_v6]}"></a></dt>
		<dd style="color:#444;">
			<p style="margin-top:7px;">{$_M[word][appstore_descript21_v6]}</p>
			<p>{$_M[word][appstore_descript22_v6]}</p>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][sys_password]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="password" name="user_passpay" value="" placeholder="{$_M[word][sys_password]}" style="width:200px;" />
			</div>
			<span class="tips">{$_M[word][appstore_descript23_v6]}</span>
		</dd>
	</dl>
	<dl>
		<dt></dt>
		<dd class="ftype_checkbox">
			<div class="fbox">
				<label><input name="svcdesc" type="checkbox" value="1" data-required="1">{$_M[word][appstore_descript24_v6]}</label>
			</div>
		</dd>
	</dl>
	<dl class="noborder">
		<dt> </dt>
		<dd>
			<input type="submit" name="submit" value="{$_M[word][appstore_descript25_v6]}" class="submit">
		</dd>
	</dl>
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>