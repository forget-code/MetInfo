<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';

    $class1_info=$met_class[$class1];	
	if(!$class1_info){
	okinfo('../site/sysadmin.php',$lang_dataerror);
	}
	$query="select * from $met_column where bigclass='$class1'";
	$result= $db->query($query);
    $serch_sql=" where lang='$lang' and class1=$class1 ";
	if($admincp_ok[admin_issueok]==1)$serch_sql .= " and(issue='$metinfo_admin_name' or issue='') ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3){$serch_sql .= " and class3=$class3"; }
	$classnow=$class3?$class3:($class2?$class2:$class1);
	$order_sql=list_order($met_class[$classnow][list_order]);
    if($search == "detail_search") {			
        if($title)$serch_sql .= " and title like '%$title%' "; 
		if(isset($img) && $img!="all") { $serch_sql .= " and img_ok ='$img' "; }
		if(isset($recommend) && $recommend!="all") { $serch_sql .= " and com_ok ='$recommend' "; }
		if(isset($top) && $top!="all") { $serch_sql .= " and top_ok ='$top' "; }
        $total_count = $db->counter($met_news, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_news, "$serch_sql", "*");
    }
	$totaltop_count = $db->counter($met_news, "$serch_sql and top_ok='1'", "*");
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_news $serch_sql and top_ok='1' $order_sql LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list = $db->fetch_array($result)){
		$news_listo[]=$list;
	}
	if(count($news_listo)<intval($list_num)){
		if($totaltop_count>=$list_num){
			$from_record=$from_record-$totaltop_count;
			if($from_record<0)$from_record=0;
		}else{
			$from_record=$from_record?($from_record-$totaltop_count):$from_record;
		}
		$list_num=intval($list_num)-count($news_listo);
		$query = "SELECT * FROM $met_news $serch_sql and top_ok='0' $order_sql LIMIT $from_record, $list_num";
		$result = $db->query($query);
		while($list= $db->fetch_array($result)){
			$news_listo[]=$list;
		}
	}
	foreach($news_listo as $key=>$list){
		if($met_member_use){
			switch($list['access']){
				case '1':$list['access']=$lang_access1;break;
				case '2':$list['access']=$lang_access2;break;
				case '3':$list['access']=$lang_access3;break;
				default:$list['access']=$lang_access0;break;
			}
		}
		$list[img_ok1] = $list[img_ok] ? $lang_yes : $lang_no;
		$list[com_ok1] = $list[com_ok] ? $lang_yes : $lang_no;
		$list[top_ok1] = $list[top_ok] ? $lang_yes : $lang_no;
		$list[wap_ok1] = $list[wap_ok] ? $lang_yes : $lang_no;
		$list[updatetime] = date('Y-m-d',strtotime($list[updatetime]));
		$news_list[]=$list;
	}
$page_list = $rowset->link("index.php?lang=$lang&class1=$class1&class2=$class2&class3=$class3&search=$search&title=$title&page=");
switch($img)
{
	case '1':$img1="selected='selected'";break;
	case '0':$img2="selected='selected'";break;
	default:$img0="selected='selected'";break;
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
$i=0;
$listjs = "<script language = 'JavaScript'>\n";
$listjs.= "var onecount;\n";
$listjs.= "lev = new Array();\n";
foreach($met_module[2] as $key=>$vallist){
$listjs.= "lev[".$i."] = new Array('".$vallist[name]."','".$vallist[bigclass]."','".$vallist[id]."');\n";
	 $i=$i+1;
}
$listjs.= "onecount=".$i.";\n";
$listjs.= "</script>";

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('article');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>