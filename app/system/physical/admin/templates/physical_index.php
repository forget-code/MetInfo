<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
if(!$phy){
echo <<<EOT
-->
<script type="text/javascript">
   var metimgurl="{$_M[url][site_admin]}templates/met/images/";
function physicalsub(my){
	$("input[type='submit']").attr('disabled',true);
	my.next('span.tips').append('<img src="'+metimgurl+'loadings.gif" style="position:relative; top:3px;" />'+'{$lang_physicaltips1}');
	location.href=my.attr('href');
	return false;
}
</script>
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<div class="v52fmbx">
	<h3 class="v52fmbx_hr metsliding">{$_M[word][physicaltips12]}</h3>
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][physicaltips5]}{$_M[word][marks]}</dt>
			<dd>
				<span style="color:red">{$sctimenum}</span>
				{$sctimetxt}
			</dd>
		</dl>
		</div>
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][physicaltips6]}{$_M[word][marks]}</dt>
			<dd>
			<span style="color:red">{$defen}</span>
			{$_M[word][physicaltips7]}
			{$_M[word][physicaltips8]}<span class="physical_stm1"  style="color:red">10</span>{$_M[word][physicaltips9]}
			{$_M[word][physicaltips10]}<span class="physical_stm1" style="color:red">{$notde}</span>{$_M[word][physicaltips11]}
<!--
EOT;
if($physical_time!=''){
echo <<<EOT
-->
			<a href="index.php?lang=$lang&anyid={$anyid}&phy=1">{$_M[word][setfileview]}</a>
<!--
EOT;
}
echo <<<EOT
-->			
			</dd>
		</dl>
		</div>
	<div class="v52fmbx_submit">
			<input type="submit" name="submit" value="{$_M[word][physicaltips13]}" class="submit" href="{$_M[url][own_form]}a=dophysical" onclick="return physicalsub($(this))" />
			<span class="tips"></span>
	</div>
</div>
</div>
</div>
<!--
EOT;
}else{
$p1=count($physical1);
echo <<<EOT
-->
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<div class="v52fmbx">
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][physicaltips14]}{$_M[word][marks]}</dt>
			<dd>
				<span style="color:red">{$defen}</span>
				<span class="tips">{$_M[word][physicaltips17]}</span>
			</dd>
		</dl>
		</div>
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][physicaltips15]}{$_M[word][marks]}</dt>
			<dd>
				{$physical_time}&nbsp;&nbsp;<a href="{$_M[url][own_form]}a=dophysical" onclick="return physicalsub($(this))">{$_M[word][physicaltips16]}</a>
			</dd>
		</dl>
		</div>
<!--
EOT;
if($p1>0){
echo <<<EOT
-->
		<h3 class="v52fmbx_hr metsliding" style="color:red" sliding="1"><b>{$_M[word][physicaltips18]}( $p1 )</b><span style="float:right">{$_M[word][physicaltips19]}</span></h3>
<!--
EOT;
}
echo <<<EOT
-->
		<div class="metsliding_box metsliding_box_1">
<!--
EOT;
foreach($physical1 as $key=>$val){
echo <<<EOT
-->
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$val[name]}{$_M[word][marks]}</dt>
			<dd>
				{$val[text]}
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
$p2=count($physical2);
if($p2>0){
echo <<<EOT
-->
		<h3 class="v52fmbx_hr metsliding" style="color:#2366A8;" sliding="2"><b>{$_M[word][physicaltips20]}( $p2 )</b><span style="float:right">{$_M[word][physicaltips21]}</span></h3>
<!--
EOT;
}
echo <<<EOT
-->
		<div class="metsliding_box metsliding_box_2">
<!--
EOT;
foreach($physical2 as $key=>$val){
echo <<<EOT
-->
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$val[name]}{$_M[word][marks]}</dt>
			<dd>
				{$val[text]}
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
$p3=count($physical3);
if($p3>0){
echo <<<EOT
-->
		<h3 class="v52fmbx_hr metsliding" style="color:#390;"sliding="3"><b>{$_M[word][physicaltips22]}( $p3 )</b></h3>
<!--
EOT;
}
echo <<<EOT
-->
		<div class="metsliding_box metsliding_box_3">
<!--
EOT;
foreach($physical3 as $key=>$val){
echo <<<EOT
-->
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$val[name]}{$_M[word][marks]}</dt>
			<dd>
				{$val[text]}
			</dd>
		</dl>
		</div>	
<!--
EOT;
}
echo <<<EOT
-->
		</div>
		<div class="v52fmbx_submit">

		</div>
</div>
</div>
</div>
<table cellpadding="2" cellspacing="1" class="table">
</table>
<!--
EOT;
}
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>