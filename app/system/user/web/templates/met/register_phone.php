<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
					<input type="text" name="username" required class="form-control" placeholder="{$_M['word']['memberbasicCell']}"
					data-bv-remote="true"
					data-bv-remote-url="{$_M['url']['register_userok']}" 
					data-bv-remote-message="{$_M['word']['teluse']}" 
					data-phone-message="{$_M['word']['telok']}"
					
					data-bv-notempty="true"
					data-bv-notempty-message="{$_M['word']['noempty']}"
					
					data-bv-stringlength="true"
					data-bv-stringlength-min="2"
					data-bv-stringlength-max="30"
					data-bv-stringlength-message="{$_M['word']['usernamecheck']}"
					/>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
					<input type="password" name="password" required class="form-control" placeholder="{$_M['word']['password']}"
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
			<div class="row login_code">
				<div class="col-xs-7">
					<div class="form-group">				
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-shield"></i></span>
							<input type="text" name="code" required class="form-control" placeholder="{$_M['word']['memberImgCode']}" 
							data-bv-notempty="true"
							data-bv-notempty-message="{$_M['word']['noempty']}"
							>
						</div>
					</div>
				</div>
				<div class="col-xs-5">
					<button type="button" data-url="{$_M['url']['valid_phone']}" class="btn btn-success phone_code" data-retxt="{$_M['word']['resend']}">{$_M['word']['getmemberImgCode']} <span class="badge"></span></button>
				</div>
			</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>