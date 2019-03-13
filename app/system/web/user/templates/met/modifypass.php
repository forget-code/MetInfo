<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once $this->template('tem/head');
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
echo <<<EOT
-->
<div class="container register_index">
	<h1 class="form-signin-heading">{$_M['word']['getTip5']}</h1>
	<h2 class="form-signin-description">{$_M['word']['resetpassword']}</h2>
	<form class="form-register ui-from" method="post" action="{$_M['url']['password_save']}">
<div class="alert alert-danger hidden eorr_mesge_top" role="alert">

</div>
		<input type="hidden" name="p"  value="{$_M['form']['p']}">
		<input type="password" name="password_new"  data-required="1" class="form-control" placeholder="{$_M['word']['newpassword']}">
		<input type="password" name="password_re"  data-required="1" class="form-control" placeholder="{$_M['word']['renewpassword']}">
		<div class="row form-signin-code">
			<div class="col-xs-7">
				<input type="text" name="code" class="form-control" placeholder="{$_M['word']['memberImgCode']}" data-errortxt="{$_M['word']['inputcode']}" data-required="1" >
			</div>
			<div class="col-xs-5">
				<img src="{$_M[url][entrance]}?m=include&c=ajax_pin&a=dogetpin" id="getcode" title="{$_M['word']['memberTip1']}" align="absmiddle">
			</div>
		</div>
<div class="alert alert-danger hidden eorr_mesge" role="alert">

</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">{$_M['word']['next']}</button>
	</form>
</div>
<!--
EOT;
require_once $this->template('tem/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>