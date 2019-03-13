<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
$valid = '';
foreach($paralist as $val){
$wr_ok = $val['wr_ok']?'required data-bv-message="'.$_M['word']['noempty'].'" data-bv-notempty="true"':'';
$list = explode("$|$",$val['options']);
$value = $para['info_'.$val['id']];
echo <<<EOT
-->
<!--
EOT;
if($val['type']==1){
echo <<<EOT
-->
			<div class="form-group met-form-choice">				
				<div class="row">
					<div class="met-form-file-title col-md-3">{$val['name']}</div>
					<div class="col-md-9">
						<input type="text" name="info_{$val['id']}" class="form-control" value="{$value}" {$wr_ok} placeholder="{$val['name']}">
					</div>
				</div>
			</div>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
if($val['type']==2){
echo <<<EOT
-->
			<div class="form-group met-form-choice">
				<div class="row">
					<div class="met-form-file-title col-md-3">{$val['name']}</div>
					<div class="col-md-9">
						<select name="info_{$val['id']}" class="form-control" {$wr_ok}>
					<option value="">{$_M['word']['Choice']}</option>
<!--
EOT;
foreach($val['list'] as $option){
if($option){
$checked = $value==$option?'selected':'';
echo <<<EOT
-->
					<option value="{$option}" {$checked}>{$option}</option>
<!--
EOT;
}}
echo <<<EOT
-->
						</select>
					</div>
				</div>
			</div>
<!--
EOT;
}
echo <<<EOT
-->	
<!--
EOT;
if($val['type']==3){
echo <<<EOT
-->
			<div class="form-group met-form-choice">				
				<div class="row">
					<div class="met-form-file-title col-md-3">{$val['name']}</div>
					<div class="col-md-9">
						<textarea name="info_{$val['id']}" class="form-control" rows="5" placeholder="{$val['name']}" {$wr_ok}>{$value}</textarea>
					</div>
				</div>
			</div>
<!--
EOT;
}
echo <<<EOT
-->	
<!--
EOT;
if($val['type']==4){
echo <<<EOT
-->
			<div class="form-group met-form-choice">
				<div class="row">
					<div class="met-form-file-title col-md-3">{$val['name']}</div>
					<div class="col-md-9">
<!--
EOT;
foreach($val['list'] as $option){
if($option){
if(strstr($value,"|")){
	$values = explode("|",$value);
	$checked ='';
	foreach($values as $v){
		if($v==$option)$checked = 'checked';
	}
}else{
	$checked = $value==$option?'checked':'';
}
echo <<<EOT
-->
						<div class="checkbox">
							<label><input name="info_{$val['id']}" type="checkbox" {$checked} value="{$option}" {$wr_ok}>{$option}</label>
						</div>
<!--
EOT;
$wr_ok='';
}}
echo <<<EOT
-->
					</div>
				</div>
			</div>
<!--
EOT;
}
echo <<<EOT
-->	
<!--
EOT;
if($val['type']==5){
echo <<<EOT
-->
			<div class="form-group met-form-choice met-upfile">
				<div class="row">
					<div class="met-form-file-title col-md-3">{$val['name']}</div>
					<div class="col-md-9">
						<input data-url="{$_M[url][site]}app/system/entrance.php?c=uploadify&m=include&lang={$lang}&a=doupfile&type=1" type="file" name="info_{$val['id']}" value="{$value}" {$wr_ok}>
					</div>
				</div>
			</div>
<!--
EOT;
}
echo <<<EOT
-->	
<!--
EOT;
if($val['type']==6){
echo <<<EOT
-->
			<div class="form-group met-form-choice">
				<div class="row">
					<div class="met-form-file-title col-md-3">{$val['name']}</div>
					<div class="col-md-9">
<!--
EOT;
foreach($val['list'] as $option){
if($option){
$checked = $value==$option?'checked':'';
echo <<<EOT
-->
						<div class="radio">
							<label><input name="info_{$val['id']}" {$checked} type="radio" value="{$option}" {$wr_ok}>{$option}</label>
						</div>
<!--
EOT;
$wr_ok='';
}}
echo <<<EOT
-->
					</div>
				</div>
			</div>
<!--
EOT;
}
echo <<<EOT
-->	
<!--
EOT;
if($val['type']==7){
$prov = $para['info_'.$val['id'].'_1'];
$city = $para['info_'.$val['id'].'_2'];
$dist = $para['info_'.$val['id'].'_3'];
echo <<<EOT
-->
			<div class="form-group met-form-choice">
				<div class="row select-linkage">
					<div class="met-form-file-title col-md-3">{$val['name']}</div>
					<div class="col-md-3"><select name="info_{$val['id']}_1" data-selected="{$prov}" class="form-control prov" {$wr_ok}></select></div>
					<div class="col-md-3"><select name="info_{$val['id']}_2" data-selected="{$city}" class="form-control city hidden"></select></div>
					<div class="col-md-3"><select name="info_{$val['id']}_3" data-selected="{$dist}" class="form-control dist hidden"></select></div>
				</div>
			</div>
<!--
EOT;
}


if($val['type']==8){
echo <<<EOT
-->
   			<div class="form-group met-form-choice">
				<div class="row">
					<div class="met-form-file-title col-md-3">{$val['name']}</div>
					<div class="col-md-9">
						<p style="font-size: 22px;">{$value}</p>
					</div>
				</div>
			</div>
<!--
EOT;
}

echo <<<EOT
-->	
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>