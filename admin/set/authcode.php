<?php
# 文件名称:authcode.php 2009-08-03 15:48:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$authurlself=$_SERVER ['HTTP_HOST'];
if($action=="modify"){
$authurl=authcode($authcode, 'DECODE', $authpass);
$authurl=explode("|",$authurl);
foreach($authurl as $val)
{
 if(strstr($_SERVER ['HTTP_HOST'],$val)){
 $query ="update $met_otherinfo set 
          authpass    ='$authpass',
		  authcode    ='$authcode',
          authtext    ='{$lang_authTip3}'
		  where id='1'";
 $db->query($query);
 okinfo('authcode.php',$lang_loginUserAdmin);
 }
}
okinfo('authcode.php',$lang_authTip2);
}
else
{
$authinfo = $db->get_one("SELECT * FROM $met_otherinfo order by id desc");
if(!$authinfo){
okinfo('../site/sysadmin.php',$lang_loginNoid);
}
if($authinfo[authcode]=="")$authinfo[authcode]="{$lang_authTip4}";
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('authcode');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>