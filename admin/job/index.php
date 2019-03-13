<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';

    $class1_info=$db->get_one("select * from $met_column where lang='$lang' and id='$class1'");
	if(!$class1_info){
	okinfox('../site/sysadmin.php',$lang_dataerror);
	}
	$serch_sql=" where lang='$lang' ";
    if($search == "detail_search") {     
	if($admincp_ok[admin_issueok]==1)$serch_sql .= " and issue='$metinfo_admin_name' ";   
        if($position) { $serch_sql .= " and position like '%$position%' "; }		
		if(isset($top) && $top!="all") { $serch_sql .= " and top_ok ='$top' "; }
        $total_count = $db->counter($met_job, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_job, "$serch_sql", "*");
    }
	$totaltop_count = $db->counter($met_job, "$serch_sql and top_ok='1'", "*");
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
	$query = "SELECT * FROM $met_job $serch_sql and top_ok='1' order by no_order LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list = $db->fetch_array($result)){
		$job_listo[]=$list;
	}
	if(count($job_listo)<intval($list_num)){
		if($totaltop_count>=$list_num){
			$from_record=$from_record-$totaltop_count;
			if($from_record<0)$from_record=0;
		}else{
			$from_record=$from_record?($from_record-$totaltop_count):$from_record;
		}
		$list_num=intval($list_num)-count($job_listo);
		$query = "SELECT * FROM $met_job $serch_sql and top_ok='0' order by no_order LIMIT $from_record, $list_num";
		$result = $db->query($query);
		while($list= $db->fetch_array($result)){
			$job_listo[]=$list;
		}
	}
	foreach($job_listo as $key=>$list){
		if($met_member_use){
		switch($list['access'])
		{
			case '1':$list['access']=$lang_access1;break;
			case '2':$list['access']=$lang_access2;break;
			case '3':$list['access']=$lang_access3;break;
			default:$list['access']=$lang_access0;break;
		}
		}
		$list[top_ok1] = $list[top_ok] ? $lang_yes : $lang_no;
		$list[wap_ok1] = $list[wap_ok] ? $lang_yes : $lang_no;
		if($list[count]==0)$list[count]=$lang_josAlways;
		if($list[useful_life]==0)$list[useful_life]=$lang_josAlways;
		$job_list[]=$list;
    }
$page_list = $rowset->link("index.php?lang=$lang&class1=$class1&search=$search&position=$position&page=");
switch($top)
{
	case '1':$top1="selected='selected'";break;
	case '0':$top2="selected='selected'";break;
	default:$top0="selected='selected'";break;
}

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('job');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.