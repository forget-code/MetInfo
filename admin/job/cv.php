<?php
# 文件名称:cv.php 2009-08-12 08:23:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
	$serch_sql=" where 1=1 ";
	$item=$langusenow=="en"?"e_position":($langusenow=="other"?"o_position":"c_position");
    if($search == "detail_search") {  		
		
		if(isset($customerid)) { $serch_sql .= " and customerid='$customerid' "; }
		if(isset($jobid)) { $serch_sql .= " and jobid='$jobid' "; }
		if(isset($position)) { $serch_sql .= " and jobid in(select id from $met_job where $item like '%$position%')  "; }
        if(isset($readok)) { $serch_sql .= " and $met_cv.readok like '%$readok%' "; }		
        $total_count = $db->counter($met_cv, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_cv, "$serch_sql", "*");
    }
    require_once 'include/pager.class.php';
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
	$list[readok] = $list[readok] ? $lang_YES : $lang_NO;
    $cv_list[]=$list;
    }
$page_list = $rowset->link("cv.php?search=$search&readok=$readok&page=");
switch($readok)
{
	case '1':$readok1="selected='selected'";break;
	case '0':$readok2="selected='selected'";break;
	default:$readok0="selected='selected'";break;
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('cv');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>