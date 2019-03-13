<?php
# 文件名称:product.php 2009-09-05 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
if(!($db->get_one("SELECT * FROM $met_column WHERE id='$class1'"))){
	 $class1ins= $db->get_one("SELECT * FROM $met_column WHERE module='100'");
	 $class1=$class1ins[id];
	 if($search=='search'){
	 $productclassnum=$db->counter($met_column, " where module='3' and bigclass='0' ", "*");
	 if($productclassnum==1) {
	    $productclassnumone=$db->get_one("SELECT * FROM $met_column WHERE module='3' and bigclass='0'");
		$class1=$productclassnumone[id];
	   }
	 }
	}

$classaccess=$class3?$class3:($class2?$class2:$class1);
$classaccess= $db->get_one("SELECT * FROM $met_column WHERE id='$classaccess'");
$metaccess=$classaccess[access];
require_once '../include/head.php';
    $class1_info=$class_list[$class1];
	$class2_info=$class_list[$class2];
	$class3_info=$class_list[$class3];

	$serch_sql .=" where 1=1 ";
    if($class1 && $class_list[$class1][module]<>100)$serch_sql .= " and class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	$paralang=($lang=="en")?'e_':(($lang=="other")?'o_':'c_');
	if($title<>''){
	  $serch_sql .= " and $paralang"."title='".trim($title)."'"; 
	  $serchpage .= "&".$paralang."title=".trim($title); 
	  }
	foreach($product_para200 as $key=>$val){
	$paratitle=$$val[name];
	if($searchtype){
	  if(trim($paratitle)<>''){
	   $serch_sql .= " and $paralang"."$val[name]='".trim($paratitle)."'"; 
	   $serchpage .= "&".$paralang.$val[name]."=".trim($paratitle);
	   }
	}else{
	  if(trim($paratitle)<>''){
	   $serch_sql .= " and $paralang"."$val[name] like '%".trim($paratitle)."%'"; 
	   $serchpage .= "&".$paralang.$val[name]."=".trim($paratitle);
	   }
	 }
	
	}
	$serchpage .= "&searchtype=".$searchtype;
	if($content<>''){
	   $serch_sql .= " and $paralang"."content like '%".trim($content)."%'"; 
	   $serchpage .= "&".$paralang."content=".trim($content); 
	   }
	$serch_sql .=($lang=="en")?" and e_title<>'' ":(($lang=="other")?" and o_title<>'' ":" and c_title<>'' ");
	$order_sql=$class3?list_order($class3_info[list_order]):($class2?list_order($class2_info[list_order]):list_order($class1_info[list_order]));
    $total_count = $db->counter($met_product, "$serch_sql", "*");
	$totaltop_count = $db->counter($met_product, "$serch_sql and top_ok='1'", "*");
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$met_product_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
	$page = $page?$page:1;
	 $query = "SELECT * FROM $met_product $serch_sql and top_ok='1' $order_sql LIMIT $from_record, $list_num";
	 $result = $db->query($query);
	 while($list= $db->fetch_array($result)){
	 $product_listnow[]=$list;
	 }
	if(count($product_listnow)<intval($list_num)){
	 if($totaltop_count>=$list_num){
	  $from_record=$from_record-$totaltop_count;
	  if($from_record<0)$from_record=0;
	 }else{
	 $from_record=$from_record?($from_record-$totaltop_count):$from_record;
	 }
	 $list_num=intval($list_num)-count($product_listnow);
	 $query = "SELECT * FROM $met_product $serch_sql and top_ok='0' $order_sql LIMIT $from_record, $list_num";
	 $result = $db->query($query);
	 while($list= $db->fetch_array($result)){
	 $product_listnow[]=$list;
	 }
	}
	foreach($product_listnow as $key=>$list){
	$list[title]=($lang=="en")?$list[e_title]:(($lang=="other")?$list[o_title]:$list[c_title]);
	$list[class1_name]=$class_list[$list[class1]][name];
	$list[class1_url]=$class_list[$list[class1]][url];
	$list[class2_name]=$list[class2]?$class_list[$list[class2]][name]:$list[class1_name];
	$list[class2_url]=$list[class2]?$class_list[$list[class2]][url]:$list[class1_url];
	$list[class3_name]=$list[class3]?$class_list[$list[class3]][name]:($list[class2]?$class_list[$list[class2]][name]:$list[class1_name]);
	$list[class3_url]=$list[class3]?$class_list[$list[class3]][url]:($list[class2]?$class_list[$list[class2]][url]:$list[class1_url]);
	$list[classname]=$class2?$list[class3_name]:$list[class2_name];
	$list[classurl]=$class2?$list[class3_url]:$list[class2_url];
	$list[keywords]=($lang=="en")?$list[e_keywords]:(($lang=="other")?$list[o_keywords]:$list[c_keywords]);
	$list[description]=($lang=="en")?$list[e_description]:(($lang=="other")?$list[o_description]:$list[c_description]);
	$list[content]=($lang=="en")?$list[e_content]:(($lang=="other")?$list[o_content]:$list[c_content]);
	$list[top]=$list[top_ok]?"<img class='listtop' src='".$img_url."top.gif"."' />":"";
	$list[hot]=$list[top_ok]?"":(($list[hits]>=$met_hot)?"<img class='listhot' src='".$img_url."hot.gif"."' />":"");
	$list[news]=$list[top_ok]?"":((((strtotime($m_now_date)-strtotime($list[updatetime]))/86400)<$met_newsdays)?"<img class='listnews' src='".$img_url."news.gif"."' />":"");
	$list[imgurls]=($list[imgurls]<>"")?$list[imgurls]:'../public/images/metinfo.gif';
	$list[imgurl]=($list[imgurl]<>"")?$list[imgurl]:'../public/images/metinfo.gif';
	$list[updatetime] = date($met_listtime,strtotime($list[updatetime]));
	for($j=1;$j<=24;$j++){
	$c_para="c_para".$j;
	$e_para="e_para".$j;
	$o_para="o_para".$j;
	$para="para".$j;
	$list[$para]=($lang=="en")?$list[$e_para]:(($lang=="other")?$list[$o_para]:$list[$c_para]);
	$metparaaccess=$met_para[3][$para][access];
	if(intval($metparaaccess)>0&&$met_member_use){
	$paracode=authcode($list[$para], 'ENCODE', $met_memberforce);
	$paracode=codetra($paracode,1); 
	$list[$para]="<script language='javascript' src='../include/access.php?metuser=para&metaccess=".$metparaaccess."&lang=".$lang."&listinfo=".$paracode."&paraid=".$j."'></script>";
	  }
	}
	switch($met_htmpagename){
    case 0:
	$htmname="showproduct".$list[id];	
	break;
	case 1:
	$list[updatetime1] = date('Ymd',strtotime($list[updatetime]));
	$htmname=$list[updatetime1].$list[id];	
	break;
	case 2:
	$htmname=$class_list[$list[class1]][foldername].$list[id];	
	break;
	}	
	$phpname="showproduct.php?id=".$list[id];
	$list[c_url]=$met_webhtm?$htmname.$met_c_htmtype:$phpname;
	$list[e_url]=$met_webhtm?$htmname.$met_e_htmtype:$phpname."&lang=en";
	$list[o_url]=$met_webhtm?$htmname.$met_o_htmtype:$phpname."&lang=other";
	$list[url]=($lang=="en")?$list[e_url]:(($lang=="other")?$list[o_url]:$list[c_url]);
	
	if($list[new_ok] == 1){
	$product_list_new[]=$list;
    if($list[class1]!=0)$product_class_new[$list[class1]][]=$list;
	if($list[class2]!=0)$product_class_new[$list[class2]][]=$list;
	if($list[class3]!=0)$product_class_new[$list[class3]][]=$list;
	}
	if($list[com_ok] == 1){
	$product_list_com[]=$list;
	if($list[class1]!=0)$product_class_com[$list[class1]][]=$list;
	if($list[class2]!=0)$product_class_com[$list[class2]][]=$list;
	if($list[class3]!=0)$product_class_com[$list[class3]][]=$list;
	}
	if($list[class1]!=0)$product_class[$list[class1]][]=$list;
	if($list[class2]!=0)$product_class[$list[class2]][]=$list;
	if($list[class3]!=0)$product_class[$list[class3]][]=$list;
    $product_list[]=$list;
	}
	
if($search=='search'){

$c_page_list = $rowset->link("product.php?class1=$class1&class2=$class2&class3=$class3".$serchpage."search=search&page=");		
$e_page_list = $rowset->link("product.php?lang=en&class1=$class1&class2=$class2&class3=$class3".$serchpage."search=search&page=");	
$o_page_list = $rowset->link("product.php?lang=other&class1=$class1&class2=$class2&class3=$class3".$serchpage."search=search&page=");

}else{
if($met_webhtm==2){
if($class3<>0){
$met_pagelist=((!$met_htmlistname)?$modulename[$class1_info[module]][0]:$class1_info[foldername])."_".$class1."_".$class2."_".$class3."_";
}elseif($class2<>0){
$met_pagelist=((!$met_htmlistname)?$modulename[$class1_info[module]][0]:$class1_info[foldername])."_".$class1."_".$class2."_";
}else{
$met_pagelist=($met_htmlistname?$class1_info[foldername]:$modulename[$class1_info[module]][0])."_".$class1."_";
}
$c_page_list = $rowset->link($met_pagelist,$met_c_htmtype);
$e_page_list = $rowset->link($met_pagelist,$met_e_htmtype);
$o_page_list = $rowset->link($met_pagelist,$met_o_htmtype);
}else{	
$c_page_list = $rowset->link("product.php?class1=$class1&class2=$class2&class3=$class3&page=");		
$e_page_list = $rowset->link("product.php?lang=en&class1=$class1&class2=$class2&class3=$class3&page=");	
$o_page_list = $rowset->link("product.php?lang=other&class1=$class1&class2=$class2&class3=$class3&page=");
}
}
if($met_product_page && $search!='search'){
if($class2 && count($nav_list3[$class2])&& (!$class3) ){
	 $metproductok=1;
	}elseif((!$class2) && count($nav_list2[$class1]) && $class1 && (!$class3)){
	 $metproductok=1;
	}elseif($class_list[$class1][module]==100){
	  $metproductok=1;
    }
    if(!$metproductok)$page_list=($lang=="en")?$e_page_list:(($lang=="other")?$o_page_list:$c_page_list);
}else{	
$page_list=($lang=="en")?$e_page_list:(($lang=="other")?$o_page_list:$c_page_list);
}
$class_info=$class3?$class3_info:($class2?$$class2_info:$class1_info);


$class_info[e_name]=$class1_info[e_name];
$class_info[c_name]=$class1_info[c_name];
$class_info[o_name]=$class1_info[o_name];

if($class2!=""){
$class_info[e_name]=$class2_info[e_name]."--".$class1_info[e_name];
$class_info[c_name]=$class2_info[c_name]."--".$class1_info[c_name];
$class_info[o_name]=$class2_info[o_name]."--".$class1_info[o_name];
}

if($class3!=""){
$class_info[e_name]=$class3_info[e_name]."--".$class2_info[e_name]."--".$class1_info[e_name];
$class_info[c_name]=$class3_info[c_name]."--".$class2_info[c_name]."--".$class1_info[c_name];
$class_info[o_name]=$class3_info[o_name]."--".$class2_info[o_name]."--".$class1_info[o_name];
}
$class_info[name]=($lang=="en")?$class_info[e_name]:(($lang=="other")?$class_info[o_name]:$class_info[c_name]);

     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$class_info[name]."--".$met_title;

require_once '../public/php/methtml.inc.php';
require_once '../public/php/producthtml.inc.php';
if(file_exists("templates/".$met_skin_user."/e_product.html")){
   if($lang=="en"){
     $show[e_description]=$class_info[e_description]?$class_info[e_description]:$met_e_keywords;
     $show[e_keywords]=$class_info[e_keywords]?$class_info[e_keywords]:$met_e_keywords;
     $e_title_keywords=$class_info[e_name]."--".$met_e_webname;
     include template('e_product');
	}else{
	 $show[c_description]=$class_info[c_description]?$class_info[c_description]:$met_c_keywords;
     $show[c_keywords]=$class_info[c_keywords]?$class_info[c_keywords]:$met_c_keywords;
     $c_title_keywords=$class_info[c_name]."--".$met_c_webname;
	 include template('product');
	 }
}else{
include template('product');
}
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>