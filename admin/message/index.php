<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';

    $serch_sql=" where lang='$lang' ";
	if($readok!="") $serch_sql.=" and readok='$readok' ";
	$order_sql=" order by id desc ";
    if($search == "detail_search") {
        if(isset($customerid)) { $serch_sql .= " and customerid='$customerid' "; }
        if($useinfo) { $serch_sql .= " and useinfo like '%$useinfo%' "; }
        $total_count = $db->counter($met_message, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_message, "$serch_sql", "*");
    }
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_message $serch_sql $order_sql LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$list['customerid']=$list['customerid']=='0'?$lang_feedbackAccess0:$list['customerid'];
	if($met_member_use){
	switch($list['access'])
    {
    	case '1':$list['access']=$lang_access1;break;
    	case '2':$list['access']=$lang_access2;break;
    	case '3':$list['access']=$lang_access3;break;
		default: $list['access']=$lang_access0;break;
	} 
   } 	
	$list[readok] = $list[readok] ? $lang_yes : $lang_no;
	//$list[addtime] = date('Y-m-d',strtotime($list[addtime]));
/*bd*/
$list[name]=strip_tags($list[name]);
$list[email]=strip_tags($list[email]);
$list[tel]=strip_tags($list[tel]);
$list[contact]=strip_tags($list[contact]);
/*bd*/
    $message_list[]=$list;
    }
$page_list = $rowset->link("index.php?search=$search&readok=$readok&useinfo=$useinfo&lang=$lang&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('message');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>