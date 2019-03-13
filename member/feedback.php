<?php
# 文件名称:feedback.php 2009-08-20 10:44:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once 'login_check.php';
$settings = parse_ini_file('../feedback/config.inc.php');
@extract($settings);
$fdclass1= $db->get_one("SELECT * FROM $met_fdparameter WHERE c_name='$met_fd_class'");
$fdclass2="para".$fdclass1[id];
$query = "SELECT * FROM $met_fdlist where bigid='$fdclass1[id]' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$list['list']=$lang=="en"?$list['e_list']:($lang=="other"?$list['o_list']:$list['c_list']);
$selectlist[]=$list;
}

    $serch_sql=" where customerid='$metinfo_member_name' ";
	if($readok!="") $serch_sql.=" and readok='$readok' ";
	if($lang!=""){
	  if($lang!="cn"){
	  $serch_sql.=" and en='$lang' ";
	  }else{
	   $serch_sql.=" and (en='cn' or en='' ) ";
	  }
	}
	if($met_fd_classname!="")$serch_sql.=" and $fdclass2='$met_fd_classname' ";
	$order_sql=" order by id desc ";
    $total_count = $db->counter($met_feedback, "$serch_sql", "*");

    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_feedback $serch_sql $order_sql  LIMIT $from_record, $list_num";

    $result = $db->query($query);
	while($list= $db->fetch_array($result)){	
	$list['customerid']=$list['customerid']=='0'?$lang_feedbackAccess0:$list['customerid'];
	$list[readok] = $list[readok] ? $lang_feedbackYes : $lang_feedbackNo;
	//$list[addtime] = date('Y-m-d',strtotime($list[addtime]));
    $feedback_list[]=$list;
    }

$page_list = $rowset->link("feedback.php?search=$search&lang=$lang&page=");
$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('feedback');
footermember();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>