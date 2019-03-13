<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
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

$title=$met_webname.$lang_getNotice;
$body="$lang_getTip1 [".$met_webname."]".$met_weburl.$lang_getTip2.$getpass.$lang_getTip3;
require_once '../../include/jmail.php';
jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp);
okinfo('../index.php',$lang_NewPassJS);
}
}else{
echo "<html xmlns='http://www.w3.org/1999/xhtml' lang='zh-cn'><head><title>MetInfo";
echo $lang_metinfo;
echo "</title><meta http-equiv='Content-Type' content='text/html; charset=utf-8'/></head><body>";
echo "<br>{$lang_getTip4} <form method='post' action='getpassword.php?action=getpassword'><input type='text' name='admin_name' size='20'/><input   type='submit' name='Submit' value=' $lang_getTip5 '> <form>";
echo "</body></html>";
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>