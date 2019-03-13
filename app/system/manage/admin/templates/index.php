<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
// exit;
require $this->template('ui/head');
echo <<<EOT
-->
<title>{$_M[word][setbasicWebInfoSet]}</title>
<style>
img{ behavior: url({$img_url}/iepngfix.htc); }
.Layer {float: left;position: absolute;left: 81px;top: 13px;font-weight: normal;color:#666;}
</style>
<link rel="stylesheet" type="text/css" href="{$_M[url][own_tem]}css/newstyle.css">
<script src="{$_M[url][own_tem]}js/jQuery1.8.2.js"></script>
</head>
<body>
<!--
EOT;
if(($class1 || $class2) && !$met_class[$class2][releclass])$title="<a href='?anyid={$anyid}&lang={$lang}&module=1&class1={$class1}'>{$met_class[$class1][name]}</a>";
if(!$met_class[$class2][releclass] && $class2)$title.=" > ";
if($class2)$title.="<a href='?anyid={$anyid}&lang={$lang}&module=1&class2={$class2}'>{$met_class[$class2][name]}</a>";
if($met_content_type==2){
	$awegcs[1]="class='column_hidden'";
	$awegcs[2]="class='modular_display'";
}else{
	$awegcs[1]="class='column_display'";
	$awegcs[2]="class='modular_hidden'";
}
$other_op.="<a href=\"{$_M[url][own_form]}&a=domodule\" title=\"{$_M[word][columnarrangement2]}{$_M[word][columnarrangement3]}\" {$awegcs[2]}>{$_M[word][columnarrangement3]}</a><a href=\"{$_M[url][own_form]}&a=doindex\" title=\"{$_M[word][columnarrangement2]}{$_M[word][columnarrangement4]}\" {$awegcs[1]}>{$_M[word][columnarrangement4]}</a></span>";
$other_op .= "<a href = '{$_M[url][adminurl]}anyid=33&n=recycle&c=recycle&a=doindex'><i class='fa fa-recycle'></i>{$_M['word']['upfiletips25']}</a>";
/*$other_op .= "<a href='{$_M[url][adminurl]}n=batch&c=batch&a=doindex' >{$_M['word']['bulkopr']}</a>";*/
echo <<<EOT
-->	
<!--
	<div align="right" class="v52fmbx_dings">

	</div>
-->
	<h3 class="v52fmbx_ding search" id="topsearch" >
<!--
EOT;
if(1){
echo <<<EOT
-->	

	<form  method='POST' name='myform' onSubmit='return Checkmember();' action='content.php?anyid={$anyid}&search={$program}&action=search&lang={$lang}' target='_self'>
	<div >
	{$x}
	</div>

	<div>
	<label class="Layer">{$_M[word][column_searchname]}</label>
	<input id='program' name='program' type='text' size='24'  class='input_text stxt'/>
	</div>
	</form>
<!--
EOT;
}
echo <<<EOT
-->		
	<div class="topsearch-rigth">
	{$other_op}
	
	</div>
	</h3>
	
<!--
EOT;

echo <<<EOT
--> 
<div class="metv5box">
	<ul class="columnlist" id="test">
<!--
EOT;
foreach ($contentlist as $key=>$val){
if(strstr($val['name'], $program)||$program==null){
$vimgurl = 'tubiao_'.$val[module].'.png';
echo <<<EOT
--> 
		<li class="contlist" >
			<div class="box">
				<a href='{$val[conturl]}'>
					<img src="{$img_url}/metv5/{$vimgurl}?new" width='70' height='70' />
<!--
EOT;
if($val[sum]){
echo <<<EOT
--> 					
					<span class="cloumn_num">{$val[sum]}</span>
<!--
EOT;
}
echo <<<EOT
--> 
					<h2>{$val['name']}</h2>
				</a>
			</div>
		</li>
<!--
EOT;
}
}
echo <<<EOT
--> 
</ul>
</div>
<div class="clear"></div>
</div>
</div>
<script type="text/javascript">
function searchzdx(dom,label,color1,color2){
	if(dom.val()=='')label.show();
	dom.focus(function(){
		label.css("color",color2);
	});
	dom.keyup(function(){
		if($(this).val()==''){
			label.show();
		}else{
			label.hide();
		}
	});
	dom.focusout(function(){
		if($(this).val()==''){
		label.show();
		label.css("color",color1);
		}
	});
}
searchzdx($('#topsearch .stxt'),$('#topsearch label'),"#666","#ccc");
var element = document.getElementById("program"); 
document.getElementById("program").onfocus=function(){
if(!+[1,]){
element.onpropertychange = webChange; 
}else{ 
element.addEventListener("input",webChange,false); 
} 
}
function webChange(){ 
$.ajax({
		url: '{$_M[url][own_form]}a=dosearch&id='+escape(element.value),
		type: 'GET',
		cache: false,
		success: function(data) {
			$('#test').html(data);
		}
	});
} 
$('.contmorehver').hover(
	function () {
		$(this).find('div.contmore').show();
	},
	function () {
		$(this).find('div.contmore').hide();
	}
);
function metHeight(group,type) {
	tallest = 0;
	group.each(function() {
		thisHeight = $(this).height();
		if(thisHeight > tallest) {
			tallest = thisHeight;
		}
	});
	if(type==1){
		group.each(function(){
			if($(this).outerHeight(true)<tallest){
				var ht = (tallest - $(this).outerHeight(true))/2;
				$(this).css('padding-top',ht+'px');
				$(this).css('padding-bottom',ht+'px');
			}
		});
	}else{
		group.height(tallest);
		group.each(function(){
			var h = tallest - $(this).find('.img').outerHeight(true);
			var x = h - $(this).find('.title').outerHeight(true);
			if(x>0){
				var ht = (x/2)+3;
				$(this).find('.title').css('padding-top',ht+'px');
				$(this).find('.title').css('padding-bottom',ht+'px');
			}
		});
	}
}
metHeight($('.box'));
metHeight($('.contlist .text'),1);
function Focus(obj) {
	if(obj.value==obj.defaultValue){
		obj.value='';
	}
}

function Blur(obj) {
	if(obj.value==''){
		obj.value=obj.defaultValue;

	}
} 
</script>
<div class="clear"></div>
<!--
EOT;
require_once $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved..
?>