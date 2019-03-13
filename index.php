<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
if(!file_exists('config/install.lock')){
 header("location:install/index.php");exit;
}
$index="index";
require_once 'include/common.inc.php';
require_once 'include/head.php';
$index = $db->get_one("SELECT * FROM $met_index where lang='$lang' order by id desc");
$index[online_type]=$index_online_type;
$index[news_no]=$index_news_no;
$index[product_no]=$index_product_no;
$index[download_no]=$index_download_no;
$index[img_no]=$index_img_no;
$index[job_no]=$index_job_no;
$index[link_ok]=$index_link_ok;
$index[link_img]=$index_link_img;
$index[link_text]=$index_link_text;
if($index[online_type]=="1" and $met_online_type=="0" )$met_online_type=2;
if($index[online_type]=="0" )$met_online_type=3;
if(!isset($dataoptimize[$pagemark][job]))$dataoptimize[$pagemark][job]=$dataoptimize[10000][job];
if($dataoptimize[$pagemark]['job']){
    $query = "SELECT * FROM $met_job where top_ok='1' and lang='$lang' order by no_order";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$list[top]="<img src='".$navurl.$img_url."top.gif"."' />";
	$list[news]="";
	 if($met_submit_type==1){
	   $list[cv]=$cv[url].$list[id];
	   }else{
	   $list[cv]=$cv[url];
	   }
	 switch($met_htmpagename){
     case 0:
	 $htmname="job/showjob".$list[id];
	 $phpname="job/showjob.php?id=".$list[id];	
	 break;
	 case 1:
	 $htmname="job/".date('Ymd',strtotime($list[addtime])).$list[id];
	 $phpname="job/showjob.php?id=".$list[id];
	 break;
	 case 2:
	 $htmname="job/job".$list[id];
	 $phpname="job/showjob.php?id=".$list[id];	
	 break;
	 }
	$list[url]=$met_webhtm?$htmname.$met_htmtype:$phpname."&lang=".$lang;
	$list[addtime] = date($met_listtime,strtotime($list[addtime]));
	if($met_member_use==2){
     if(intval($metinfo_member_type)>=intval($list[access])){  
    $listall[job][]=$list;
	}
	}else{
	$listall[job][]=$list;
	}
}
    $query = "SELECT * FROM $met_job where top_ok='0' and lang='$lang' order by no_order";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$list[top]="";
	$list[news]=(((strtotime($m_now_date)-strtotime($list[addtime]))/86400)<$met_newsdays)?"<img src='".$navurl.$img_url."news.gif"."' />":"";
	switch($met_htmpagename){
     case 0:
	 $htmname="showjob".$list[id];	
	 break;
	 case 1:
	 $htmname=date('Ymd',strtotime($list[addtime])).$list[id];
	 break;
	 case 2:
	 $htmname="job".$list[id];	
	 break;
	 }
	 if($met_submit_type==1){
	   $list[cv]=$cv[url].$list[id];
	   }else{
	   $list[cv]=$cv[url];
	   }
	$filename=$navurl.'job';
	$pagename='job';
	$htmname=($list['filename']<>"" and $metadmin['pagename'])?$filename."/".$list['filename']:$filename."/".$htmname;
	$panyid = $list['filename']!=''?$list['filename']:$list['id'];
	$met_ahtmtype = $list['filename']<>""?$met_chtmtype:$met_htmtype;
	$phpname=$met_pseudo?$filename."/".$panyid.'-'.$lang.'.html':$filename."/show".$pagename.".php?".$langmark."&id=".$list['id'];	
	$list['url']=$met_pseudo?$phpname:($met_webhtm?$htmname.$met_ahtmtype:$phpname);
	$list['addtime'] = date($met_listtime,strtotime($list['addtime']));
	if($met_member_use==2){
     if(intval($metinfo_member_type)>=intval($list[access])){  
      $listall[job][]=$list;
	}
	}else{
	$listall[job][]=$list;
	}
}
}
$show['description']=$met_description;
$show['keywords']=$met_keywords;
require_once 'public/php/methtml.inc.php';
if($met_indexskin=="" or (!file_exists("templates/".$met_skin_user."/".$met_indexskin.".".$dataoptimize_html)))$met_indexskin='index';
include template($met_indexskin);
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>