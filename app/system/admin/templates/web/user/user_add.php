<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doaddsave" target="_self">
	<div class="v52fmbx">
		<dl>
			<dt>用户名</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="username" data-size="2-30" data-ajaxcheck-url="{$_M[url][own_form]}a=douserok" value="" data-required="1" />
				</div>
			</dd>
		</dl>
		<dl>
			<dt>密码</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="password" name="password" data-size="6-30" value="" data-required="1" />
				</div>
			</dd>
		</dl>
		<dl>
			<dt>用户组</dt>
			<dd class="ftype_select">
				<div class="fbox">
					<select name="groupid">
<!--
EOT;
foreach($this->group->get_group_list() as $val){
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
					<select name="valid">
						<option value="1">是</option>
						<option value="0">否</option>
					</select>
				</div>
			</dd>
		</dl>
		<dl class="noborder">
			<dt>&nbsp;</dt>
			<dd>
				<input type="submit" name="submit" value="添加会员" class="submit" />
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