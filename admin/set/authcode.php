<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$authurlself=$_SERVER ['HTTP_HOST'];
if($action=="modify"){
$authurl=authcode($authcode, 'DECODE', $authpass);
 if(!strstr($_SERVER ['HTTP_HOST'],$authurl)){
 okinfo('authcode.php','您所输入的商业注册码与域名不匹配！');
 }else{
 $query ="update $met_otherinfo set 
          authpass    ='$authpass',
		  authcode    ='$authcode',
          authtext    ='您的域名没有经过MetInfo企业网站管理系统官方认证'
		  where id='1'";
 $db->query($query);
 okinfo('authcode.php',$lang[user_admin]);
 }
}
else
{
$authinfo = $db->get_one("SELECT * FROM $met_otherinfo order by id desc");
if(!$authinfo){
okinfo('../site/sysadmin.php',$lang[noid]);
}
if($authinfo[authcode]=="")$authinfo[authcode]="您使用的MetInfo企业网站管理系统为免费版，如您将其用于商业用途，请联系米特官方进行授权，感谢您的使用！";
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('authcode');
footer();
?>