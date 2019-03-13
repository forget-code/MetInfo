<?php
# 文件名称:add.php 2009-08-11 16:19:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$query = "SELECT * FROM $met_parameter where type=4 order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
$list['mark']=$langusenow=="en"?$list['e_mark']:($langusenow=="other"?$list['o_mark']:$list['c_mark']);
if($list[use_ok]==1)$list_p[]=$list;
}

$class2_ok=FALSE;
    $query = "SELECT * FROM $met_column where module=4 order by no_order";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
	 $list['name']=$langusenow=="en"?$list['e_name']:($langusenow=="other"?$list['o_name']:$list['c_name']);
	 if($list[id]==$class1){$class1_name=$list[name];$lev=$list[access];}
     if($list[bigclass]==$class1){
	 $column_list2[]=$list;
	 $class2_ok=TRUE;
	 }
	if($list[bigclass]!=0)$column_list[]=$list;
    }
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
	case 0:$level.="<option value='all' >$lang_access0</option>";
	case 1:$level.="<option value='1' >$lang_access1</option>";
	case 2:$level.="<option value='2' >$lang_access2</option>";
	case 3:$level.="<option value='3' >$lang_access3</option>";
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('download_add');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>