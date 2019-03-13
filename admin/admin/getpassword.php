<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../include/common.inc.php';
if($action=="getpassword"){
$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$admin_name' and admin_email='$admin_email'");
if(!$admin_list){
okinfoy('getpassword.php',$lang_NoidJS1);
}else{
$met_fd_usename=$met_fd_usename;
$met_fd_fromname=$met_fd_fromname;
$met_fd_password=$met_fd_password;
$met_fd_smtp=$met_fd_smtp;
$met_webname=$met_webname;
$met_weburl=$met_weburl;

$adminfile=$url_array[count($url_array)-2];
$from=$met_fd_usename;
$fromname=$met_fd_fromname;
$to=$admin_email;
$usename=$met_fd_usename;
$usepassword=$met_fd_password;
$smtp=$met_fd_smtp;
$title=$met_webname.$lang_getNotice;

$x = md5($admin_name.'+'.$admin_list[admin_pass]);
$String = base64_encode($admin_name.".".$x);
$mailurl= $met_weburl.$adminfile.'/admin/getpassword.php?p='.$String;
//$body=$lang_getTip1.$admin_name.'&nbsp;'.$lang_hello.'<br/>'.$lang_getTip2.'<br/>'.$mailurl;

$body ="<style type='text/css'>\n";
$body .="#metinfo{ padding:10px; color:#555; font-size:12px; line-height:1.8;}\n";
$body .="#metinfo .logo{ border-bottom:1px dotted #333; padding-bottom:5px;}\n";
$body .="#metinfo .logo img{ border:none;}\n";
$body .="#metinfo .logo a{ display:block;}\n";
$body .="#metinfo .text{ border-bottom:1px dotted #333; padding:5px 0px;}\n";
$body .="#metinfo .text p{ margin-bottom:5px;}\n";
$body .="#metinfo .text a{ color:#70940E;}\n";
$body .="#metinfo .copy{ color:#BBB; padding:5px 0px;}\n";
$body .="#metinfo .copy a{ color:#BBB; text-decoration:none; }\n";
$body .="#metinfo .copy a:hover{ text-decoration:underline; }\n";
$body .="#metinfo .copy b{ font-weight:normal; }\n";
$body .="</style>\n";
$body .="<div id='metinfo'>\n";
$body .="<div class='logo'><a href='$met_weburl' title='$met_webname'><img src='http://www.metinfo.cn/upload/200911/1259148297.gif' /></a></div>";
$body .="<div class='text'><p>".$lang_hello.$admin_name."</p><p>$lang_getTip1</p>";
$body .="<p><a href='$mailurl'>$mailurl</a></p>\n";
$body .="<p>$lang_getTip2</p></div><div class='copy'>$foot</a></div>";

require_once '../../include/jmail.php';
$sendMail=jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp);
$text=$sendMail?$lang_getTip3:$lang_getTip4;
okinfoy('../index.php',$text);
}
}
if($p){
   $array = explode('.',base64_decode($p));
   $sql="SELECT * FROM $met_admin_table WHERE admin_id='".$array[0]."'";
   $sqlarray = $db->get_one($sql);
   $passwords=$sqlarray[admin_pass];
   $checkCode = md5($array[0].'+'.$passwords);
   if($array[1]!=$checkCode){
        okinfoy('javascript:history.back();',$lang_dataerror);
   }
   if($action == "MembersAction"){
        if($password=='')okinfoy('javascript:history.back();',$lang_dataerror);
        $password = md5($password);
        $query="update $met_admin_table set
		   admin_pass='$password'
		   where admin_id='$array[0]'";
        $db->query($query);
		okinfoy('../index.php',$lang_jsok);
   }
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('getpassword');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>