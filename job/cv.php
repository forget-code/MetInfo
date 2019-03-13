<?php
# 文件名称:cv.php 2009-08-18 09:56:13
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
$admin_index=FALSE;
require_once '../include/common.inc.php';
$classaccess= $db->get_one("SELECT * FROM $met_column WHERE module='6'");
$metaccess=$classaccess[access];
$class1=$classaccess[id];
$cv[c_url]=$met_webhtm?"cv".$met_c_htmtype:"cv.php";
$cv[e_url]=$met_webhtm?"cv".$met_e_htmtype:"cv.php?lang=en";
$cv[o_url]=$met_webhtm?"cv".$met_o_htmtype:"cv.php?lang=other";
if($met_submit_type==1){
   $cv[url]=($lang=="en")?"cv.php?lang=en&selectedjob=":(($lang=="other")?"cv.php?lang=other&selectedjob=":"cv.php?selectedjob=");
   }else{
   $cv[url]=($lang=="en")?$cv[e_url]:(($lang=="other")?$cv[o_url]:$cv[c_url]);
   }
require_once '../include/head.php';

$query = "SELECT * FROM $met_parameter where use_ok='1' and type=10000 order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
if($list[wr_ok]=='1')
{
	$list[wr_must]="*";
	$fdwr_list[]=$list;
}
$list[mark]=$lang=="en"?$list['e_mark']:($lang=="other"?$list['o_mark']:$list['c_mark']);
$cv_para[]=$list;
}
$fdjs="<script language='javascript'>";
$fdjs=$fdjs."function Checkcv(){ ";
foreach($fdwr_list as $key=>$val){
$fdjs=$fdjs."if (document.myform.$val[name].value.length == 0) {";
 if($lang=="en"){
 $fdjs=$fdjs."alert('$val[e_mark] is Null');";
  }else if($lang=="other"){
  $fdjs=$fdjs."alert('$val[o_mark]$lang_Empty');";
  }else
  {
  $fdjs=$fdjs."alert('$val[c_mark]$lang_Empty');";
  }
 $fdjs=$fdjs."document.myform.$val[name].focus();";
 $fdjs=$fdjs."return false;}";
}
$fdjs=$fdjs."}</script>";


	$selectjob = "";
	$serch_sql=" where 1=1 ";
	$item=($lang=="en")?"e_position":($lang=="other"?"o_position":"c_position");
	$serch_sql .=" and $item<>'' ";
	$metinfo_member_type=intval($metinfo_member_type);
	$query = "SELECT id,$item FROM $met_job $serch_sql and  access <= $metinfo_member_type and ((TO_DAYS(NOW())-TO_DAYS(`addtime`)< useful_life) OR useful_life=0)";
    
	$result = $db->query($query);
	 while($list= $db->fetch_array($result)){
	 $selectok=$selectedjob==$list[id]?"selected='selected'":"";	 
	 $selectjob.="<option value='$list[id]' $selectok>{$list[$item]}</option>";
	 }
	 
     $show[description]=$met_keywords;
     $show[keywords]=$met_keywords;
	 $met_title=$lang_cvtitle."--".$met_title;
     $nav_list2[$class1][0]=$class1_info=$class_list[$class1];
     $nav_list2[$class1][1]=array('id'=>10004,'url'=>$cv[url],'name'=>$lang_cvtitle,'c_url'=>$cv[c_url],'e_url'=>$cv[e_url],'o_url'=>$cv[o_url],'c_name'=>$lang_cvtitle,'e_name'=>$lang_cvtitle,'o_name'=>$lang_cvtitle);
     require_once '../public/php/methtml.inc.php';
	 $nav_x[name]=$lang_cvtitle;
	 
	 
     $methtml_cv.="<script type='text/javascript'>function pressCaptcha(obj){obj.value = obj.value.toUpperCase();}</script>\n";
     $methtml_cv.=$fdjs;
     $methtml_cv.="<form  enctype='multipart/form-data' method='POST' onSubmit='return Checkcv();' name='myform' action='save.php?action=add' target='_self'>\n";
     $methtml_cv.="<input type='hidden' name='lang' value='".$lang."' />\n";
     $methtml_cv.="<table cellpadding='2' cellspacing='1' border='0' class='cv_table'>\n";
     $methtml_cv.="<tr class='cv_tr'>\n"; 
     $methtml_cv.="<td class='cv_td1'>".$lang_memberPosition.":</td>\n";
     $methtml_cv.="<td class='cv_select'><select name='jobid' id='jobid'>".$selectjob."</select></td>\n";
     $methtml_cv.="<td class='cv_info'>*</td>\n";
     $methtml_cv.="</tr>\n";
    foreach($cv_para as $key=>$val){
     if($val[maxsize]==200 ){
     $methtml_cv.="<tr class='cv_tr'> \n";
     $methtml_cv.="<td class='cv_td1'>".$val[mark].":</td>\n";
     $methtml_cv.="<td class='cv_input'><input name='".$val[name]."' type='text' class='input' size='40' maxlength='250'></td>\n";
     $methtml_cv.="<td class='cv_info'>".$val[wr_must]."</td>\n";
     $methtml_cv.="</tr>\n";
     }else if($val[maxsize]==255){
     $methtml_cv.="<tr class='cv_tr'> \n";
     $methtml_cv.="<td class='cv_td1'>".$val[mark].":</td>\n";
     $methtml_cv.="<td class='cv_input'><input name='".$val[name]."' type='file' class='input' size='20' maxlength='200'></td>\n";
     $methtml_cv.="<td class='cv_info'>".$val[wr_must]."</td>\n";
     $methtml_cv.="</tr>\n";
    }else{
     $methtml_cv.="<tr class='cv_tr'> \n";
     $methtml_cv.="<td class='cv_td1'>".$val[mark].":</td>\n";
     $methtml_cv.="<td class='cv_input'><textarea name='".$val[name]."' cols='60' rows='5'></textarea></td>\n";
     $methtml_cv.="<td class='cv_info'>".$val[wr_must]."</td>\n";
     $methtml_cv.="</tr>\n";
    }
   }
     $methtml_cv.="<tr class='cv_tr'> \n";   
     $methtml_cv.="<td class='cv_td1'>".$lang_memberImgCode.":</b></td>\n";
     $methtml_cv.="<td class='cv_code' colspan='2'><input name='code' onKeyUp='pressCaptcha(this)' type='text' class='code' id='code' size='6' maxlength='8' style='width:50px' />";
     $methtml_cv.="<img align='absbottom' src='ajax.php?action=code'  onclick=this.src='ajax.php?action=code&'+Math.random() style='cursor: pointer;' title='".$lang_memberTip1."'/>";
     $methtml_cv.="</td>\n";
     $methtml_cv.="</tr>\n";
     $methtml_cv.="<tr class='cv_tr'>\n"; 
     $methtml_cv.="<td class='cv_td1'></td>\n";
     $methtml_cv.="<td class='cv_submit' colspan='2'><input type='submit' name='Submit' value='".$lang_Submit."' class='tj'><input type='reset' name='Submit' value='".$lang_Reset."' class='tj'> </td>\n";
     $methtml_cv.="</tr>";		
     $methtml_cv.="</table>";
     $methtml_cv.="</form>";
if(file_exists("../templates/".$met_skin_user."/cv.html")){
    include template('cv');
}else{
 include 'templates/met/cv.html';
 }
footer();

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>