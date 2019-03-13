<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form  method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doeditorsave" target="_self">
	<input name="id" type="hidden" value="$about[id]">
	<input name="lang" type="hidden" value="$lang">
	<input name="filenameold" type="hidden"  value="$about[filename]">
	<input name="updatetimeold" type="hidden"  value="$about[updatetime]">
	<input name="turnurl" type="hidden"  value="$turnurl">
	<div class="v52fmbx_tbmax">
		<div class="v52fmbx_tbbox">
			<div class="v52fmbx">
				<h3 class="v52fmbx_hr metsliding">
					{$_M[word][contentdetail]}
					<a href="{$_M[url][adminurl]}anyid=25&n=column&c=index&a=doeditor&id={$_M['form']['id']}" target='_blank'>{$_M[word][indexcolumn]}</a>
				</h3>
				<dl>
					<dd class="ftype_ckeditor">
						<div class="fbox">
							<textarea name="content" data-ckeditor-y="500">{$about[content]}</textarea>
						</div>
					</dd>
				</dl>
				<h3 class="v52fmbx_hr metsliding clearfix" sliding="2">{$_M[word][columnSEO]}<button type='button' class='btn btn-default btn-sm showmoreset-btn'>{$_M[word][jsx33]}</button></h3>
				<div class='showmoreset-content'>
					<div class="metsliding_box metsliding_box_2">
						<dl>
							<dt>{$_M[word][columnmtitle]}{$_M[word][marks]}</dt>
							<dd class="ftype_input">
							    <div class="fbox">
								<input name="ctitle" type="text" class="text" maxlength="200" value="$about[ctitle]" />
								</div>
								<span class="tips">{$_M[word][ctitleinfo]}</span>
							</dd>
						</dl>
						<dl>
							<dt>{$_M[word][keywords]}{$_M[word][marks]}</dt>
							<dd  class="ftype_input">
							   <div class="fbox">
								<input name="keywords" type="text" size="40" class="text" value="$about[keywords]" />
								</div>
								<span class="tips">{$_M[word][descriptioninfo]},{$_M[word][keywordsinfo]}</span>
							</dd>
						</dl>
						<dl>
						    <dt>{$_M[word][description]}{$_M[word][marks]}</dt>
							<dd class="ftype_textarea">
								<div class="fbox">
									<textarea name="description" data-ckeditor-y="500">{$about[description]}</textarea>
								</div>
							</dd>
						</dl>
						<dl>
							<dt>{$_M[word][columnhtmlname]}{$_M[word][marks]}</dt>
							<dd class="ftype_input">
								<div class="fbox">
							    <input name="filename" type="text" class="text med" value="$about[filename]" />
							    </div>
								<span class="tips">{$_M[word][columntip14]}</span>
							</dd>
						</dl>
					</div>
				</div>
				<div class="v52fmbx_submit">
					<input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit" onclick="return Smit($(this),'myform')" />
				</div>
			</div>
		</div>
	</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>