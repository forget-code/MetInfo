<?php
# 文件名称:messageeditor 2009-08-20 17:29:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once 'login_check.php';
if($action=="editor"){

	//登陆验证码判断
     if($met_memberlogin_code==1){
         require_once 'captcha.class.php';
         $Captcha= new  Captcha();
         if(!$Captcha->CheckCode($code)){
         echo("<script type='text/javascript'> alert('$lang_membercode');window.history.back();</script>");
		       exit;
         }
     }

$query = "update $met_message SET
                      name               = '{$messagename}',
					  tel            	 = '$tel',
					  email              = '$email',
					  contact			 = '$contact',
					  info  			 = '$info'
					  where id='$id'";

$db->query($query);
okinfo('message.php?lang='.$lang,$lang_js21);
}
else
{
$message_list=$db->get_one("select * from $met_message where id='$id'");
if($message_list[readok]==1 || $message_list[useinfo]!='') okinfo('message.php?lang='.$lang,$lang_js24);

if(!$message_list){
okinfo('message.php?lang='.$lang, $lang_js1);
}

$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('message_editor');
footermember();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>