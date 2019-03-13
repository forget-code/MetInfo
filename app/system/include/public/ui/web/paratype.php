<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
defined('IN_MET') or exit('No permission');
global $page_type;
$valid = '';
foreach($paralist as $val){
	$wr_ok = $val['wr_ok']?'required data-bv-message="'.$_M['word']['noempty'].'" data-bv-notempty="true"':'';
	$list = explode("$|$",$val['options']);
	$value = $para['info_'.$val['id']];
	if($val['type']==1){
echo <<<EOT
-->
<div class="form-group met-form-choice">
	<div class="row">
		<div class="met-form-file-title col-md-3">{$val['name']}</div>
		<div class="col-md-9">
			<input type="text" name="info_{$val['id']}" class="form-control" value="{$value}" placeholder="{$val['name']}" {$wr_ok}>
		</div>
	</div>
</div>
<!--
EOT;
	}
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
				$checked = $value==$option['id']?'selected':'';
echo <<<EOT
-->
				<option value="{$option['id']}" {$checked}>{$option['value']}</option>
<!--
EOT;
			}
		}
echo <<<EOT
-->
			</select>
		</div>
	</div>
</div>
<!--
EOT;
	}
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
						if($v==$option['value'])$checked = 'checked';
					}
				}else{
					$checked = $value==$option['value']?'checked':'';
				}
				// html修改（新模板框架v2） 开始
echo <<<EOT
-->
			<div class="checkbox-custom checkbox-primary">
              	<input type="checkbox" name="info_{$val['id']}" id="{$option['id']}" {$checked} value="{$option['id']}" {$wr_ok}>
              	<label for="{$option['id']}">{$option['value']}</label>
        	</div>
<!--
EOT;
				// html修改（新模板框架v2）  结束
				$wr_ok='';
			}
		}
echo <<<EOT
-->
		</div>
	</div>
</div>
<!--
EOT;
	}
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
	if($val['type']==6){
echo <<<EOT
-->
<div class="form-group met-form-choice">
	<div class="row">
		<div class="met-form-file-title col-md-3">{$val['name']}</div>
		<div class="col-md-9">
<!--
EOT;
		foreach($val['list'] as $key => $option){

			if($option){
				$checked = $value==$option['value']?'checked':($key ? '' : 'checked');

				// html修改（新模板框架v2） 开始
echo <<<EOT
-->
			<div class="radio-custom radio-primary">
              	<input type="radio" id="{$option['value']}" name="info_{$val['id']}" value="{$option['value']}" {$wr_ok} {$checked}>
              	<label for="{$option['value']}">{$option['value']}</label>
            </div>
<!--
EOT;
				// html修改（新模板框架v2） 结束
				$wr_ok='';
			}
		}
echo <<<EOT
-->
		</div>
	</div>
</div>
<!--
EOT;
	}
	if($val['type']==7){
		$prov = $para['info_'.$val['id'].'_1'];
		$city = $para['info_'.$val['id'].'_2'];
		$dist = $para['info_'.$val['id'].'_3'];
		$select_w=$page_type=='register'?12:4;
echo <<<EOT
-->
<div class="form-group met-form-choice">
	<div class="row select-linkage" data-plugin='select-linkage'>
		<div class="met-form-file-title col-md-3">{$val['name']}</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-{$select_w}"><select name="info_{$val['id']}_1" data-checked="{$prov}" class="form-control prov" {$wr_ok}></select></div>
				<div class="col-md-{$select_w}"><select name="info_{$val['id']}_2" data-checked="{$city}" class="form-control city hidden"></select></div>
				<div class="col-md-{$select_w}"><select name="info_{$val['id']}_3" data-checked="{$dist}" class="form-control dist hidden"></select></div>
			</div>
		</div>
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
			<input type="text" name="info_{$val['id']}" class="form-control" value="{$value}" placeholder="{$val['name']}" {$wr_ok} data-fv-phone="true" data-fv-phone-message="{$_M['word']['telok']}">
		</div>
	</div>
</div>
<!--
EOT;
	}
	if($val['type']==9){
echo <<<EOT
-->
<div class="form-group met-form-choice">
	<div class="row">
		<div class="met-form-file-title col-md-3">{$val['name']}</div>
		<div class="col-md-9">
			<input type="text" name="info_{$val['id']}" class="form-control" value="{$value}" placeholder="{$val['name']}" {$wr_ok} data-fv-emailAddress="true" data-fv-emailAddress-message='{$_M['word']['emailcheck']}'>
		</div>
	</div>
</div>
<!--
EOT;
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->