<?php
# 文件名称:fdeditor.php 2009-08-20 11:57:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once 'login_check.php';

$settings = parse_ini_file('../feedback/config.inc.php');
@extract($settings);
$classaccess= $db->get_one("SELECT * FROM $met_column WHERE module='8'");
$metaccess=$classaccess[access];
$class1=$classaccess[id];
require_once '../include/head.php';
$class1_info=$class_list[$class1];
$fromurl=$_SERVER['HTTP_REFERER'];
$ip=$m_user_ip;
if($title==""){
$navtitle=($lang=="en")?$met_e_fdtable:(($lang=="other")?$met_o_fdtable:$met_c_fdtable);
$title=$navtitle;
}
else{
$c_navtitle1="[".$title."]".$met_c_fdtable;
$e_navtitle1="[".$title."]".$met_e_fdtable;
$o_navtitle1="[".$title."]".$met_o_fdtable;
$navtitle=($lang=="en")?$e_navtitle1:(($lang=="other")?$o_navtitle1:$c_navtitle1);
}

if($action=="editor"){

	//登陆验证码判断
     if($met_memberlogin_code==1){
         require_once 'captcha.class.php';
         $Captcha= new  Captcha();
         if(!$Captcha->CheckCode($code)){
         echo("<script type='text/javascript'> alert('$lang_membercode');window.history.back();</script>");
		       exit;
         }
     }

$addtime=$m_now_date;
$ipok=$db->get_one("select * from $met_feedback where ip='$ip' order by addtime desc");
$time1 = strtotime($ipok[addtime]);
$time2 = strtotime($m_now_date);
$timeok= (float)($time2-$time1);

if($timeok<=$met_fd_time){
$fd_time="{$lang_Feedback1}".$met_fd_time."{$lang_Feedback2}";
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

$c_fd_word="{$lang_Feedback3}[".$fd_word."]！";
$e_fd_word="[".$fd_word."] {$lang_Feedback3}";
$o_fd_word="[".$fd_word."] {$lang_Feedback3}";
$fd_word=($_GET[lang]=="en")?$e_fd_word:(($_GET[lang]=="other")?$o_fd_word:$c_fd_word);
if($fdok==true)okinfo('javascript:history.back();',$fd_word);

require_once '../feedback/uploadfile_save.php';

for($i=21;$i<25;$i++){
$para="para".$i;
for($j=1;$j<=$$para;$j++){
$parad="para".$i."_".$j;
$parad1=$$parad;
$fdpara=($parad1=="")?$fdpara:$fdpara.$parad1.",";
}
$$para=$fdpara;
$fdpara="";
}
if($met_fd_type==0 or $met_fd_type==2){
$from=$met_fd_usename;
$fromname=$met_fd_fromname;
$to=$met_fd_to;
$usename=$met_fd_usename;
$usepassword=$met_fd_password;
$smtp=$met_fd_smtp;

$fdclass1= $db->get_one("SELECT * FROM $met_fdparameter WHERE c_name='$met_fd_class'");
$fdclass2="para".$fdclass1[id];
$fdclass=$$fdclass2;

$title=$fdclass;

$query = "SELECT * FROM $met_fdparameter order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$fdbacklist[]=$list;
}
for($k=0;$k<count($fdbacklist);$k++){
if($fdbacklist[$k][use_ok]==1){
$parafd="para".$fdbacklist[$k][id];
$emailname=$lang=="en"?$fdbacklist[$k][e_name]:($lang=="other"?$fdbacklist[$k][o_name]:$fdbacklist[$k][c_name]);
if($fdbacklist[$k][type]!=5)
{
$body=$body."<b>".$emailname."</b>:".$$parafd."<br>";
}
if($fdbacklist[$k][type]==5)
{
if($fdbacklist[$k][type]==5 && $$parafd=='')
{
$tmppara="back".$parafd;
$$parafd=$$tmppara;
}

$x=explode('/', $fromurl);
unset($x[count($x)-1]);
unset($x[count($x)-1]);
$path = implode('/', $x).'/upload/file/';
$parafd="para".$fdbacklist[$k][id];
$body=$body."<b>".$emailname."</b>:<a href=".$path.$$parafd.">{$$parafd}</a><br>";
}
}
}

$body=$body."<b>{$lang_FeedbackProduct}</b>：".$fdtitle."<br>";
$body=$body."<b>{$lang_IP}</b>：".$ip."<br>";
$body=$body."<b>{$lang_AddTime}</b>：".$addtime."<br>";
$body=$body."<b>{$lang_SourcePage}</b>：".$fromurl;
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
mail("$fdto", "$met_fd_title", "$met_fd_content", "$headers");
}else{
jmailsend($from,$fromname,$fdto,$met_fd_title,$met_fd_content,$usename,$usepassword,$smtp);
}

}

$query = "update $met_feedback SET ";

for($k=0;$k<count($fdbacklist);$k++){
if($fdbacklist[$k][use_ok]==1){
$parafd="para".$fdbacklist[$k][id];
$query = $query."     $parafd            = '{$$parafd}',";
}
}

$query = $query."
                      fdtitle            = '$title',
					  fromurl            = '$fromurl',
					  ip                 = '$ip',
					  addtime            = '$addtime'
					  where id='$id'";
$db->query($query);
okinfo('feedback.php?lang='.$lang,$lang_js21);
}
else
{

$feedback_list=$db->get_one("select * from $met_feedback where id='$id'");
if($feedback_list[readok]==1) okinfo('feedback.php?lang='.$lang,$lang_js24);

if(!$feedback_list){
okinfo('feedback.php?lang='.$lang,$lang_loginNoid);
}

$query = "SELECT * FROM $met_fdlist order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$list['list']=($lang=="en")?$list[e_list]:(($lang=="other")?$list[o_list]:$list[c_list]);
$fdlist[]=$list;
}


$query = "SELECT * FROM $met_fdparameter where use_ok='1' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
if($list[wr_ok]=='1')$list[wr_must]="*";
$para="para".$list[id];
$list[name]=($lang=="en")?$list[e_name]:(($lang=="other")?$list[o_name]:$list[c_name]);
switch($list[type]){
case '1';
$list[input]="<input name='para$list[id]' type='text' size='30' value='{$feedback_list[$para]}' />";

break;
case '2';
$list[input]="<select name='para$list[id]'><option value=''>{$lang_Choice}</option>";
foreach($fdlist as $key=>$val){
if($val[bigid]==$list[id]){
$select2=$feedback_list[$para]==$val['list']?"selected='selected'":"";
$list[input]=$list[input]."<option value='$val[list]' $select2>$val[list]</option>";
}
}
$list[input]=$list[input]."</select>";
break;
case '3';
$list[input]="<textarea name='para$list[id]' cols='50' rows='5'>{$feedback_list[$para]}</textarea>";
break;
case '4';
$i=0;
foreach($fdlist as $key=>$val){
if($val[bigid]==$list[id]){
if(strstr($feedback_list[$para],$val['list'] )) $select4="checked='checked'";
else $select4="";
$i++;
$list[input]=$list[input]."<input name='para$list[id]_$i' type='checkbox' value='$val[list]' $select4 />$val[list]&nbsp;&nbsp;";
}
}
$list[input]=$list[input]."<input name='para$list[id]' type='hidden' value='$i' />";
$lagernum[$list[id]]=$i;
break;
case '5';
$tmpurl=$feedback_list[$para]!=''?"<a href='../upload/file/{$feedback_list[$para]}'>$lang_memberFile</a>":"";
$list[input]=" $tmpurl <input name='para$list[id]' type='file' class='input' size='20' maxlength='200'><input name='backpara$list[id]' type='hidden' value='{$feedback_list[$para]}'>";

break;
}

$fd_para[]=$list;
if($list[wr_ok])$fdwr_list[]=$list;
}


$fdjs="<script language='javascript'>";
$fdjs=$fdjs."function Checkfeedback(){ ";
foreach($fdwr_list as $key=>$val){
if($val[type]!=4){
$fdjs=$fdjs."if (document.myform.para$val[id].value.length == 0) {";
 if($_GET[lang]=="en"){
 $fdjs=$fdjs."alert('$val[e_name] {$lang_Empty}');";
  }else if($_GET[lang]=="en"){
 $fdjs=$fdjs."alert('$val[o_name] {$lang_Empty}');";
  }else{
  $fdjs=$fdjs."alert('$val[c_name]{$lang_Empty}');";
  }
 $fdjs=$fdjs."document.myform.para$val[id].focus();";
 $fdjs=$fdjs."return false;}";
}else{
 $lagerinput="";
 for($j=1;$j<=$lagernum[$val[id]];$j++){
 $lagerinput=$lagerinput."document.myform.para$val[id]_$j.checked||";
 }
 $lagerinput=$lagerinput."false";
 $fdjs=$fdjs."if(!($lagerinput)){";
 if($_GET[lang]=="en"){
 $fdjs=$fdjs."alert('$val[e_name] {$lang_Empty}');";
 }else if($_GET[lang]=="other"){
 $fdjs=$fdjs."alert('$val[o_name] {$lang_Empty}');";
 }else{
 $fdjs=$fdjs."alert('$val[c_name]{$lang_Empty}');";
 }
 $fdjs=$fdjs."document.myform.para$val[id]_1.focus();";
 $fdjs=$fdjs."return false;}";
}
}
$fdjs=$fdjs."}</script>";


$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('feedback_editor');
footermember();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>