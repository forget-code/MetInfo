<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
 $serch_sql=" where usertype = 3 ";
    if($search == "detail_search") {
        if($admin_id) { $serch_sql .= " and admin_id like '%$admin_id%' "; }
        if($admin_name){ $serch_sql .= " and admin_name like '%$admin_name%' "; }
        $total_count = $db->counter($met_admin_table, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_admin_table, "$serch_sql", "*");
    }
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 16;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_admin_table $serch_sql ORDER BY admin_modify_date DESC LIMIT $from_record, $list_num";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
     $admin_list[]=$list;
    }
$page_list = $rowset->link("index.php?admin_id=$admin_id&admin_name=$admin_name&search=$search&lang=$lang&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('admin');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>