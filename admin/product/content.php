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
$product_list=$db->get_one("select * from $met_product where id='$id'");
if($met_member_use){
$lev=$met_class[$product_list['class1']][access];
switch($product_list['access'])
{
	case '1':$access1="selected='selected'";break;
	case '2':$access2="selected='selected'";break;
	case '3':$access3="selected='selected'";break;
	default:$access0="selected='selected'";break;
}
}
if(!$product_list){
okinfo('index.php?lang='.$lang,$lang_dataerror);
}

$query = "select * from $met_plist where module='3' and listid='$id'";
$result = $db->query($query);
while($list = $db->fetch_array($result)){
$nowpara="para".$list[paraid];
$product_list[$nowpara]=$list[info];
$nowparaname="";
if($list[imgname]<>"")$nowparaname=$nowpara."name";$product_list[$nowparaname]=$list[imgname];
}

$class1=$product_list[class1];

if($product_list[new_ok]==1)$new_ok="checked='checked'";
if($product_list[com_ok]==1)$com_ok="checked='checked'";
if($product_list[top_ok]==1)$top_ok="checked='checked'";
$class2[$product_list[class2]]="selected='selected'";
$class3[$product_list[class3]]="selected='selected'";	
}else{
$product_list[issue]=$metinfo_admin_name;
$product_list[hits]=0;
$product_list[addtime]=$m_now_date;
$product_list[access]="0";
$product_list[contentinfo]=$lang_contentinfo;
$product_list[contentinfo1]=$lang_contentinfo1;
$product_list[contentinfo2]=$lang_contentinfo2;
$product_list[contentinfo3]=$lang_contentinfo3;
$product_list[contentinfo4]=$lang_contentinfo4;
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

$checkjs=$checkjs."function Checkproduct(){ \n";
$checkjs=$checkjs."if (document.myform.title.value==null || document.myform.title.value.length == 0) {\n";
$checkjs=$checkjs."	alert(user_msg['js13']);\n";
$checkjs=$checkjs."	document.myform.title.focus();\n";
$checkjs=$checkjs."	return false;\n";
$checkjs=$checkjs."}\n";
$checkjs=$checkjs."if (document.myform.class2.value =='0') {\n";
$checkjs=$checkjs."	alert(user_msg['js14']);\n";
$checkjs=$checkjs."	document.myform.class2.focus();\n";
$checkjs=$checkjs."	return false;\n";
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
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('product_content');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>