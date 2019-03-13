<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$query = "select * from $met_parameter where lang='$lang' and module='".$met_class[$class1][module]."' and (class1=$class1 or class1=0) order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)){
$paralist[$list[type]][]=$list;
 if($list[type]==2 or $list[type]==4 or $list[type]==6){
  $query1 = "select * from $met_list where lang='$lang' and bigid='".$list[id]."' order by no_order";
  $result1 = $db->query($query1);
  while($list1 = $db->fetch_array($result1)){
  $paravalue[$list[id]][]=$list1;
  }}
 if($list[wr_ok])$para_listwr[]=$list;
$para_list[]=$list;
}
if($action=="editor"){
$download_list=$db->get_one("select * from $met_download where id='$id'");
if($met_member_use){
$lev=$met_class[$download_list['class1']][access];
switch($download_list['access'])
{
	case '1':$access1="selected='selected'";break;
	case '2':$access2="selected='selected'";break;
	case '3':$access3="selected='selected'";break;
	default:$access0="selected='selected'";break;
}
switch($download_list['downloadaccess'])
{
	case '1':$downloadaccess1="selected='selected'";break;
	case '2':$downloadaccess2="selected='selected'";break;
	case '3':$downloadaccess3="selected='selected'";break;
	default:$downloadaccess0="selected='selected'";break;
}
}
if(!$download_list){
okinfo('index.php?lang='.$lang,$lang_dataerror);
}

$query = "select * from $met_plist where module='4' and listid='$id'";
$result = $db->query($query);
while($list = $db->fetch_array($result)){
$nowpara="para".$list[paraid];
$download_list[$nowpara]=$list[info];
$nowparaname="";
if($list[imgname]<>"")$nowparaname=$nowpara."name";$download_list[$nowparaname]=$list[imgname];
}

$class1=$download_list[class1];

if($download_list[new_ok]==1)$new_ok="checked='checked'";
if($download_list[com_ok]==1)$com_ok="checked='checked'";
if($download_list[top_ok]==1)$top_ok="checked='checked'";
$class2[$download_list[class2]]="selected='selected'";
$class3[$download_list[class3]]="selected='selected'";	
}else{
$download_list[issue]=$metinfo_admin_name;
$download_list[hits]=0;
$download_list[addtime]=$m_now_date;
$download_list[access]="0";
$lang_editinfo=$lang_addinfo;
$lev=$met_class[$class1][access];
}
	$i=0;
echo "<script language = 'JavaScript'>\n";
echo "var onecount;\n";
echo "subcat = new Array();\n";
foreach($met_class22[$class1] as $key=>$vallist){
echo "subcat[".$i."] = new Array('".$vallist[name]."','".$vallist[bigclass]."','".$vallist[id]."','".$vallist[access]."');\n";
	 $i=$i+1;
  foreach($met_class3[$vallist[id]] as $key=>$vallist3){
      echo "subcat[".$i."] = new Array('".$vallist3[name]."','".$vallist3[bigclass]."','".$vallist3[id]."','".$vallist3[access]."');\n";
	 $i=$i+1;
    }
}
echo "onecount=".$i.";\n";

$checkjs=$checkjs."function Checkdownload(){ \n";
$checkjs=$checkjs."if (document.myform.title.value==null || document.myform.title.value.length == 0){\n";
$checkjs=$checkjs."	alert(user_msg['js13']);\n";
$checkjs=$checkjs."	document.myform.title.focus();\n";
$checkjs=$checkjs."	return false;\n";
$checkjs=$checkjs."}\n";
$checkjs=$checkjs."if (document.myform.class2.value =='0') {\n";
$checkjs=$checkjs."	alert(user_msg['js14']);\n";
$checkjs=$checkjs."	document.myform.class2.focus();\n";
$checkjs=$checkjs."	return false;\n";
$checkjs=$checkjs."}\n";
$checkjs=$checkjs."if (document.myform.downloadurl.value.length == 0) {\n";
$checkjs=$checkjs."alert(user_msg['js16']);\n";
$checkjs=$checkjs."document.myform.downloadurl.focus();\n";
$checkjs=$checkjs."return false;\n";
$checkjs=$checkjs."}\n";
foreach($para_listwr as $key=>$val){
if($val[type]==1 or $val[type]==2 or $val[type]==3 or $val[type]==5){
$checkjs=$checkjs."if (document.myform.para$val[id].value.length == 0) {\n";
$checkjs=$checkjs."alert('$val[name]{$lang_modnull1}');\n";
$checkjs=$checkjs."document.myform.para$val[id].focus();\n";
$checkjs=$checkjs."return false;}\n";
}elseif($val[type]==4){
 $lagerinput="";
 for($j=1;$j<=count($paravalue[$val[id]]);$j++){
 $lagerinput=$lagerinput."document.myform.para$val[id]_$j.checked ||";
 }
 $lagerinput=$lagerinput."false\n";
 $checkjs=$checkjs."if(!($lagerinput)){\n";
 $checkjs=$checkjs."alert('$val[name]{$lang_modnull1}');\n";
 $checkjs=$checkjs."document.myform.para$val[id]_1.focus();\n";
 $checkjs=$checkjs."return false;}\n";
}
}
$checkjs=$checkjs."}";
echo $checkjs;
echo "</script>";
if($met_member_use){
$level="";
switch(intval($lev))
{
	case 0:$level.="<option value='0' $access0>$lang_access0</option>";
	case 1:$level.="<option value='1' $access1>$lang_access1</option>";
	case 2:$level.="<option value='2' $access2>$lang_access2</option>";
	case 3:$level.="<option value='3' $access3>$lang_access3</option>";
}

$leve2="";
$leve2.="<option value='0' $downloadaccess0>$lang_access0</option>";
$leve2.="<option value='1' $downloadaccess1>$lang_access1</option>";
$leve2.="<option value='2' $downloadaccess2>$lang_access2</option>";
$leve2.="<option value='3' $downloadaccess3>$lang_access3</option>";

}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('download_content');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>