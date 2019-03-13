<?php
# 文件名称:jmail.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.

function jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp){
global $met_c_charset,$met_e_charset,$met_o_charset,$lang;
$charset=$lang=="en"?$met_e_charset:($lang=="other"?$met_o_charset:$met_c_charset);
$jmail=new COM("JMail.Message")or die("Jmail is disable");
//屏蔽例外错误，静默处理
$jmail->silent=true;
//编码必须设置，否则中文会乱码
$jmail->charset="$charset";
//发信人邮件地址和名称，能自定义，可以和邮件发送账号不同
$jmail->From=$from;
$jmail->FromName=$fromname;
//添加多个邮件接受者
$toarray=explode("|",$to);
$tocount=count($toarray);
for($k=0;$k<$tocount;$k++){
$jmail->AddRecipient($toarray[$k]);
}
//邮件主题和正文信息
$jmail->ContentType ='text/html';   //设置邮件格式为html格式
$jmail->Subject = mb_convert_encoding($title, "$charset", 'UTF-8'); 
$jmail->Body = mb_convert_encoding($body, "$charset", 'UTF-8'); 
//发信邮件账号和密码
$jmail->MailServerUserName=$usename;
$jmail->MailServerPassword=$usepassword;
    $email = $jmail->Send($smtp);
    if($email)$msg= '发送成功';
    else $msg= '发送失败';
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>