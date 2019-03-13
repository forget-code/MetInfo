<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
foreach($inilist as $key=>$val){
	if($val[sliding]){
echo <<<EOT
-->
					<h3 class="v52fmbx_hr">{$val[inputhtm]}</h3>
<!--
EOT;
	}else{
		if(strpos($val[inputhtm], '<select')!==false){
			$val[inputhtm]=str_replace('<select', '<div class="fbox"><select', $val[inputhtm]);
			$val[inputhtm]=str_replace('select>', 'select></div>', $val[inputhtm]);
		}
echo <<<EOT
-->
					<dl>
						<dt>{$val[valueinfo]}</dt>
						<dd class="{$val[ftype]}">{$val[inputhtm]}</dd>
					</dl>
<!--
EOT;
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>