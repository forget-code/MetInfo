<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../include/common.inc.php';
$search_column=$db->get_one("select * from $met_column where module='11' and lang='$lang'");
$metaccess=$search_column[access];
$classnow=$search_column[id];
require_once '../include/head.php';
unset($search_list);
function replaceHtmlAndJs($document)
{
$document = trim($document);
if (strlen($document) <= 0)
{
   return $document;
}
$search = array ("'<script[^>]*?>.*?</script>'si",  // Remove javascript
                  "'<[\/\!]*?[^<>]*?>'si",          // Remove HTML
                  "'([\r\n])[\s]+'",                // Remove black
                  "'&(quot|#34);'i",                // Replace HTML
                  "'&(amp|#38);'i",
                  "'&(lt|#60);'i",
                  "'&(gt|#62);'i",
                  "'&(nbsp|#160);'i"
                  );                    

$replace = array ("",
                   "",
                   "\\1",
                   "\"",
                   "&",
                   "<",
                   ">",
                   " "
                   );

return @preg_replace ($search, $replace, $document);
}

if($searchword==""){
$search_list[0][title]="<font color=red>{$lang_SearchInfo1}</font>";
$search_list[0][updatetime]=$m_now_date;  
$search_list[0][url]=$index_url; 
$class_info=$class1_info=$class_list[$search_column[id]];
}
else
{
if(($class1=="" || $class1==10000 || $class1==10001 || $class1==0) and (intval($module)==0)){
   switch($searchtype){
   default:
   if($searchword<>'')$serch_sql=" where (title like '%".trim($searchword)."%' or content like '%".trim($searchword)."%') ";
   if($searchword<>'')$serch_sql1=" where (name like '%".trim($searchword)."%' or content like '%".trim($searchword)."%') ";
   break;
   case 1:
   if($searchword<>'')$serch_sql=" where title like '%".trim($searchword)."%' ";
   if($searchword<>'')$serch_sql1=" where name like '%".trim($searchword)."%' ";
   break;
   case 2:
   if($searchword<>'')$serch_sql=" where content like '%".trim($searchword)."%' ";
   if($searchword<>'')$serch_sql1=" where content like '%".trim($searchword)."%' ";
   break;
   }
$serch_sql.= "and lang='$lang' "; 
if($met_member_use==2)$serch_sql.= " and access<=$metinfo_member_type";
$searchitem="id,title,content,updatetime,filename,hits,imgurls,class1";
$searchitem1="id,title,content,updatetime,filename,hits,class1";
switch($met_htmpagename){
case 0:   
	$pagename="news";
    $query = "SELECT $searchitem FROM $met_news $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="shownews";
    require 'searchlist.php';
	}
	
	$pagename="product";
    $query = "SELECT $searchitem FROM $met_product $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showproduct";
    require 'searchlist.php';
	}
	
	$pagename="download";
    $query = "SELECT $searchitem1 FROM $met_download $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'searchlist.php';
	}
    
	$pagename="img";
    $query = "SELECT $searchitem FROM $met_img $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'searchlist.php';
	}
break;

case 1:   
	$pagename="news";
    $query = "SELECT $searchitem FROM $met_news $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'searchlist.php';
	}
	
	$pagename="product";
    $query = "SELECT $searchitem FROM $met_product $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'searchlist.php';
	}
	
	$pagename="download";
    $query = "SELECT $searchitem1 FROM $met_download $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'searchlist.php';
	}
    
	$pagename="img";
    $query = "SELECT $searchitem FROM $met_img $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'searchlist.php';
	}
break;

case 2:   
	$pagename="news";
    $query = "SELECT $searchitem FROM $met_news $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=$class_list[$list[class1]][foldername];
    require 'searchlist.php';
	}
	
	$pagename="product";
    $query = "SELECT $searchitem FROM $met_product $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=$class_list[$list[class1]][foldername];
    require 'searchlist.php';
	}
	
	$pagename="download";
    $query = "SELECT $searchitem1 FROM $met_download $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=$class_list[$list[class1]][foldername];
    require 'searchlist.php';
	}
    
	$pagename="img";
    $query = "SELECT $searchitem FROM $met_img $serch_sql order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=$class_list[$list[class1]][foldername];
    require 'searchlist.php';
	}
break;
}
	$serch_sql1.=" and lang='$lang' and module=1";
	$query1 = "SELECT * FROM $met_column $serch_sql1 order by id";
    $result = $db->query($query1);
	while($list= $db->fetch_array($result)){
	if($list[filename]=='')$list[filename]=$list[foldername].$list[id];
	$url1="../".$list[foldername]."/show.php?lang=".$lang."&id=".$list[id];
	$url2="../".$list[foldername]."/".$list[filename].$met_htmtype;	
	$list[url]=$met_webhtm?$url2:$url1;
	$list[title]=get_keyword_str($list[name],$searchword,50);
	$list[content]=get_keyword_str($list[content],$searchword,68);
	$list[updatetime]=$m_now_date;
    $search_list[]=$list;
    }

   	$total_count = count($search_list);
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$met_search_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
	$searchok=$search_list;
	$search_list=array_slice($search_list,$from_record,$list_num);		
    $page_list = $rowset->link("search.php?lang=$lang&class1=$class1&class2=$class2&class3=$class3&searchword=".trim($searchword)."&searchtype=$searchtype&page=");	
	$class_info=$class1_info=$class_list[$search_column[id]];
}else{
    if($class1)$module=0;
    if(intval($module)){
      $serch_sql.=" where lang='$lang' ";
	}else{
	$class1_info=$class_list[$class1];
	if(!$class1_info)okinfo('../',$pagelang[noid]);
	$serch_sql=" where lang='$lang' and class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	$order_sql=list_order($class1_info[list_order]); 
	}
 switch($searchtype){
   default:
   if($searchword<>'')$serch_sql.=" and (title like '%$searchword%' or content like '%$searchword%') ";
   break;
   case 1:
   if($searchword<>'')$serch_sql.=" and title like '%$searchword%' ";
   break;
   case 2:
   if($searchword<>'')$serch_sql.=" and content like '%$searchword%' ";
   break;
  } 
    $module_name=intval($module)?$module:$class1_info[module];
  	$table_name="met_".$modulename[$module_name][0];
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
	$pagename=$modulename[$module_name][0];
	while($list= $db->fetch_array($result)){
    $filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=($met_htmpagename==2)?$filename:($met_htmpagename?date('Ymd',strtotime($list[updatetime])):$modulename[$module_name][1]);
    require 'searchlist.php';
	}
    $page_list = $rowset->link("search.php?lang=$lang&class1=$class1&class2=$class2&class3=$class3&searchword=$searchword&searchtype=$searchtype&page=");
	$class1_info=$class1?$class_list[$class1]:"";
	$class2_info=$class2?$class_list[$class2]:"";
    $class3_info=$class3?$class_list[$class3]:"";
    $class_info=intval($module)?$class_list[$search_column[id]]:($class3?$class3_info:($class2?$class2_info:$class1_info));
	
}
}

if(!count($search_list)){
$search_list[0][title]="{$lang_SearchInfo3}[<font color=red>$searchword</font>]{$lang_SearchInfo4}";
$search_list[0][updatetime]=$m_now_date;  
$search_list[0][url]=$index_url; 
}
if($class_info[name]=="")$class_info=array('name'=>$lang_search,'url'=>'search.php?lang='.$lang);
     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$met_title?$class_info['name'].'-'.$met_title:$class_info['name'];
	 if($class_info['ctitle']!='')$met_title=$class_info['ctitle'];


require_once '../public/php/methtml.inc.php';

function methtml_searchlist($content=1,$time=1,$detail=1,$img=0){
global $search_list,$met_img_x,$met_img_y,$lang_Detail;
   $methtml_searchlist.="<ul>\n";
  foreach($search_list as $key=>$val){
  if($img)$methtml_searchlist.="<span class='search_img'><a href='".$val[url]."' target='_blank'><img src='".$val[imgurls]."' width=".$met_img_x." height=".$met_img_y." /></span>";
   $methtml_searchlist.="<li><span class='search_title'><a href='".$val[url]."' target='_blank'>".$val[title]."</a></span>";
   if($content)$methtml_searchlist.="<span class='search_content'>".$val[content]."</span>";
   if($time)$methtml_searchlist.="<span class='search_updatetime'>".$val[updatetime]."</span>";
   if($detail)$methtml_searchlist.="<span class='search_detail'><a href='".$val[url]."' target='_blank'>".$lang_Detail."</a></span>";
   }
   $methtml_searchlist.="</li>\n";
   $methtml_searchlist.="</ul>\n";
   return $methtml_searchlist;
   }
if($class1=="" || $class1==10000 || $class1==10001 || $class1==0 || $searchword=='' ){
$nav_x[name]="<a href='$class_info[url]'>{$class_info[name]}</a> > {$lang_SearchInfo2}";
}
if($searchword<>''){
$nav_x[name]=$nav_x[name]."&nbsp&nbsp<font color=red>'".$lang_Keywords.":&nbsp".$searchword."'</font>";
}
include template('search');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>