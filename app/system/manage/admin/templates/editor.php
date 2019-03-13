<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once $this->template('ui/head');
if($column_list[module]==100 or $column_list[module]==101)$parent_class=$_M[word][funMod100];
echo <<<EOT
-->
<script>var metimgurl="{$_M[url][own_tem]}",basepath='{$_M[url][site_admin]}',adminurls="{$adminurl}";</script>

<script src="{$_M[url][own_tem]}/js/jQuery1.8.2.js"></script>
<script src="{$_M[url][own_tem]}/js/iframes.js"></script>
<script src="{$_M[url][own_tem]}/js/metvar.js"></script>
</head>
{$edjs}
<body>
<!--
EOT;
$title="{$_M[word][columnmeditor]}({$column_list[name]})";
echo <<<EOT
-->
<form method="POST"  class="ui-from" name="myform" action="save.php?anyid={$anyid}&action=editor" target="_self">
			<input name="bigclass" type="hidden" value="$class" />
			<input name="id" type="hidden" value="$id" />
			<input name="module" type="hidden" value="$column_list[module]" />
			<input name="foldername" type="hidden" value="$column_list[foldername]" />
			<input name="filename" type="hidden" value="$column_list[filename]" />
			<input name="filenameold" type="hidden" value="$column_list[filename]" />
			<input name="if_in" type="hidden" value="$column_list[if_in]" />
			<input name="classtype" type="hidden" value="$classtype" />
			<input name="releclass" type="hidden" value="$releclass" />
			<input name="access" type="hidden" value="$column_list[access]" />
			<input name="lang" type="hidden" value="$lang" />
<!--
EOT;
if($column_list[classtype]!=1){
echo <<<EOT
-->
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnPreName]}{$_M[word][marks]}</dt>
			<dd>
				{$parent_class}
			</dd>
		</dl>
		</div>
<!--
EOT;
}
echo <<<EOT
-->	
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnname]}{$_M[word][marks]}</dt>
			<dd>
				<input name="name" type="text" class="ui-input" value="$column_list[name]" />
			</dd>
		</dl>
		</div>
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnorder]}{$_M[word][marks]}</dt>
			<dd>
			<input name="no_order" type="text" class="ui-input text-center" style="width:25px" value="$column_list[no_order]" />
			<span class="tips">{$_M[word][noorderinfo]}</span>
			</dd>
		</dl>
		</div>
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnnav]}{$_M[word][marks]}</dt>
			<dd class="ftype_radio">
			<div class="fbox">
				<label><input name="nav" type="radio" value="0"  {$nav[0]} />{$_M[word][columnnav1]}</label>
				<label><input name="nav" type="radio" value="1"  {$nav[1]} />{$_M[word][columnnav2]}</label>
				<label><input name="nav" type="radio" value="2"  {$nav[2]} />{$_M[word][columnnav3]}</label>
				<label><input name="nav" type="radio" value="3"  {$nav[3]} />{$_M[word][columnnav4]}</label>
			</div>
			</dd>
		</dl>
		</div>
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnnewwindow]}{$_M[word][marks]}</dt>
			<dd class="ftype_radio">
			<div class="fbox">
			<label><input name="new_windows" type="radio"  {$new_windows[1]} value="1" />{$_M[word][yes]}</label>
			<label><input name="new_windows" type="radio"  {$new_windows[0]} value="0" />{$_M[word][no]}</label>
			</div>
			<span class="tips">{$_M[word][columnexplain4]}</span>
			</dd>
		</dl>
		</div>
		
<!--
EOT;
if($column_list[if_in]==0||$column_list[module]>1000){
echo <<<EOT
-->
		<div class="v52fmbx" id="list_order" style="display:{$list_orderok}">
		<dl>
			<dt>{$_M[word][columncontentorder]}{$_M[word][marks]}</dt>
			<dd class="ftype_radio">
			<div class="fbox">
				<label><input name="list_order" type="radio"  value="1" $list_order[1] />{$_M[word][updatetime]}</label>
				<label><input name="list_order" type="radio"  value="2" $list_order[2]>{$_M[word][addtime]}</label>
				<label><input name="list_order" type="radio"  value="3" $list_order[3]>{$_M[word][hits]}</label>
				<label><input name="list_order" type="radio"  value="4" $list_order[4]>ID{$_M[word][columnReverseSort]} </label>
				<label><input name="list_order" type="radio"  value="5" $list_order[5]>ID{$_M[word][columnaddOrder]}</label>
			</div>
			</dd>
		</dl>
		</div>
		<div class="v52fmbx" id="static2" style="display:{$filenameok}">
		<dl>
			<dt>{$_M[word][columnshow]}{$_M[word][marks]}</dt>
			<dd class="ftype_radio">
			<div class="fbox">
			<label><input name="isshow" type="radio"  value="1" {$isshowcheck[1]} />{$_M[word][columnmallow]}</label>
			<label><input name="isshow" type="radio"  value="0" {$isshowcheck[0]} />{$_M[word][columnmnotallow]}</label>
			</div>
			<span class="tips">{$_M[word][columntip8]}</span>
			</dd>
		</dl>
		</div>
<!--
EOT;
if($column_list[module]==9){
$met_addlinkopens[$met_addlinkopen]="checked";
echo <<<EOT
-->
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnmlink]}{$_M[word][marks]}</dt>
			<dd class="ftype_radio">
			<div class="fbox">
			<label><input name="met_addlinkopen" type="radio"  value="1" {$met_addlinkopens[1]}>{$_M[word][open]}</label>
			<label><input name="met_addlinkopen" type="radio"  value="0" {$met_addlinkopens[0]}>{$_M[word][close]}</label>
			<span class="tips">{$_M[word][columnexplain5]}</span>
			</dd>
			</div>
		</dl>
		</div>
<!--
EOT;
}	
echo <<<EOT
-->

<!--
EOT;
if($met_wap && $met_wap_ok){
echo <<<EOT
-->
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnmwap]}{$_M[word][marks]}</dt>
			<dd >
			<label><input name="wap_ok" type="checkbox" class="checkbox" value="1" {$wap_ok}>{$_M[word][wapcontentcom]}</label>
			</dd>
		</dl>
		</div>
<!--
EOT;
}else{
echo <<<EOT
-->
			<label><input name="wap_ok" type="hidden" value="$column_list[wap_ok]"></label>
<!--
EOT;
}
if($column_list[module]==8){
echo <<<EOT
-->
		<h3 class="v52fmbx_hr metsliding">{$_M[word][columnmfeedback]}</h3>
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnmfeedback1]}{$_M[word][marks]}</dt>
			<dd>
			<select name="copyculmnid">
				<option value="0">{$_M[word][columnmfeedback2]}</option>
<!--
EOT;
foreach($met_module[8] as $key=>$val){
if($val[id]!=$id){
echo <<<EOT
-->	
				<option value="{$val[id]}">{$val[name]}</option>
<!--
EOT;
}}
echo <<<EOT
-->	
			</select>
			&nbsp;<a href="copyfeed.php?lang={$lang}&id={$id}" onclick="return copyfromlist($(this));" title="{$_M[word][columnmfeedback3]}">{$_M[word][columnmfeedback4]}</a>
			<span class="tips">{$_M[word][columnexplain6]}</span>
			<br/>
			<a href="parameter/parameter.php?anyid=31&lang=cn&module=8&class1={$id}&cs=2" title="{$_M[word][columnmfeedback5]}">{$_M[word][columnmfeedback6]}</a>
			</dd>
		</dl>
		</div>
		
<!--
EOT;
}
echo <<<EOT
-->
<h3 class="v52fmbx_hr metsliding">
			{$_M[word][columnSEO]}
		</h3>
<!--
EOT;
}
if($column_list[if_in]==1){
echo <<<EOT
-->
		<div class="v52fmbx" id="static1" style="display:{$filenameok1}">
		<dl>
			<dt>{$_M[word][columnhref]}{$_M[word][marks]}</dt>
			<dd>
				<input name="out_url" type="text" class="ui-input" value="{$column_list[out_url]}" />
				<span class="tips">{$_M[word][columntip7]}</span>
			</dd>
		</dl>
		</div>
<!--
EOT;
}

if($column_list[if_in]!=1){
echo <<<EOT
-->			
		<div class="v52fmbx on_dlbox">
		<dl>
			<dt style='width:96px;'>{$_M[word][columnctitle]}{$_M[word][marks]}</dt>
			<dd>
			<input name="ctitle" type="text" class="ui-input" maxlength="200" value="$column_list[ctitle]" />
			<span class="tips">{$_M[word][ctitleinfo]}</span>
			</dd>
		</dl>
		</div>
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][keywords]}{$_M[word][marks]}</dt>
			<dd>
			<input name="keywords" type="text" class="ui-input" maxlength="200" value="$column_list[keywords]" />
			<span class="tips">{$_M[word][keywordsinfo]}</span>
			</dd>
		</dl>
		</div>
<!--
EOT;
}
echo <<<EOT
-->			
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][description]}{$_M[word][marks]}</dt>
			<dd class="ftype_textarea">
			<div class="fbox">
			<textarea name="description"  >$column_list[description]</textarea>
			</div>
			</dd>
		</dl>
		</div>
<!--
EOT;
if($column_list[if_in]==0){	
echo <<<EOT
-->			
		<div class="v52fmbx" id="static1" style="display:{$filenameok1}">
		<dl>
			<dt>{$_M[word][columnhtmlname]}{$_M[word][marks]}</dt>
			<dd>
			<input name="filename" type="text" class="text med ui-input" value="$column_list[filename]" $filenameable />
			<span class="tips">{$_M[word][columntip14]}</span>
			</dd>
		</dl>
		</div>
<!--
EOT;
}			
echo <<<EOT
-->	
		<h3 class="v52fmbx_hr metsliding">{$_M[word][columnnamemarkinfo]}</h3>
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnmark]}{$_M[word][marks]}</dt>
			<dd>
				<input name="index_num" type="text" class="ui-input" value="$column_list[index_num]" />
				<span class="tips">{$_M[word][columnexplain7]}</span>
			</dd>
		</dl>
		</div>
<!--
EOT;
if($metadmin[categorynamemark]){	
echo <<<EOT
-->	
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnnamemark]}{$_M[word][marks]}</dt>
			<dd>
				<input name="namemark" type="text" class="ui-input" value="$column_list[namemark]" />
			</dd>
		</dl>
		</div>
<!--
EOT;
}	
if($metadmin[categorymarkimage]){
echo <<<EOT
--> 
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnImg1]}{$_M[word][marks]}</dt>
			<dd >
				<input name="indeximg" type="text" class="ui-input" value="$column_list[indeximg]" />
				<input name="met_upsql" type="file" id="file_upload"  />
<script type="text/javascript">
$(document).ready(function(){
	metuploadify('#file_upload','upimage','indeximg');
});
</script>	
			</dd>
		</dl>
		</div>	
		
<!--
EOT;
}
if($metadmin[categoryimage]){
echo <<<EOT
-->	
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnImg2]}{$_M[word][marks]}</dt>
			<dd>
				<input name="columnimg" type="text" class="ui-input" value="$column_list[columnimg]" />
				<input name="met_upsql" type="file" id="file_upload1" />
<script type="text/javascript">
$(document).ready(function(){
	metuploadify('#file_upload1','upimage','columnimg');
});
</script>				
			</dd>
		</dl>
		</div>
<!--
EOT;
}	
if($column_list[module]>=2&&$column_list[module]<=5){
echo <<<EOT
-->	
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][columnmappend]}</dt>
			<dd class="ftype_ckeditor">
			<div class="fbox">
			<textarea class="ckeditor" name="content">$column_list[content]</textarea>
			</div>
<script type="text/javascript">
met_ckeditor('ckeditor','content',1);
</script>
<span class="tips">{$_M[word][columnexplain8]}</span>
			</dd>
		</dl>
		</div>
<!--
EOT;
}
echo <<<EOT
-->		
		<h3 class="v52fmbx_hr metsliding">{$_M[word][unitytxt_33]}</h3>
<!--
EOT;
	
if($_M[config][met_member_use]&&$column_list[if_in]!=1){
echo <<<EOT
-->
		<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][webaccess]}{$_M[word][marks]}</dt>
			<dd>
			<select name="access" id="access" >$level</select>
			</dd>
		</dl>
		</div>
<!--
EOT;
}	
echo <<<EOT
-->	
		<div class="v52fmbx">
		<dl>
			<dt >{$_M[word][displaytype]}{$_M[word][marks]}</dt>
			<dd class="ftype_radio">
			<div class="fbox">
			<label><input name="displays" type="radio"  {$displays1[0]} value="0" />{$_M[word][yes]}</label>
			<label><input name="displays" type="radio"  {$displays1[1]} value="1" />{$_M[word][no]}</label>
			</div>
			</dd>
		</dl>
		</div>

		<div class="v52fmbx_submit">
			<input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit" onclick="return Smit($(this),'myform');" />
		</div>
</div>
</div>
</div>		
</form>
<!--
EOT;
require_once $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>