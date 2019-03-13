<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!DOCTYPE HTML>
<html>
<head>
<title>{$_M[word][metinfo]}</title>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta content="telephone=no" name="format-detection" />
<link href="{$_M[url][site]}favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="{$_M[url][pub]}ui/admin/css/box.css?{$jsrand}" />
<link rel="stylesheet" href="{$_M[url][pub]}font-awesome/css/font-awesome.min.css?{$jsrand}" />
<script>
var langtxt = {
	"checkupdatetips":"{$_M[word][checkupdatetips]}",
	"detection":"{$_M[word][detection]}",
	"try_again":"{$_M[word][try_again]}"
},
anyid="{$_M[form][anyid]}",
own_form="{$_M[url][own_form]}",
own_name="{$_M[url][own_name]}",
tem="{$_M[url][own_tem]}",
adminurl="{$_M[url][adminurl]}",
renewable="{$_M[form][renewable]}",
apppath="{$_M[url][api]}",
jsrand="{$jsrand}"
;
</script>
<!--[if IE]><script src="{$_M[url][site]}public/js/html5.js" type="text/javascript"></script><![endif]-->
</head>
<body>
<input id="met_automatic_upgrade" type="hidden" value="{$_M['config']['met_automatic_upgrade']}" />
<div class="metcms_cont v52fmbx" id="metcmsbox" data-metcms_v="{$_M[config][metcms_v]}" data-patch="{$_M[config][met_patch]}">
	<div class="metcms_cont_left hidden-xs">
		<div class="metlogo">
			<a href="{$_M[url][site_admin]}index.php?lang={$_M[lang]}" hidefocus="true">
				<img 
					src="{$met_admin_logo}"
					alt="{$_M[word][metinfo]}"
					title="{$_M[word][metinfo]}"
				/>
			</a>
		</div>
		<dl class="jslist">
			<dt><a target="_blank" href="{$_M['config']['met_weburl']}index.php?lang={$_M['lang']}" title="{$_M[word][indexhome]}"><i class="fa fa-home"></i>{$_M[word][indexhome]}</a></dt>
		</dl>
<!--
EOT;
$i=0;
foreach($toparr as $key=>$val){
if($val[id]==18){$pcurl = $val[url];}//得到电脑模板url
if($val['type']==1){
$cnm='';
$dt="{$val[name]}";
if($val[icon]!=''){
$cnm = 'class="jslist"';
$dt="{$val[icon]}{$val[name]}<i class=\"fa fa-angle-right\"></i>";
}
if($_M[config][met_wap]==0 && $val[id]==69)
{
$dt="{$val[icon]}{$val[name]}";
echo <<<EOT
-->
		<dl {$cnm}>
			<dt><a href="{$pcurl}" target="_blank">{$dt}</a></dt>
		</dl>
<!--
EOT;

}else{
echo <<<EOT
-->
		<dl {$cnm}>
			<dt>{$dt}</dt>
			<dd>
<!--
EOT;
}


foreach($toparr as $key=>$val2){
if($val2['type']==2&&$val2['bigclass']==$val['id']){
$target = $val2[id]==70||$val2[id]==18?'target="_blank"':'';
echo <<<EOT
-->
					<a href="{$val2[url]}" {$val2[property]} title="{$val2[name]}" {$target} id="metinfo_metnav_{$val2[id]}">{$val2[icon]}{$val2[name]}</a>
<!--
EOT;
}}
echo <<<EOT
-->	
			</dd>
		</dl>
<!--
EOT;
$i++;
}}
echo <<<EOT
-->
	</div>
	<div class="metcms_cont_right">
		<div class="metcms_cont_right_box">
<!--
EOT;
$ifurl = "{$_M[url][own_form]}a=dohome";
echo <<<EOT
-->
			<iframe src="{$ifurl}" frameborder="0"></iframe>
		</div>
	</div>
	<div class="clear"></div>
</div>
<script>
var indexbox = 1;
//手机版关闭时隐藏电脑外观
if({$_M[config][met_wap]}==0)
{
	document.getElementById("metinfo_metnav_18").style.display="none";
}
</script>
<script src="{$_M[url][pub]}js/sea.js?{$jsrand}"></script>
</body>
</html>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->