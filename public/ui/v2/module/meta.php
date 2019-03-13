<!--<?php
require_once template('static/config');
if($nofollow)$nofollow = "<meta name=\"robots\" content=\"noindex,nofllow\" />";
echo <<<EOT
--><!DOCTYPE HTML>
<html>
<head>
<title>{$met_title}</title>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />{$nofollow}
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="{$show['description']}" />
<meta name="keywords" content="{$show['keywords']}" />
<meta name="generator" content="MetInfo {$_M[config][metcms_v]}"  data-variable="{$_M[config][met_weburl]}|{$lang}|{$navurl}|{$classnow}|{$id}|{$class_list[$classnow][module]}|{$_M[config][met_skin_user]}|{$_M['langlist']['web'][$_M['lang']]['synchronous']}" />
<link href="{$navurl}favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!--
EOT;
foreach ($resui[css] as $value) {
echo <<<EOT
-->
<link rel='stylesheet' type='text/css' href="{$value}">
<!--
EOT;
}
foreach ($resui_lteie9[js] as $value) {
echo <<<EOT
-->
<script src="{$value}"></script>
<!--
EOT;
}
echo <<<EOT
-->
{$_M['html_plugin']['head_script']}{$appscriptcss}{$iehack}{$met_js_access}{$_M[config][met_headstat]}{$closure}
</head>
<!--[if lte IE 8]>
<div class="text-xs-center m-b-0 bg-blue-grey-100 alert">
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    你正在使用一个 <strong>过时</strong> 的浏览器。请 <a href="http://browsehappy.com/" target="_blank">升级您的浏览器</a>，以提高您的体验。
</div>
<![endif]-->
<!--
EOT;
if(!$metuipack->isLteIe9 && $lang_pageprogress_ok && $metresclass->useragent('desktop') && !strpos($_SERVER['HTTP_USER_AGENT'], 'SE')){
    // $nprogress_status=round(100*$_COOKIE['NProgress_status'])-100;
    $nprogress_style='transform: translate3d(-30%,0,0);';
    if($metuipack->isLteIe9) $nprogress_style='-ms-transform: translate(-30%,0);';
echo <<<EOT
-->
<section id="nprogress"><div class="bar" role="bar" style="{$nprogress_style}"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div></section>
<!--
EOT;
}
?>