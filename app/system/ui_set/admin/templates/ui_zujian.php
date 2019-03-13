<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<input type="hidden" name='ui_title' value='{$config['desc']['ui_title']}'>
<input type="hidden" name='ui_description' value='{$config['desc']['ui_description']}'>
<!--
EOT;
$config_list_length=count($config_list)-1;
foreach($config_list as $key=>$val){
	if($val['sliding']){
echo <<<EOT
-->
<h3 class="v52fmbx_hr">{$val['inputhtm']}</h3>
<!--
EOT;
	}else{
		if(strpos($val['inputhtm'], '<select')!==false){
			$val['inputhtm']=str_replace('<select', '<div class="fbox"><select', $val['inputhtm']);
			$val['inputhtm']=str_replace('select>', 'select></div>', $val['inputhtm']);
		}
		if($val['uip_hidden'] && !$uip_hidden_open){
			$uip_hidden_open=true;
echo <<<EOT
-->
<dl>
	<dt><button type='button' class='btn btn-danger showmoreset-btn pull-left' data-hidden_text="{$_M['word']['met_template_setmarktexth']}" data-show_text="{$_M['word']['met_template_setmarktext']}">{$_M['word']['met_template_setmarktext']}</button></dt>
</dl>
<div class='showmoreset-content'>
<!--
EOT;
		}
echo <<<EOT
-->
<dl>
	<dt>{$val['uip_title']}</dt>
	<dd class="{$val['ftype']}">{$val['inputhtm']}</dd>
</dl>
<!--
EOT;
		if($uip_hidden_open && $key==$config_list_length){
echo <<<EOT
-->
</div>
<!--
EOT;
		}
	}
}
if($time_html){
echo <<<EOT
-->
<dl>
		<dt>{$_M['word']['setskindatelist']}</dt>
		<dd class="ftype_select">
			<div class="fbox">
				<select name="met_listtime" data-checked="{$_M['config']['met_listtime']}">
					{$time_html}
				</select>
			</div>
		</dd>
	</dl>
<!--
EOT;
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->