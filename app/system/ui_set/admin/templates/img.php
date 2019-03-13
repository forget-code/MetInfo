<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<div class="v52fmbx">
<h3 class="v52fmbx_hr">{$_M['word']['tab_settings']}</h3>
	

	<dl>
		<dt>{$_M['word']['unitytxt_76']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_imgs_x" value="{$_M[config][met_imgs_x]}" style="width:40px;">
				×
				<input type="text" name="met_imgs_y" value="{$_M[config][met_imgs_y]}" style="width:40px;">
				<span class="tips">
				{$_M[word][setimgWidth]}×{$_M[word][setimgHeight]}({$_M[word][setimgPixel]})
				</span>
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][unitytxt_42]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_img_list" value="{$_M[config][met_img_list]}" style="width:40px;">
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][mod5]}{$_M[word][setskinListPage]}</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input name="met_img_page" type="radio" value="0" data-checked="{$_M[config][met_img_page]}">{$_M[word][setskinproduct1]}</label>
				<label><input name="met_img_page" type="radio" value="1">{$_M[word][setskinproduct2]}</label>
			</div>
			<span class="tips">{$_M['word']['sys_navigation2']}</span>
		</dd>
	</dl>
	
</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->