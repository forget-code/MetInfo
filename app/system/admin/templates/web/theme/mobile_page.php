<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
				<div class="v52fmbx">
<!--
EOT;
if(!$metinfover){
echo <<<EOT
-->
	<h3 class="v52fmbx_hr">{$_M['word']['inside_larger']}</h3>
	<dl>
		<dt>{$_M['word']['call_way']}</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input name="met_bannerpagetype" type="radio" value="1" data-checked="{$_M[config][met_bannerpagetype]}">{$_M['word']['consistent_home_page']}</label>
				<label><input name="met_bannerpagetype" type="radio" value="0">{$_M['word']['managertyp5']}</label>
			</div>
		</dd>
	</dl>
	<dl>
		<dd class="banner_set_more">
			<a href="{$_M[url][site_admin]}app/wap/setflash.php?anyid=70&lang={$_M[lang]}&cs=2" target="_blank">{$_M['word']['click_here_settings']}<br/>{$_M['word']['defined_separately']}</a>
		</dd>
	</dl>
<!--
EOT;
}
echo <<<EOT
-->
<h3 class="v52fmbx_hr">{$_M['word']['unitytxt_42']}</h3>
<dl>
	<dt>{$_M[word][mod2]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<input type="text" name="wap_news_list" value="{$_M[config][wap_news_list]}" style="width:40px;" />
		</div>
	</dd>
</dl>
<dl>
	<dt>{$_M[word][mod3]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<input type="text" name="wap_product_list" value="{$_M[config][wap_product_list]}" style="width:40px;" />
		</div>
	</dd>
</dl>
<dl>
	<dt>{$_M[word][mod4]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<input type="text" name="wap_download_list" value="{$_M[config][wap_download_list]}" style="width:40px;" />
		</div>
	</dd>
</dl>
<dl>
	<dt>{$_M[word][mod5]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<input type="text" name="wap_img_list" value="{$_M[config][wap_img_list]}" style="width:40px;" />
		</div>
	</dd>
</dl>
<dl>
	<dt>{$_M[word][mod6]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<input type="text" name="wap_job_list" value="{$_M[config][wap_job_list]}" style="width:40px;" />
		</div>
	</dd>
</dl>
<dl>
	<dt>{$_M[word][mod7]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<input type="text" name="wap_message_list" value="{$_M[config][wap_message_list]}" style="width:40px;" />
		</div>
	</dd>
</dl>
<dl>
	<dt>{$_M[word][mod11]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<input type="text" name="wap_search_list" value="{$_M[config][wap_search_list]}" style="width:40px;" />
		</div>
	</dd>
</dl>
<!--
EOT;
require $this->template('tem/zujian');
echo <<<EOT
-->	
				</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->