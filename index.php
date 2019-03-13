<?php
# 文件名称:show.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
if(!file_exists('config/install.lock')){
 header("location:install/index.php");exit;
}
$index="index";
require_once 'include/common.inc.php';
require_once 'include/head.php';
$news_list_new=$listimg[news];
$news_list_com=$listcom[news];
$news_list=$listall[news];
$news_listhits_new=$hitslistimg[news];
$news_listhits_com=$hitslistcom[news];
$news_listhits=$hitslistall[news];
$product_list_new=$listnew[product];
$product_list_com=$listcom[product];
$product_list=$listall[product];
$product_listhits_new=$hitslistnew[product];
$product_listhits_com=$hitslistcom[product];
$product_listhits=$hitslistall[product];
$download_list_new=$listnew[download];
$download_list_com=$listcom[download];
$download_list=$listall[download];
$download_listhits_new=$hitslistnew[download];
$download_listhits_com=$hitslistcom[download];
$download_listhits=$hitslistall[download];	
$img_list_new=$listnew[img];
$img_list_com=$listcom[img];
$img_list=$listall[img];
$img_listhits_new=$hitslistnew[img];
$img_listhits_com=$hitslistcom[img];
$img_listhits=$hitslistall[img];
	
$index = $db->get_one("SELECT * FROM $met_index order by id desc");
if($index[online_type]=="1" and $met_online_type=="0" )$met_online_type=2;
if($index[online_type]=="0" )$met_online_type=3;
$index[content]=($lang=="en")?$index[e_content]:(($lang=="other")?$index[o_content]:$index[c_content]);	

    $query = "SELECT * FROM $met_job where top_ok='1' order by addtime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$list[position]=($lang=="en")?$list[e_position]:(($lang=="other")?$list[o_position]:$list[c_position]);
if($list[position]<>""){
	$list[place]=($lang=="en")?$list[e_place]:(($lang=="other")?$list[o_place]:$list[c_place]);
	$list[deal]=($lang=="en")?$list[e_deal]:(($lang=="other")?$list[o_deal]:$list[c_deal]);
	$list[content]=($lang=="en")?$list[e_content]:(($lang=="other")?$list[o_content]:$list[c_content]);
	$list[top]="<img src='".$navurl.$img_url."top.gif"."' />";
	$list[news]="";
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
	 $list[c_url]=$met_webhtm?$htmname.$met_c_htmtype:$phpname;
	 $list[e_url]=$met_webhtm?$htmname.$met_e_htmtype:$phpname."&lang=en";
	 $list[o_url]=$met_webhtm?$htmname.$met_o_htmtype:$phpname."&lang=other";
	$list[url]=($lang=="en")?$list[e_url]:(($lang=="other")?$list[o_url]:$list[c_url]);
	$list[addtime] = date($met_listtime,strtotime($list[addtime]));
	$listall[job][]=$list;
	}
}

if(!isset($dataoptimize[$pagemark][job]))$dataoptimize[$pagemark][job]=$dataoptimize[10000][job];
if($dataoptimize[$pagemark][job]){
    $query = "SELECT * FROM $met_job where top_ok='0' order by addtime desc";
	nave1_1();
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$list[position]=($lang=="en")?$list[e_position]:(($lang=="other")?$list[o_position]:$list[c_position]);
if($list[position]<>""){
	$list[place]=($lang=="en")?$list[e_place]:(($lang=="other")?$list[o_place]:$list[c_place]);
	$list[deal]=($lang=="en")?$list[e_deal]:(($lang=="other")?$list[o_deal]:$list[c_deal]);
	$list[content]=($lang=="en")?$list[e_content]:(($lang=="other")?$list[o_content]:$list[c_content]);
	$list[top]="";
	$list[news]=(((strtotime($m_now_date)-strtotime($list[addtime]))/86400)<$met_newsdays)?"<img src='".$navurl.$img_url."news.gif"."' />":"";
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

	 $list[c_url]=$met_webhtm?$htmname.$met_c_htmtype:$phpname;
	 $list[e_url]=$met_webhtm?$htmname.$met_e_htmtype:$phpname."&lang=en";
	 $list[o_url]=$met_webhtm?$htmname.$met_o_htmtype:$phpname."&lang=other";
	$list[url]=($lang=="en")?$list[e_url]:(($lang=="other")?$list[o_url]:$list[c_url]);
	$list[addtime] = date($met_listtime,strtotime($list[addtime]));
	$listall[job][]=$list;
	}
}
}
$show[description]=$met_description;
$show[keywords]=$met_keywords;
if(file_exists("templates/".$met_skin_user."/e_index.html")){
   if($lang=="en"){
     $show[e_description]=$met_e_description;
     $show[e_keywords]=$met_e_keywords;
     include template('e_index');
	}else{
	 $show[c_description]=$met_c_description;
     $show[c_keywords]=$met_c_keywords;
	 include template('index');
	 }
}else{
require_once 'public/php/methtml.inc.php';
if($met_indexskin=="" or (!file_exists("templates/".$met_skin_user."/".$met_indexskin.".html")))$met_indexskin='index';
include template($met_indexskin);
}
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>