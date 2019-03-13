<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<div class="v52fmbx">
<!--
EOT;
require PATH_WEB."templates/{$_M[config][met_skin_user]}/metinfo.inc.php";
if($metadmin['system_flash_close'] != 1){
echo <<<EOT
-->
	<h3 class="v52fmbx_hr">{$_M['word']['larger_wheel']}</h3>
	<dl>
		<dd style='padding-left:10px;'>
			<a href="{$_M[url][adminurl]}anyid=18&n=banner&c=banner_admin&a=domanage" target="_blank" class="ui-addlist" style="width:100%;margin:0;text-align:center;">{$_M[word][indexflash]}</a>
		</dd>
	</dl>
<!--
EOT;
	}
	require $this->template('tem/zujian');
echo <<<EOT
-->
<!--
EOT;
	if(!$metinfover){
		if($metadmin[homecontent]){
echo <<<EOT
-->
	<h3 class="v52fmbx_hr">{$_M['word']['indexsetIntroduce']}</h3>
	<dl>
		<dd class="ftype_ckeditor_theme">
			<div class="fbox">
				<textarea name="met_index_content" data-ckeditor-type="2" data-ckeditor-y="380">{$_M['config']['met_index_content']}</textarea>
			</div>
		</dd>
	</dl>
<!--
EOT;
	}
echo <<<EOT
-->
	<h3 class="v52fmbx_hr">{$_M[word][unitytxt_40]}</h3>
	<dl>
		<dt>{$_M[word][mod2]}{$_M[word][indexsetnum]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="index_news_no" value="{$_M[config][index_news_no]}">
			</div>
			<span class="tips">{$_M[word][item]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][mod3]}{$_M[word][indexsetnum]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="index_product_no" value="{$_M[config][index_product_no]}">
			</div>
			<span class="tips">{$_M[word][item]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][mod5]}{$_M[word][indexsetnum]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="index_img_no" value="{$_M[config][index_img_no]}">
			</div>
			<span class="tips">{$_M[word][item]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][mod4]}{$_M[word][indexsetnum]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="index_download_no" value="{$_M[config][index_download_no]}">
			</div>
			<span class="tips">{$_M[word][item]}</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M[word][mod6]}{$_M[word][indexsetnum]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="index_job_no" value="{$_M[config][index_job_no]}">
			</div>
			<span class="tips">{$_M[word][item]}</span>
		</dd>
	</dl>
	<h3 class="v52fmbx_hr">{$_M[word][unitytxt_41]}</h3>
	<dl>
		<dt>{$_M[word][indexsetFriendly]}</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input name="index_link_ok" type="radio" value="1" data-checked="{$_M[config][index_link_ok]}">{$_M[word][open]}</label>
				<label><input name="index_link_ok" type="radio" value="0">{$_M[word][close]}</label>
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