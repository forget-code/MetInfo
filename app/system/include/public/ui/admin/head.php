<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$jsrand=str_replace('.','',$_M[config][metcms_v]).$_M[config][met_patch];
if(strstr($_M[config][met_weburl],'https')){
    $_M[url][api]=strstr($_M[url][api],'https')?$_M[url][api]:str_replace('http','https',$_M[url][api]);
    $_M[url][app_api]=strstr($_M[url][app_api],'https')?$_M[url][app_api]:str_replace('http','https',$_M[url][app_api]);
}

if($_M[config][met_agents_type] > 2) $met_agents_display = "style=\"display:none\"";
echo <<<EOT
--><!DOCTYPE HTML>
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
<link rel="stylesheet" href="{$_M[url][pub]}bootstrap/css/bootstrap.min.css?{$jsrand}" />
<link rel="stylesheet" href="{$_M[url][pub]}ui/admin/css/metinfo.css?{$jsrand}" />
<link rel="stylesheet" href="{$_M[url][pub]}font-awesome/css/font-awesome.min.css?{$jsrand}" />
<script>
var langtxt = {
	"jsx15":"{$_M[word][jsx15]}",
	"js35":"{$_M[word][js35]}",
	"jsx17":"{$_M[word][jsx17]}",
	"formerror1":"{$_M[word][formerror1]}",
	"formerror2":"{$_M[word][formerror2]}",
	"formerror3":"{$_M[word][formerror3]}",
	"formerror4":"{$_M[word][formerror4]}",
	"formerror5":"{$_M[word][formerror5]}",
	"formerror6":"{$_M[word][formerror6]}",
	"formerror7":"{$_M[word][formerror7]}",
	"formerror8":"{$_M[word][formerror8]}",
	"js46":"{$_M[word][js46]}",
	"js23":"{$_M[word][js23]}",
	"checkupdatetips":"{$_M[word][checkupdatetips]}",
	"detection":"{$_M[word][detection]}",
	"try_again":"{$_M[word][try_again]}"
},
anyid="{$_M[form][anyid]}",
own_form="{$_M[url][own_form]}",
own_name="{$_M[url][own_name]}",
tem="{$_M[url][own_tem]}",
adminurl="{$_M[url][adminurl]}",
apppath="{$_M[url][api]}",
jsrand="{$jsrand}",
editorname="{$_M[config][met_editor]}"
;
</script>
<!--[if IE]><script src="{$_M[url][site]}public/js/html5.js" type="text/javascript"></script><![endif]-->
</head>
<body>
<div id="metcmsbox">
<!--
EOT;
require $this->template('ui/box');
require $this->template('ui/top');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>