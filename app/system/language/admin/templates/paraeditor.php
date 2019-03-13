<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require $this->template('ui/head');
echo <<<EOT
-->
<title>{$_M[word][langwebeditor]}</title>
</head>
<body>
<!--
EOT;
$title=$_M[word][langwebeditor].'('.$met_langok[$langeditor][name].')';
$rurl='lang.php?anyid='.$anyid.'&lang='.$lang.'&cs=1';
//require_once template('metlangs');
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
<script src="{$_M[url][own_tem]}js/jQuery1.8.2.js"></script>
<script src="{$_M[url][own_tem]}js/iframes.js"></script>
<style type="text/css">
.ymsearchbox{ padding:10px 5px 0px;}
.ymsearchbox p{ margin:8px 0px;}
</style>
<div class="clear"></div>
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<span class="tips color999">{$_M[word][xtips]}</span>
<h3 class="v52fmbx_hr color390">{$_M[word][langexplain1]}</h3>	
<div class="v52fmbx">
<div class="v52fmbx_dlbox" style="border-bottom:1px solid #ccc;">
<dl>
	<dd>
		<input name="ymsearchkey" type="text" class="text" value="" /> 
		<input type="submit" name="Submit" value="{$_M[word][search]}" class="submit" onclick="return ymsearch()" style="display:inline;"/>
		<span class="tips">&nbsp;&nbsp;{$_M[word][hotsearches]}{$_M[word][marks]}<a href="javascript:;" onclick="return ymsearch('home_metinfo');">{$langtext_a[home][value]}</a></span>
		<div class="ymsearchbox"></div>
	</dd>
</dl>
</div>
        <form method="POST" name="myform" action="{$_M[url][own_form]}a=domodify&langeditor={$langeditor}" target="_self">
		<input name="action" type="hidden" value="modify">
		<input name="langnum" type="hidden" value="$j">
		<input name="lang" type="hidden" value="tc">
		<input name="langeditor" type="hidden" value="cn">
		<input name="metinfolangid" type="hidden" value="{$langid}">
		<input id="ato_disable" type="hidden" value="1">
		<h3 class="v52fmbx_hr v52fmbx_search metsliding" sliding="0" style="display:none;border-top:0px!important;">{$_M[word][searchresult]}</h3>
<!--
EOT;
$j=count($langtext[0]);
for($i=0;$i<=$j;$i++){
echo <<<EOT
-->
	<div class="metsliding_box metsliding_box_{$i}">
<!--
EOT;
foreach($langtext[$i] as $key=>$val){
echo <<<EOT
-->
	<div class="v52fmbx_dlbox div_{$val[name]}_metinfo" style="display:none">
	<dl>
		<dd>
			<input name="$val[name]_metinfo" type="text" class="text ymsearch nonull" value="$val[value]" disabled="disabled"/>&nbsp;&nbsp;
			<span class="tips">&#123;&#36;lang_{$val[name]}&#125;</span>
		</dd>
	</dl>
	</div>
<!--
EOT;
}
echo <<<EOT
-->
	</div>
<!--
EOT;
}
echo <<<EOT
-->
	<div class="v52fmbx_submit" style="display:none;">
		<input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit"/>
	</div>
        </form>
</div>
<script type="text/javascript">
function ymsearch(key){
	if(key){
		key = $("input[name='"+key+"']").val();
	}else{
		key = $("input[name='ymsearchkey']").val();
	}
	if(key==''){
		$("div[class*='div_']").hide();
		$(".v52fmbx_search").show();
		var puts = $(".ymsearch");
		puts.attr('disabled',false);
		var i=0;
		$(".ymsearchbox").empty();
		puts.each(function(){
			var str = $(this).val();
			if(str==key){
				$(".div_"+$(this).attr('name')).show();
				i++;
			}else{
				$(this).attr('disabled',true);
			}
		});
		$(".v52fmbx_submit").show();
		
		if(i==0){
			$(".ymsearchbox").append("<span class='tips'>{$_M[word][csvnodata]}</span>");
		}
	}else{
		$("div[class*='div_']").hide();
		$(".v52fmbx_search").show();
		var puts = $(".ymsearch");
		puts.attr('disabled',false);
		var i=0;
		$(".ymsearchbox").empty();
		puts.each(function(){
			var str = $(this).val();
			if(str.indexOf(key)>=0){
				$(".div_"+$(this).attr('name')).show();
				i++;
			}else{
				$(this).attr('disabled',true);
			}
		});
		$(".v52fmbx_submit").show();
		if(i==0){
			$(".ymsearchbox").append("<span class='tips'>{$_M[word][csvnodata]}</span>");
		}
	}
	return false;
}
</script>
</div>
</div>
<div class="footer">$foot</div>
</body>
</html>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>