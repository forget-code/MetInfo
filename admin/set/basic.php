<?php
# 文件名称:basic.php 2009-08-01 21:01:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
if($action=="modify"){
if(substr($met_weburl,-1,1)!="/")$met_weburl.="/";
if(!strstr($met_weburl,"http://"))$met_weburl="http://".$met_weburl;
require_once 'configsave.php';
okinfo('basic.php',$lang_loginUserAdmin);
}
else{
$localurl="http://";
$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
$localurl_a=explode("/",$localurl);
$localurl_count=count($localurl_a);
$localurl_admin=$localurl_a[$localurl_count-3];
$localurl_admin=$localurl_admin."/set/basic";
$localurl_real=explode($localurl_admin,$localurl);
$localurl=$localurl_real[0];
if($met_weburl=="")$met_weburl=$localurl;
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_basic');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>