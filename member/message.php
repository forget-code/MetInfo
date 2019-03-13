<?php
# 文件名称:message.php 2009-08-20 17:01:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once 'login_check.php';

$serch_sql=" where customerid='$metinfo_member_name' ";
	if($readok!="") $serch_sql.=" and readok='$readok' ";
	if($langnow!=""){
	  if($langnow!="cn"){
	  $serch_sql.=" and en='$langnow' ";
	  }else{
	   $serch_sql.=" and (en='cn' or en='' ) ";
	  }
	}
	$order_sql=" order by id desc ";
	$total_count = $db->counter($met_message, "$serch_sql", "*");
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_message $serch_sql $order_sql LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$list[readok]=$list[readok]==1?$lang_YES:$lang_NO;
    $message_list[]=$list;
    }
$page_list = $rowset->link("message.php?search=$search&page=");

$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('message');
footermember();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>