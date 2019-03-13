<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('tem/head');
echo <<<EOT
-->
<input id="position" type="hidden" value="lr">
<input id="ordernum" type="hidden" value="{$_M['config']['met_secret_key']}">
<input id="payjumphref" type="hidden" value="{$sucurl}">
	<div class="v52fmbx">
		<div class="paydiv">
		<form method="POST" class="ui-from" name="myform" action="{$_M['url']['api']}n=platform&c=pay&a=doalipay&user_key={$_M['config']['met_secret_key']}&metcms_v={$_M['config']['metcms_v']}" target="_blank">
			<h3 class="v52fmbx_hr">{$_M['word']['smsrecharge']}</h3>
			<dl>
				<dt>{$_M['word']['smstips22']}</dt>
				<dd class="ftype_input">
					<div class="fbox">
						<span class="money"></span>
					</div>
				</dd>
			</dl>
			<dl>
				<dt>{$_M['word']['payment_amount']}</dt>
				<dd class="ftype_input">
					<div class="fbox">
						<input type="text" style="width:110px;" name="payprice" value="" placeholder="{$_M['word']['enter_amount']}" data-required="1">
						<span style="color:red;display:inline-block;padding-left:15px">(提示:充值金额可用于消费，但不支持提现及退款)</span>
					</div>
					<span class="tips"></span>
				</dd>
			</dl>
			<dl style="display:none">
				<dt>{$_M['word']['smstips7']}{$_M['word']['marks']}</dt>
				<dd class="ftype_radio ftype_transverse">
					<div class="fbox">
						<label><input name="paytype" type="radio" value="1" data-checked="1">{$_M['word']['alipay']}</label>
						<label><input name="paytype" type="radio" value="2">{$_M['word']['sys_unionpay']}</label>
					</div>
					<span class="tips">{$_M['word']['payment_method']}</span>
				</dd>
			</dl>
			<dl class="noborder">
				<dt> </dt>
				<dd>
					<input type="submit" name="paysubmit" value="{$_M['word']['smstips19']}" class="submit paysubmit" />
					<span class="tips"><a href="{$_M['url']['own_form']}a=dofinance">{$_M['word']['my_bill']}</a></span>
				</dd>
			</dl>
		</form>
		</div>
		<div class="paysuc" style="display:none">
		<h3 class="v52fmbx_hr">{$_M['word']['pay_success']}</h3>
		<dl>
			<dt></dt>
			<dd>
				<div>
					<span class="paysucjump" ><a>{$_M['word']['please_click']}</a></span>
				</div>
			</dd>
		</dl>
	</div>
	</div>
<!--
EOT;
require $this->template('ui/foot');

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>