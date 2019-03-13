<?php
# 文件名称:feedbackindex.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
$settings = parse_ini_file('config.inc.php');
@extract($settings);
$classaccess= $db->get_one("SELECT * FROM $met_column WHERE module='8'");
$metaccess=$classaccess[access];
$class1=$classaccess[id];
require_once '../include/head.php';
$class1_info=$class_list[$class1];
$fromurl=$_SERVER['HTTP_REFERER'];
$ip=$m_user_ip;
$met_fd_title=($lang=="en")?$met_e_fd_title:(($lang=="other")?$met_o_fd_title:$met_c_fd_title);
$met_fd_content=($lang=="en")?$met_e_fd_content:(($lang=="other")?$met_o_fd_content:$met_c_fd_content);
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
if($action=="add"){
$addtime=$m_now_date;
$ipok=$db->get_one("select * from $met_feedback where ip='$ip' order by addtime desc");
if($ipok)
$time1 = strtotime($ipok[addtime]);
else
$time1 = 0;
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

require_once 'uploadfile_save.php';

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

$title=$fdclass."--".$fdtitle;

$query = "SELECT * FROM $met_fdparameter order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$emaillist[]=$list;
}
for($k=0;$k<count($emaillist);$k++){
if($emaillist[$k][use_ok]==1){
$parafd="para".$emaillist[$k][id];
$emailname=$lang=="en"?$emaillist[$k][e_name]:($lang=="other"?$emaillist[$k][o_name]:$emaillist[$k][c_name]);
if($emaillist[$k][type]!=5)
{
$body=$body."<b>".$emailname."</b>:".$$parafd."<br>";
}
if($emaillist[$k][type]==5)
{
$x=explode('/', $fromurl);
unset($x[count($x)-1]);
unset($x[count($x)-1]);
$path = implode('/', $x).'/upload/file/';
$parafd="para".$emaillist[$k][id];
$body=$body."<b>".$emailname."</b>:<a href=".$path.$$parafd.">{$$parafd}</a><br>";
}
}
}


$body=$body."<b>{$lang_FeedbackProduct}</b>:".$fdtitle."<br>";
$body=$body."<b>{$lang_IP}</b>:".$ip."<br>";
$body=$body."<b>{$lang_AddTime}</b>:".$addtime."<br>";
$body=$body."<b>{$lang_SourcePage}</b>:".$fromurl;
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

if($met_fd_type!=0){
if(!isset($metinfo_member_name) || $metinfo_member_name=='') $metinfo_member_name=0;

$query = "INSERT INTO $met_feedback SET
                      fdtitle            = '$title',
					  fromurl            = '$fromurl',
					  ip                 = '$ip',
					  addtime            = '$addtime',
					  customerid         = '$metinfo_member_name',
					  en                 = '$_GET[lang]', 
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
					  para20             = '$para20',
					  para21             = '$para21', 
					  para22             = '$para22',
					  para23             = '$para23', 
					  para24             = '$para24', 
					  para25             = '$para25',
					  para26             = '$para26',
					  para27             = '$para27' ";
			
         $db->query($query);
}
if($met_webhtm){
$returnurl=($lang=="en")?'index'.$met_e_htmtype:(($lang=="other")?'index'.$met_o_htmtype:'index'.$met_c_htmtype);
}else{
$returnurl=($lang=="en")?'index.php?lang=en':(($lang=="other")?'index.php?lang=other':'index.php');
}
okinfo($returnurl,"{$lang_Feedback4}");
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
$list[o_input]="<input name='para$list[id]' type='text' size='30' />";
break;
case '2';
$list[c_input]="<select name='para$list[id]'><option selected='selected' value=''>{$lang_Choice}</option>";
$list[e_input]="<select name='para$list[id]'><option selected='selected' value=''>{$lang_Choice}</option>";
$list[o_input]="<select name='para$list[id]'><option selected='selected' value=''>{$lang_Choice}</option>";
foreach($fdlist as $key=>$val){
if($val[bigid]==$list[id]){
$list[c_input]=$list[c_input]."<option value='$val[c_list]'>$val[c_list]</option>";
$list[e_input]=$list[e_input]."<option value='$val[e_list]'>$val[e_list]</option>";
$list[o_input]=$list[o_input]."<option value='$val[o_list]'>$val[o_list]</option>";
}
}
$list[input]=$list[e_input]."</select>";
break;
case '3';
$list[c_input]="<textarea name='para$list[id]' cols='50' rows='5'></textarea>";
$list[e_input]="<textarea name='para$list[id]' cols='50' rows='5'></textarea>";
$list[o_input]="<textarea name='para$list[id]' cols='50' rows='5'></textarea>";
break;
case '4';
$i=0;
foreach($fdlist as $key=>$val){
if($val[bigid]==$list[id]){
$i++;
$list[c_input]=$list[c_input]."<input name='para$list[id]_$i' class='checboxcss' type='checkbox' value='$val[c_list]' />$val[c_list]&nbsp;&nbsp;";
$list[e_input]=$list[e_input]."<input name='para$list[id]_$i' class='checboxcss' type='checkbox' value='$val[e_list]' />$val[e_list]&nbsp;&nbsp;";
$list[o_input]=$list[o_input]."<input name='para$list[id]_$i' class='checboxcss' type='checkbox' value='$val[o_list]' />$val[o_list]&nbsp;&nbsp;";
}
}
$list[c_input]=$list[c_input]."<input name='para$list[id]' type='hidden' value='$i' />";
$list[e_input]=$list[e_input]."<input name='para$list[id]' type='hidden' value='$i' />";
$list[o_input]=$list[o_input]."<input name='para$list[id]' type='hidden' value='$i' />";
$lagernum[$list[id]]=$i;
break;
case '5';
$list[c_input]="<input name='para$list[id]' type='file' class='input' size='20' maxlength='200' >";
$list[e_input]="<input name='para$list[id]' type='file' class='input' size='20' maxlength='200' >";
$list[o_input]="<input name='para$list[id]' type='file' class='input' size='20' maxlength='200' >";
break;
}
$fd_para[]=$list;
if($list[wr_ok])$fdwr_list[]=$list;
}
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

foreach($fd_para as $key=>$val){
$fd_para[$key][name]=($lang=="en")?$val[e_name]:(($lang=="other")?$val[o_name]:$val[c_name]);
$fd_para[$key][input]=($lang=="en")?$val[e_input]:(($lang=="other")?$val[o_input]:$val[c_input]);
}

$class_info[e_name]=$class1_info[e_name];
$class_info[c_name]=$class1_info[c_name];
$class_info[o_name]=$class1_info[o_name];

$class_info[name]=($lang=="en")?$class_info[e_name]:(($lang=="other")?$class_info[o_name]:$class_info[c_name]);
     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$navtitle."--".$met_title;

require_once '../public/php/methtml.inc.php';

     $methtml_feedback.=$fdjs;
     $methtml_feedback.="<form enctype='multipart/form-data' method='POST' name='myform' onSubmit='return Checkfeedback();' action='index.php?action=add&lang=".$_GET[lang]."' target='_self'>\n";
     $methtml_feedback.="<table cellpadding='2' cellspacing='1'  bgcolor='#F2F2F2' align='center' class='feedback_table' >\n";
    foreach($fd_para as $key=>$val){
     $methtml_feedback.="<tr class=feedback_tr bgcolor='#FFFFFF'    height='25'  >\n";
     $methtml_feedback.="<td class=feedback_td1 align='right' width='20%'>".$val[name].":</td>\n";
     $methtml_feedback.="<td class=feedback_input width='70%'>".$val[input]."</td>\n";
     $methtml_feedback.="<td class=feedback_info style='color:#990000'>".$val[wr_must]."</td>\n";
     $methtml_feedback.="</tr>\n";
    }
     $methtml_feedback.="<tr><td colspan='3' bgcolor='#FFFFFF' class=feedback_submit align='center'>\n";
     $methtml_feedback.="<input type='hidden' name='fdtitle' value='".$title."' />\n";
     $methtml_feedback.="<input type='hidden' name='fromurl' value='".$fromurl."' />\n";
     $methtml_feedback.="<input type='hidden' name='lang' value='".$lang."' />\n";
     $methtml_feedback.="<input type='hidden' name='ip' value='".$ip."' />\n";
     $methtml_feedback.="<input type='submit' name='Submit' value='".$lang_Submit."' class='tj'>\n";
     $methtml_feedback.="<input type='reset' name='Submit' value='".$lang_Reset."' class='tj'></td></tr>\n";
     $methtml_feedback.="</table>\n";
     $methtml_feedback.="</form>\n";

if(file_exists("templates/".$met_skin_user."/e_feedback.html")){
   if($lang=="en"){
     $show[e_description]=$class_info[e_description]?$class_info[e_description]:$met_e_keywords;
     $show[e_keywords]=$class_info[e_keywords]?$class_info[e_keywords]:$met_e_keywords;
     $e_title_keywords=$navtitle."--".$met_e_webname;
     include template('e_feedback');
	}else{
	 $show[c_description]=$class_info[c_description]?$class_info[c_description]:$met_c_keywords;
     $show[c_keywords]=$class_info[c_keywords]?$class_info[c_keywords]:$met_c_keywords;
     $c_title_keywords=$navtitle."--".$met_c_webname;
	 include template('feedback');
	 }
}else{
include template('feedback');
}
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>