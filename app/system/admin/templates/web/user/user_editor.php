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
			<dt>用户名</dt>
			<dd class="ftype_input">
				<div class="fbox">
					{$user['username']}
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">账号安全</h3>
		<dl>
			<dt>密码重置</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="password" name="password" value="" />
				</div>
				<span class="tips">6 - 30 位字符 留空则不修改 </span>
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
			<dt>绑定邮箱</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="email" value="{$user['email']}" data-errortxt="邮箱已被绑定" data-custom="emailfunc($(this),'{$user['id']}','email')" />
				</div>
			</dd>
		</dl>
		<dl>
			<dt>绑定手机</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="tel" value="{$user['tel']}" data-errortxt="手机已被绑定" data-custom="emailfunc($(this),'{$user['id']}','tel')" />
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">账号状态</h3>
		<dl>
			<dt>用户组</dt>
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
			<dt>是否激活</dt>
			<dd class="ftype_select">
				<div class="fbox">
					<select name="valid" data-checked="{$user['valid']}">
						<option value="1">是</option>
						<option value="0">否</option>
					</select>
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">会员属性</h3>
<!--
EOT;
$this->paraclass->paratem($_M['form']['id'],10);
echo <<<EOT
-->
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