<?php
# 文件名称:index.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
$settings = parse_ini_file('config.inc.php');
@extract($settings);
$message_column=$db->get_one("select * from $met_column where module='7'");
$metaccess=$message_column[access];
$class1=$message_column[id];
require_once '../include/head.php';
$class1_info=$class_list[$class1];
$navtitle=($lang=="en")?$message_column[e_name]:(($lang=="other")?$message_column[o_name]:$message_column[c_name]);
    $serch_sql=" where 1=1 ";
	if($met_fd_type==1) $serch_sql.=" and readok='1' ";
	if($lang=="")$lang='cn';
	$serch_sql.=($lang=="en")?" and en='en' ":(($lang=="other")?" and en='other' ":" and (en='' or en='cn') ");
	$order_sql=" order by id desc ";
    $total_count = $db->counter($met_message, "$serch_sql", "*");
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = $met_message_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_message $serch_sql $order_sql LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	if($met_member_use!=0){
	if(intval($list[access])>0){ 
	$list[info]="<script language='javascript' src='access.php?metaccess=".$list[access]."&lang=".$lang."&listinfo=info&id=".$list[id]."'></script>";
	$list[useinfo]="<script language='javascript' src='access.php?metaccess=".$list[access]."&lang=".$lang."&listinfo=useinfo&id=".$list[id]."'></script>";
	  }}
    $message_list[]=$list;
    }

if($met_webhtm==2){
$met_pagelist=$met_htmlistname?"message_list_":"index_list_";
$c_page_list = $rowset->link($met_pagelist,$met_c_htmtype);
$e_page_list = $rowset->link($met_pagelist,$met_e_htmtype);
$o_page_list = $rowset->link($met_pagelist,$met_o_htmtype);
}else{	
$c_page_list = $rowset->link("index.php?page=");		
$e_page_list = $rowset->link("index.php?lang=en&page=");	
$o_page_list = $rowset->link("index.php?lang=other&page=");
}
$page_list=($lang=="en")?$e_page_list:(($lang=="other")?$o_page_list:$c_page_list);
$class_info=$class1_info;
     $class_info[name]=($lang=="en")?$class_info[e_name]:(($lang=="other")?$class_info[o_name]:$class_info[c_name]);
     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$class_info[name]."--".$met_title;

require_once '../public/php/methtml.inc.php';

$methtml_messagelist.="<ul>\n";
foreach($message_list as $key=>$val){
$methtml_messagelist.="<li class='message_list_line'><span >[NO".$val[id]."]：<b>".$val[name]."</b> ".$lang_Publish." ".$val[addtime]."</span></li>\n";
$methtml_messagelist.="<li class='message_list_info'><span ><b>".$lang_SubmitContent."</b>:".$val[info]."</span></li>\n";
$methtml_messagelist.="<li class='message_list_reinfo'><span ><b>".$lang_Reply."</b>:".$val[useinfo]."</span></li>\n";
}
$methtml_messagelist.="</ul>\n";

if(file_exists("templates/".$met_skin_user."/e_message_index.html")){
   if($lang=="en"){
     $show[e_description]=$class_info[e_description]?$class_info[e_description]:$met_e_keywords;
     $show[e_keywords]=$class_info[e_keywords]?$class_info[e_keywords]:$met_e_keywords;
     $e_title_keywords=$navtitle."--".$met_e_webname;
     include template('e_message_index');
	}else{
	 $show[c_description]=$class_info[c_description]?$class_info[c_description]:$met_c_keywords;
     $show[c_keywords]=$class_info[c_keywords]?$class_info[c_keywords]:$met_c_keywords;
     $c_title_keywords=$navtitle."--".$met_c_webname;
	 include template('message_index');
	 }
}else{
include template('message_index');
}
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>