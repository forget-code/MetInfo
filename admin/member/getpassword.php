<?php
# 文件名称:getpassword.php 2009-08-15 11:04:13
# MetInfo企业网站管理系统
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
if($action=="getpassword"){
$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$admin_name'");
if(!$admin_list){
okinfo('getpassword.php',$lang_NoidJS);
}
else{
$from=$met_fd_usename;
$fromname=$met_fd_fromname;
$to=$admin_list[admin_email];
$usename=$met_fd_usename;
$usepassword=$met_fd_password;
$smtp=$met_fd_smtp;

$random = mt_rand(1000, 9999);
$passwords=date('Ymd').$random;
$getpass=$passwords;
$passwords=md5($passwords);

$query = "update $met_admin_table SET
          admin_pass         = '$passwords' 
		  where admin_id='$admin_name'";
$db->query($query);

$title=$met_c_webname.$lang_getNotice;
$body="$lang_getTip1 [".$met_c_webname."]".$met_weburl.$lang_getTip2.$getpass.$lang_getTip3;
if(PATH_SEPARATOR==':'){
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";
mail("$to", "$title", "$body", "$headers");
}else{
jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp);
}
okinfo('../index.php',$lang_NewPassJS);
}
}else{
echo "<br>{$lang_getTip4}：<form method='post' action='getpassword.php?action=getpassword'><input type='text' name='admin_name' size='20'/><input   type='submit' name='Submit' value=' $lang_getTip5 '> <form>";
}

function jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp){
$jmail=new COM("JMail.Message")or die($lang_getTip6);
//屏蔽例外错误，静默处理
$jmail->silent=true;
//编码必须设置，否则中文会乱码
$jmail->charset="utf8";
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
$jmail->Subject = mb_convert_encoding($title, 'GB2312', 'UTF-8'); 
$jmail->Body = mb_convert_encoding($body, 'GB2312', 'UTF-8'); 
//发信邮件账号和密码
$jmail->MailServerUserName=$usename;
$jmail->MailServerPassword=$usepassword;
try{
    $email = $jmail->Send($smtp);
    if($email)$msg= $lang_getOK;
    else $msg= $lang_getFail;
} catch (Exception $e){
    $msg=$e->getMessage();
}
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 ( http://www.metinfo.cn). All rights reserved.
?>