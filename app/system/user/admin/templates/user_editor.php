<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doeditorsave" target="_self">
	<input type="hidden" name="id" value="{$_M['form']['id']}" />
	<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][loginusename]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					{$user['username']}
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][user_accsafe_v6]}</h3>
		<dl>
			<dt>{$_M[word][user_PasswordReset_v6]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="password" name="password" value="" />
				</div>
				<span class="tips">{$_M[word][user_tips18_v6]}</span>
			</dd>
		</dl>
<script>
function emailfunc(my,id,type){
	var t = true;
	if(my.val()!=''){
		var url = '{$_M[url][own_form]}a=doemailok&email='+my.val()+'&id='+id;
		if(type == 'tel')url = '{$_M[url][own_form]}a=dotelok&tel='+my.val()+'&id='+id;
		$.ajax({
		   type: "POST",
		   async:false,
		   url: url,
		   success: function(msg){
				if(msg!='SUCCESS'){
					t = false;
				}
		   }
		});
	}
	return t;
}
</script>
		<dl>
			<dt>{$_M[word][bindingmail]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="email" value="{$user['email']}" data-errortxt="{$_M[word][user_emailuse_v6]}" data-custom="emailfunc($(this),'{$user['id']}','email')" />
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][bindingmobile]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="tel" value="{$user['tel']}" data-errortxt="{$_M[word][user_phoneuse_v6]}" data-custom="emailfunc($(this),'{$user['id']}','tel')" />
				</div>
			</dd>
		</dl>
		
		<dl>
			<dt>{$_M['word']['rnvalidate']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					{$user['idvalid']}
				</div>
			</dd>
		</dl>
		
		<dl>
			<dt>{$_M['word']['memberName']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="tel" value="{$user['realidinfo']['realname']}" disabled="disabled" />
				</div>
			</dd>
		</dl>

		<dl>
			<dt>{$_M['word']['idcode']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="tel" value="{$user['realidinfo']['idcode']}" disabled="disabled" />
				</div>
			</dd>
		</dl>
		
		
		<h3 class="v52fmbx_hr">{$_M[word][user_Accountstatus_v6]}</h3>
		<dl>
			<dt>{$_M[word][admintips5]}</dt>
			<dd class="ftype_select">
				<div class="fbox">
					<select name="groupid" data-checked="{$user['groupid']}">
<!--
EOT;
foreach($this->grouplist as $val){
echo <<<EOT
-->
						<option value="{$val[id]}">{$val[name]}</option>
<!--
EOT;
}
echo <<<EOT
-->
					</select>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][memberCheck]}</dt>
			<dd class="ftype_select">
				<div class="fbox">
					<select name="valid" data-checked="{$user['valid']}">
						<option value="1">{$_M[word][yes]}</option>
						<option value="0">{$_M[word][no]}</option>
					</select>
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][memberattribute]}</h3>
<!--
EOT;
$this->paraclass->paratem($_M['form']['id'],10);
echo <<<EOT
-->
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