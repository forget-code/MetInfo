<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<div class="dropup pull-left" style="margin-left:5px;">
  	<ul class="dropdown-menu list-type-update" data-type="move" role="menu" >
<!--
EOT;
require $this->template('own/mod_column');
echo <<<EOT
-->
		<li role="presentation" class="divider"></li>
  	</ul>
</div>
<div class="dropup pull-left" style="margin-left:5px;">
  	<ul class="dropdown-menu list-type-update" data-type="copy" role="menu" >
<!--
EOT;
require $this->template('own/mod_column');
echo <<<EOT
-->
  	</ul>
  	<input type="hidden" name="columnid" value="" />
  	<input type="hidden" name="recycle" value="" />
</div>
<button type="submit" name="del" class="btn btn-default" style="margin-left:2px;" data-toggle="popover">{$_M[word][delete]}</button>
<div style="float:right;margin-left:2px;">
   	&nbsp;&nbsp;{$_M[word][feedbackTip2]}
   	<select name="met_fd_export"  class='met_fd_export'>
	   <option value="{$_M[url][own_form]}a=doexport&class1={$class[class1]}&met_fd_export=-1">{$_M[word][feedbackTip4]}</option>
	   <option value="{$_M[url][own_form]}a=doexport&class1={$class[class1]}&met_fd_export=-1&custom=1">{$_M[word][managertyp5]}</option>
<!--
EOT;
foreach ($selectlist as $key=>$val){
    echo <<<EOT
-->

		<option value="$val[info]">$val[info]</option>
<!--
EOT;
}
//<a href="{$_M[url][own_form]}a=doexport&class1={$class[class1]}&met_fd_export=-1" target="_self" class='export-feedback btn btn-default'>{$_M[word][feedbackExport]}</a>
echo <<<EOT
-->
	</select>
    <input type="hidden" name="check_id">
	<a href="javascript:;" target="_self" class='export-feedback btn btn-default'>{$_M[word][feedbackExport]}</a>
</div>
<!--
EOT;

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>