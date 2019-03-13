<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form  method="POST" name="myform"  action="{$_M[url][own_form]}a=dosendemail&customerid={$customerid}&action=sendmail&class1={$_M[form][class1]}" target="_self">
		<input name="id" type="hidden" value="{$_M[form][id]}">
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<div class="v52fmbx">
    <dl>
	<dt>{$_M[word][setbasicToName]}{$_M[word][marks]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<input type="text" name="addressee" value="{$_M[form][email]}">
		</div>
	</dd>
</dl>
 <dl>
	<dt>{$_M[word][setbasictopic]}{$_M[word][marks]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<input type="text" name="title" value="">
		</div>
	</dd>
</dl>
<dl>
	<dd class="ftype_ckeditor">
		<div class="fbox">
			<textarea name="contents">{$_M[word][setbasicmainbody]}{$_M[word][marks]}</textarea>
		</div>
	</dd>
</dl>




		<div class="v52fmbx_submit">
			<input type="submit" name="Submit" value="{$_M[word][smstips48]}" class="submit" />
		</div>
</div>
</div>
</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>