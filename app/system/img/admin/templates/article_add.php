<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->

<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from article_add" name="myform" action="{$_M[url][own_form]}a={$a}" target="_self">
	<input type="hidden" name='id' value="{$_M['form']['id']}" />
	<input type="hidden" name="addtime_l" value="{$list['addtime']}">
	<input type="hidden" name="imgurl_l" value="{$list['imgurl']}">
	<input type="hidden" name="imgurls_l" value="{$list['imgurls']}">
	<input type="hidden" name="no_order" value="{$list['no_order']}">
	<input type="hidden" name="select_class1" value="{$_M['form']['select_class1']}">
	<input type="hidden" name="select_class2" value="{$_M['form']['select_class2']}">
	<input type="hidden" name="select_class3" value="{$_M['form']['select_class3']}">
	<input type="hidden" name="turnurl" value="{$turnurl}">
    <div class="v52fmbx">
		<dl>
			<dt><em class="required">*</em>{$_M[word][category]}</dt>
			<dd class="ftype_select-linkage">
					<div class="fbox pull-left" data-selectdburl="{$_M[url][own_form]}a=docolumnjson&type=1">
						<select name="class1" class="prov" data-required="1" data-checked="{$list[class1]}"></select>
						<select name="class2" class="city" data-checked="{$list[class2]}"></select>
						<select name="class3" class="dist" data-checked="{$list[class3]}"></select>
					</div>
				<span class="tips pull-left" style="margin-left:20px;"><a href="{$_M[url][site_admin]}index.php?lang={$_M[lang]}#metnav_25" target="_blank">{$_M[word][admin_colunmmanage_v6]}</a></span>
			</dd>
		</dl>
		<dl>
			<dt><em class="required">*</em>{$_M[word][articletitle]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="title" value="{$list[title]}" data-required="1" />
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][contentinfo]}</h3>
		<dl>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="content" data-ckeditor-y="500">{$list[content]}</textarea>
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">SEO{$_M[word][unitytxt_39]}</h3>
		<dl>
			<dt>{$_M[word][managertyp5]}{$_M[word][columnmtitle]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="ctitle" value="{$list[ctitle]}" />
				</div>
				<span class="tips">{$_M[word][tips6_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][keywords]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="keywords" value="{$list[keywords]}" />
				</div>
				<span class="tips">{$_M[word][setseoTip1]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][desctext]}</dt>
			<dd class="ftype_textarea">
				<div class="fbox">
					<textarea name="description">{$list[description]}</textarea>
				</div>
				<span class="tips">{$_M[word][tips1_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt><abbr title="{$_M[word][tips2_v6]}">{$_M[word][tag]}</abbr></dt>
			<dd class="ftype_tags">
				<div class="fbox">
					<input name="tag" type="hidden" data-label="|" value="{$list[tag]}">
				</div>
				<span class="tips">{$_M[word][tips3_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][columnhtmlname]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="filename" data-ajaxcheck-url="{$_M[url][own_form]}a=docheck_filename&id={$_M['form']['id']}" style="width:200px;" value="{$list[filename]}" />
				</div>
				<span class="tips">{$_M[word][js74]}</span>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][unitytxt_15]}</h3>
		<dl>
			<dt>{$_M[word][modpublish]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="issue" style="width:100px;" value="{$list[issue]}" />
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][js79]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="hits" style="width:100px;" value="{$list[hits]}" />
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][linkto]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="links" value="{$list[links]}" />
				</div>
				<span class="tips">{$_M[word][tips4_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][webaccess]}</dt>
			<dd class="ftype_select">
				<div class="fbox">
					{$access_option}
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][smstips64]}</dt>
			<dd class="ftype_checkbox ftype_transverse">
				<div class="fbox">
					<label><input name="displaytype" type="checkbox" value="1" data-checked="{$list[displaytype]}">{$_M[word][displaytype]}</label>
					<label><input name="com_ok" type="checkbox" value="1" data-checked="{$list[com_ok]}">{$_M[word][recom]}</label>
					<label><input name="top_ok" type="checkbox" value="1" data-checked="{$list[top_ok]}">{$_M[word][top]}</label>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][updatetime]}</dt>
			<dd class="ftype_day">
				<div class="fbox">
					<input type="input" name="updatetime" data-day-type = "2" value="{$list[updatetime]}">
				</div>
			</dd>
		</dl>
<!--
EOT;
if($_M['config']['met_webhtm']){
	$list['addtype'] = 1;
	$disabled = 'disabled';
    $tips = '<span class="tips">{$_M[word][tips5_v6]}</span>';
}
echo <<<EOT
-->
		<dl>
			<dt>{$_M[word][addtime]}</dt>
			<dd class="ftype_day">
					<div class="form-inline" style="margin-bottom:10px;">
					<div class="radio">
						<label>
							<input type="radio" name="addtype" value="1" data-checked="{$list[addtype]}">
							{$_M[word][releasenow]}
						</label>
					</div>
				</div>
				<div class="form-inline" style="margin-bottom:10px;">
					<div class="radio">
						<label>
							<input type="radio" name="addtype" value="2" {$disabled} >
							{$_M[word][timedrelease]}
						</label>
					</div>
					<div class="form-group" style="margin-left:10px;">
						<div class="fbox">
							<input type="input" name="addtime" data-day-type = "2" {$disabled} value="{$list[addtime]}">
						</div>
					</div>
				</div>
				{$tips}
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][downloadurl]}</dt>
			<dd class="ftype_upload">
				<div class="fbox">
					<input 
						name="imgurl" 
						type="text" 
						data-upload-type="doupimg"
						value="{$list[imgurl]}" 
					/>
				</div>
				<span class="tips">{$_M[word][tips7_v6]}</span>
			</dd>
		</dl>
    </div>
	<div class="met_affix_save bg-success">
		<button type="submit" class="btn btn-success">{$_M[word][mobiletips3]}</button>
	</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>