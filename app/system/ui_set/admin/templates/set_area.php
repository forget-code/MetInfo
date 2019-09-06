<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
if($_M['form']['set_config']) $set_config='set-'.$_M['form']['set_config'];
$settype=$_M['form']['settype'];
if(!$settype) $settype='doeditor';
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from set-block-form" name="myform" action="{$_M[url][own_form]}a={$settype}" target="_self">
	<input type="hidden" name="met_skin_user" value="{$_M['config']['met_skin_user']}" />
	<input type="hidden" name="mid"/>
	<div class="v52fmbx set-block {$set_config}">
<!--
EOT;
if(isset($inilist)) require $this->template('tem/zujian');
echo <<<EOT
-->
	</div>
	<input type="submit" value="{$_M['word']['Submit']}" class="submit hide">
</form>
<div class="modal fade modal-primary icon-modal" id="icon-modal" aria-hidden="true" aria-labelledby="icon-modal" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="top: 10px;">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">{$_M[word][column_choosicon_v6]}</h4>
			</div>
			<div class="modal-body">
				<iframe src="" data-src='{$_M['url']['adminurl']}n=ui_set&c=index&a=doset_icon&other=1' class='icon-iframe' width='100%' height='100%' frameborder="0"></iframe>
			</div>
			<div class="modal-footer bg-blue-grey-100">
				<button type="button" class="btn btn-warning pull-left back-iconlist" hidden>{$_M[word][column_backiconlist_v6]}</button>
				<span style='margin-right:20px;'>{$_M[word][column_saveicon_v6]}</span>
				<button type="button" class="btn btn-default" data-dismiss="modal">{$_M['word']['indexonlieno']}</button>
				<button type="submit" class="btn btn-primary">{$_M['word']['Submit']}</button>
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