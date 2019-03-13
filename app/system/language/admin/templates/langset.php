<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');

echo <<<EOT
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="{$_M[url][pub]}bootstrap/css/bootstrap.min.css?{$jsrand}" />
<link rel="stylesheet" type="text/css" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<link rel="stylesheet" type="text/css" href="{$_M[url][own_tem]}css/newstyle.css?{$jsrand}" />
<link rel="stylesheet" href="{$_M[url][pub]}font-awesome/css/font-awesome.min.css?{$jsrand}" />
<script type="text/javascript">var basepath='{$img_url}?$jsrand',lang = '$lang',adminurl='{$_M[url][site_admin]}';</script>

<div class="clear"></div>

 <form method="POST" name="myform" action="{$_M[url][own_form]}a=doupdate" class="ui-from" target="_self">
		<input name="action" type="hidden" value="modify">
		<input name="langsetaction"type="hidden" value="set">
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<div class="v52fmbx">
<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][language_backlangchange_v6]}{$_M[word][marks]}</dt>
		<dd>
			<label><input name="met_admin_type_ok" type="radio" class="radio" value="1" $met_admin_type_yes />{$_M[word][open]}</label><label><input name="met_admin_type_ok" type="radio" class="radio" value="0" $met_admin_type_no />{$_M[word][close]}</label><span class="tips">{$_M[word][langadminyes]}</span>
		</dd>
	</dl>
	</div>
	<!--<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][language_backlangchange_v6]}</dt>
		<dd class="ftype_select">
		  <div class="fbox">
			<select name="met_admin_type_ok" data-checked='{$_M[config][met_admin_type_ok]}'>
<!--
EOT;
foreach($met_langok as $key=>$val){
echo <<<EOT
-->
<option value="{$val[mark]}">{$val[name]}</option>	
<!--
EOT;
}
echo <<<EOT
-->
	</select></div>&nbsp;<span class="tips">{$_M[word][langadminyes]}</span>
		</dd>
	</dl>
	-->
	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][langsw]}{$_M[word][marks]}</dt>
		<dd>
			<label><input name="met_lang_mark" type="radio" class="radio" value="1" $met_lang_mark_yes />{$_M[word][open]}</label>
			<label><input name="met_lang_mark" type="radio" class="radio" value="0" $met_lang_mark_no />{$_M[word][close]}</label>
			<span class="tips">{$_M[word][langchok]}</span>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_dlbox v52fmbx_mo">
	<dl>
		<dt>{$_M[word][langch]}{$_M[word][marks]}</dt>
		<dd>
			<label><input name="met_ch_lang" type="radio" class="radio" value="1" $met_ch_lang1 />{$_M[word][open]}</label>
			<label><input name="met_ch_lang" type="radio" class="radio" value="0" $met_ch_lang2 />{$_M[word][close]}</label>
			<span class="tips">{$_M[word][unitytxt_10]}</span>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_submit">
		<input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit" onclick="" />
	</div>
</div>
</div>
</div>
        </form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved..
?>