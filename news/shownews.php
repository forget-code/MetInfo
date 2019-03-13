<?php
# 文件名称:shownews.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';

    $news=$db->get_one("select * from $met_news where id='$id'");
	if(!$news){
	okinfo('../',$lang_error);
	};

	$news[c_content]=contentshow($news[c_content]);
	$news[e_content]=contentshow($news[e_content]);
	$news[o_content]=contentshow($news[o_content]);
	$news[title]=($lang=="en")?$news[e_title]:(($lang=="other")?$news[o_title]:$news[c_title]);
	$news[keywords]=($lang=="en")?$news[e_keywords]:(($lang=="other")?$news[o_keywords]:$news[c_keywords]);
	$news[description]=($lang=="en")?$news[e_description]:(($lang=="other")?$news[o_description]:$news[c_description]);
	$news[content]=($lang=="en")?$news[e_content]:(($lang=="other")?$news[o_content]:$news[c_content]);
	$news[updatetime] = date($met_contenttime,strtotime($news[updatetime]));
	$news[imgurls]=($news[imgurls]<>"")?$news[imgurls]:'../public/images/metinfo.gif';
	$news[imgurl]=($news[imgurl]<>"")?$news[imgurl]:'../public/images/metinfo.gif';
    $class1=$news[class1];
	$class2=$news[class2];
    $class3=$news[class3];	
$metaccess=$news[access];
require_once '../include/head.php';
    $class1_info=$class_list[$class1];
	$class2_info=$class_list[$class2];
	$class3_info=$class_list[$class3];
	if(!class1_info){
	okinfo('../',$lang_error);
	};

    $prenews=$db->get_one("select * from $met_news where class1=$class1 and class2=$class2 and class3=$class3 and (id > $id) limit 0,1");
    $nextnews=$db->get_one("select * from $met_news where class1=$class1 and class2=$class2 and class3=$class3 and (id < $id) order by id desc limit 0,1");
if($dataoptimize[2][otherlist]){	
	$serch_sql=" where class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	$serch_sql .=($lang=="en")?" and e_title<>'' ":(($lang=="other")?" and o_title<>'' ":" and c_title<>'' ");
	$order_sql=$class3?list_order($class3_info[list_order]):($class2?list_order($class2_info[list_order]):list_order($class1_info[list_order]));
    $query = "SELECT * FROM $met_news $serch_sql $order_sql LIMIT 0, $met_news_list";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
    $list[class1_name]=$class_list[$list[class1]][name];
	$list[class1_url]=$class_list[$list[class1]][url];
	$list[class2_name]=$list[class2]?$class_list[$list[class2]][name]:$list[class1_name];
	$list[class2_url]=$list[class2]?$class_list[$list[class2]][url]:$list[class1_url];
	$list[class3_name]=$list[class3]?$class_list[$list[class3]][name]:($list[class2]?$class_list[$list[class2]][name]:$list[class1_name]);
	$list[class3_url]=$list[class3]?$class_list[$list[class3]][url]:($list[class2]?$class_list[$list[class2]][url]:$list[class1_url]);
	$list[title]=($lang=="en")?$list[e_title]:(($lang=="other")?$list[o_title]:$list[c_title]);
	$list[classname]=$class2?$list[class3_name]:$list[class2_name];
	$list[classurl]=$class2?$list[class3_url]:$list[class2_url];
	$list[keywords]=($lang=="en")?$list[e_keywords]:(($lang=="other")?$list[o_keywords]:$list[c_keywords]);
	$list[description]=($lang=="en")?$list[e_description]:(($lang=="other")?$list[o_description]:$list[c_description]);
	$list[content]=($lang=="en")?$list[e_content]:(($lang=="other")?$list[o_content]:$list[c_content]);
	$list[top]=$list[top_ok]?"<img class='listtop' src='".$img_url."top.gif"."' />":"";
	$list[hot]=$list[top_ok]?"":(($list[hits]>=$met_hot)?"<img class='listhot' src='".$img_url."hot.gif"."' />":"");
	$list[news]=$list[top_ok]?"":((((strtotime($m_now_date)-strtotime($list[updatetime]))/86400)<$met_newsdays)?"<img class='listnews' src='".$img_url."news.gif"."' />":"");
	$list[updatetime] = date($met_listtime,strtotime($list[updatetime]));
	$list[imgurls]=($list[imgurls]<>"")?$list[imgurls]:'../public/images/metinfo.gif';
	$list[imgurl]=($list[imgurl]<>"")?$list[imgurl]:'../public/images/metinfo.gif';
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
	$phpname="shownews.php?id=".$list[id];
	$list[c_url]=$met_webhtm?$htmname.$met_c_htmtype:$phpname;
	$list[e_url]=$met_webhtm?$htmname.$met_e_htmtype:$phpname."&lang=en";
	$list[o_url]=$met_webhtm?$htmname.$met_o_htmtype:$phpname."&lang=other";
	$list[url]=($lang=="en")?$list[e_url]:(($lang=="other")?$list[o_url]:$list[c_url]);
	if($prenews[id]==$list[id])$preinfo=$list;  
	if($nextnews[id]==$list[id])$nextinfo=$list;
if($met_member_use==2){
   if($list[class3]!=0&&$class3_list[$list[class3]][name]==""){
   $nowaccess=100;
   }elseif($list[class2]!=0&&$class2_list[$list[class2]][name]==""){
   $nowaccess=101;
   }elseif($list[class1]!=0&&$class1_list[$list[class1]][name]==""){
   $nowaccess=102;
   }else{
   $nowaccess=max(intval($list[access]),intval($class3_list[$list[class3]][access]),intval($class2_list[$list[class2]][access]),intval($class1_list[$list[class1]][access]));
   }
 if(intval($metinfo_member_type)>=intval($nowaccess)){ 
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
   }else{
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
}
}
    $news_class_img=$news_class_new;
	$news_list_img=$news_list_new;
	
     $show[description]=$news[description]?$news[description]:$met_keywords;
     $show[keywords]=$news[keywords]?$news[keywords]:$met_keywords;
	 $met_title=$news[title]."--".$met_title;
     require_once '../public/php/methtml.inc.php';
	 require_once '../public/php/newshtml.inc.php';
	 $nav_x[name]=$nav_x[name]." > ".$news[title];

if(file_exists("templates/".$met_skin_user."/e_shownews.html")){
   if($lang=="en"){
     $show[e_description]=$news[e_description]?$news[e_description]:$met_e_keywords;
     $show[e_keywords]=$news[e_keywords]?$news[e_keywords]:$met_e_keywords;
     $e_title_keywords=$news[e_title]."--".$met_e_webname;
	 $nav_x[e_name]=$nav_x[e_name]." > ".$news[e_title];
     include template('e_shownews');
	}else{
	 $show[c_description]=$news[c_description]?$news[c_description]:$met_c_keywords;
     $show[c_keywords]=$news[c_keywords]?$news[c_keywords]:$met_c_keywords;
     $c_title_keywords=$news[c_title]."--".$met_c_webname;
	 $nav_x[c_name]=$nav_x[c_name]." > ".$news[c_title];
	 include template('shownews');
	 }
}else{
include template('shownews');
}
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>