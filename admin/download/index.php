<?php
# 文件名称:index.php 2009-08-11 17:16:17
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';

    $class1_info=$db->get_one("select * from $met_column where id='$class1'");
	if(!$class1_info){
	okinfo('../site/sysadmin.php',$lang_loginNoid);
	}
	$class1_info[name]=$langusenow=="en"?$class1_info['e_name']:($langusenow=="other"?$class1_info['o_name']:$class1_info['c_name']);
	$query="select * from $met_column where bigclass='$class1'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$list['name']=$langusenow=="en"?$list['e_name']:($langusenow=="other"?$list['o_name']:$list['c_name']);
	$class2_list[]=$list;
	$class2_listok=1;
	}
    $serch_sql=" where class1=$class1 ";
	if($admincp_ok[admin_issueok]==1)$serch_sql .= " and(issue='$metinfo_admin_name' or issue='') ";
	if($class2){
	$serch_sql .= " and class2=$class2";
	$query="select * from $met_column where bigclass='$class2'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$list['name']=$langusenow=="en"?$list['e_name']:($langusenow=="other"?$list['o_name']:$list['c_name']);
	$class3_list[]=$list;
	$class3_listok=1;
	}
	}
	if($class3){$serch_sql .= " and class3=$class3"; }
	$order_sql=list_order($class1_info[list_order]);
    if($search == "detail_search") {
        
       $item=$langusenow=="en"?"e_title":($langusenow=="other"?"o_title":"c_title");
        if($title) { $serch_sql .= " and $item like '%$title%' "; }
		
		if(isset($new) && $new!="all") { $serch_sql .= " and new_ok ='$new' "; }
		if(isset($recommend) && $recommend!="all") { $serch_sql .= " and com_ok ='$recommend' "; }
		if(isset($top) && $top!="all") { $serch_sql .= " and top_ok ='$top' "; }
        $total_count = $db->counter($met_download, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_download, "$serch_sql", "*");
    }
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_download $serch_sql $order_sql LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	switch($list['access'])
    {
    	case '1':$list['access']=$lang_access1;break;
    	case '2':$list['access']=$lang_access2;break;
    	case '3':$list['access']=$lang_access3;break;
		default:$list['access']=$lang_access0;break;
	}
	$list[new_ok1] = $list[new_ok] ? $lang_YES : $lang_NO;
	$list[com_ok1] = $list[com_ok] ? $lang_YES : $lang_NO;
	$list[top_ok1] = $list[top_ok] ? $lang_YES : $lang_NO;
	$list[updatetime] = date('Y-m-d',strtotime($list[updatetime]));
    $download_list[]=$list;
    }
$page_list = $rowset->link("index.php?class1=$class1&class2=$class2&class3=$class3&search=$search&title=$title&page=");
switch($new)
{
	case '1':$new1="selected='selected'";break;
	case '0':$new2="selected='selected'";break;
	default:$new0="selected='selected'";break;
}
switch($recommend)
{
	case '1':$recommend1="selected='selected'";break;
	case '0':$recommend2="selected='selected'";break;
	default:$recommend0="selected='selected'";break;
}
switch($top)
{
	case '1':$top1="selected='selected'";break;
	case '0':$top2="selected='selected'";break;
	default:$top0="selected='selected'";break;
}
switch($langtype)
{
	case 'c':$langtype1="selected='selected'";$urllang='cn';break;
	case 'e':$langtype2="selected='selected'";$urllang='en';break;
	case 'o':$langtype3="selected='selected'";$urllang='other';break;
	default:$langtype0="selected='selected'";$urllang=$langusenow;break;
}
$selectlang = "";
if($met_c_lang_ok==1) $selectlang.="<option value='c' $langtype1>$met_c_lang</option>";
if($met_e_lang_ok==1) $selectlang.="<option value='e' $langtype2>$met_e_lang</option>";
if($met_o_lang_ok==1) $selectlang.="<option value='o' $langtype3>$met_o_lang</option>";

$query = "SELECT * FROM $met_column where module=4 order by no_order";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {	 
	 $list['name']=$langusenow=="en"?$list['e_name']:($langusenow=="other"?$list['o_name']:$list['c_name']);
	 if($list['classtype']==1) {$classlev1[$list[id]][name]=$list[name];$classlev1[$list[id]][id]=$list[id];$classlev1[$list[id]][bigclass]=$list[bigclass];}
	 if($list['classtype']==2) {$classlev2[$list[id]][name]=$list[name];$classlev2[$list[id]][id]=$list[id];$classlev2[$list[id]][bigclass]=$list[bigclass];}
	 if($list['classtype']==3) {$classlev3[$list[id]][name]=$list[name];$classlev3[$list[id]][id]=$list[id];$classlev3[$list[id]][bigclass]=$list[bigclass];}
    }
$lev[]=	$classlev1;
$lev[]=	$classlev2;
$lev[]=	$classlev3;
$i=0;
echo "<script language = 'JavaScript'>\n";
echo "var onecount;\n";
echo "lev = new Array();\n";
foreach($lev as $key0=>$val0){

foreach($val0 as $key=>$vallist){
echo "lev[".$i."] = new Array('".$vallist[name]."','".$vallist[bigclass]."','".$vallist[id]."');\n";
	 $i=$i+1;
}}
echo "onecount=".$i.";\n";
echo "</script>";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('download');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>