<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<script>
var ownlangtxt = {
	"jsx18":"{$_M[word][jsx18]}",
	"jsx19":"{$_M[word][jsx19]}"
};
</script>
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doemaileditor" target="_self">
<div class="v52fmbx">
	<dl>
		<dd class="ftype_description">
		{$_M[word][setbasicTip6]}
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setbasicFromName]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_fd_fromname" type="text" autocomplete="off" value="{$_M[config][met_fd_fromname]}" />
			</div>
			<span class="tips">{$_M[word][setbasicTip7]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setbasicEmailAccount]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_fd_usename" type="text" autocomplete="off" value="{$_M[config][met_fd_usename]}" />
			</div>
			<span class="tips">{$_M[word][setbasicTip8]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setbasicSMTPPassword]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_fd_password" type="password" autocomplete="off" value="passwordhidden" />
			</div>
			<span class="tips">{$_M[word][setbasicTip11]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][setbasicSMTPServer]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_fd_smtp" type="text" autocomplete="off" value="{$_M[config][met_fd_smtp]}" />
			</div>
			<span class="tips">{$_M[word][setbasicTip10]}</span>
		</dd>
	</dl>
	<dl class="morodllist" style="display:none;">
		<dt>{$_M[word][setbasicSMTPPort]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input name="met_fd_port" type="text" autocomplete="off" value="{$_M[config][met_fd_port]}" />
			</div>
			<span class="tips">{$_M[word][setbasicTip12]}</span>
		</dd>
	</dl>
	<dl class="morodllist" style="display:none;">
		<dt>{$_M[word][setbasicSMTPWay]}</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input type="radio" name="met_fd_way" value="ssl" data-checked="{$_M[config][met_fd_way]}" />{$_M[word][ssl]}</label>
				<label><input type="radio" name="met_fd_way" value="tls" />{$_M[word][tls]}</label>
			</div>
			<span class="tips">{$_M[word][setbasicTip13]}</span>
		</dd>
	</dl>
	<dl>
		<dt></dt>
		<dd>
			<a href="#" class="morodllist">{$_M['word']['more_options']}</a>
		</dd>
	</dl>
	<dl>
		<dt></dt>
		<dd>
			<a href="{$_M[url][own_form]}a=doemail" class="emailtest">{$_M[word][upfiletips16]}</a>
			<span class="tips" style="padding-left:10px;"></span>
		</dd>
	</dl>
	<dl class="noborder">
		<dt> </dt>
		<dd>
			<input type="submit" name="submit" value="{$_M['word']['Submit']}" class="submit">
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