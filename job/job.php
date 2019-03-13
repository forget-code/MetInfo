<?php
# 文件名称:job.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
$classaccess= $db->get_one("SELECT * FROM $met_column WHERE module='6'");
$metaccess=$classaccess[access];
$class1=$classaccess[id];

require_once '../include/head.php';
    $class1_info=$class_list[$class1];
	if(!class1_info){
	okinfo('../',$lang_error);
	};
    $serch_sql=" where 1=1 ";
	$serch_sql .=($lang=="en")?" and e_position<>'' ":(($lang=="other")?" and o_position<>'' ":" and c_position<>'' ");
	$order_sql="order by addtime desc ";
    $total_count = $db->counter($met_job, "$serch_sql", "*");
	$totaltop_count = $db->counter($met_job, "$serch_sql and top_ok='1'", "*");
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$met_job_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
	$page = $page?$page:1;
	 $query = "SELECT * FROM $met_job $serch_sql and top_ok='1' $order_sql LIMIT $from_record, $list_num";
	 $result = $db->query($query);
	 while($list= $db->fetch_array($result)){
	 $job_listnow[]=$list;
	 }
	if(count($job_listnow)<intval($list_num)){
	 if($totaltop_count>=$list_num){
	  $from_record=$from_record-$totaltop_count;
	  if($from_record<0)$from_record=0;
	 }else{
	 $from_record=$from_record?($from_record-$totaltop_count):$from_record;
	 }
	 $list_num=intval($list_num)-count($job_listnow);
	 $query = "SELECT * FROM $met_job $serch_sql and top_ok='0' $order_sql LIMIT $from_record, $list_num";
	 $result = $db->query($query);
	 while($list= $db->fetch_array($result)){
	 $job_listnow[]=$list;
	 }
	}
	foreach($job_listnow as $key=>$list){
	if(intval($list[useful_life])==0)$list[useful_life]=$lang_Nolimit;
	$list[position]=($lang=="en")?$list[e_position]:(($lang=="other")?$list[o_position]:$list[c_position]);
	$list[place]=($lang=="en")?$list[e_place]:(($lang=="other")?$list[o_place]:$list[c_place]);
	$list[deal]=($lang=="en")?$list[e_deal]:(($lang=="other")?$list[o_deal]:$list[c_deal]);
	$list[content]=($lang=="en")?$list[e_content]:(($lang=="other")?$list[o_content]:$list[c_content]);
	$list[top]=$list[top_ok]?"<img class='listtop' src='".$img_url."top.gif"."' />":"";
	$list[news]=$list[top_ok]?"":((((strtotime($m_now_date)-strtotime($list[addtime]))/86400)<$met_newsdays)?"<img class='listnews' src='".$img_url."news.gif"."' />":"");
	$list[addtime] = date($met_listtime,strtotime($list[addtime]));
	switch($met_htmpagename){
    case 0:
	$htmname="showjob".$list[id];	
	break;
	case 1:
	$list[updatetime1] = date('Ymd',strtotime($list[addtime]));
	$htmname=$list[updatetime1].$list[id];	
	break;
	case 2:
	$htmname="job".$list[id];	
	break;
	}	
	$phpname="showjob.php?id=".$list[id];
	$list[c_url]=$met_webhtm?$htmname.$met_c_htmtype:$phpname;
	$list[e_url]=$met_webhtm?$htmname.$met_e_htmtype:$phpname."&lang=en";
	$list[o_url]=$met_webhtm?$htmname.$met_o_htmtype:$phpname."&lang=other";
	$list[url]=($lang=="en")?$list[e_url]:(($lang=="other")?$list[o_url]:$list[c_url]);
	 if($met_submit_type==1){
	   $list[cv]=$cv[url].$list[id];
	   }else{
	   $list[cv]=$cv[url];
	   }
    $job_list[]=$list;
	}

if($met_webhtm==2){
$met_pagelist="job_".$class1."_";
$c_page_list = $rowset->link($met_pagelist,$met_c_htmtype);
$e_page_list = $rowset->link($met_pagelist,$met_e_htmtype);
$o_page_list = $rowset->link($met_pagelist,$met_o_htmtype);
}else{	
$c_page_list = $rowset->link("job.php?page=");		
$e_page_list = $rowset->link("job.php?lang=en&page=");	
$o_page_list = $rowset->link("job.php?lang=other&page=");
}
$page_list=($lang=="en")?$e_page_list:(($lang=="other")?$o_page_list:$c_page_list);


$class_info[e_name]=$class1_info[e_name];
$class_info[c_name]=$class1_info[c_name];
$class_info[o_name]=$class1_info[o_name];

$class_info[name]=($lang=="en")?$class_info[e_name]:(($lang=="other")?$class_info[o_name]:$class_info[c_name]);


     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$class_info[name]."--".$met_title;

$nav_list2[$class1][0]=$class1_info;
$nav_list2[$class1][1]=array('id'=>10004,'url'=>$cv[url],'name'=>$lang_cvtitle,'c_url'=>$cv[c_url],'e_url'=>$cv[e_url],'o_url'=>$cv[o_url],'c_name'=>$lang_cvtitle,'e_name'=>$lang_cvtitle,'o_name'=>$lang_cvtitle);

require_once '../public/php/methtml.inc.php';
require_once '../public/php/jobhtml.inc.php';
if(file_exists("templates/".$met_skin_user."/e_job.html")){
   if($lang=="en"){
     $show[e_description]=$class_info[e_description]?$class_info[e_description]:$met_e_keywords;
     $show[e_keywords]=$class_info[e_keywords]?$class_info[e_keywords]:$met_e_keywords;
     $e_title_keywords=$class_info[e_name]."--".$met_e_webname;
     include template('e_job');
	}else{
	 $show[c_description]=$class_info[c_description]?$class_info[c_description]:$met_c_keywords;
     $show[c_keywords]=$class_info[c_keywords]?$class_info[c_keywords]:$met_c_keywords;
     $c_title_keywords=$class_info[c_name]."--".$met_c_webname;
	 include template('job');
	 }
}else{
include template('job');
}
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>