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
$langaction="add";
$langeditor=$_M[form][langeditor];
$langorder=count($met_langok)+1;
$langopen1="checked='checked'";
$langopen1="";
$langopen2="checked='checked'";
$_M[word][langadd]=$_M[word][langedit];
$met_langadmin[$langeditor][useok]?$langopen1="checked='checked'":$langopen0="checked='checked'";
$langmark1="disabled='disabled'";
$y='';
$i=0;
$met_langokxs[$langeditor][flag]=$met_langok[$langeditor][flag]?$met_langok[$langeditor][flag]:'zh-CN.gif';

foreach($met_langadmin as $key=>$val){
// if($langaction=='editadmin')$y=$langeditor;
//if($val[mark]!=$y){
echo <<<EOT
-->
        langmarks[$i]='$val[mark]';
<!--
EOT;
$i++;
}
//}




echo <<<EOT
-->
   var p = 0;
</script>
        <form method="POST" name="myform" action="{$_M[url][own_form]}a=dolangsave" target="_self">
		<input name="action" type="hidden" value="modify">
		<input name="langsetaction"type="hidden" value="add">
		<input name="langorderold" type="hidden" value="{$met_langadmin[$langeditor][order]}">
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<div class="v52fmbx">

	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][sort]}{$_M[word][marks]}</dt>
		<dd>
			<input type="text" name="langorder" class="text nonull" value="$langorder" style="width:50px" />
			<span class="tips">{$_M[word][langorderinfo]}</span>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][langselect]}{$_M[word][marks]}</dt>
		<dd>
			<select name="langautor" id="met-lang" tabindex="0">
			<option value="0">{$_M[word][langselect1]}</option><option value="">{$_M[word][managertyp5]}...</option>
			<option value="sq">{$_M[word][lang1]}</option><option value="ar">{$_M[word][lang2]}</option>
			<option value="az">{$_M[word][lang3]}</option><option value="ga">{$_M[word][lang4]}</option>
			<option value="et">{$_M[word][lang5]}</option><option value="be">{$_M[word][lang6]}</option>
			<option value="bg">{$_M[word][lang7]}</option><option value="is">{$_M[word][lang8]}</option>
			<option value="pl">{$_M[word][lang9]}</option><option value="fa">{$_M[word][lang10]}</option>
			<option value="af">{$_M[word][lang11]}</option><option value="da">{$_M[word][lang12]}</option>
			<option value="de">{$_M[word][lang13]}</option><option value="ru">{$_M[word][lang14]}</option>
			<option value="fr">{$_M[word][lang15]}</option><option value="tl">{$_M[word][lang16]}</option>
			<option value="fi">{$_M[word][lang17]}</option><option value="ht">{$_M[word][lang20]}</option>
			<option value="ko">{$_M[word][lang21]}</option><option value="nl">{$_M[word][lang22]}</option>
			<option value="gl">{$_M[word][lang23]}</option><option value="ca">{$_M[word][lang24]}</option>
			<option value="cs">{$_M[word][lang25]}</option><option value="hr">{$_M[word][lang26]}</option>
			<option value="la">{$_M[word][lang27]}</option><option value="lv">{$_M[word][lang28]}</option>
			<option value="lt">{$_M[word][lang29]}</option><option value="ro">{$_M[word][lang30]}</option>
			<option value="mt">{$_M[word][lang31]}</option><option value="ms">{$_M[word][lang32]}</option>
			<option value="mk">{$_M[word][lang33]}</option>
			<option value="no">{$_M[word][lang35]}</option><option value="pt">{$_M[word][lang36]}</option>
			<option value="ja">{$_M[word][lang37]}</option><option value="sv">{$_M[word][lang38]}</option>
			<option value="sr">{$_M[word][lang39]}</option><option value="sk">{$_M[word][lang40]}</option>
			<option value="sl">{$_M[word][lang41]}</option><option value="sw">{$_M[word][lang42]}</option>
			<option value="th">{$_M[word][lang43]}</option><option value="tr">{$_M[word][lang44]}</option>
			<option value="cy">{$_M[word][lang45]}</option><option value="uk">{$_M[word][lang46]}</option>
			<option value="iw">{$_M[word][lang47]}</option><option value="el">{$_M[word][lang48]}</option>
			<option value="eu">{$_M[word][lang49]}</option><option value="es">{$_M[word][lang50]}</option>
			<option value="hu">{$_M[word][lang51]}</option>
			<option value="it">{$_M[word][lang53]}</option><option value="yi">{$_M[word][lang54]}</option>
			<option value="ur">{$_M[word][lang59]}</option><option value="id">{$_M[word][lang60]}</option>
			<option value="en">{$_M[word][lang61]}</option><option value="vi">{$_M[word][lang62]}</option>
			<option value="zh">{$_M[word][lang63]}</option><option value="cn">{$_M[word][lang64]}</option></select>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][langname]}{$_M[word][marks]}</dt>
		<dd>
			<input type="text" class="text nonull" name="langname" value="" />
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
			    <a href="javascript:;" onclick="return metflag($(this),'cn');" title="{$_M[word][selected]}">{$_M[word][selected]}</a>
			</div>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_dlbox" {$langmark1} style="display:none;" id="langmark">
	<dl>
		<dt>{$_M[word][langexplain2]}{$_M[word][marks]}</dt>
		<dd>
			<input type="text" class="text nonull" name="langmark" value="" style="width:50px" />
			<span class="tips">{$_M[word][langmarkinfo]}</span>
		</dd>
	</dl>
	</div>

	<div id="notlangautor1" class="v52fmbx_dlbox notlangautor2 " >
	<dl>
		<dt>{$_M[word][langexplain6]}{$_M[word][marks]}</dt>
		<dd>
			<select name="langfile">
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
	</select>&nbsp;<span class="tips">{$_M[word][langexplain4]}</span>
		</dd>
	</dl>
	</div>

<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][language_copysetting_v6]}{$_M[word][marks]}</dt>
		<dd>
			<select name="langconfig">
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
	</select>&nbsp;<span class="tips">{$_M[word][language_tips1_v6]}</span>
		</dd>
	</dl>
	</div>
	<div class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][websiteContent]}{$_M[word][marks]}</dt>
		<dd>
			<select name="langcontent">
			<option value="">{$_M[word][notcopy]}</option>
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
	</select>&nbsp;<span class="tips">{$_M[word][language_tips2_v6]}</span>
		</dd>
	</dl>
	</div>
	<div  class="v52fmbx_dlbox">
	<dl>
		<dt>{$_M[word][websitetheme]}{$_M[word][marks]}</dt>
		<dd>
			<select name="langui">
		<option value="">{$_M[word][notcopy]}</option>
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
	</select>&nbsp;<span class="tips">{$_M[word][language_tips3_v6]}</span>
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
		$met_langok[$langeditor][newwindows]?$_M[form][langnewwindows1]="checked='checked'":$_M[form][langnewwindows0]="checked='checked'";
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
			<input type="text" class="text" name="langlink" value="" />
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
			if($(this).val()=='zh')img='zh-TW';
			var imgu=img+'.gif';
			$('#langmark').hide();
			var gn=$(this).find("option:selected").text();
			$("input[name='langname']").val(gn);
			$("input[name='langflag']").val(imgu);
			$("#langflag").attr('src','{$_M[url][own_tem]}images/flag/'+imgu);
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
	function expandtan(dm,mt){
	var h = mt?mt:dm.height();
	dm.height(0);
	dm.animate({ height: h+"px"}, 300,function(){

	});
	dm.show();
}
</script>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved..
?>