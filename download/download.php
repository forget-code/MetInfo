<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../include/common.inc.php';
if(!$class1){
	$downloadclassnumone=$db->get_one("SELECT * FROM $met_column WHERE module='4' and bigclass='0' and lang='$lang' ");
     $class1=$downloadclassnumone[id];
	 }
if($met_member_use){
$classaccess=$class3?$class3:($class2?$class2:$class1);
$classaccess= $db->get_one("SELECT * FROM $met_column WHERE id='$classaccess'");
$metaccess=$classaccess[access];
}
require_once '../include/head.php';
    $class1_info=$class_list[$class1][releclass]?$class_list[$class_list[$class1][releclass]]:$class_list[$class1];
	$class2_info=$class_list[$class1][releclass]?$class_list[$class1]:$class_list[$class2];
	$class3_info=$class_list[$class3];

	$serch_sql .=" where lang='$lang' and class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
if($search=="search"){
if($searchtype){
   if($title<>''){
	  $serch_sql .= " and title='".trim($title)."' "; 
	  $serchpage .= "&title=".trim($title); 
	  }
	foreach($download_paralist as $key=>$val){
	$paratitle=$$val[para];
	 if($val[type]==4 and intval($page<1)){
	 $paratitle="";
	  foreach($para_select[$val[id]] as $key=>$val1){
	  $parasel="para".$val[id]."_".$val1[id];
	  if(trim($$parasel)<>'')$paratitle.=$$parasel."-";
	  }
	  if(trim($paratitle)<>'')$paratitle=substr($paratitle, 0, -1);
	 }
	  if(trim($paratitle)<>''){
	   $serch_sql .= " and exists(select * from $met_plist where module=4 and $met_plist.listid=$met_download.id and $met_plist.info='".trim($paratitle)."') "; 
	   $serchpage .= "&".$val[para]."=".trim($paratitle);
	   }
     }
}else{
    if($title<>''){
	  $serch_sql .= " and title like '%".trim($title)."%'"; 
	  $serchpage .= "&title=".trim($title); 
	  }
    if($content<>''){
	   $serch_sql .= " and ((content like '%".trim($content)."%' or title like '%".trim($content)."%') or (title like '%".trim($content)."%')) "; 
	   $serchpage .= "&content=".trim($content); 
	   }
	foreach($download_paralist as $key=>$val){
	$paratitle=$$val[para];
	 if($val[type]==4 and intval($page<1)){
	 $paratitle="";
	  foreach($para_select[$val[id]] as $key=>$val1){
	  $parasel="para".$val[id]."_".$val1[id];
	  if(trim($$parasel)<>'')$paratitle.=$$parasel."-";
	  }
	  if(trim($paratitle)<>'')$paratitle=substr($paratitle, 0, -1);
	 }
	if(trim($paratitle)<>''){
	   $serch_sql .= " and exists(select * from $met_plist where module=4 and $met_plist.listid=$met_download.id and $met_plist.info like'%".trim($paratitle)."%') ";  
	   $serchpage .= "&".$val[para]."=".trim($paratitle);
	   }
	 }
} 
} 

	$serchpage .= "&searchtype=".$searchtype;
	if($met_member_use==2)$serch_sql .= " and access<=$metinfo_member_type";
	$order_sql=$class3?list_order($class_list[$class3][list_order]):($class2?list_order($class_list[$class2][list_order]):list_order($class_list[$class1][list_order]));
    $total_count = $db->counter($met_download, "$serch_sql", "*");
	$totaltop_count = $db->counter($met_download, "$serch_sql and top_ok='1'", "*");
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$met_download_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
	$page = $page?$page:1;
	 $query = "SELECT $listitem[download] FROM $met_download $serch_sql and top_ok='1' $order_sql LIMIT $from_record, $list_num";
	 $result = $db->query($query);
	 while($list= $db->fetch_array($result)){
	 $download_listnow[]=$list;
	 }
	if(count($download_listnow)<intval($list_num)){
	 if($totaltop_count>=$list_num){
	  $from_record=$from_record-$totaltop_count;
	  if($from_record<0)$from_record=0;
	 }else{
	 $from_record=$from_record?($from_record-$totaltop_count):$from_record;
	 }
	 $list_num=intval($list_num)-count($download_listnow);
	 $query = "SELECT * FROM $met_download $serch_sql and top_ok='0' $order_sql LIMIT $from_record, $list_num";
	 $result = $db->query($query);
	 while($list= $db->fetch_array($result)){
	 $download_listnow[]=$list;
	 }
	}
	foreach($download_listnow as $key=>$list){
    if($dataoptimize[4][para][4]){
	  $query1 = "select * from $met_plist where listid='$list[id]' and module='4' ";
      $result1 = $db->query($query1);
      while($list1 = $db->fetch_array($result1)){
      $nowpara1="para".$list1[paraid];
	  $list[$nowpara1]=$list1[info];
	  $metparaaccess=$metpara[$list1[paraid]][access];
	  if(intval($metparaaccess)>0&&$met_member_use){
	  $paracode=authcode($list[$nowpara1], 'ENCODE', $met_memberforce);
	  $paracode=codetra($paracode,1); 
	  $list[$nowpara1]="<script language='javascript' src='../include/access.php?metuser=para&metaccess=".$metparaaccess."&lang=".$lang."&listinfo=".$paracode."&paratype=".$metpara[$list1[paraid]][type]."'></script>";
	  }
      $nowparaname="";
	  $nowparaname=$nowpara1."name";
	  $list[$nowparaname]=($list1[imgname]<>"")?$list1[imgname]:$metpara[$list1[paraid]][name];
      }
	 }
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
	if(intval($list[downloadaccess])>0&&$met_member_use){
	$list[downloadurl]="down.php?id=$list[id]&lang=$lang";
	}
	if($met_webhtm){
	switch($met_htmpagename){
    case 0:
	$htmname="showdownload".$list[id];	
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
	$phpname="showdownload.php?id=".$list[id];
	$list[url]=$met_webhtm?$htmname.$met_htmtype:$phpname."&lang=".$lang;
	if($list[new_ok] == 1){
	$download_list_new[]=$list;
    if($list[class1]!=0)$download_class_new[$list[class1]][]=$list;
	if($list[class2]!=0)$download_class_new[$list[class2]][]=$list;
	if($list[class3]!=0)$download_class_new[$list[class3]][]=$list;
	}
	if($list[com_ok] == 1){
	$download_list_com[]=$list;
	if($list[class1]!=0)$download_class_com[$list[class1]][]=$list;
	if($list[class2]!=0)$download_class_com[$list[class2]][]=$list;
	if($list[class3]!=0)$download_class_com[$list[class3]][]=$list;
	}
	if($list[class1]!=0)$download_class[$list[class1]][]=$list;
	if($list[class2]!=0)$download_class[$list[class2]][]=$list;
	if($list[class3]!=0)$download_class[$list[class3]][]=$list;
    $download_list[]=$list;
}
	
if($search=='search'){		
$page_list = $rowset->link("download.php?lang=$lang&class1=$class1&class2=$class2&class3=$class3".$serchpage."&search=search&page=");	
}else{
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
$page_list = $rowset->link("download.php?lang=$lang&class1=$class1&class2=$class2&class3=$class3&page=");	
}
}
if($met_download_page && $search!='search'){
if($class2 && count($nav_list3[$class2])&& (!$class3) ){
	 $metdownloadok=1;
	}elseif((!$class2) && count($nav_list2[$class1]) && $class1 && (!$class3)){
	 $metdownloadok=1;
	}elseif($class_list[$class1][module]==100){
	  $metdownloadok=1;
    }
    if($metdownloadok)$page_list="";
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
require_once '../public/php/downloadhtml.inc.php';
include template('download');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>