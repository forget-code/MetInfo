<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');

if($_M[config][met_agents_type] < 2) {
	$copyright_info = $_M[word][copyright];
	$metinfo_info = $_M[word][metinfo];
	$metinfo_ver = $_M[config][metcms_v];
} else {
	$copyright_info = $_M['word'][copyright];
	$metinfo_info = $_M['word'][metinfo];
	$metinfo_ver = $_M[config][metcms_v];
}
echo <<<EOT
-->
<script>
var ownlangtxt = {
	"be_updated":"{$_M[word][be_updated]}",
	"checkupdate":"{$_M[word][checkupdate]}",
	"latest_version":"{$_M[word][latest_version]}"
};
</script>
<div class="v52fmbx" data-metcms_v="{$_M[config][metcms_v]}" data-patch="{$_M[config][met_patch]}">
	<h3 class="v52fmbx_hr">{$_M['word']['program_information']}</h3>
	<dl>
		<dt>{$_M['word']['upfiletips43']}</dt>
		<dd>
			<span class="newpatch" data-auto="{$data_auto}">{$_M['word']['get_in']}...<span class='metcms_upload_download'></span></span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['upfiletips39']}</dt>
		<dd>
			{$metinfo_info}&nbsp;&nbsp;&nbsp;&nbsp;
			
<span class="bdsharebuttonbox" 
			data-bdUrl="http://www.metinfo.cn/web/metcms.htm" 
			data-bdText="{$_M[word][metinfo_explain]}" 
			data-bdPic="{$_M[url][site]}templates/{$_M[config][met_skin_user]}/view.jpg" 
			data-bdCustomStyle="{$_M[url][own_tem]}css/metinfo.css" 
			data-tag="share_1">
			<a href="#" class="bds_more" data-cmd="more" {$met_agents_display}><i class="fa fa-share-alt"></i>&nbsp;{$_M[word][share_friends]}</a>
</span>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['current_version']}</dt>
		<dd>
			{$metinfo_ver}
		</dd>
	</dl>
	<dl {$met_agents_display}>
		<dt>{$_M['word']['update_log']}</dt>
		<dd>
			<a href="http://www.metinfo.cn/course/record/" target="_blank">{$_M['word']['View']}</a>
		</dd>
	</dl>
	<dl>
		<dt>{$_M['word']['reserved']}</dt>
		<dd>
			{$copyright_info}
		</dd>
	</dl>
	<dl {$met_agents_display}>
		<dt>{$_M['word']['upfiletips31']}</dt>
		<dd>
			<a href="http://www.metinfo.cn/course/" target="_blank">{$_M['word']['indexebook']}</a>
			<i style="font-style:normal; padding:0px 8px; color:#eee;">|</i>
			<a href="http://edu.metinfo.cn/" target="_blank">{$_M['word']['extension_school']}</a>
			<i style="font-style:normal; padding:0px 8px; color:#eee;">|</i>
			<a href="http://bbs.metinfo.cn/" target="_blank">{$_M['word']['upfiletips32']}</a>
			<i style="font-style:normal; padding:0px 8px; color:#eee;">|</i>
			<a href="http://www.metinfo.cn/idc/index.htm" target="_blank">{$_M['word']['upfiletips33']}</a>
			<i style="font-style:normal; padding:0px 8px; color:#eee;">|</i>
			<a href="http://www.metinfo.cn/web/product.htm" target="_blank">{$_M['word']['indexcode']}</a>
		</dd>
	</dl>
	<h3 class="v52fmbx_hr">{$_M[word][upfiletips38]}</h3>
	<dl>
		<dt>{$_M['word']['Operating']}</dt>
		<dd>
			{$agens}
		</dd>
	</dl>
	<dl>
		<dt>WEB{$_M['word']['the_server']}</dt>
		<dd>{$web}</dd>
	</dl>
	<dl>
		<dt>PHP{$_M['word']['the_version']}</dt>
		<dd>{$php}</dd>
	</dl>
	<dl>
		<dt>MySQL{$_M['word']['the_version']}</dt>
		<dd>{$mysql}</dd>
	</dl>
	<!--
	<h3 class="v52fmbx_hr" {$met_agents_display}>{$_M['word']['special_thanks']}</h3>
	<dl {$met_agents_display}>
		<dd>
			小璇子
			<i style="font-style:normal; padding:0px 8px; color:#eee;">|</i>
			月明影
		</dd>
	</dl>
	-->
</div>
<div class="remodal met_uplaod_remodal" data-remodal-id="modal"><div class="temset_box"></div></div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>