<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
				<div class="v52fmbx">
<!--
EOT;
$tmpincfile=PATH_WEB."templates/{$_M[config][met_skin_user]}/metinfo.inc.php";
require $tmpincfile;
if($metadmin['mobile_flash_close'] != 1){
echo <<<EOT
-->
	<h3 class="v52fmbx_hr">{$_M['word']['larger_wheel']}</h3>
	<dl>
	<dd class="ftype_description" style="padding:10px;">
		图片建议尺寸：500*500 (像素)
	</dd>
	</dl>
	<dl>
		<dd class="bannerlist index_bannerlist ftype_input">
			<input type="hidden" name="indexbannerlist" value="" />
			<textarea name="bannerlist_li_html" style="display:none;">
				<li>
					<a href="#" class="img">
						<img src="" />
						<div class="banner_rep">
						<input type="hidden" name="img_path" data-upload-type="doupimg" value="" />
						</div>
						<div class="banner_del"><i class="fa fa-times"></i></div>
					</a>
					<div class="banner_more">{$_M['word']['title_link']}<i class="fa fa-sort-desc"></i></div>
					<div class="banner_input">
					<input type="text" name="img_title" value="" placeholder="{$_M['word']['setflashName']}">
					<input type="text" name="img_link" class="in2" value="" placeholder="{$_M['word']['columnhref']}">
					</div>
				</li>
			</textarea>
			<div class="fbox">
			<ul>
<!--
EOT;
foreach($bannerlist as $key=>$val){
echo <<<EOT
-->
			<li data-bannerid="{$val[id]}">
				<a href="#" class="img">
					<img src="{$val[img_path]}" />
					<div class="banner_rep">
					<input type="hidden" name="img_path" data-upload-type="doupimg" value="{$val[img_path]}" />
					</div>
					<div class="banner_del"><i class="fa fa-times"></i></div>
				</a>
				<div class="banner_more">{$_M['word']['title_link']}<i class="fa fa-sort-desc"></i></div>
				<div class="banner_input">
				<input type="text" name="img_title" value="{$val[img_title]}" placeholder="{$_M['word']['setflashName']}">
				<input type="text" name="img_link" class="in2" value="{$val[img_link]}" placeholder="{$_M['word']['columnhref']}">
				</div>
			</li>
<!--
EOT;
}
echo <<<EOT
-->
			</ul>
			<div class="banner_add">{$_M['word']['add_them_picture']}</div>
			</div>
		</dd>
	</dl>
<!--
EOT;
if(!$metinfover){
echo <<<EOT
-->
	<dl>
		<dt>{$_M[word][wapdimensionalsize]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="met_flash_10001_y" value="{$inbaset[1]}" style="width:40px;">
				<span class="tips">{$_M[word][setimgHeight]}({$_M[word][setimgPixel]})</span>
			</div>
		</dd>
	</dl>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
}
require $this->template('tem/zujian');
echo <<<EOT
-->	
				</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->