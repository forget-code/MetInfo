<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doregsetsave" target="_self">
	<div class="v52fmbx">
		<h3 class="v52fmbx_hr">{$_M[word][user_Registratset_v6]}</h3>
		<dl>
			<dt>{$_M[word][memberlogin]}</dt>
			<dd class="ftype_radio ftype_transverse">
				<div class="fbox">
					<label><input name="met_member_register" type="radio" value="1" data-checked="{$_M['config']['met_member_register']}">{$_M[word][open]}</label>
					<label><input name="met_member_register" type="radio" value="0">{$_M[word][close]}</label>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][rnvalidate]}</dt>
			<dd class="ftype_radio ftype_transverse">
				<div class="fbox">
					<label><input name="met_member_idvalidate" type="radio" value="1" data-checked="{$_M['config']['met_member_idvalidate']}" {$disabled}  >{$_M[word][open]}</label>
					<label><input name="met_member_idvalidate" type="radio" value="0" {$disabled}>{$_M[word][close]}</label>
					<span class="tips" style="padding-left:10px;">{$_M[word][user_tips33_v6]}&nbsp;&nbsp;
					    ({$_M['word']['timesofuse']}：{$number})
					    <a href="{$_M['url']['adminurl']}n=user&c=admin_set&a=dorecharge" target="">{$_M['word']['systips12']}</a>
					</span>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][user_Regverificat_v6]}</dt>
			<dd class="ftype_radio">
				<div class="fbox">
					<label><input name="met_member_vecan" type="radio" value="1" data-checked="{$_M['config']['met_member_vecan']}"><abbr title="{$_M[word][user_tips23_v6]}">{$_M[word][user_Mailvalidat_v6]}</abbr><span class="tips" style="padding-left:10px;">{$_M[word][user_tips24_v6]}</span></label>
					<label><input name="met_member_vecan" type="radio" value="2">{$_M[word][user_tips25_v6]}</label>
					<label><input name="met_member_vecan" type="radio" value="3"><abbr title="{$_M[word][user_tips26_v6]}">{$_M[word][user_tips27_v6]}</abbr><span class="tips" style="padding-left:10px;">{$_M[word][user_tips28_v6]}</span></label>
					<label><input name="met_member_vecan" type="radio" value="4">{$_M[word][user_Notverifying_v6]}</label>
				</div>
			</dd>
		</dl>
		
		<h3 class="v52fmbx_hr">{$_M[word][displaytype]}</h3>
		<dl>
			<dt>{$_M[word][background_color]}</dt>
			<dd class="ftype_color">
				<div class="fbox">
					<input type="text" name="met_member_bgcolor" value="{$_M['config']['met_member_bgcolor']}">
				</div>
				<span class="tips">{$_M[word][user_tips29_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][user_Backgroundpicture_v6]}</dt>
			<dd class="ftype_upload">
				<div class="fbox">
					<input
						name="met_member_bgimage"
						type="text"
						data-upload-type="doupimg"
						value="{$_M['config']['met_member_bgimage']}"
					/>
				</div>
				<span class="tips">{$_M[word][user_tips30_v6]}</span>
			</dd>
		</dl>
		<dl class="none">
			<dt>{$_M[word][memberforce]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="met_member_force" value="{$_M['config']['met_member_force']}">
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