<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
defined('IN_MET') or exit('No permission');
$data['page_title']=$_M['word']['memberReg'].$data['page_title'];
?>
<include file="sys_web/head"/>
<div class="register-index met-member page p-y-50 bg-pagebg1">
	<div class="container">
		<form class="form-register met-form met-form-validation panel panel-body" method="post" action="{$_M['url']['register_save']}">
			<h1 class='m-t-0 m-b-20 font-size-24 text-xs-center'>{$_M['word']['memberReg']}</h1>
			<?php
			switch ($_M['config']['met_member_vecan']) {
				case 1:
			?>
			<include file="app/register_email"/>
			<?php
					break;
				case 3:
			?>
			<include file="app/register_phone"/>
			<?php
					break;
				default:
			?>
			<include file="app/register_ord"/>
			<?php
					break;
			}
			if(count($_M['paralist'])){
			?>
			<div class="form-group m-y-30 text-muted met-more">
				<hr />
				<span>{$_M['word']['memberMoreInfo']}</span>
			</div>
			<?php
			}
			$_M['paraclass']->parawebtem($_M['user']['id'],10,1);
			?>
			<button class="btn btn-lg btn-primary btn-squared btn-block" type="submit">{$_M['word']['memberRegister']}</button>
			<div class="login_link m-t-10 text-xs-right"><a href="{$_M['url']['login']}">{$_M['word']['acchave']}</a></div>
		</form>
	</div>
</div>
<include file="sys_web/foot"/>