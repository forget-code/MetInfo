<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$authurlself=$_SERVER ['HTTP_HOST'];
$authcode=trim($authcode);
$authpass=trim($authpass);
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
 okinfo('authcode.php?lang='.$lang,$lang_jsok);
 }
}
okinfo('authcode.php?lang='.$lang,'',$lang_authTip2);
}
else
{
$authinfo = $db->get_one("SELECT * FROM $met_otherinfo where id=1");
if(!$authinfo){
okinfo('../site/sysadmin.php?lang='.$lang,$lang_dataerror);
}
if($authinfo[authcode]=="")$authinfo[authcode]="{$lang_authTip4}";
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('authcode');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>