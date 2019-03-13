<?php
# 文件名称:editor.php 2009-08-08 13:45:13
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$news_list=$db->get_one("select * from $met_news where id='$id'");
$lev=0;
switch($news_list['access'])
{
	case '1':$access1="selected='selected'";break;
	case '2':$access2="selected='selected'";break;
	case '3':$access3="selected='selected'";break;
	default:$access0="selected='selected'";break;
}
if(!$news_list){
okinfo('index.php',$lang_loginNoid);
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

    $class2_ok=FALSE;
    $query = "SELECT * FROM $met_column where module=2 order by no_order";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
	 $list['name']=$langusenow=="en"?$list['e_name']:($langusenow=="other"?$list['o_name']:$list['c_name']);
	 if($list[id]==$class1){$class1_name=$list[name];$lev=$list['access'];}
     if($list[bigclass]==$class1){
	 $lev=$list['access'];
	 $column_list2[]=$list;
	 $class2_ok=TRUE;
	 }
	 if($list[bigclass]!=0)$column_list[]=$list;
    }
	
if($news_list[class3]!=0){
$query ="select * from $met_column where bigclass=$news_list[class2] order by no_order";
$result = $db->query($query);
while($class3_r= $db->fetch_array($result)){
$lev=$class3_r['access'];
$class3_r['name']=$langusenow=="en"?$class3_r['e_name']:($langusenow=="other"?$class3_r['o_name']:$class3_r['c_name']);
$class3_list[]=$class3_r;
}
}
$class3[$news_list[class3]]="selected='selected'";	
	
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
	case 0:$level.="<option value='all' $access0>$lang_articleeditorAccess0</option>";
	case 1:$level.="<option value='1' $access1>$lang_articleeditorAccess1</option>";
	case 2:$level.="<option value='2' $access2>$lang_articleeditorAccess2</option>";
	case 3:$level.="<option value='3' $access3>$lang_articleeditorAccess3</option>";
}

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('article_editor');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>