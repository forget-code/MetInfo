<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
foreach($column['class1'] as $val){
if(count($column['class2'][$val[id]])){
echo <<<EOT
-->
    <li role="presentation" class="dropdown-submenu">
		<a role="menuitem" data-toggle="dropdown" class="dropdown-toggle" tabindex="-1" href="javascript:;">{$val[name]}</a>
		<ul class="dropdown-menu">
<!--
EOT;
foreach($column['class2'][$val[id]] as $val2){
echo <<<EOT
-->
<!--
EOT;
if(count($column['class3'][$val2[id]])){
echo <<<EOT
-->
		<li role="presentation" class="dropdown-submenu">
			<a role="menuitem" data-toggle="dropdown" class="dropdown-toggle" tabindex="-1" href="javascript:;">{$val2[name]}</a>
			<ul class="dropdown-menu">
<!--
EOT;
foreach($column['class3'][$val2[id]] as $val3){
echo <<<EOT
-->
				<li><a href="javascript:;" data-value="{$val[id]}-{$val2[id]}-{$val3[id]}">{$val3[name]}</a></li>	
<!--
EOT;
}
echo <<<EOT
-->
			</ul>
		</li>
<!--
EOT;
}else{
echo <<<EOT
-->
			<li><a href="javascript:;" data-value="{$val[id]}-{$val2[id]}-0">{$val2[name]}</a></li>	
<!--
EOT;
}}
echo <<<EOT
-->
		</ul>
	</li>
<!--
EOT;
}else{
echo <<<EOT
-->
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="{$val[id]}-0-0">{$val[name]}</a></li>
<!--
EOT;
}
}
echo <<<EOT
-->
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>