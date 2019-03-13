<?php
# 文件名称:showjob.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';

    $job=$db->get_one("select * from $met_job where id='$id'");
	if(!$job){
	okinfo('../',$lang_error);
	};
    if(intval($job[useful_life])==0)$job[useful_life]=$lang_Nolimit;
    $job[position]=($lang=="en")?$job[e_position]:(($lang=="other")?$job[o_position]:$job[c_position]);
	$job[place]=($lang=="en")?$job[e_place]:(($lang=="other")?$job[o_place]:$job[c_place]);
	$job[deal]=($lang=="en")?$job[e_deal]:(($lang=="other")?$job[o_deal]:$job[c_deal]);
	$job[content]=($lang=="en")?$job[e_content]:(($lang=="other")?$job[o_content]:$job[c_content]);

    $classaccess= $db->get_one("SELECT * FROM $met_column WHERE module='6'");
    $class1=$classaccess[id];		
$metaccess=$job[access];
$cv[c_url]=$met_webhtm?"cv".$met_c_htmtype:"cv.php";
$cv[e_url]=$met_webhtm?"cv".$met_e_htmtype:"cv.php?lang=en";
$cv[o_url]=$met_webhtm?"cv".$met_o_htmtype:"cv.php?lang=other";
if($met_submit_type==1){
   $cv[url]=($lang=="en")?"cv.php?lang=en&selectedjob=":(($lang=="other")?"cv.php?lang=other&selectedjob=":"cv.php?selectedjob=");
   }else{
   $cv[url]=($lang=="en")?$cv[e_url]:(($lang=="other")?$cv[o_url]:$cv[c_url]);
   }
 	if($met_submit_type==1){
	   $job[cv]=$cv[url].$job[id];
	   }else{
	   $job[cv]=$cv[url];
	   }
require_once '../include/head.php';
    $class1_info=$class_list[$class1];
	if(!class1_info){
	okinfo('../',$lang_error);
	};
    $prejob=$db->get_one("select * from $met_job where id > $id limit 0,1");
    $nextjob=$db->get_one("select * from $met_job where id < $id order by id desc limit 0,1");
	
	$serch_sql=" where 1=1 ";
	$serch_sql .=($lang=="en")?" and e_position<>'' ":(($lang=="other")?" and o_position<>'' ":" and c_position<>'' ");
	$order_sql="order by addtime desc ";
    $query = "SELECT * FROM $met_job $serch_sql $order_sql";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
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
	$list[title]=$list[position];
	if($prejob[id]==$list[id])$preinfo=$list;  
	if($nextjob[id]==$list[id])$nextinfo=$list;
	 if($met_submit_type==1){
	   $list[cv]=$cv[url].$list[id];
	   }else{
	   $list[cv]=$cv[url];
	   }
    $job_list[]=$list;
    }


	
     $show[description]=$job[description]?$job[description]:$met_keywords;
     $show[keywords]=$job[keywords]?$job[keywords]:$met_keywords;
	 $met_title=$job[position]."--".$met_title;
$nav_list2[$class1][0]=$class1_info;
$nav_list2[$class1][1]=array('id'=>10004,'url'=>$cv[url],'name'=>$lang_cvtitle,'c_url'=>$cv[c_url],'e_url'=>$cv[e_url],'o_url'=>$cv[o_url],'c_name'=>$lang_cvtitle,'e_name'=>$lang_cvtitle,'o_name'=>$lang_cvtitle);
     require_once '../public/php/methtml.inc.php';
	 require_once '../public/php/jobhtml.inc.php';
	 $nav_x[name]=$nav_x[name]." > ".$job[position];

if(file_exists("templates/".$met_skin_user."/e_showjob.html")){
   if($lang=="en"){
     $show[e_description]=$job[e_description]?$job[e_description]:$met_e_keywords;
     $show[e_keywords]=$job[e_keywords]?$job[e_keywords]:$met_e_keywords;
     $e_title_keywords=$job[e_position]."--".$met_e_webname;
	 $nav_x[e_name]=$nav_x[e_name]." > ".$job[e_position];
     include template('e_showjob');
	}else{
	 $show[c_description]=$job[c_description]?$job[c_description]:$met_c_keywords;
     $show[c_keywords]=$job[c_keywords]?$job[c_keywords]:$met_c_keywords;
     $c_title_keywords=$job[c_position]."--".$met_c_webname;
	 $nav_x[c_name]=$nav_x[c_name]." > ".$job[c_position];
	 include template('showjob');
	 }
}else{
include template('showjob');
}
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>