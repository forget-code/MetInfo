<?php
# 文件名称:search.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
$search_column=$db->get_one("select * from $met_column where module='11'");
$metaccess=$search_column[access];
$classnow=$search_column[id];
require_once '../include/head.php';
unset($search_list);
$searchpre=($lang=="en")?'e':(($lang=="other")?'o':'c');

$searchword=$searchword?$searchword:(($lang=="en")?$e_searchword:(($lang=="other")?$o_searchword:$c_searchword));


if($searchword==""){
$search_list[0][title]="<font color=red>{$lang_SearchInfo1}</font>";
$search_list[0][updatetime]=$m_now_date;  
$search_list[0][url]=$index_url; 
//兼容1.5
$search_list[0][c_title]="<font color=red>{$lang_SearchInfo1}</font>";
$search_list[0][e_title]="<font color=red>{$lang_SearchInfo1}</font>";
$search_list[0][c_url]=$index_url;
$search_list[0][e_url]=$index_url;
//兼容1.5
}
else
{
if($class1=="" || $class1==10000 || $class1==10001 || $class1==$classnow || $class1==0){
   switch($searchtype){
   default:
   if($searchword<>'')$serch_sql=" where $searchpre"."_title like '%".trim($searchword)."%' or $searchpre"."_content like '%".trim($searchword)."%' ";
   if($searchword<>'')$serch_sql1=" where $searchpre"."_name like '%".trim($searchword)."%' or $searchpre"."_content like '%".trim($searchword)."%' ";
   break;
   case 1:
   if($searchword<>'')$serch_sql=" where $searchpre"."_title like '%".trim($searchword)."%' ";
   if($searchword<>'')$serch_sql1=" where $searchpre"."_name like '%".trim($searchword)."%' ";
   break;
   case 2:
   if($searchword<>'')$serch_sql=" where $searchpre"."_content like '%".trim($searchword)."% ";
   if($searchword<>'')$serch_sql1=" where $searchpre"."_content like '%".trim($searchword)."% ";
   break;
   }  
switch($met_htmpagename){
case 0:   
	$pagename="news";
    $query = "SELECT * FROM $met_news $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="shownews";
    require 'infolist.php';
	}
	
	$pagename="product";
    $query = "SELECT * FROM $met_product $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showproduct";
    require 'infolist.php';
	}
	
	$pagename="download";
    $query = "SELECT * FROM $met_download $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'infolist.php';
	}
    
	$pagename="img";
    $query = "SELECT * FROM $met_img $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'infolist.php';
	}
break;

case 1:   
	$pagename="news";
    $query = "SELECT * FROM $met_news $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
	}
	
	$pagename="product";
    $query = "SELECT * FROM $met_product $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
	}
	
	$pagename="download";
    $query = "SELECT * FROM $met_download $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
	}
    
	$pagename="img";
    $query = "SELECT * FROM $met_img $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
	}
break;

case 2:   
	$pagename="news";
    $query = "SELECT * FROM $met_news $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=$filename;
    require 'infolist.php';
	}
	
	$pagename="product";
    $query = "SELECT * FROM $met_product $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=$filename;
    require 'infolist.php';
	}
	
	$pagename="download";
    $query = "SELECT * FROM $met_download $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=$filename;
    require 'infolist.php';
	}
    
	$pagename="img";
    $query = "SELECT * FROM $met_img $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=$filename;
    require 'infolist.php';
	}
break;
}
	
	$query1 = "SELECT * FROM $met_column $serch_sql1 order by id";
    $result = $db->query($query1);
	while($list= $db->fetch_array($result)){
	if($list[module]==1){
	$url1_c="../".$list[foldername]."/show.php?id=".$list[id];
	$url2_c="../".$list[foldername]."/".$list[filename].$met_c_htmtype;
	$url1_e="../".$list[foldername]."/show.php?lang=en&id=".$list[id];
	$url2_e="../".$list[foldername]."/".$list[filename].$met_e_htmtype;	
	$url1_o="../".$list[foldername]."/show.php?lang=other&id=".$list[id];
	$url2_o="../".$list[foldername]."/".$list[filename].$met_o_htmtype;	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	$list[o_url]=$met_webhtm?$url2_o:$url1_o;
	$list[url]=($lang=="en")?$list[e_url]:(($lang=="other")?$list[o_url]:$list[c_url]);
	$list[c_title]=get_keyword_str($list[c_name],$searchword,50);
	$list[c_content]=get_keyword_str($list[c_content],$searchword,68);
	$list[e_title]=get_keyword_str($list[e_name],$searchword,50);
	$list[e_content]=get_keyword_str($list[e_content],$searchword,68);
	$list[o_title]=get_keyword_str($list[o_name],$searchword,50);
	$list[o_content]=get_keyword_str($list[o_content],$searchword,68);
	$list[title]=($lang=="en")?$list[e_title]:(($lang=="other")?$list[o_title]:$list[c_title]);
	$list[content]=($lang=="en")?$list[e_content]:(($lang=="other")?$list[o_content]:$list[c_content]);
	$list[updatetime]=$m_now_date;
    $search_list[]=$list;
    }}

   	$total_count = count($search_list);
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$met_search_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
	$searchok=$search_list;
	$search_list=array_slice($search_list,$from_record,$list_num);
    $c_page_list = $rowset->link("search.php?class1=$class1&class2=$class2&class3=$class3&c_searchword=".trim($searchword)."&searchtype=$searchtype&page=");		
    $e_page_list = $rowset->link("search.php?lang=en&class1=$class1&class2=$class2&class3=$class3&e_searchword=".trim($searchword)."&searchtype=$searchtype&page=");	
	$o_page_list = $rowset->link("search.php?lang=other&class1=$class1&class2=$class2&class3=$class3&o_searchword=".trim($searchword)."&searchtype=$searchtype&page=");
	$page_list=($lang=="en")?$e_page_list:(($lang=="other")?$o_page_list:$c_page_list);
}else{
    $class1_info=$class_list[$class1];
	if(!$class1_info)okinfo('../',$pagelang[noid]);
	$serch_sql=" where class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	$order_sql=list_order($class1_info[list_order]); 
 switch($searchtype){
   default:
   if($searchword<>'')$serch_sql.=" and $searchpre"."_title like '%$searchword%' or $searchpre"."_content like '%$searchword%' ";
   break;
   case 1:
   if($searchword<>'')$serch_sql.=" and $searchpre"."_title like '%$searchword%' ";
   break;
   case 2:
   if($searchword<>'')$serch_sql.=" and $searchpre"."_content like '%$searchword% ";
   break;
  } 
  	$table_name="met_".$modulename[$class1_info[module]][0];
	$table_name=$$table_name;
    $total_count = $db->counter($table_name, "$serch_sql", "*");
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$met_search_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $table_name $serch_sql $order_sql LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
    $filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=($met_htmpagename==2)?$filename:($met_htmpagename?date('Ymd',strtotime($list[updatetime])):$modulename[$class1_info[module]][1]);
    require 'infolist.php';
	}
	$c_page_list = $rowset->link("search.php?class1=$class1&class2=$class2&class3=$class3&c_searchword=$searchword&searchtype=$searchtype&page=");		
    $e_page_list = $rowset->link("search.php?lang=en&class1=$class1&class2=$class2&class3=$class3&e_searchword=$searchword&searchtype=$searchtype&page=");	
    $o_page_list = $rowset->link("search.php?lang=other&class1=$class1&class2=$class2&class3=$class3&o_searchword=$searchword&searchtype=$searchtype&page=");
    $page_list=($lang=="en")?$e_page_list:(($lang=="other")?$o_page_list:$c_page_list);
}


}

if(!count($search_list)){
$search_list[0][title]="{$lang_SearchInfo5}[<font color=red>$searchword</font>]{$lang_SearchInfo6}";
$search_list[0][updatetime]=$m_now_date;  
$search_list[0][url]=$index_url; 
//兼容1.5
$search_list[0][c_title]="{$lang_SearchInfo5}[<font color=red>$searchword</font>]{$lang_SearchInfo6}";
$search_list[0][e_title]="{$lang_SearchInfo5}[<font color=red>$searchword</font>]{$lang_SearchInfo6}";
$search_list[0][c_url]=$index_url;
$search_list[0][e_url]=$index_url;
//兼容1.5
}

$class2_info=$class2?$class_list[$class2]:"";
$class3_info=$class3?$class_list[$class3]:"";
$class_info=$class1_info=$class_list[$search_column[id]];

	 $class_info[name]=($lang=="en")?$class_info[e_name]:(($lang=="other")?$class_info[o_name]:$class_info[c_name]);
     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$class_info[name]."--".$met_title;


require_once '../public/php/methtml.inc.php';

function methtml_searchlist($content=1,$time=1,$detail=1,$img=0){
global $search_list,$met_img_x,$met_img_y,$lang_Detail;
   $methtml_searchlist.="<ul>\n";
  foreach($search_list as $key=>$val){
  if($img)$methtml_searchlist.="<span class='search_img'><a href='".$val[url]."' target='_blank'><img src='".$val[imgurls]."' width=".$met_img_x." height=".$met_img_y." /></span>";
   $methtml_searchlist.="<li><span class='search_title'><a href='".$val[url]."' target='_blank'>".$val[title]."</a></span>";
   if($content)$methtml_searchlist.="<span class='search_content'>".$val[content]."</span>";
   if($time)$methtml_searchlist.="<span class='search_updatetime'>".$val[updatetime]."</span>";
   if($img)$methtml_searchlist.="<span class='search_detail'><a href='".$val[url]." target='_blank'>".$lang_Detail."</a></span>";
   }
   $methtml_searchlist.="</li>\n";
   $methtml_searchlist.="</ul>\n";
   return $methtml_searchlist;
   }

if($class1=="" || $class1==10000 || $class1==10001 || $class1==$classnow || $class1==0 || $searchword=='' ){
$nav_x[c_name]="<a href='$class_info[c_url]'>{$class_info[c_name]}</a> > {$lang_SearchInfo3}";
$nav_x[c_name]="<a href='$class_info[e_url]'>{$class_info[e_name]}</a> > {$lang_SearchInfo3} ";
$nav_x[name]="<a href='$class_info[url]'>{$class_info[name]}</a> > {$lang_SearchInfo3}";
}
if($searchword<>''){
$nav_x[c_name]=$nav_x[c_name]." > ".$lang_SearchInfo4.$searchword;
$nav_x[e_name]=$nav_x[e_name]." > ".$lang_SearchInfo4.$searchword;
$nav_x[name]=$nav_x[name]." > ".$lang_SearchInfo4.$searchword;
}

if(file_exists("templates/".$met_skin_user."/e_search.html")){
   if($lang=="en"){
     $show[e_description]=$met_e_keywords;
     $show[e_keywords]=$met_e_keywords;
     $e_title_keywords=$lang_SearchInfo."--".$met_e_webname;
     include template('e_search');
	}else{
	 $show[c_description]=$met_c_keywords;
     $show[c_keywords]=$met_c_keywords;
     $c_title_keywords=$lang_SearchInfo."--".$met_c_webname;
	 include template('search');
	 }
}else{
include template('search');
}
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>