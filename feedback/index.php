<?php
require_once '../include/common.inc.php';
$settings = parse_ini_file('config.inc.php');
@extract($settings);
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";
$fromurl=$_SERVER['HTTP_REFERER'];
$ip=getenv('REMOTE_ADDR');
if($title==""){
$navtitle=($en=="en")?"FeedBack":"咨询反馈";
$title=$navtitle;
}
else{
$c_navtitle1="[".$title."]信息反馈";
$e_navtitle1="[".$title."]FeedBack";
$navtitle=($en=="en")?$e_navtitle1:$c_navtitle1; 
}
if($action=="add"){
$addtime=$m_now_date;
$ipok=$db->get_one("select * from $met_feedback where ip='$ip' order by addtime desc");
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
for($j=1;$j<=20;$j++){
$para="para".$j;
$content=$content."-".$$para;
}
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
if($met_fd_type==0 or $met_fd_type==2){
$from=$met_fd_usename;
$fromname=$met_fd_fromname;
$to=$met_fd_to;
$usename=$met_fd_usename;
$usepassword=$met_fd_password;
$smtp=$met_fd_smtp;


$title=$fdtitle."--反馈邮件";

$query = "SELECT * FROM $met_fdparameter order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$emaillist[]=$list;
}
for($k=0;$k<20;$k++){
if($emaillist[$k][use_ok]==1){
$parafd="para".$emaillist[$k][id];
if($en=="en"){
$body=$body."<b>".$emaillist[$k][e_name]."</b>:".$$parafd."<br>";
}
else{
$body=$body."<b>".$emaillist[$k][c_name]."</b>:".$$parafd."<br>";
}
}
}
$body=$body."<b>反馈产品</b>：".$fdtitle."<br>";
$body=$body."<b>来源IP</b>：".$ip."<br>";
$body=$body."<b>提交时间</b>：".$addtime."<br>";
$body=$body."<b>来源页面</b>：".$fromurl;
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

if($met_fd_back==1){
$fdemail= $db->get_one("SELECT * FROM $met_fdparameter WHERE c_name='$met_fd_email'");
$fdto="para".$fdemail[id];
$fdto=$$fdto;
if(PATH_SEPARATOR==':'){
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";
mail("$toemail", "$met_fd_title", "$met_fd_content", "$headers");
}else{
jmailsend($from,$fromname,$fdto,$met_fd_title,$met_fd_content,$usename,$usepassword,$smtp);
}
}
if($met_fd_type!=0){
$query = "INSERT INTO $met_feedback SET
                      fdtitle            = '$title',
					  fromurl            = '$fromurl',
					  ip                 = '$ip',
					  addtime            = '$addtime',
					  en                 = '$en', 
					  para1              = '$para1', 
					  para2              = '$para2', 
					  para3              = '$para3', 
					  para4              = '$para4', 
					  para5              = '$para5', 
					  para6              = '$para6',
					  para7              = '$para7', 
					  para8              = '$para8', 
					  para9              = '$para9', 
					  para10             = '$para10', 
					  para11             = '$para11', 
					  para12             = '$para12', 
					  para13             = '$para13', 
					  para14             = '$para14', 
					  para15             = '$para15', 
					  para16             = '$para16', 
					  para17             = '$para17',
					  para18             = '$para18', 
					  para19             = '$para19', 
					  para20             = '$para20'";
         $db->query($query);
}
if($en=="en"){
		 okinfo('index.php?en=en',"Successfully,Thanks!");
}else{
         okinfo('index.php',"反馈信息已成功提交，谢谢！");
}
}
else{
$query = "SELECT * FROM $met_fdlist order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$fdlist[]=$list;
}

$query = "SELECT * FROM $met_fdparameter where use_ok='1' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
if($list[wr_ok]=='1')$list[wr_must]="*";
switch($list[type]){
case '1';
$list[c_input]="<input name='para$list[id]' type='text' size='30' />";
$list[e_input]="<input name='para$list[id]' type='text' size='30' />";
break;
case '2';
$list[c_input]="<select name='para$list[id]'><option selected='selected' value=''>请选择</option>";
$list[e_input]="<select name='para$list[id]'><option selected='selected' value=''>Please Select</option>";
foreach($fdlist as $key=>$val){
if($val[bigid]==$list[id]){
$list[c_input]=$list[c_input]."<option value='$val[c_list]'>$val[c_list]</option>";
$list[e_input]=$list[e_input]."<option value='$val[e_list]'>$val[e_list]</option>";
}
}
$list[input]=$list[e_input]."</select>";
break;
case '3';
$list[c_input]="<textarea name='para$list[id]' cols='50' rows='5'></textarea>";
$list[e_input]="<textarea name='para$list[id]' cols='50' rows='5'></textarea>";
break;
}
$fd_para[]=$list;
if($list[wr_ok])$fdwr_list[]=$list;
}
}
$fdjs="<script language='javascript'>";
$fdjs=$fdjs."function Checkfeedback(){ ";
foreach($fdwr_list as $key=>$val){
$fdjs=$fdjs."if (document.myform.para$val[id].value.length == 0) {";
if($en=="en"){
$fdjs=$fdjs."alert('$val[e_name] is Null');";
}else{
$fdjs=$fdjs."alert('$val[c_name]不能为空');";
}
$fdjs=$fdjs."document.myform.para$val[id].focus();";
$fdjs=$fdjs."return false;}";
}
$fdjs=$fdjs."}</script>";

require_once '../include/head.php';
if($en=="en"){
$show[e_description]=$met_e_keywords;
$show[e_keywords]=$met_e_keywords;
$e_title_keywords=$navtitle."--".$e_title_keywords;
include template('e_feedback');
}
else{
$show[c_description]=$met_c_keywords;
$show[c_keywords]=$met_c_keywords;
$c_title_keywords=$navtitle."--".$c_title_keywords;

include template('feedback');
}

footer();
?>