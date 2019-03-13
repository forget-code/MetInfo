<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="editor"){
$news_list=$db->get_one("select * from $met_news where id='$id'");
if($met_member_use){
$lev=$met_class[$news_list['class1']][access];
switch($news_list['access'])
{
	case '1':$access1="selected='selected'";break;
	case '2':$access2="selected='selected'";break;
	case '3':$access3="selected='selected'";break;
	default:$access0="selected='selected'";break;
}
}
if(!$news_list){
okinfox('../article/index.php?lang='.$lang,$lang_dataerror);
}
$class1=$news_list[class1];
if($news_list[img_ok]==1){
$img_ok="checked='checked'";
$img_ok_display="";
}
else{
$img_ok="";
$img_ok_display="none";
}

if($news_list[com_ok]==1)$com_ok="checked='checked'";
if($news_list[top_ok]==1)$top_ok="checked='checked'";
$class2[$news_list[class2]]="selected='selected'";
$class3[$news_list[class3]]="selected='selected'";	
}else{
$news_list[issue]=$metinfo_admin_name;
$news_list[hits]=0;
$news_list[no_order]=0;
$news_list[addtime]=$m_now_date;
$news_list[access]=0;
$lang_editinfo=$lang_addinfo;
$lev=$met_class[$class1][access];
}
	$i=0;
$listjs = "<script language = 'JavaScript'>\n";
$listjs .= "var onecount;\n";
$listjs .= "subcat = new Array();\n";
foreach($met_class22[$class1] as $key=>$vallist){
$listjs .= "subcat[".$i."] = new Array('".$vallist[name]."','".$vallist[bigclass]."','".$vallist[id]."','".$vallist[access]."');\n";
	 $i=$i+1;
  foreach($met_class3[$vallist[id]] as $key=>$vallist3){
$listjs .= "subcat[".$i."] = new Array('".$vallist3[name]."','".$vallist3[bigclass]."','".$vallist3[id]."','".$vallist3[access]."');\n";
	 $i=$i+1;
    }
}
$listjs .= "onecount=".$i.";\n";
$listjs .= "</script>";

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
include template('article_content');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>