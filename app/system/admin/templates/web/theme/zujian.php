<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
foreach($inilist as $key=>$val){
echo <<<EOT
-->
<!--
EOT;
if($val[sliding]){
echo <<<EOT
-->
					<h3 class="v52fmbx_hr">{$val[inputhtm]}</h3>
<!--
EOT;
}else{
if($val[ftype]=="ftype_ckeditor_theme"){
echo <<<EOT
-->
					<h4 class="v52fmbx_hr4">{$val[valueinfo]}</h4>
					<dl style="border-bottom:0;">
						<dd class="{$val[ftype]}">
							{$val[inputhtm]}
						</dd>
					</dl>
<!--
EOT;
}else{
echo <<<EOT
-->
					<dl>
						<dt>{$val[valueinfo]}</dt>
						<dd class="{$val[ftype]}">{$val[inputhtm]}</dd>
					</dl>
<!--
EOT;
}}
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