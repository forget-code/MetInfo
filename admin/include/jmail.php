<?php

function jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp){
$jmail=new COM("JMail.Message")or die($lang_getTip6);
//屏蔽例外错误，静默处理
$jmail->silent=true;
//编码必须设置，否则中文会乱码
$jmail->charset="GB2312";
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

    $email = $jmail->Send($smtp);
    if($email)$msg= $lang_getOK;
    else $msg= $lang_getFail;

}

?>