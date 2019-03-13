<?php
require_once '../include/common.inc.php';
if($action=="getpassword"){
$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$admin_name'");
if(!$admin_list){
okinfo('getpassword.php','没有此用户');
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

$title=$met_c_webname."管理员密码通知";
$body="您在[".$met_c_webname."]".$met_weburl."的用户密码已随机更改为:".$getpass."<br>请您及时登陆管理后台并更改密码！";
jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp);
okinfo('../index.php','请您登陆邮箱收取最新密码');
}
}else{
echo "<br>请输入您的用户名：<form method='post' action='getpassword.php?action=getpassword'><input type='text' name='admin_name' size='20'/><input   type='submit' name='Submit' value=' 找回密码 '> <form>";
}

function jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp){
$jmail=new COM("JMail.Message")or die("无法调用Jmail组件");
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
    if($email)$msg= '发送成功';
    else $msg= '发送失败';
} catch (Exception $e){
    $msg=$e->getMessage();
}
}
?>