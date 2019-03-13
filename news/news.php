<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../include/common.inc.php';
if($met_member_use){
$classaccess=$class3?$class3:($class2?$class2:$class1);
$classaccess= $db->get_one("SELECT * FROM $met_column WHERE id='$classaccess'");
$metaccess=$classaccess[access];
}
require_once '../include/head.php';
    $class1_info=$class_list[$class1][releclass]?$class_list[$class_list[$class1][releclass]]:$class_list[$class1];
	$class2_info=$class_list[$class1][releclass]?$class_list[$class1]:$class_list[$class2];
	$class3_info=$class_list[$class3];
	if(!class1_info){
	okinfo('../',$lang_error);
	}


    $serch_sql=" where lang='$lang' and class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	if($met_member_use==2)$serch_sql .= " and access<=$metinfo_member_type";
	$order_sql=$class3?list_order($class_list[$class3][list_order]):($class2?list_order($class_list[$class2][list_order]):list_order($class_list[$class1][list_order]));
    $total_count = $db->counter($met_news, "$serch_sql", "*");
	$totaltop_count = $db->counter($met_news, "$serch_sql and top_ok='1'", "*");
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$met_news_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
	$page = $page?$page:1;
	 $query = "SELECT $listitem[news] FROM $met_news $serch_sql and top_ok='1' $order_sql LIMIT $from_record, $list_num";
	 $result = $db->query($query);
	 while($list= $db->fetch_array($result)){
	 $news_listnow[]=$list;
	 }
	if(count($news_listnow)<intval($list_num)){
	 if($totaltop_count>=$list_num){
	  $from_record=$from_record-$totaltop_count;
	  if($from_record<0)$from_record=0;
	 }else{
	 $from_record=$from_record?($from_record-$totaltop_count):$from_record;
	 }
	 $list_num=intval($list_num)-count($news_listnow);
	 $query = "SELECT * FROM $met_news $serch_sql and top_ok='0' $order_sql LIMIT $from_record, $list_num";
	 $result = $db->query($query);
	 while($list= $db->fetch_array($result)){
	 $news_listnow[]=$list;
	 }
	}
	foreach($news_listnow as $key=>$list){
if($dataoptimize[$pagemark][classname]){
	$list[class1_name]=$class_list[$list[class1]][name];
	$list[class1_url]=$class_list[$list[class1]][url];
	$list[class2_name]=$list[class2]?$class_list[$list[class2]][name]:$list[class1_name];
	$list[class2_url]=$list[class2]?$class_list[$list[class2]][url]:$list[class1_url];
	$list[class3_name]=$list[class3]?$class_list[$list[class3]][name]:($list[class2]?$class_list[$list[class2]][name]:$list[class1_name]);
	$list[class3_url]=$list[class3]?$class_list[$list[class3]][url]:($list[class2]?$class_list[$list[class2]][url]:$list[class1_url]);
	$list[classname]=$class2?$list[class3_name]:$list[class2_name];
	$list[classurl]=$class2?$list[class3_url]:$list[class2_url];
}
	$list[top]=$list[top_ok]?"<img class='listtop' src='".$img_url."top.gif"."' />":"";
	$list[hot]=$list[top_ok]?"":(($list[hits]>=$met_hot)?"<img class='listhot' src='".$img_url."hot.gif"."' />":"");
	$list[news]=$list[top_ok]?"":((((strtotime($m_now_date)-strtotime($list[updatetime]))/86400)<$met_newsdays)?"<img class='listnews' src='".$img_url."news.gif"."' />":"");
	$list[updatetime] = date($met_listtime,strtotime($list[updatetime]));
	$list[imgurls]=($list[imgurls]<>"")?$list[imgurls]:'../public/images/metinfo.gif';
	$list[imgurl]=($list[imgurl]<>"")?$list[imgurl]:'../public/images/metinfo.gif';
	if($met_webhtm){
	switch($met_htmpagename){
    case 0:
	$htmname="shownews".$list[id];	
	break;
	case 1:
	$list[updatetime1] = date('Ymd',strtotime($list[updatetime]));
	$htmname=$list[updatetime1].$list[id];	
	break;
	case 2:
	$htmname=$class_list[$list[class1]][foldername].$list[id];	
	break;
	}
    $htmname=($list[filename]<>"" and $metadmin[pagename])?$list[filename]."_".$htmname:$htmname;	
	}
	$phpname="shownews.php?".$langmark."&id=".$list[id];
	$list[url]=$met_webhtm?$htmname.$met_htmtype:$phpname;
 	if($list[img_ok] == 1){
	$news_list_new[]=$list;
    if($list[class1]!=0)$news_class_new[$list[class1]][]=$list;
	if($list[class2]!=0)$news_class_new[$list[class2]][]=$list;
	if($list[class3]!=0)$news_class_new[$list[class3]][]=$list;
	}
	if($list[com_ok] == 1){
	$news_list_com[]=$list;
	if($list[class1]!=0)$news_class_com[$list[class1]][]=$list;
	if($list[class2]!=0)$news_class_com[$list[class2]][]=$list;
	if($list[class3]!=0)$news_class_com[$list[class3]][]=$list;
	}
	if($list[class1]!=0)$news_class[$list[class1]][]=$list;
	if($list[class2]!=0)$news_class[$list[class2]][]=$list;
	if($list[class3]!=0)$news_class[$list[class3]][]=$list;
    $news_list[]=$list;
 }
if($met_webhtm==2){
if($class3<>0){
$met_pagelist=(($metadmin[pagename] and $class_list[$class3][filename]<>"")?$class_list[$class3][filename]:($met_htmlistname?$class1_info[foldername]:$modulename[$class1_info[module]][0]))."_".$class1."_".$class2."_".$class3."_";
}elseif($class2<>0){
$met_pagelist=(($metadmin[pagename] and $class_list[$class2][filename]<>"")?$class_list[$class2][filename]:($met_htmlistname?$class1_info[foldername]:$modulename[$class1_info[module]][0]))."_".$class1."_".$class2."_";
}else{
$met_pagelist=(($metadmin[pagename] and $class_list[$class1][filename]<>"")?$class_list[$class1][filename]:($met_htmlistname?$class1_info[foldername]:$modulename[$class1_info[module]][0]))."_".$class1."_";
}
$page_list = $rowset->link($met_pagelist,$met_htmtype);
}else{		
$page_list = $rowset->link("news.php?".$langmark."&class1=$class1&class2=$class2&class3=$class3&page=");	
}
$class2=$class_list[$class1][releclass]?$class1:$class2;
$class1=$class_list[$class1][releclass]?$class_list[$class1][releclass]:$class1;

$class_info=$class3?$class3_info:($class2?$class2_info:$class1_info);
if($class2!=""){
$class_info[name]=$class2_info[name]."--".$class1_info[name];
}
if($class3!=""){
$class_info[name]=$class3_info[name]."--".$class2_info[name]."--".$class1_info[name];
}
     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$class_info[name]."--".$met_title;
require_once '../public/php/methtml.inc.php';
require_once '../public/php/newshtml.inc.php';
include template('news');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>