<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
$title = $_M['word']['memberIndex3'];
require_once $this->template('tem/head');
echo <<<EOT
-->
<div class="member-profile met-member">
	<div class="container">
		<div class="member-profile-content">
			<div class="row">
<!--
EOT;
$active['safety'] = 'active';
require_once $this->template('tem/sidebar');
echo <<<EOT
-->
				<div class="col-xs-12 col-sm-9 met-member-safety met-member-profile">
<div class="media">
  <div class="media-left media-middle">
    <i class="fa fa-unlock-alt"></i>
  </div>
  <div class="media-body">
		<div class="row">
			<div class="col-xs-8 col-sm-10">
				<h4 class="media-heading">{$_M['word']['accpassword']}</h4>
				{$_M['word']['accsaftips1']}
			</div>
			<div class="col-xs-4 col-sm-2">
				<button type="button" class="btn btn-default" data-toggle="modal" data-target=".safety-modal-pass">{$_M['word']['modify']}</button>
			</div>
		</div>
  </div>
</div>
<div class="media">
  <div class="media-left media-middle">
    <i class="fa fa-envelope"></i>
  </div>
  <div class="media-body">
		<div class="row">
			<div class="col-xs-8 col-sm-10">
				<h4 class="media-heading">{$_M['word']['accemail']} <span class="text-muted">{$emailtxt}</span></h4>
				{$_M['word']['accsaftips2']}
			</div>
			<div class="col-xs-4 col-sm-2">
				<button type="button" class="btn btn-default {$emailclass}" {$disabled} data-mailedit="{$_M['url']['mailedit']}" data-mailadd="{$_M['url']['profile_safety_emailadd']}">{$emailbut}</button>
			</div>
		</div>
  </div>
</div>
<div class="media">
  <div class="media-left media-middle">
    <i class="fa fa-mobile"></i>
  </div>
  <div class="media-body">
		<div class="row">
			<div class="col-xs-8 col-sm-10">
				<h4 class="media-heading">{$_M['word']['acctel']} <span class="text-muted">{$teltxt}</span></h4>
				{$_M['word']['accsaftips3']}
			</div>
			<div class="col-xs-4 col-sm-2">
				<button type="button" class="btn btn-default {$telclass}">{$telbut}</button>
			</div>
		</div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade safety-modal-pass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
		<form class="met-form" method="post" action="{$_M['url']['pass_save']}">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{$_M['word']['modifypassword']}</h4>
      </div>
      <div class="modal-body">
			<div class="form-group">
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
				<input type="password" name="oldpassword" required class="form-control" placeholder="{$_M['word']['oldpassword']}"
					data-bv-notempty="true"
					data-bv-notempty-message="{$_M['word']['noempty']}"
				>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
				<input type="password" name="password" required class="form-control" placeholder="{$_M['word']['newpassword']}"
					data-bv-notempty="true"
					data-bv-notempty-message="{$_M['word']['noempty']}"
					
					data-bv-identical="true"
					data-bv-identical-field="confirmpassword"
					data-bv-identical-message="{$_M['word']['passwordsame']}"
					
					data-bv-stringlength="true"
					data-bv-stringlength-min="3"
					data-bv-stringlength-max="30"
					data-bv-stringlength-message="{$_M['word']['passwordcheck']}"
				>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
					<input type="password" name="confirmpassword" required data-password="password" class="form-control" placeholder="{$_M['word']['renewpassword']}"
					
					
					data-bv-identical="true"
					data-bv-identical-field="password"
					data-bv-identical-message="{$_M['word']['passwordsame']}"
					>
				</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{$_M['word']['confirm']}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{$_M['word']['cancel']}</button>
      </div>
		</form>
    </div>
  </div>
</div>
<div class="modal fade safety-modal-emailadd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
		<form class="met-form" method="post" action="{$_M['url']['profile_safety_emailadd']}">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{$_M['word']['accemail']}</h4>
      </div>
      <div class="modal-body">
			<div class="form-group">
				<input type="email" name="email" required class="form-control" placeholder="{$_M['word']['emailaddress']}"
				data-bv-remote="true"
				data-bv-remote-url="{$_M['url']['maileditok']}" 
				data-bv-remote-message="{$_M['word']['emailuse']}">
			</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{$_M['word']['confirm']}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{$_M['word']['cancel']}</button>
      </div>
		</form>
    </div>
  </div>
</div>
<div class="modal fade safety-modal-teladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
		<form class="met-form" method="post" action="{$_M['url']['profile_safety_teladd']}">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{$_M['word']['acctel']}</h4>
      </div>
      <div class="modal-body">
			<div class="form-group">
				<input type="text" name="tel" required class="form-control" placeholder="{$_M['word']['telnum']}"
				data-bv-remote="true"
				data-bv-remote-url="{$_M['url']['profile_safety_telok']}" 
				data-bv-remote-message="{$_M['word']['teluse']}"
				data-phone-message="{$_M['word']['telok']}"
				data-bv-notempty="true"
				data-bv-notempty-message="{$_M['word']['noempty']}"
				>
			</div>
			<div class="row login_code">
				<div class="col-xs-7">
					<div class="form-group">
						<input type="text" name="code" required class="form-control" placeholder="{$_M['word']['memberImgCode']}" 
						data-bv-notempty="true"
						data-bv-notempty-message="{$_M['word']['noempty']}"
						>
					</div>
				</div>
				<div class="col-xs-5">
					<button type="button" data-url="{$_M['url']['profile_safety_telvalid']}" class="btn btn-success phone_code" data-retxt="{$_M['word']['resend']}">{$_M['word']['getmemberImgCode']} <span class="badge"></span></button>
				</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{$_M['word']['confirm']}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{$_M['word']['cancel']}</button>
      </div>
		</form>
    </div>
  </div>
</div>
<div class="modal fade safety-modal-teledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
		<form class="met-form" method="post" action="{$_M['url']['profile_safety_teledit']}">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{$_M['word']['modifyacctel']}</h4>
      </div>
      <div class="modal-body">
			<div class="form-group">
				{$teltxt}
			</div>
			<div class="row login_code">
				<div class="col-xs-7">
					<div class="form-group">
						<input type="text" name="code" required class="form-control" placeholder="{$_M['word']['memberImgCode']}" 
							data-bv-notempty="true"
							data-bv-notempty-message="{$_M['word']['noempty']}"
						>
					</div>
				</div>
				<div class="col-xs-5">
					<button type="button" data-url="{$_M['url']['profile_safety_teledit']}" class="btn btn-success phone_code" data-retxt="{$_M['word']['resend']}">{$_M['word']['getmemberImgCode']} <span class="badge"></span></button>
				</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{$_M['word']['confirm']}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{$_M['word']['cancel']}</button>
      </div>
		</form>
    </div>
  </div>
</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--
EOT;
$page_type = 'profile_safety';
require_once $this->template('tem/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>