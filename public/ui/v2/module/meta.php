<!--<?php
require_once template('static/config');
if($nofollow)$nofollow = "\n<meta name=\"robots\" content=\"noindex,nofllow\" />";
$user_name=$_M['user']?" data-user_name='{$_M['user']['username']}'":'';
echo <<<EOT
--><!DOCTYPE HTML>
<html>
<head>
<title>{$met_title}</title>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />{$nofollow}
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=0,minimal-ui">
<meta name="description" content="{$show['description']}" />
<meta name="keywords" content="{$show['keywords']}" />
<meta name="generator" content="MetInfo {$_M[config][metcms_v]}" data-variable="{$_M['url']['site']}|{$lang}|{$classnow}|{$id}|{$class_list[$classnow][module]}|{$_M[config][met_skin_user]}"{$user_name}/>
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
    {$_M['word']['browserupdatetips']}
</div>
<![endif]-->
<!--
EOT;
?>