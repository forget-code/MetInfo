<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. .
$_M['word']['fontfamily'] = str_replace("'","\"", $_M['word']['fontfamily']);
$_M['word']['fontfamily'] =str_replace("&quot;","\"", $_M['word']['fontfamily']);
$_M['config']['met_agents_linkurl'] = $_M['config']['met_agents_linkurl'] ? $_M['config']['met_agents_linkurl'] : 'https://www.metinfo.cn';
$jsrand=str_replace('.','',$_M[config][metcms_v]).$_M[config][met_patch];
$rand = time();
echo <<<EOT
--><!DOCTYPE HTML>
<html>
<head>
<title>{$_M['word']['logintitle']} - {$_M['word']['metinfo']}</title>
<meta charset="utf-8" />
<meta http-equiv="Content-Language" content="zh-cn"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta name="author" content="www.metinfo.cn"/>
<meta name="copyright" content="www.metinfo.cn"/>
<meta content="{$_M['word']['metinfo']}{$_M['word']['logintitle']}"/>
<link href="{$_M['url']['site']}favicon.ico" rel="shortcut icon" type="image/x-icon">
<link rel="stylesheet" href="{$_M['url']['own_tem']}css/metinfo.css?{$jsrand}" />
<script type="text/javascript" src="{$_M['url']['site']}public/js/metinfo-min.js"></script>
</head>
<script type="text/javascript">
function check_main_login(){
	var name = $("input[name='login_name']");
	var pass = $("input[name='login_pass']");
		if(name.val() == ''){
			alert("{$_M[word][loginid]}");
			name.focus();
			return false;
		}
		if(pass.val() == ''){
			alert('{$_M[word][loginps]}');
			pass.focus();
			return false;
		}
}
function pressCaptcha(obj){
    obj.value = obj.value.toUpperCase();
}
function metfocus(intext){
        intext.focus(function(){
		    $(this).addClass('metfocus');
		});
        intext.focusout(function(){
		    $(this).removeClass('metfocus');
		});
}
</script>
<body id="login">
<div class="login-min">
	<div class="login-left">
		<div style=" border-right:1px solid #fff; padding:0px 0px 20px;">
<!--
EOT;
if($_M['config']['met_agents_type'] >= 2){
echo <<<EOT
-->
			<a href="{$_M['config']['met_agents_linkurl']}" style="font-size:0px;" target="_blank" title="{$_M['word']['metinfo']}" class="img">
<!--
EOT;
}else{
echo <<<EOT
-->
            <a href="{$_M['config']['met_agents_linkurl']}" style="font-size:0px;" target="_blank" title="{$_M['word']['metinfo']}" class="img">
<!--
EOT;
}
echo <<<EOT
-->
				<img src="{$_M['config']['met_agents_logo_login']}?{$rand}" alt="{$_M['word']['metinfo']}" title="{$_M['word']['metinfo']}" 
				style="width:200px;"/>
			</a>
		</div>
	</div>
	<div class="login-right">
		<h1 class="login-title">{$_M['word']['loginadmin']}</h1>
		<div>
			<form method="post" action="{$_M['url']['own_form']}a=dologin&langset={$_M[form][langset]}" name="main_login" onSubmit="return check_main_login()">
				<input type="hidden" name="action" value="login" />
				<p style="height:22px; margin-top:0px;">
<!--
EOT;
if($_M['config']['met_admin_type_ok']){
echo <<<EOT
-->
					<label>{$_M['word']['loginlanguage']}</label>
					<select name="loginlang" onchange=javascript:window.location.href=this.options[this.selectedIndex].value >
<!--
EOT;
	//ob_pcontent();
    $langset=$langset==""?$_M['config']['met_admin_type']:$langset;
    $met_langtype_select[$langset]="selected='selected'" ;
	foreach($met_langadmin as $key=>$val){
		if($val[mark] == 'en' || $val[mark] == 'cn' || 1 == 1){
echo <<<EOT
-->
						<option value="{$_M['url']['own_form']}langset=$val[mark]" {$met_langtype_select[$val[mark]]}>$val[name]</option>
<!--
EOT;
	}
}
echo <<<EOT
-->
					</select>
<!--
EOT;
}
echo <<<EOT
-->
				</p>
				<p><label>{$_M['word']['loginusename']}</label><input type="text" class="text" name="login_name" value="$check_name" $disabled /></p>
				<p><label>{$_M['word']['loginpassword']}</label><input type="password" class="text" name="login_pass" /></p>
				<p class="login-code">
<!--
EOT;
if($_M['config']['met_login_code']==1){
echo <<<EOT
-->
					<label>{$_M['word']['logincode']}</label>
					<input name="code" onKeyUp="pressCaptcha(this)" type="text" class="text mid" id="code" />
					<img align="absbottom" src="./include/ajax.php?action=code"  onclick=this.src="./include/ajax.php?action=code&"+Math.random() style="cursor: pointer;" title="{$_M['word']['logincodechange']}"/>
<!--
EOT;
}
echo <<<EOT
-->
				</p>
				<p class="login-submit">
					<input type="submit" name="Submit" value="{$_M['word']['loginconfirm']}" />
					<a href="./index.php?n=getpassword&c=index&a=doindex&langset={$_M[form][langset]}">{$_M['word']['loginforget']}</a>
				</p>
			</form>
		</div>
	</div>
	<div class="clear"></div>
</div>
<!--
EOT;
require $this->template('ui/footer');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>