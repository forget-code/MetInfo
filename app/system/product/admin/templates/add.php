<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');


echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doaddsubmit" target="_self">
<div class="v52fmbx content_add">
	<dl>
		<dt>{$_M['word']['release_to']}</dt>
		<dd class="ftype_select-linkage">
			<div class="fbox" style="float:left;" data-selectdburl="{$_M[url][own_form]}a=docolumnjson">
				<select name="add_class1" class="prov" data-required="1"></select>  
				<select name="add_class2" class="city"></select>
				<select name="add_class3" class="dist"></select>
			</div>
			<!--
EOT;
if(in_array('metinfo',$arrlanguage)||in_array('1201',$arrlanguage)){
echo <<<EOT
-->     
			<span class="tips" style="float:left; margin-left:20px;"><a href="{$_M[url][site_admin]}column/index.php?anyid=25&lang={$_M[lang]}" >{$_M['word']['configuration_section']}</a></span>
<!--
EOT;
}
echo <<<EOT
--> 
		</dd>
	</dl>
	<dl class="noborder">
		<dt> </dt>
		<dd>
			<input type="submit" name="submit" value="{$_M['word']['password20']}" class="submit">
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