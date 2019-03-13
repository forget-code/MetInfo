<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<div class="v52fmbx">
<h3 class="v52fmbx_hr">{$_M['word']['tab_settings']}</h3>
<dl>
		<dt>{$_M[word][mod5]}{$_M[word][image]}{$_M[word][wapdimensionalsize]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_imgdetail_x" value="{$_M[config][met_imgdetail_x]}" style="width:40px;">
				×
				<input type="text" name="met_imgdetail_y" value="{$_M[config][met_imgdetail_y]}" style="width:40px;">
				<span class="tips">{$_M[word][setimgWidth]}×{$_M[word][setimgHeight]}({$_M[word][setimgPixel]})</span>
			</div>
		</dd>
	</dl>
	
	
</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->