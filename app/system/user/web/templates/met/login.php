<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
$title = $_M['word']['memberLogin']; 
require_once $this->template('tem/head');
echo <<<EOT
-->
<div class="login_index met-member">
	<div class="container">
		<form method="post" action="{$_M['url']['login_check']}">
			<input type="hidden" name="gourl" value="{$_M['form']['gourl']}" />
			<div class="form-group">
				<input type="text" name="username" required class="form-control" placeholder="{$_M['word']['logintips']}"
				data-bv-notempty="true"
				data-bv-notempty-message="{$_M['word']['noempty']}"
				>
			</div>
			<div class="form-group">
				<input type="password" name="password" required class="form-control" placeholder="{$_M['word']['password']}" 
				data-bv-notempty="true"
				data-bv-notempty-message="{$_M['word']['noempty']}"
				>
			</div>
<!--
EOT;
if($code){
echo <<<EOT
-->
			<div class="row login_code">
				<div class="col-xs-7">
					<div class="form-group">
						<input type="text" name="code" required class="form-control" placeholder="{$_M['word']['memberImgCode']}" 
						
						data-bv-notempty="true"
						data-bv-notempty-message="{$_M['word']['noempty']}"
						>
					</div>
				</div>
				<div class="col-xs-5 login_code_img">
					<img src="{$_M[url][entrance]}?m=include&c=ajax_pin&a=dogetpin" class="img-responsive" id="getcode" title="{$_M['word']['memberTip1']}" align="absmiddle">
				</div>
			</div>
<!--
EOT;
}
echo <<<EOT
-->
			<div class="login_link"><a href="{$_M['url']['getpassword']}">{$_M['word']['memberForget']}</a></div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">{$_M['word']['memberGo']}</button>
<!--
EOT;
if($_M['config']['met_qq_open']||$_M['config']['met_weixin_open']||$_M['config']['met_weibo_open']){
echo <<<EOT
-->
			<div class="login_type">
				<p>{$_M['word']['otherlogin']}</p>
				<div class="row">
<!--
EOT;
if($_M['config']['met_qq_open']){
echo <<<EOT
-->
					<div class="col-xs-4 col-md-4"><a title="QQ{$_M['word']['login']}" href="{$_M['url']['login_other']}&type=qq"><i class="fa fa-qq"></i></a></div>
<!--
EOT;
}
if($_M['config']['met_weixin_open'] && !(!is_weixin_client() && is_mobile_client())){
echo <<<EOT
-->
					<div class="col-xs-4 col-md-4"><a href="{$_M['url']['login_other']}&type=weixin"><i class="fa fa-weixin"></i></a></div>
<!--
EOT;
}
if($_M['config']['met_weibo_open']){
echo <<<EOT
-->
					<div class="col-xs-4 col-md-4"><a href="{$_M['url']['login_other']}&type=weibo"><i class="fa fa-weibo"></i></a></div>
<!--
EOT;
}
echo <<<EOT
-->
				</div>
			</div>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
if($_M['config']['met_member_register']){
echo <<<EOT
-->
			<a class="btn btn-lg btn-info btn-block" href="{$_M['url']['register']}">{$_M['word']['logintips1']}</a> 
<!--
EOT;
}
echo <<<EOT
-->			
		</form>
	</div>
</div>
<!--
EOT;
$page_type = 'login';
require_once $this->template('tem/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>