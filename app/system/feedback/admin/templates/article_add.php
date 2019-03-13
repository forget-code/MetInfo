<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form  method="POST" name="myform"  action="{$_M[url][own_form]}a={$a}" target="_self">
		<input name="id" type="hidden" value="$id">
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<div class="v52fmbx">
<!--
EOT;
foreach($feedback_para as $key=>$val){
$email=$val[id]==$met_fd_email&&$val[content]?"&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"{$_M[url][own_form]}a=doreplyemail&customerid={$customerid}&id={$id}&class1={$_M[form][class1]}&class2={$_M[form][class2]}&class3={$_M[form][class3]}&email={$val[content]}\">{$_M[word][unitytxt_35]}</a>":'';
echo <<<EOT
-->
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$val[name]}{$_M[word][marks]}</dt>
			<dd>
				$val[content]{$email}
			</dd>
		</dl>
		</div>
<!--
EOT;
}
echo <<<EOT
-->
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][fdeditorTime]}{$_M[word][marks]}</dt>
			<dd>
				{$feedback_list[addtime]}
			</dd>
		</dl>
		</div>
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][fdeditorFrom]}{$_M[word][marks]}</dt>
			<dd>
				{$feedback_list[fromurl]}
			</dd>
		</dl>
		</div>
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][feedbackID]}{$_M[word][marks]}</dt>
			<dd>
				{$feedback_list[customerid]}
			</dd>
		</dl>
		</div>
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>IP{$_M[word][marks]}</dt>
			<dd>
				{$feedback_list[ip]}
			</dd>
		</dl>
		</div>
		<div class="v52fmbx_dlbox">
		<h3 class="v52fmbx_hr">{$_M[word][fdeditorRecord]}{$_M[word][marks]}</h3>
		<dl>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="useinfo" data-ckeditor-y="500">{$feedback_list[useinfo]}</textarea>
				</div>
			</dd>
		</dl>
		</div>
		<div class="v52fmbx_submit">
			<input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit" />
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