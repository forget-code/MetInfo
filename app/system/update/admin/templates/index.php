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
			<a href="http://www.metinfo.cn/" target="_blank">{$copyright_info}</a>
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
</div>
<div class="remodal met_uplaod_remodal" data-remodal-id="modal"><div class="temset_box"></div></div>
<div class="modal fade install-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{$_M['word']['metinfoappinstallinfo4']}</h4>
            </div>
            <div class="modal-body">
            	{$_M['word']['metinfoappinstallinfo4']}
        	</div>
        	<div class="modal-footer" style='text-align: center;'>
                <button type="button" class="btn btn-default" data-dismiss="modal" style='margin-right: 10px;'>{$_M['word']['indexonlieno']}</button>
                <a href='{$_M['url']['adminurl']}anyid=13&n=databack&c=index&a=doindex' target='_blank' class="btn btn-primary" style='margin-right: 10px;'>{$_M['word']['databackup4']}</a>
                <button type="button" class="btn btn-success btn_metcms_install">{$_M['word']['appinstall']}</button>
            </div>
    	</div>
	</div>
</div>

<div class="modal fade update-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{$_M['word']['metinfoappinstallinfo4']}</h4>
            </div>
            <div class="modal-body">
            	{$_M['word']['metinfoappinstallinfo4']}
        	</div>
        	<div class="modal-footer" style='text-align: center;'>
                <button type="button" class="btn btn-default" data-dismiss="modal" style='margin-right: 10px;'>{$_M['word']['indexonlieno']}</button>
                <button type="button" class="btn btn-success btn_metcms_update">{$_M['word']['confirm']}</button>
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