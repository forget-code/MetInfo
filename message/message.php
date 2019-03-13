<?php
require_once '../include/common.inc.php';
$settings = parse_ini_file('config.inc.php');
@extract($settings);
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";
$ip=getenv('REMOTE_ADDR');
$message_column=$db->get_one("select * from $met_column where module='7'");
$navtitle=($en=="en")?$message_column[e_name]:$message_column[c_name];
if($action=="add"){
$addtime=$m_now_date;
$ipok=$db->get_one("select * from $met_message where ip='$ip' order by addtime desc");
$time1 = strtotime($ipok[addtime]);
$time2 = strtotime($m_now_date);
$timeok= (float)($time2-$time1);
if($timeok<=$met_fd_time){
$c_fd_time="请不要在".$met_fd_time."秒内重复提交信息，谢谢合作！";
$e_fd_time="Please do not send information again in".$met_fd_time."second！";
$fd_time=($en=="en")?$e_fd_time:$c_fd_time;

okinfo('javascript:history.back();',$fd_time);
}

$fdstr = $met_fd_word; 
$fdarray=explode("|",$fdstr);
$fdarrayno=count($fdarray);
$fdok=false;
$content=$content."-".$name."-".$tel."-".$email."-".$contact."-".$info;
for($i=0;$i<$fdarrayno;$i++){ 
if(strstr($content, $fdarray[$i])){
$fdok=true;
$fd_word=$fdarray[$i];
break;
}
}

$c_fd_word="反馈信息中不能包含[".$fd_word."]！";
$e_fd_word="[".$fd_word."] is not permited to send！";
$fd_word=($en=="en")?$e_fd_word:$c_fd_word;
if($fdok==true)okinfo('javascript:history.back();',$fd_word);

if($met_fd_email==1){
$from=$met_fd_usename;
$fromname=$met_fd_fromname;
$to=$met_fd_to;
$usename=$met_fd_usename;
$usepassword=$met_fd_password;
$smtp=$met_fd_smtp;


$title=$name."在线留言";
$body=$body."<b>姓名</b>：".$name."<br>";
$body=$body."<b>电话</b>：".$tel."<br>";
$body=$body."<b>email</b>：".$email."<br>";
$body=$body."<b>其他联系方式</b>：".$contact."<br>";
$body=$body."<b>留言内容</b>：".$info."<br>";
$body=$body."<b>来源IP</b>：".$ip."<br>";
$body=$body."<b>提交时间</b>：".$addtime."<br>";
if(PATH_SEPARATOR==':'){
$toarray=explode("|",$to);
$to_no=count($toarray);
for($i=0;$i<$to_no;$i++){
$toemail.=$toarray[$i].", ";
}
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";
mail("$toemail", "$title", "$body", "$headers");
}else{
jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp);
}
}

if($met_fd_back==1 and $email!=""){
if(PATH_SEPARATOR==':'){
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";
mail("$toemail", "$met_fd_title", "$met_fd_content", "$headers");
}else{
jmailsend($from,$fromname,$email,$met_fd_title,$met_fd_content,$usename,$usepassword,$smtp);
}
}
$query = "INSERT INTO $met_message SET
					  ip                 = '$ip',
					  addtime            = '$addtime',
					  en                 = '$en', 
					  name               = '$name', 
					  email              = '$email', 
					  tel                = '$tel', 
					  contact            = '$contact', 
					  info               = '$info'";
         $db->query($query);
if($en=="en"){
		 okinfo('message.php?en=en',"Successfully,Thanks!");
}else{
         okinfo('message.php',"您的留言已成功提交，谢谢！");
}
}
else{


$fdjs="<script language='javascript'>";
$fdjs=$fdjs."function Checkmessage(){ ";
$fdjs=$fdjs."if (document.myform.name.value.length == 0) {";
if($en=="en"){
$fdjs=$fdjs."alert('Name is Null');";
}else{
$fdjs=$fdjs."alert('姓名不能为空');";
}
$fdjs=$fdjs."document.myform.name.focus();";
$fdjs=$fdjs."return false;}";
$fdjs=$fdjs."if (document.myform.info.value.length == 0) {";
if($en=="en"){
$fdjs=$fdjs."alert('Infomation is Null');";
}else{
$fdjs=$fdjs."alert('留言信息不能为空');";
}
$fdjs=$fdjs."document.myform.info.focus();";
$fdjs=$fdjs."return false;}";
$fdjs=$fdjs."}</script>";

require_once '../include/head.php';
if($en=="en"){
$show[e_description]=$met_e_keywords;
$show[e_keywords]=$met_e_keywords;
$e_title_keywords=$navtitle."--".$e_title_keywords;
include template('e_message');
}
else{
$show[c_description]=$met_c_keywords;
$show[c_keywords]=$met_c_keywords;
$c_title_keywords=$navtitle."--".$c_title_keywords;

include template('message');
}

footer();
}
?>