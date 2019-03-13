<?php
# 文件名称:cv.php 2009-08-20 08:23:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once 'login_check.php';
	$serch_sql=" where customerid='$metinfo_member_name' ";
	$item=$lang=="en"?"e_position":($lang=="other"?"o_position":"c_position");
    
    $total_count = $db->counter($met_cv, "$serch_sql", "*");

    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();	
	
	$query = "SELECT * FROM $met_job";
    $result = $db->query($query);
	while($list = $db->fetch_array($result)){
	$job_list[$list[id]]=$list[$item];
	}
    $query = "SELECT id,jobid,addtime,customerid,readok FROM $met_cv $serch_sql order by addtime desc LIMIT $from_record, $list_num";

	$result = $db->query($query);
	while($list = $db->fetch_array($result)){
	$list['customerid']=$list['customerid']=='0'?$lang_cvID:$list['customerid'];
	if(isset($job_list[$list[jobid]])) $list[position]= $job_list[$list[jobid]];
	else $list[position]= "<font color=red>$lang_cvTip4</font>";
    $cv_list[]=$list;
    }
	
$page_list = $rowset->link("cv.php?search=$search&page=");

$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('cv');
footermember();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>