<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../include/common.inc.php';
if($action=="getpassword"){
$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$admin_name'");
if(!$admin_list){
okinfo('getpassword.php?lang='.$lang,$lang_NoidJS);
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

$met_webnamearray=explode('--Powered by MetInfo',$met_webname);
$met_webname1=$met_webnamearray[0];

$title=$met_webname1.$lang_getNotice;
$body="$lang_getTip1 [".$met_webname1."]".$met_weburl.$lang_getTip2.$getpass.$lang_getTip3;
jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp);
okinfo('login_member.php?lang='.$lang,$lang_NewPassJS);
}
}else{
echo "<br>{$lang_getTip4}：<form method='post' action='getpassword.php?action=getpassword&lang=$lang'><input type='text' name='admin_name' size='20'/><input   type='submit' name='Submit' value=' $lang_getTip5 '> <form>";
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>