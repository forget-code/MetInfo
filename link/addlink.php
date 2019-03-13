<?php
# 文件名称:addlink.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
$message_column=$db->get_one("select * from $met_column where module='9'");
$metaccess=$message_column[access];
$class1=$message_column[id];
require_once '../include/head.php';
$class1_info=$class_list[$class1];
$navtitle=($lang=="en")?$message_column[e_name]:(($lang=="other")?$message_column[o_name]:$message_column[c_name]);


$link_lang=$lang;
if($action=="add"){
if($_GET[lang]=="en")
{$e_webname=$webname;$c_webname="";$o_webname="";$e_info=$info;$c_info="";$o_info="";}
else if($_GET[lang]=="other")
{$o_webname=$webname;$e_webname="";$c_webname="";$o_info=$info;$e_info="";$c_info="";}
else
{$c_webname=$webname;$e_webname="";$o_webname="";$c_info=$info;$e_info="";$o_info="";}
$query = "INSERT INTO $met_link SET
                      c_webname            = '$c_webname',
                      e_webname            = '$e_webname',
					  c_info               = '$c_info',
					  e_info               = '$e_info',
					  link_type            = '$link_type',
					  weburl               = '$weburl',
					  weblogo              = '$weblogo',
					  contact              = '$contact',
					  orderno              = '$orderno',
					  com_ok               = '$com_ok',
					  show_ok              = '$show_ok', 
					  link_lang            = '$link_lang', 
					  addtime              = '$m_now_date'";
         $db->query($query);
if($met_webhtm){
$returnurl=($lang=="en")?'addlink'.$met_e_htmtype:(($lang=="other")?'addlink'.$met_o_htmtype:'addlink'.$met_c_htmtype);
}else{
$returnurl=($lang=="en")?'addlink.php?lang=en':(($lang=="other")?'addlink.php?lang=other':'addlink.php');
}
okinfo($returnurl,"{$lang_MessageInfo2}");

}
else{


$fdjs="<script language='javascript'>";
$fdjs=$fdjs."function Checklink(){ ";

$fdjs=$fdjs."if (document.myform.webname.value.length == 0) {";
$fdjs=$fdjs."alert('{$lang_LinkInfo2}');";
$fdjs=$fdjs."document.myform.webname.focus();";

$fdjs=$fdjs."return false;}";
$fdjs=$fdjs."if (document.myform.weburl.value.length == 0 || document.myform.weburl.value == 'http://') {";

$fdjs=$fdjs."alert('{$lang_LinkInfo3}');";

$fdjs=$fdjs."document.myform.weburl.focus();";
$fdjs=$fdjs."return false;}";
$fdjs=$fdjs."}</script>";

require_once '../public/php/methtml.inc.php';

$methtml_addlink.=$fdjs;
$methtml_addlink.="<table width='90%' cellpadding='2' cellspacing='1' bgcolor='#F2F2F2' align='center' class=addlink_table>\n";
$methtml_addlink.="<tr class='addlink_tr'><td width='20%' height='25' align='left' bgcolor='#FFFFFF' colspan='3' class='addlink_title'><b>".$lang_Info4."</b></td></tr>\n";
$methtml_addlink.="<tr class='addlink_tr'>\n";
$methtml_addlink.="<td width='20%' height='25' align='right' bgcolor='#FFFFFF' class='addlink_td1'>".$lang_OurWebName."</td>\n";
$methtml_addlink.="<td width='70%' bgcolor='#FFFFFF' lass='addlink_td2'>".$met_linkname."</td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' style='color:#990000'></td>\n";
$methtml_addlink.="</tr>\n";
$methtml_addlink.="<tr class='addlink_tr'>\n";
$methtml_addlink.="<td align='right' bgcolor='#FFFFFF' class='addlink_td1'>".$lang_OurWebUrl."</td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' lass='addlink_td2'>".$met_weburl."</td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' style='color:#990000'></td>\n";
$methtml_addlink.="</tr>\n";
$methtml_addlink.="<tr class='addlink_tr'>\n";
$methtml_addlink.="<td align='right' bgcolor='#FFFFFF' class='addlink_td1'>".$lang_OurWebLOGO."</td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' lass='addlink_td2'><img src='".$met_logo."' /></td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' style='color:#990000'></td>\n";
$methtml_addlink.="</tr>\n";
$methtml_addlink.="<tr class='addlink_tr'>\n";
$methtml_addlink.="<td align='right' bgcolor='#FFFFFF' class='addlink_td1'>".$lang_OurWebKeywords."</td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' class='addlink_td2'>".$met_title_keywords."</td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' style='color:#990000'></td>\n";
$methtml_addlink.="</tr>\n";
$methtml_addlink.="</table>\n";

$methtml_addlink.="<form method='POST' name='myform' onSubmit='return Checklink();' action='addlink.php?action=add' target='_self'>\n";
$methtml_addlink.="<table width='90%' cellpadding='2' cellspacing='1' bgcolor='#F2F2F2' align='center' class=addlink_table >\n";
$methtml_addlink.="<tr class='addlink_tr'>\n";
$methtml_addlink.="<td width='20%' height='25' align='right' bgcolor='#FFFFFF' class='addlink_td1'>".$lang_YourWebName."</td>\n";
$methtml_addlink.="<td width='70%' bgcolor='#FFFFFF' class='addlink_input'><input name='webname' type='text' size='30' /></td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' style='color:#990000' class='addlink_info'>*</td>\n";
$methtml_addlink.="</tr>\n";
$methtml_addlink.="<tr class='addlink_tr'>\n";
$methtml_addlink.="<td class='addlink_td1' align='right' bgcolor='#FFFFFF'>".$lang_YourWebUrl."</td>\n";
$methtml_addlink.="<td width='70%' bgcolor='#FFFFFF' class='addlink_input'><input name='weburl' type='text' size='30' value='http://' /></td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' style='color:#990000' class='addlink_info'>*</td>\n";
$methtml_addlink.="</tr>\n";
$methtml_addlink.="<tr class='addlink_tr'>\n";
$methtml_addlink.="<td class='addlink_td1' align='right' bgcolor='#FFFFFF'>".$lang_LinkType."</td>\n";
$methtml_addlink.="<td width='70%' bgcolor='#FFFFFF' class='addlink_input'><input name='link_type' type='radio' value='0'  checked='checked' style='border:0px;' />{$lang_TextLink}  <input name='link_type' type='radio' value='1' style='border:0px;' />{$lang_PictureLink}</td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' style='color:#990000' class='addlink_info'>*</td>\n";
$methtml_addlink.="</tr>\n";
$methtml_addlink.="<tr class='addlink_tr'>\n";
$methtml_addlink.="<td class='addlink_td1' align='right' bgcolor='#FFFFFF'>".$lang_YourWebLOGO."</td>\n";
$methtml_addlink.="<td width='70%' bgcolor='#FFFFFF' class='addlink_input'><input name='weblogo' type='text' size='30' value='http://'/></td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' style='color:#990000' class='addlink_info'></td>\n";
$methtml_addlink.="</tr>\n";
$methtml_addlink.="<tr class='addlink_tr'>\n";
$methtml_addlink.="<td class='addlink_td1' align='right' bgcolor='#FFFFFF'>".$lang_YourWebKeywords."</td>\n";
$methtml_addlink.="<td width='70%' bgcolor='#FFFFFF' class='addlink_input'><input name='info' type='text' size='30' /></td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' style='color:#990000' class='addlink_info'></td>\n";
$methtml_addlink.="</tr>\n";
$methtml_addlink.="<tr class='addlink_tr'>\n";
$methtml_addlink.="<td class='addlink_td1' align='right' bgcolor='#FFFFFF'>".$lang_Contact."</td>\n";
$methtml_addlink.="<td width='70%' bgcolor='#FFFFFF' class='addlink_input'><textarea name='contact' cols='50' rows='6'></textarea></td>\n";
$methtml_addlink.="<td bgcolor='#FFFFFF' style='color:#990000' class='addlink_info'></td>\n";
$methtml_addlink.="</tr>\n";
$methtml_addlink.="<tr class='addlink_tr'><td colspan='3' bgcolor='#FFFFFF' align='center' class='addlink_submit'>\n";
$methtml_addlink.="<input type='submit' name='Submit' value='".$lang_Submit."' class='tj'>\n";
$methtml_addlink.="<input type='hidden' name='lang' value='".$lang."'>\n";
$methtml_addlink.="<input type='reset' name='Submit' value='".$lang_Reset."' class='tj'></td></tr>\n";
$methtml_addlink.="</table>\n";
$methtml_addlink.="</form>\n";


if(file_exists("templates/".$met_skin_user."/e_addlink.html")){
   if($lang=="en"){
     $show[e_description]=$class_info[e_description]?$class_info[e_description]:$met_e_keywords;
     $show[e_keywords]=$class_info[e_keywords]?$class_info[e_keywords]:$met_e_keywords;
     $e_title_keywords=$navtitle."--".$met_e_webname;
     include template('e_addlink');
	}else{
	 $show[c_description]=$class_info[c_description]?$class_info[c_description]:$met_c_keywords;
     $show[c_keywords]=$class_info[c_keywords]?$class_info[c_keywords]:$met_c_keywords;
     $c_title_keywords=$navtitle."--".$met_c_webname;
	 include template('addlink');
	 }
}else{
include template('addlink');
}
footer();

}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>