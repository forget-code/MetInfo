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
<script type="text/javascript">var basepath='{$img_url}?$jsrand',lang = '$lang',adminurl='{$_M[url][site_admin]}',temurl='{$_M[url][own_tem]}',form_url='{$_M[url][own_form]}';</script>
<script src="{$_M[url][own_tem]}js/jQuery1.8.2.js"></script>
<script src="{$_M[url][own_tem]}js/iframes.js"></script>
<script src="{$_M[url][own_tem]}js/metvar.js"></script>

<div class="clear"></div>
<script type="text/javascript">
    var langmarks = Array();
<!--
EOT;

$langaction="edit";
$langeditor=$_M[form][langeditor];
$langorder=count($met_langadmin)+1;
$langopen1="checked='checked'";
$langopen1="";
$langopen2="checked='checked'";
$_M[word][langadd]=$_M[word][langedit];
$langorder=$met_langok[$langeditor][order];

$met_langok[$langeditor][useok]?$langopen1="checked='checked'":$langopen0="checked='checked'";
$langmark1="disabled='disabled'";
$y='';
$i=0;
$met_langokxs[$langeditor][flag]=$met_langok[$langeditor][flag]?$met_langok[$langeditor][flag]:'zh-CN.gif';

foreach($met_langadmin as $key=>$val){
$y=$langeditor;
if($val[mark]!=$y){
echo <<<EOT
-->
        langmarks[$i]='$val[mark]';
<!--
EOT;
$i++;
}
}


	

echo <<<EOT
-->
   var p = 0;
</script>
        <form method="POST" name="myform" action="{$_M[url][own_form]}a=dosave" target="_self">
		<input name="action" type="hidden" value="modify">
		<input name="langsetaction"type="hidden" value="{$langaction}">
		<input name="langorderold" type="hidden" value="{$met_langadmin[$langeditor][order]}">
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<div class="v52fmbx">	
	
	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][sort]}{$_M[word][marks]}</dt>
		<dd>
			<input type="text" name="langorder" class="text small nonull" value="$langorder" />
			<span class="tips">{$_M[word][langorderinfo]}</span>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][langname]}{$_M[word][marks]}</dt>
		<dd>
			<input type="text" class="text nonull" name="langname" value="{$met_langok[$langeditor][name]}" />
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][langflag]}{$_M[word][marks]}</dt>
		<dd>
			<img id="langflag" src="{$_M[url][own_tem]}images/flag/{$met_langokxs[$langeditor][flag]}" alt="" title="" style="float:left; margin:10px 20px 0px;" />
			<input name="langflag" type="hidden" class="text" value="{$met_langokxs[$langeditor][flag]}" />
			<div class="flag flagselect">
			    <a href="javascript:;" onclick="return metflag($(this),'{$lang}');" title="{$_M[word][selected]}">{$_M[word][selected]}</a>
			</div>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_dlbox" {$langmark1} style="display:none;" id="langmark">
	<dl>
		<dt>{$_M[word][langexplain2]}{$_M[word][marks]}</dt>
		<dd>
			<input type="text" class="text small nonull" name="langmark" value="{$met_langok[$langeditor][mark]}" />
			<span class="tips">{$_M[word][langmarkinfo]}</span>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][langtype]}{$_M[word][marks]}</dt>
		<dd>
			<label><input name="languseok" type="radio" class="radio" value="1" $langopen1 />{$_M[word][open]}</label>
			<label><input name="languseok" type="radio" class="radio" value="0" $langopen0 />{$_M[word][close]}</label>
		</dd>
	</dl>
	</div>

<!--
EOT;
    $langorder=count($met_langok)+1;
	$langopen1="checked=''";
	$langautor2="checked=''";
	$langnewwindows1="checked=''";
		$langopen1="";
		$_M[word][langadd]=$_M[word][langedit];
		$langorder=$met_langok[$langeditor][order];
		if($met_langok[$langeditor][useok]){
			$langopen1="checked";
		}else{
			$langopen2="checked";
		}
		$met_langok[$langeditor][newwindows]?$langnewwindows1="checked='checked'":$langnewwindows0="checked='checked'";
		$langmark1="class='none'";
		$langautor1='';
		$langautor2='';
		$langautor1="checked=''";
		$copyhide=' style="display:none"';
		$addhide='';
		$syn[$met_langok[$langeditor][synchronous]]="selected";
echo <<<EOT
-->
        <form method="POST" name="myform" action="lang.php?anyid={$anyid}&lang={$lang}&cs={$cs}" target="_self">
		<input name="action" type="hidden" value="modify">
		<input name="langsetaction"type="hidden" value="{$langaction}">
		<input name="cs"type="hidden" value="{$cs}">
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<!--
EOT;
if($langaction!='add'){
$dbinput='<input name="langautor" value="'.$met_langok[$langeditor][autor].'" type="hidden" />';
}
$met_index_type11[1]=$met_index_type?'':'checked';
$met_index_type11[0]=$met_index_type?'checked':'';
if($met_langok[$langeditor][mark]==$met_index_type){
$met_index_type11[1]='checked';
$met_index_type11[0]='';
}
echo <<<EOT
-->
	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][langnewwindows]}{$_M[word][marks]}</dt>
		<dd>
			<label><input name="langnewwindows" id="langnewwindows1" type="radio" class="radio" value="1" $langnewwindows1 />{$_M[word][yes]}</label>
			<label><input name="langnewwindows" id="langnewwindows0" type="radio" class="radio" value="0" $langnewwindows0 />{$_M[word][no]}</label>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][langhome]}{$_M[word][marks]}</dt>
		<dd>
			<label><input name="met_index_type1" type="radio" class="radio" value="1" {$met_index_type11[1]} />{$_M[word][yes]}</label>
			<label><input name="met_index_type1" type="radio" class="radio" value="0" {$met_index_type11[0]} />{$_M[word][no]}</label>
			<span class="tips">{$_M[word][langurlinfo]}</span>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][langouturl]}{$_M[word][marks]}</dt>
		<dd>
			<input type="url" class="text" name="langlink" placeholder="http://www.xxx.com/" value="{$met_langok[$langeditor][link]}" />
			<br/><span class="tips">{$_M[word][langouturlinfo]}</span>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_submit">
		{$dbinput}
		<input type="submit" name="Submit" value="{$_M[word][Submit]}" class='submit' onclick="return Smit($(this),'myform')" />
	</div>
</div>
</div>
</div>
    </form>
	<div class="footer">$foot</div>
<script type="text/javascript">
	$('#met-lang').change(function(){
		if($(this).val()==''){
			expandtan($('#langmark'));
			$('#langautor-box').hide();
			$("input[name=langdlok]:eq(1)").attr("checked",'checked');changelang(0);
			if($('input:radio[name="langdlok"]:checked').val()==1){
				expandtan($('#notlangautor2'));
				$('.notlangautor2').hide();
			}
		}else if($(this).val()!=0){
			var img=$(this).val();
			if($(this).val()=='cn')img='zh-CN';
			if($(this).val()=='tc')img='zh-TW';
			var imgu=img+'.gif';
			$('#langmark').hide();
			var gn=$(this).find("option:selected").text();
			$("input[name='langname']").val(gn);
			$("input[name='langflag']").val(imgu);
			$("#langflag").attr('src','../../../public/images/flag/'+imgu);
			expandtan($('#langautor-box'));
			$('#notlangautor2').hide();
		}
	});
	function changelang(i){
		y= $('#met-lang').val()!=''?0:1;
		if(y){
			if(i){
				$('.notlangautor2').hide();
				expandtan($('#notlangautor2'));
			}else{
				$('#notlangautor2').hide();
				expandtan($('.notlangautor2'));
			}
		}else{
			if(i){
				$('.notlangautor2').hide();
			}else{
				expandtan($('.notlangautor2'));
			}
			$('#notlangautor2').hide();
		}
	}
</script>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved..
?>