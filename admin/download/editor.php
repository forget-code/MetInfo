<?php
# 文件名称:editor.php 2009-08-11 10:45:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$download_list=$db->get_one("select * from $met_download where id='$id'");
$lev=0;
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
if(!$download_list){
okinfo('index.php',$lang_loginNoid);
}
$query = "SELECT * FROM $met_parameter where type=4 order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
$list['mark']=$langusenow=="en"?$list['e_mark']:($langusenow=="other"?$list['o_mark']:$list['c_mark']);
if($list[use_ok]==1)$list_p[]=$list;
}

$class1=$download_list[class1];
if($download_list[new_ok]==1)$new_ok="checked='checked'";
if($download_list[com_ok]==1)$com_ok="checked='checked'";
if($download_list[top_ok]==1)$top_ok="checked='checked'";
$class2[$download_list[class2]]="selected='selected'";

    $class2_ok=FALSE;
    $query = "SELECT * FROM $met_column where module=4 order by no_order";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
	 $list['name']=$langusenow=="en"?$list['e_name']:($langusenow=="other"?$list['o_name']:$list['c_name']);
	 if($list[id]==$class1){$class1_name=$list[name];$lev=$list['access'];}
     if($list[bigclass]==$class1){
	 $lev=$list['access'];
	 $column_list2[]=$list;
	 $class2_ok=TRUE;
	 }
	if($list[bigclass]!=0) $column_list[]=$list;
    }
	
if($download_list[class3]!=0){
$query ="select * from $met_column where bigclass=$download_list[class2] order by no_order";
$result = $db->query($query);
while($class3_r= $db->fetch_array($result)){
$lev=$class3_r['access'];
$class3_r['name']=$langusenow=="en"?$class3_r['e_name']:($langusenow=="other"?$class3_r['o_name']:$class3_r['c_name']);
$class3_list[]=$class3_r;
}
}
$class3[$download_list[class3]]="selected='selected'";	
	
	$i=0;
echo "<script language = 'JavaScript'>\n";
echo "var onecount;\n";
echo "subcat = new Array();\n";
foreach($column_list as $key=>$vallist){
echo "subcat[".$i."] = new Array('".$vallist[name]."','".$vallist[bigclass]."','".$vallist[id]."','".$vallist[access]."');\n";
	 $i=$i+1;
}
echo "onecount=".$i.";\n";
echo "</script>";


$level="";
switch(intval($lev))
{
	case 0:$level.="<option value='all' $access0>$lang_access0</option>";
	case 1:$level.="<option value='1' $access1>$lang_access1</option>";
	case 2:$level.="<option value='2' $access2>$lang_access2</option>";
	case 3:$level.="<option value='3' $access3>$lang_access3</option>";
}

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('download_editor');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>