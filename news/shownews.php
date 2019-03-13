<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../include/common.inc.php';

    $news=$db->get_one("select * from $met_news where id='$id'");
	if(!$news){
	okinfo('../',$lang_error);
	}
	$news[content]=contentshow($news[content]);
	$news[updatetime] = date($met_contenttime,strtotime($news[updatetime]));
	$news[imgurls]=($news[imgurls]<>"")?$news[imgurls]:'../public/images/metinfo.gif';
	$news[imgurl]=($news[imgurl]<>"")?$news[imgurl]:'../public/images/metinfo.gif';
    $class1=$news[class1];
	$class2=$news[class2];
    $class3=$news[class3];	
$metaccess=$news[access];
require_once '../include/head.php';
    $class1_info=$class_list[$class1][releclass]?$class_list[$class_list[$class1][releclass]]:$class_list[$class1];
	$class2_info=$class_list[$class1][releclass]?$class_list[$class1]:$class_list[$class2];
	$class3_info=$class_list[$class3];
if($dataoptimize[$pagemark][nextlist]){
if($met_member_use==2){
    $prenews=$db->get_one("select $listitem[news] from $met_news where  class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (access<=$metinfo_member_type) and (id > $id) limit 0,1");
    $nextnews=$db->get_one("select $listitem[news] from $met_news where class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (access<=$metinfo_member_type) and (id < $id) order by id desc limit 0,1");
}else{
    $prenews=$db->get_one("select $listitem[news] from $met_news where  class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (id > $id) limit 0,1");
    $nextnews=$db->get_one("select $listitem[news] from $met_news where class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (id < $id) order by id desc limit 0,1");
}
}
if($dataoptimize[2][otherlist]){	
	$serch_sql=" where lang='$lang' and class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	if($met_member_use==2)$serch_sql .= " and access<=$metinfo_member_type";
	$order_sql=$class3?list_order($class_list[$class3][list_order]):($class2?list_order($class_list[$class2][list_order]):list_order($class_list[$class1][list_order]));
    $query = "SELECT $listitem[news] FROM $met_news $serch_sql $order_sql LIMIT 0, $met_news_list";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
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
	if($prenews[id]==$list[id])$preinfo=$list;  
	if($nextnews[id]==$list[id])$nextinfo=$list;
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
}elseif($dataoptimize[$pagemark][nextlist]){
    switch($met_htmpagename){
    case 0:
	$prehtmname="shownews";	
	$nexthtmname="shownews";
	break;
	case 1:
	$prehtmname = date('Ymd',strtotime($prenews[updatetime]));	
	$nexthtmname = date('Ymd',strtotime($nextnews[updatetime]));
	break;
	case 2:
	$prehtmname=$class_list[$prenews[class1]][foldername];
    $nexthtmname=$class_list[$nextnews[class1]][foldername];		
	break;
	}
	$phpname="shownews.php?".$langmark."&id=";
	if($prenews)$prenews[url]=$met_webhtm?$prehtmname.$prenews[id].$met_htmtype:$phpname.$prenews[id];
    if($nextnews)$nextnews[url]=$met_webhtm?$nexthtmname.$nextnews[id].$met_htmtype:$phpname.$nextnews[id];
	$preinfo=$prenews;
	$nextinfo=$nextnews;
}
    $news_class_img=$news_class_new;
	$news_list_img=$news_list_new;
$class2=$class_list[$class1][releclass]?$class1:$class2;
$class1=$class_list[$class1][releclass]?$class_list[$class1][releclass]:$class1;	
     $show[description]=$news[description]?$news[description]:$met_keywords;
     $show[keywords]=$news[keywords]?$news[keywords]:$met_keywords;
	 $met_title=$news[title]."--".$met_title;
     require_once '../public/php/methtml.inc.php';
	 require_once '../public/php/newshtml.inc.php';
	 $nav_x[name]=$nav_x[name]." > ".$news[title];
include template('shownews');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>