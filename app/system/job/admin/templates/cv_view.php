<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<div class="v52fmbx" style="position:relative;">
<!--
EOT;
if($jobzhaop){
if($jobzhaop!='../../'){
echo <<<EOT
-->
	<div class="job_cv_img"><img src="{$jobzhaop}" width="200" /></div>
<!--
EOT;
}}
echo <<<EOT
-->
<!--
EOT;
foreach($cv_para as $key=>$val){
echo <<<EOT
-->
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$val[name]}{$_M[word][marks]}</dt>
			<dd>
				{$val[content]}
			</dd>
		</dl>
		</div>
<!--
EOT;
}
echo <<<EOT
--> 
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][cvAddtime]}{$_M[word][marks]}</dt>
			<dd>
				{$cv_list[addtime]}
			</dd>
		</dl>
		</div>
</div>
</div>
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>