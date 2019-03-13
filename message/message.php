<?php
# 文件名称:message.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
$settings = parse_ini_file('config.inc.php');
@extract($settings);
$ip=$m_user_ip;
$met_fd_title=($lang=="en")?$met_e_fd_title:(($lang=="other")?$met_o_fd_title:$met_c_fd_title);
$met_fd_content=($lang=="en")?$met_e_fd_content:(($lang=="other")?$met_o_fd_content:$met_c_fd_content);
$message_column=$db->get_one("select * from $met_column where module='7'");
$metaccess=$message_column[access];
$class1=$message_column[id];
require_once '../include/head.php';
$class1_info=$class_list[$class1];
$navtitle=($lang=="en")?$message_column[e_name]:(($lang=="other")?$message_column[o_name]:$message_column[c_name]);
if($action=="add"){
$addtime=$m_now_date;
$ipok=$db->get_one("select * from $met_message where ip='$ip' order by addtime desc");
$time1 = strtotime($ipok[addtime]);
$time2 = strtotime($m_now_date);
$timeok= (float)($time2-$time1);
if($timeok<=$met_fd_time){

$fd_time="{$lang_Feedback1} ".$met_fd_time." {$lang_Feedback2}";

okinfo('javascript:history.back();',$fd_time);
}

$fdstr = $met_fd_word; 
$fdarray=explode("|",$fdstr);
$fdarrayno=count($fdarray);
$fdok=false;
$content=$content."-".$pname."-".$tel."-".$email."-".$contact."-".$info;
for($i=0;$i<$fdarrayno;$i++){ 
if(strstr($content, $fdarray[$i])){
$fdok=true;
$fd_word=$fdarray[$i];
break;
}
}

$c_fd_word=" {$lang_Feedback3} [".$fd_word."]！";
$e_fd_word="[".$fd_word."] {$lang_Feedback3} ";
$o_fd_word="[".$fd_word."] {$lang_Feedback3} ";
$fd_word=($lang=="en")?$e_fd_word:(($lang=="other")?$o_fd_word:$c_fd_word);
if($fdok==true)okinfo('javascript:history.back();',$fd_word);

if($met_fd_email==1){
$from=$met_fd_usename;
$fromname=$met_fd_fromname;
$to=$met_fd_to;
$usename=$met_fd_usename;
$usepassword=$met_fd_password;
$smtp=$met_fd_smtp;

$title=$pname."{$lang_MessageInfo1}";
$body=$body."<b>{$lang_Name}</b>:".$pname."<br>";
$body=$body."<b>{$lang_Phone}</b>:".$tel."<br>";
$body=$body."<b>{$lang_Email}</b>:".$email."<br>";
$body=$body."<b>{$lang_OtherContact}</b>:".$contact."<br>";
$body=$body."<b>{$lang_SubmitContent}</b>:".$info."<br>";
$body=$body."<b>{$lang_IP}</b>:".$ip."<br>";
$body=$body."<b>{$lang_AddTime}</b>:".$addtime."<br>";
jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp,$email);
}
if($met_fd_back==1 and $email!=""){
jmailsend($from,$fromname,$email,$met_fd_title,$met_fd_content,$usename,$usepassword,$smtp);
}
$langnow=($lang<>"")?$lang:"cn";
$customerid=$metinfo_member_name!=''?$metinfo_member_name:0;
$query = "INSERT INTO $met_message SET
					  ip                 = '$ip',
					  addtime            = '$addtime',
					  en                 = '$langnow', 
					  name               = '$pname', 
					  email              = '$email', 
					  tel                = '$tel', 
					  contact            = '$contact', 
					  customerid 		 = '$customerid',
					  info               = '$info'";
         $db->query($query);
if($met_webhtm){
$returnurl=($lang=="en")?'message'.$met_e_htmtype:(($lang=="other")?'message'.$met_o_htmtype:'message'.$met_c_htmtype);
}else{
$returnurl=($lang=="en")?'message.php?lang=en':(($lang=="other")?'message.php?lang=other':'message.php');
}

okinfo($returnurl,"{$lang_MessageInfo2}");

}
else{


$fdjs="<script language='javascript'>";
$fdjs=$fdjs."function Checkmessage(){ ";
$fdjs=$fdjs."if (document.myform.pname.value.length == 0) {";

$fdjs=$fdjs."alert('{$lang_MessageInfo3}');";

$fdjs=$fdjs."document.myform.pname.focus();";
$fdjs=$fdjs."return false;}";
$fdjs=$fdjs."if (document.myform.info.value.length == 0) {";
$fdjs=$fdjs."alert('{$lang_MessageInfo4}');";
$fdjs=$fdjs."document.myform.info.focus();";
$fdjs=$fdjs."return false;}";
$fdjs=$fdjs."}</script>";
     $class_info=$class1_info;
     $class_info[name]=($lang=="en")?$class_info[e_name]:(($lang=="other")?$class_info[o_name]:$class_info[c_name]);
     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$navtitle."--".$met_title;
	 
	$message[c_listurl]=($met_webhtm==2)?($met_htmlistname?"message_list_1":"index_list_1").$met_c_htmtype:"index.php";
	$message[e_listurl]=($met_webhtm==2)?($met_htmlistname?"message_list_1":"index_list_1").$met_e_htmtype:"index.php?lang=en";
	$message[o_listurl]=($met_webhtm==2)?($met_htmlistname?"message_list_1":"index_list_1").$met_o_htmtype:"index.php?lang=other";
	$message[listurl]=($lang=="en")?$message[e_listurl]:(($lang=="other")?$message[o_listurl]:$message[c_listurl]);
	 
require_once '../public/php/methtml.inc.php';
$methtml_message.=$fdjs;
$methtml_message.="<form method='POST' name='myform' onSubmit='return Checkmessage();' action='message.php?action=add' target='_self'>\n";
$methtml_message.="<table width='90%' cellpadding='2' cellspacing='1' bgcolor='#F2F2F2' align='center' class='message_table'>\n";
$methtml_message.="<tr class='message_tr'>\n";
$methtml_message.="<td width='20%' height='25' align='right' bgcolor='#FFFFFF' class='message_td1'>".$lang_Name."</td>\n";
$methtml_message.="<td width='70%' bgcolor='#FFFFFF' class='message_input'><input name='pname' type='text' size='30' /></td>\n";
$methtml_message.="<td bgcolor='#FFFFFF' style='color:#990000' class='message_info'>*</td>\n";
$methtml_message.="</tr>\n";
$methtml_message.="<tr class='message_tr'>\n";
$methtml_message.="<td align='right' bgcolor='#FFFFFF' class='message_td1'>".$lang_Phone."</td>\n";
$methtml_message.="<td bgcolor='#FFFFFF' class='message_input'><input name='tel' type='text' size='30' /></td>\n";
$methtml_message.="<td bgcolor='#FFFFFF' style='color:#990000' class='message_info'></td>\n";
$methtml_message.="</tr>\n";
$methtml_message.="<tr class='message_tr'>\n";
$methtml_message.="<td align='right' bgcolor='#FFFFFF' class='message_td1'>".$lang_Email."</td>\n";
$methtml_message.="<td bgcolor='#FFFFFF' class='message_input'><input name='email' type='text' size='30' /></td>\n";
$methtml_message.="<td bgcolor='#FFFFFF' style='color:#990000' class='message_info'></td>\n";
$methtml_message.="</tr>\n";
$methtml_message.="<tr class='message_tr'>\n";
$methtml_message.="<td align='right' bgcolor='#FFFFFF' class='message_td1'>".$lang_OtherContact."</td>\n";
$methtml_message.="<td bgcolor='#FFFFFF' class='message_input'><input name='contact' type='text' size='30' />".$lang_Info5."</td>\n";
$methtml_message.="<td bgcolor='#FFFFFF' style='color:#990000' class='message_info'></td>\n";
$methtml_message.="</tr>\n";
$methtml_message.="<tr class='message_tr'>\n";
$methtml_message.="<td align='right' bgcolor='#FFFFFF' class='message_td1'>".$lang_SubmitContent."</td>\n";
$methtml_message.="<td bgcolor='#FFFFFF' class='message_text'><textarea name='info' cols='50' rows='6'></textarea></td>\n";
$methtml_message.="<td bgcolor='#FFFFFF' style='color:#990000' class='message_info'>*</td>\n";
$methtml_message.="</tr>\n";
$methtml_message.="<tr class='message_tr'><td colspan='3' bgcolor='#FFFFFF' class='message_submint' align='center'>\n";
$methtml_message.="<input type='hidden' name='fromurl' value='".$fromurl."' />\n";
$methtml_message.="<input type='hidden' name='ip' value='".$ip."' />\n";
$methtml_message.="<input type='hidden' name='lang' value='".$lang."' />\n";
$methtml_message.="<input type='submit' name='Submit' value='".$lang_SubmitInfo."' class='tj'>\n";
$methtml_message.="<input type='reset' name='Submit' value='".$lang_Reset."' class='tj'></td></tr>\n";
$methtml_message.="</table>\n";
$methtml_message.="</form>\n";



if(file_exists("templates/".$met_skin_user."/e_message.html")){
   if($lang=="en"){
     $show[e_description]=$class_info[e_description]?$class_info[e_description]:$met_e_keywords;
     $show[e_keywords]=$class_info[e_keywords]?$class_info[e_keywords]:$met_e_keywords;
     $e_title_keywords=$navtitle."--".$met_e_webname;
     include template('e_message');
	}else{
	 $show[c_description]=$class_info[c_description]?$class_info[c_description]:$met_c_keywords;
     $show[c_keywords]=$class_info[c_keywords]?$class_info[c_keywords]:$met_c_keywords;
     $c_title_keywords=$navtitle."--".$met_c_webname;
	 include template('message');
	 }
}else{
include template('message');
}
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>