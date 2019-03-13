<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
defined('IN_MET') or exit('No permission');
// 判断来源页面是否有pageset=1 ，如果有而本页url没有pageset=1，则本页加上pageset=1跳转
if(strpos($_SERVER["HTTP_REFERER"], 'pageset=1')!==false && !$_M['form']['pageset'] && !$_M['form']['nopageset'] && strpos($_SERVER['HTTP_REFERER'], 'nopageset=1')===false){
    echo '--><script>
        var newurl=location.href;
        if(location.search!=""){
            newurl+="&pageset=1";
        }else{
            newurl+="?pageset=1";
        }
        location.href=newurl;
    </script>';
    die;
}
$jsrand=str_replace('.','',$_M['config']['metcms_v']).$_M['config']['met_patch'];
if($_M['config']['met_agents_type'] > 2) $met_agents_display = "style=\"display:none\"";
echo <<<EOT
--><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta name="robots" content="noindex,nofllow">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=0,minimal-ui">
<meta name="format-detection" content="telephone=no">
<title>{$_M['word']['metinfo']}</title>
<meta name="generator" content="MetInfo {$_M['config']['metcms_v']}" data-variable="{$_M['url']['site']}|{$_M['lang']}||||{$_M['config']['met_skin_user']}" data-m_type="{$_M['config']['m_type']}">
<link href="{$_M['url']['site']}favicon.ico" rel="shortcut icon" type="image/x-icon">
<link rel="stylesheet" href="{$_M['url']['pub']}bootstrap/css/bootstrap.min.css?{$jsrand}">
<link rel="stylesheet" href="{$_M['url']['ui']}css/metinfo.css?{$jsrand}">
<link rel="stylesheet" href="{$_M['url']['pub']}font-awesome/css/font-awesome.min.css?{$jsrand}">
<script>
var langtxt = {
		"jsx15":"{$_M['word']['jsx15']}",
		"js35":"{$_M['word']['js35']}",
		"jsx17":"{$_M['word']['jsx17']}",
		"formerror1":"{$_M['word']['formerror1']}",
		"formerror2":"{$_M['word']['formerror2']}",
		"formerror3":"{$_M['word']['formerror3']}",
		"formerror4":"{$_M['word']['formerror4']}",
		"formerror5":"{$_M['word']['formerror5']}",
		"formerror6":"{$_M['word']['formerror6']}",
		"formerror7":"{$_M['word']['formerror7']}",
		"formerror8":"{$_M['word']['formerror8']}",
		"js46":"{$_M['word']['js46']}",
		"js23":"{$_M['word']['js23']}",
		"checkupdatetips":"{$_M['word']['checkupdatetips']}",
		"detection":"{$_M['word']['detection']}",
		"try_again":"{$_M['word']['try_again']}",
		"enter_amount":"{$_M[word][enter_amount]}",
		"downloads":"{$_M[word][downloads]}",
		"click_rating":"{$_M[word][click_rating]}",
		"sys_evaluation":"{$_M[word][sys_evaluation]}",
		"download_application":"{$_M[word][download_application]}",
		"appupgrade":"{$_M[word][appupgrade]}",
		"appinstall":"{$_M[word][appinstall]}",
		"have_bought":"{$_M[word][have_bought]}",
		"usertype1":"{$_M[word][usertype1]}",
		"please_again":"{$_M[word][please_again]}",
		"password_mistake":"{$_M[word][password_mistake]}",
		"product_commented":"{$_M[word][product_commented]}",
		"goods_comment":"{$_M[word][goods_comment]}",
		"permission_download":"{$_M[word][permission_download]}",
		"installations":"{$_M[word][installations]}",
		"attention":"{$_M[word][attention]}",
		"cvall":"{$_M[word][cvall]}"
	},
	langset="{$_M['langset']}",
	anyid="{$_M['form']['anyid']}",
	own_form="{$_M['url']['own_form']}",
	own_name="{$_M['url']['own_name']}",
	own="{$_M['url']['own']}",
	own_tem="{$_M['url']['own_tem']}",
	adminurl="{$_M['url']['adminurl']}",
	apppath="{$_M['url']['api']}",
	jsrand="{$jsrand}",
	editorname="{$_M['config']['met_editor']}",
	met_keywords = "{$_M['config']['met_keywords']}",
	met_alt="{$_M['config']['met_alt']}";
</script>
<!--['if IE']><script src="{$_M['url']['site']}public/js/html5.js" type="text/javascript"></script><!['endif']-->
</head>
<body>
<!--
EOT;
if(!$_M['form']['head_no']){
echo <<<EOT
-->
<div id="metcmsbox">
<!--
EOT;
	require $this->template('ui/box');
	require $this->template('ui/top');
	if($_M['config']['met_agents_app'] && (M_NAME=='met_template' || M_NAME=='appstore' || M_NAME=='theme') && $navlist){
		require $this->template('ui/logininfo');
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
