<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
$mobcss = $_M['form'][mobile]?'class="mobileiframe"':'';
$pageset_class=$_M['form']['from_page']?' pageset':'';
$pageset_url=$_M['form']['from_page']?"{$_M['url']['adminurl']}n=ui_set&c=index&a=dochange_skin":"{$_M['url']['own_form']}a=doeditor";
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M['url']['own_tem']}css/metinfo.css?{$jsrand}" />
<script>
var ownlangtxt = {
	"skinusenow":"{$_M[word][skinusenow]}",
	"skinused":"{$_M[word][skinused]}"
};
</script>
<div class="theme{$pageset_class}">
	<div class="theme-left">
		<ul class="tabs">
			<li class="list"><a href="#" class="list">{$_M['word']['templates_choice']}</a></li>
<!--
EOT;
if(!$_M['form']['from_page']){
echo <<<EOT
-->
			<li class="list">
				<a href="#" class="list" data-dup="1">
				{$_M['word']['unitytxt_39']} - <span></span>
				<i class="fa fa-sort-desc"></i></a>
				<ul>
					<li><a href="#">{$_M['word']['global']}</a></li>
					<li><a href="#">{$_M['word']['seotips6']}</a></li>
					<li><a href="#">{$_M['word']['setskinListPage']}</a></li>
					<li><a href="#">{$_M['word']['page_for_details']}</a></li>
				</ul>
			</li>
<!--
EOT;
}
echo <<<EOT
-->
		</ul>
		<form method="POST" class="ui-from" name="myform" action="{$pageset_url}" target="_self">
			<input type="hidden" name="mobile" value="{$_M['form'][mobile]}" />
			<input type="hidden" name="met_skin_user" value="{$_M['config'][met_skin_user]}" />
			<input type="hidden" name="item_index" value="{$item_index}" />
			<input type="hidden" name="iframesrc" value="" />
			<div class="tab_content">
				<div class="tabs_item theme-mb">
					<div class="row">
<!--
EOT;
$mb_list_w=$_M['form']['from_page']?'col-xs-12 col-sm-6 col-md-4 col-lg-3':'col-xs-12';
foreach($tem as $key=>$val){
	$qy = $_M['config']['met_skin_user']==$val['skin_file']?'1':'0';
	$qytxt = $_M['config']['met_skin_user']==$val['skin_file']?$_M['word']['skinused']:$_M['word']['skinusenow'];
	$val['mb_view']="templates/{$val['skin_file']}/view.jpg";
	if(!file_exists(PATH_WEB.$val['mb_view'])) $val['mb_view']='app/system/login/admin/templates/img/login-logo.png';
	$val['template_type']=false;
	if(file_exists(PATH_WEB."templates/{$val['skin_file']}/metinfo.inc.php")){
		$val['ver_str']=file_get_contents(PATH_WEB."templates/{$val['skin_file']}/metinfo.inc.php");
		if(strpos($val['ver_str'], 'template_type')!==false && strpos($val['ver_str'], 'ui')!==false) $val['template_type']=true;
	}
	if(!$val['template_type']){
echo <<<EOT
-->
						<dl class="theme-mb-list {$mb_list_w}">
							<div>
								<dt>{$val['skin_file']}</dt>
								<dd>
									<a href="#" class="img">
										<img src="{$_M['url'][site]}{$val['mb_view']}" width="100%" />
									</a>
									<div class="theme-mb-ow" data-mbqy="{$qy}">
										<a href="#" class="theme-mb-qy">{$qytxt}</a>
									</div>
								</dd>
							</div>
						</dl>
<!--
EOT;
	}
}
echo <<<EOT
-->
					</div>
<!--
EOT;
if(!$_M['config']['met_agents_switch']){
echo <<<EOT
-->
				    <div class="moretemp"><a href="{$_M['url'][site_admin]}index.php?anyid=65&n=appstore&c=appstore&a=dotem_market&lang={$_M[lang]}" target="_blank">{$_M['word']['skinmore']}</a></div>
				    <div style="padding:10px;text-align:center; line-height:1.5; color:#888;">
					    {$_M['word']['installation_template']}<br/>
					    {$_M['word']['install_application']}
					    <a href="{$_M['url'][site_admin]}index.php?n=appstore&c=appstore&a=doappdetail&type=app&no=10012&lang={$_M[lang]}&anyid=65" target="_blank">{$_M['word']['template_assistant']}</a>
				    </div>
<!--
EOT;
}
echo <<<EOT
-->
				</div>
				<div class="tabs_item" name="tabs_item_set"></div>
				<div class="tabs_item" name="tabs_item_set"></div>
				<div class="tabs_item" name="tabs_item_set"></div>
				<div class="tabs_item" name="tabs_item_set"></div>
				<div class="listzhezhao"><span>{$_M['word']['trying_load']}....</span></div>
				<input type="submit" name="submit" value="{$_M['word']['Submit']}" style="display:none;" class="submit">
			</div>
			<div class="theme-save"><a href="#">{$_M['word']['save_Settings']}</a></div>
		</form>
	</div>
<!--
EOT;
if(!$_M['form']['from_page']){
echo <<<EOT
-->
	<div class="theme-right">
		<div class="theme-right-iframe">
		<div {$mobcss}>
			<div class="theme-right-bx">
				<iframe src="{$iframesrc}" frameborder="0" id="themeshow" name="themeshow" ></iframe>
				<div class="iframezhezhao"><span>{$_M['word']['trying_load']}....</span></div>
			</div>
<!--
EOT;
	if($_M['form'][mobile]){
echo <<<EOT
-->
			<div class="theme-right-erweima">
				<dl>
					<dt>{$_M['word']['unitytxt_71']}</dt>
					<dd class="erweima" data-size="{$_M['config']['wap_dimensional_size']}" data-logo="{$_M['config'][met_dimensional_logo]}">{$_M['word']['trying_load']}...</dd>
					<dd>
					<br/>
					{$_M['word']['computer_browser']}
					<br/><br/>
					{$_M['word']['effect_should']}
					<br/><br/>
					{$_M['word']['complete_experience']}</dd>
				</dl>
			</div>
<!--
EOT;
	}
echo <<<EOT
-->
		</div>
		</div>
	</div>
<!--
EOT;
}
echo <<<EOT
-->
	<div class="clear"></div>
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>