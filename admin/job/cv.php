<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
	$serch_sql=" where lang='$lang' ";
    if($search == "detail_search"){  			
		if(isset($customerid)&&$customerid<>'') { $serch_sql .= " and customerid='$customerid' "; }
		if(isset($jobid)&&$jobid<>'') { $serch_sql .= " and jobid='$jobid' "; }
		if(isset($position)&&$position<>'') { $serch_sql .= " and jobid in(select id from $met_job where position like '%$position%')  "; }
        if(isset($readok)&&$readok<>'') { $serch_sql .= " and $met_cv.readok=$readok "; }		
        $total_count = $db->counter($met_cv, "$serch_sql", "*");
    }else{
        $total_count = $db->counter($met_cv, "$serch_sql", "*");
    }
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();	
	
	$query = "SELECT * FROM $met_job where lang='$lang'";
    $result = $db->query($query);
	while($list = $db->fetch_array($result)){
	$job_list[$list[id]]=$list[position];
	}
    $query = "SELECT id,jobid,addtime,customerid,readok FROM $met_cv $serch_sql order by addtime desc LIMIT $from_record, $list_num";

	$result = $db->query($query);
	while($list = $db->fetch_array($result)){
	$list['customerid']=$list['customerid']=='0'?$lang_anonymity:$list['customerid'];
	$list[position]=(isset($job_list[$list[jobid]]))? $job_list[$list[jobid]]:"<font color=red>$lang_cvTip4</font>";
	$list[readok] = $list[readok] ? $lang_yes : $lang_no;
    $cv_list[]=$list;
    }
$page_list = $rowset->link("cv.php?lang=$lang&search=$search&readok=$readok&position=$position&jobid=$jobid&customerid=$customerid&page=");
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
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>