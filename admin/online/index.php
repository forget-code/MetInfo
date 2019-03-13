<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
    $serch_sql=" where lang='$lang' ";
    if($search == "detail_search") {  
    if($name) { $serch_sql .= " and name like '%$name%' "; }
        $total_count = $db->counter($met_online, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_online, "$serch_sql", "*");
    }
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_online $serch_sql order by no_order LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list = $db->fetch_array($result)){
	if(strlen($list[qq])>30){
	    $list[qq1a]=explode('http://wpa.qq.com/pa',$list[qq]);
		$list[qq2a]=explode(':',$list[qq1a][1]);
		$list[qq]=$list[qq2a][1];
		}
    $online_list[]=$list;
    }
$page_list = $rowset->link("index.php?lang=$lang&search=$search&name=$name&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('online');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>