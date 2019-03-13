<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<div class="v52fmbx">
	<h3 class="v52fmbx_hr">{$_M['word']['page_setup_details']}</h3>
	<dl>
		<dt>{$_M[word][setskindatecontent]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<select name="met_contenttime" data-checked="{$_M[config][met_contenttime]}">
					{$selecthtml}
				</select>
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][mod3]}{$_M[word][image]}{$_M[word][wapdimensionalsize]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_productdetail_x" value="{$_M[config][met_productdetail_x]}" style="width:40px;">
				×
				<input type="text" name="met_productdetail_y" value="{$_M[config][met_productdetail_y]}" style="width:40px;">
				<span class="tips">{$_M[word][setimgWidth]}×{$_M[word][setimgHeight]}({$_M[word][setimgPixel]})</span>
			</div>
		</dd>
	</dl>
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
	<dl>
		<dt>{$_M['word']['page_range']}</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input name="met_pnorder" type="radio" value="0" data-checked="{$_M[config][met_pnorder]}" />{$_M[word][settopcolumns]}{$_M[word][skinunder]}</label>
				<label><input name="met_pnorder" type="radio" value="1" />{$_M[word][setequivalentcolumns]}{$_M[word][skinunder]}</label>
			</div>
		</dd>
	</dl>
<!--
EOT;
require $this->template('tem/zujian');
echo <<<EOT
-->
<!--
EOT;
if($metinfover){
echo <<<EOT
-->
<h3 class="v52fmbx_hr">{$_M['word']['tab_settings']}</h3>
	<dl>
		<dt>{$_M['word']['display_number']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<select name="met_productTabok" data-checked="{$_M[config][met_productTabok]}">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<span class="tips">{$_M['word']['corresponding_products']}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['tab_title1']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_productTabname" value="{$_M[config][met_productTabname]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['tab_title2']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_productTabname_1" value="{$_M[config][met_productTabname_1]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['tab_title3']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_productTabname_2" value="{$_M[config][met_productTabname_2]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['tab_title4']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_productTabname_3" value="{$_M[config][met_productTabname_3]}" />
			</div>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['tab_title5']}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_productTabname_4" value="{$_M[config][met_productTabname_4]}" />
			</div>
		</dd>
	</dl>
<!--
EOT;
}
echo <<<EOT
-->
</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->