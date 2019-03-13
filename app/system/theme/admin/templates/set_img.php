<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<div><div><div><div>
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from set-block-form" name="myform" action="{$_M[url][own_form]}a=dosave_img" target="_self">
	<input type="hidden" name="met_skin_user" value="{$_M['config']['met_skin_user']}" />
	<div class="v52fmbx set-block set-img">
		<dl>
			<dt>{$_M[word][replacemethod]}</dt>
			<dd class="ftype_radio">
				<div class="fbox">
					<label>
						<input value='1' name='set_img_type' type='radio' checked/>
						{$_M[word][replacemeth1]}
					</label>
					<label>
						<input value='0' name='set_img_type' type='radio'/>
						{$_M[word][replacemeth2]}
					</label>
				</div>
				<span class='tips'></span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][uploadimg]}</dt>
			<dd class="ftype_upload">
				<div class="fbox">
					<input name="old_img" type="hidden"/>
					<input name="new_img" type="text" data-upload-type="doupimg"/>
				</div>
				<span class="tips"></span>
			</dd>
		</dl>
	</div>
	<input type="submit" value="{$_M['word']['Submit']}" class="submit hide">
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>