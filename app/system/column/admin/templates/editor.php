<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->

<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from article_add" name="myform" action="{$_M[url][own_form]}a=doeditorsave" target="_self">
	<input type="hidden" name='id' value="{$_M['form']['id']}" />
		<div class="v52fmbx">
		<h3 class="v52fmbx_hr">{$_M[word][upfiletips7]}</h3>
		<dl>
			<dt>{$_M['word']['columnname']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="name" value="{$column_list['name']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['columnorder']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="no_order" value="{$column_list['no_order']}">
				</div>
				<span class="tips">{$_M['word']['noorderinfo']}</span>
			</dd>
		</dl>
		<dl>
		<dt>{$_M['word']['columnnav']}</dt>
			<dd class="ftype_radio">
				<div class="fbox">
					<label><input name="nav" type="radio" value="0" data-checked="{$column_list['nav']}">{$_M['word']['columnnav1']}</label>
					<label><input name="nav" type="radio" value="1">{$_M['word']['columnnav2']}</label>
					<label><input name="nav" type="radio" value="2">{$_M['word']['columnnav3']}</label>
					<label><input name="nav" type="radio" value="3">{$_M['word']['columnnav4']}</label>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['columnnewwindow']}</dt>
			<dd class="ftype_radio">
				<div class="fbox">
					<label><input name="new_windows" type="radio" value="1" data-checked="{$column_list['new_windows']}">{$_M['word']['yes']}</label>
					<label><input name="new_windows" type="radio" value="0">{$_M['word']['no']}</label>
				</div>
				<span class="tips">{$_M['word']['columnexplain4']}</span>
			</dd>
		</dl>
<!--
EOT;
if($column_list['module']>=2 && $column_list['module']<=6){
echo <<<EOT
-->
		<dl>
			<dt>{$_M['word']['columncontentorder']}</dt>
			<dd class="ftype_radio">
				<div class="fbox">
					<label><input name="list_order" type="radio" value="1" data-checked="{$column_list['list_order']}">{$_M['word']['updatetime']}</label>
					<label><input name="list_order" type="radio" value="2">{$_M['word']['addtime']}</label>
					<label><input name="list_order" type="radio" value="3">{$_M['word']['hits']}</label>
					<label><input name="list_order" type="radio" value="4">ID{$_M['word']['columnReverseSort']}</label>
					<label><input name="list_order" type="radio" value="5">ID{$_M['word']['columnaddOrder']}</label>
				</div>
			</dd>
		</dl>
<!--
EOT;
}
if($column_list['module']==1){
echo <<<EOT
-->
		<dl>
			<dt>{$_M['word']['columnshow']}</dt>
			<dd class="ftype_radio">
				<div class="fbox">
					<label><input name="isshow" type="radio" value="1" data-checked="{$column_list['isshow']}">{$_M['word']['columnmallow']}</label>
					<label><input name="isshow" type="radio" value="0">{$_M['word']['columnmnotallow']}</label>
				</div>
				<span class="tips">{$_M['word']['columntip8']}</span>
			</dd>
		</dl>
<!--
EOT;
}
//if($column_list['module']==9){
if(0){//功能已废除
echo <<<EOT
-->
		<dl>
			<dt>{$_M['word']['columnmlink']}</dt>
			<dd class="ftype_radio">
				<div class="fbox">
					<label><input name="met_addlinkopen" type="radio" value="1" data-checked="{$_M['config']['met_addlinkopen']}">{$_M['word']['open']}</label>
					<label><input name="met_addlinkopen" type="radio" value="0">{$_M['word']['close']}</label>
				</div>
				<span class="tips">{$_M['word']['columnexplain5']}</span>
			</dd>
		</dl>
<!--
EOT;
}
if($_M['config']['met_wap'] && $_M['config']['met_wap_ok']){
echo <<<EOT
-->
		<dl>
			<dt>{$_M['word']['columnmwap']}</dt>
			<dd class="ftype_checkbox">
				<div class="fbox">
					<label><input name="wap_ok" type="checkbox" class="checkbox" value="1" data-checked="{$column_list['wap_ok']}">{$_M['word']['wapcontentcom']}</label>
				</div>
			</dd>
		</dl>
<!--
EOT;
}else{
echo <<<EOT
-->
		<input name="wap_ok" type="hidden" value="{$column_list['wap_ok']}">
<!--
EOT;
}
if($column_list[if_in]==1){
echo <<<EOT
-->
		<dl>
			<dt>{$_M['word']['columnhref']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="out_url" value="{$column_list['out_url']}">
				</div>
				<span class="tips">{$_M['word']['columntip7']}</span>
			</dd>
		</dl>
<!--
EOT;
}
echo <<<EOT
-->
		<h3 class="v52fmbx_hr">{$_M['word']['columnSEO']}</h3>
		<dl>
			<dt>{$_M['word']['columnctitle']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="ctitle" value="{$column_list['ctitle']}">
				</div>
				<span class="tips">{$_M['word']['ctitleinfo']}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['keywords']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="keywords" value="{$column_list['keywords']}">
				</div>
				<span class="tips">{$_M['word']['keywordsinfo']}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['description']}</dt>
			<dd class="ftype_textarea">
				<div class="fbox">
					<textarea name="description" placeholder="">{$column_list['description']}</textarea>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['columnhtmlname']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="filename" value="{$column_list['filename']}">
				</div>
				<span class="tips">{$_M['word']['columntip14']}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['columnnofollow']}</dt>
			<dd class="ftype_checkbox">
				<div class="fbox">
					<input type="checkbox" name="nofollow" value="1" data-checked="{$column_list['nofollow']}">
					<span class="tips">{$_M['word']['columnnofollowinfo']}</span>
				</div>

			</dd>
		</dl>
		<h3 class="v52fmbx_hr metsliding">{$_M['word']['columnnamemarkinfo']}</h3>
		<dl>
			<dt>{$_M['word']['columnmark']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="index_num" value="{$column_list['index_num']}">
				</div>
				<span class="tips">{$_M['word']['columnexplain7']}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['columnnamemark']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="namemark" value="{$column_list['namemark']}">
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['columnImg1']}</dt>
			<dd class="ftype_upload">
				<div class="fbox">
					<input
						name="indeximg"
						type="text"
						data-upload-type="doupimg"
						value="{$column_list['indeximg']}"
					/>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M['word']['columnImg2']}</dt>
			<dd class="ftype_upload">
				<div class="fbox">
					<input
						name="columnimg"
						type="text"
						data-upload-type="doupimg"
						value="{$column_list['columnimg']}"
					/>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][column_littleicon_v6]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="input" name="icon" value="{$column_list['icon']}">
					<button type="button" class="btn btn-default icon-add" data-toggle="modal" data-target=".icon-modal">{$_M[word][column_choosicon_v6]}</button>
				</div>
			</dd>
		</dl>
<!--
EOT;
if($column_list['module']>=2&&$column_list['module']<=5){
echo <<<EOT
-->
		<dl>
			<dt>{$_M['word']['columnmappend']}</dt>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="content" data-ckeditor-type="1">{$column_list['content']}</textarea>
				</div>
			</dd>
		</dl>
<!--
EOT;
}
echo <<<EOT
-->
	<h3 class="v52fmbx_hr metsliding">{$_M['word']['unitytxt_33']}</h3>
	<dl>
		<dt>{$_M['word']['webaccess']}</dt>
		<dd class="ftype_select">
			<div class="fbox">
				{$access}
			</div>
		</dd>
	</dl>
	<dl>
	<dt>{$_M['word']['displaytype']}</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input name="display" type="radio" value="0" data-checked="{$column_list['display']}">{$_M['word']['yes']}</label>
				<label><input name="display" type="radio" value="1">{$_M['word']['no']}</label>
			</div>

		</dd>
	</dl>
  </div>
	<div class="met_affix_save bg-success">
		<button type="submit" class="btn btn-success">{$_M['word']['Submit']}</button>
	</div>
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
				<iframe src="" data-src='{$_M['url']['own_form']}a=doset_icon' class='icon-iframe' width='100%' height='100%' frameborder="0"></iframe>
			</div>
			<div class="modal-footer bg-blue-grey-100">
				<button type="button" class="btn btn-warning pull-left back-iconlist" hidden>{$_M[word][column_backiconlist_v6]}</button>
				<span style='margin-right:20px;'>{$_M[word][column_saveicon_v6]}</span>
				<button type="button" class="btn btn-default" data-dismiss="modal">{$_M['word']['indexonlieno']}</button>
				<button type="submit" class="btn btn-primary" data-url='{$_M['url']['own_form']}a=dosave_img'>{$_M['word']['Submit']}</button>
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