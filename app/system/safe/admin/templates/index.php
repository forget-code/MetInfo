<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. .
require $this->template('ui/head');
// require_once $this->template('tem/metlangs');
$filepop='disabled="disabled"';
if($admin_list[admin_group]==10000)$filepop='';
echo <<<EOT
-->
<form method="POST" name="myform" action="{$_M[url][own_form]}a=doupdate" target="_self">
	<input name="action" type="hidden" value="modify">
	<input name="adminmodify" value="1" type="hidden"/>
	<input name="met_deleteimg" type="hidden" value=0 />
	<input name="met_img_rename" type="hidden" value=0 />
	<div class="v52fmbx">
		<h3 class="v52fmbx_hr metsliding" sliding="2">{$_M[word][safety_efficiency]}</h3>
		<div class="metsliding_box metsliding_box_2">
			<div class="v52fmbx">
				<dl>
					<dt>{$_M[word][setimgrename]}{$_M[word][marks]}</dt>
					<dd class="ftype_radio">
						<div class="fbox" style='padding-bottom:10px'>
							<label><input name="met_img_rename" type="checkbox" class="checkbox" value=1 {$met_img_rename1}>{$_M[word][setimgrename1]}</label>
						</div>
<!--
EOT;
if($_M[config][met_agents_type]<=1){
echo <<<EOT
-->
						<span class="tips" >{$_M[word][setimgrename2]}</span>
<!--
EOT;
}
echo <<<EOT
-->
					</dd>
				</dl>
			</div>
		</div>

<!--
EOT;
$fmsnone = 'none';
if(!$updatestyle||!$installstyle)$fmsnone = '';
echo <<<EOT
-->
		<h3 class="v52fmbx_hr metsliding {$fmsnone}"><span style="float:right;">{$_M[word][setsafeupdate1]}</span>{$_M[word][unitytxt_69]}</h3>
		<div class="v52fmbx" style="{$updatestyle}">
			<dl>
				<dt>{$_M[word][setsafeupdate]}{$_M[word][marks]}</dt>
				<dd>
					<font color="#FF0000"></font>
					<a href="{$_M[url][own_form]}&a=dodelete&filename=update">{$_M[word][delete]}</a>
				</dd>
			</dl>
		</div>
		<div class="v52fmbx" style="{$installstyle}">
			<dl>
				<dt>{$_M[word][setsafeinstall]}{$_M[word][marks]}</dt>
				<dd>
					<font color="#FF0000"></font>
					<a href="{$_M[url][own_form]}&a=dodelete&filename=install">{$_M[word][delete]}</a>
				</dd>
			</dl>
		</div>
		<h3 class="v52fmbx_hr metsliding">{$_M[word][setsafeadminname1c]}{$localurl_admin}</h3>
		<div class="v52fmbx">
			<dl>
				<dt>{$_M[word][setsafeadminname]}{$_M[word][marks]}</dt>
				<dd class="ftype_input">
				<div class="fbox">
				    <input name="met_adminfile" type="text" value="{$_M['config']['met_adminfile']}" {$filepop} />
				    </div>
				</dd>
			</dl>
		</div>
		<h3 class="v52fmbx_hr metsliding">{$_M[word][logincode]}</h3>
		<div class="v52fmbx">
			<dl>
				<dt>{$_M[word][setsafeadmin]}{$_M[word][marks]}</dt>
				<dd class="ftype_radio">
				<div class="fbox">
				    <label><input name="met_login_code" type="radio" value="1" {$met_login_code1[1]} />{$_M[word][open]}</label>
					<label><input name="met_login_code" type="radio" value="0" {$met_login_code1[0]} />{$_M[word][close]}</label>
					</div>
				</dd>
			</dl>
		</div>
		<div class="v52fmbx">
			<dl>
				<dt>{$_M[word][setsafemember]}{$_M[word][marks]}</dt>
				<dd class="ftype_radio">
				<div class="fbox">
				    <label><input name="met_memberlogin_code" type="radio" value="1" {$met_memberlogin_code1[1]}>{$_M[word][open]}</label>
					<label><input name="met_memberlogin_code" type="radio" value="0" {$met_memberlogin_code1[0]}>{$_M[word][close]}</label>
					</div>
					<span class="tips">{$_M[word][upfiletips24]}</span>
				</dd>
			</dl>
		</div>
        <h3 class="v52fmbx_hr metsliding">{$_M[word][fdincSlash]}</h3>
        <div class="v52fmbx v52fmbx_mo">
			<dl>
				<dt>{$_M[word][fdincSlash]}{$_M[word][marks]}</dt>
				<dd class="ftype_textarea">
				<div class="fbox">
					<textarea name="met_fd_word" type="text" class="textarea" rows="5" style="width:350px;">{$_M['config']['met_fd_word']}</textarea>
				</div>
					<span class="tips">{$_M[word][setbasicTip5]}</span>
				</dd>
			</dl>
		</div>
		<h3 class="v52fmbx_hr metsliding">{$_M[word][unitytxt_70]}</h3>
		<div class="v52fmbx">
			<dl>
				<dt>{$_M[word][setbasicUploadMax]}{$_M[word][marks]}</dt>
				<dd class="ftype_input" >
				<div class="fbox">
				    <input name="met_file_maxsize" type="text" value="{$_M[config][met_file_maxsize]}" style="width:50px"/>
				  </div>
					<span class="tips">{$_M[word][systips15]}</span>
				</dd>
			</dl>
		</div>
		<div class="v52fmbx v52fmbx_mo">
			<dl>
				<dt>{$_M[word][setbasicEnableFormat]}{$_M[word][marks]}</dt>
				<dd class="ftype_textarea">
				<div class="fbox">
					<textarea name="met_file_format" type="text" class="textarea" rows="5" style="width:350px;">{$_M[config][met_file_format]}</textarea>
				</div>
					<span class="tips">{$_M[word][setbasicTip5]}</span>
				</dd>
			</dl>
		</div>
		<div class="v52fmbx_submit"><input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit" onclick="return Smit($(this),'myform')" /></div>
	</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.d.
?>