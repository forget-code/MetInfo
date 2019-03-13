<?php
# 文件名称:index.php 2009-08-15 16:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
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
$page_list = $rowset->link("index.php?admin_id=$admin_id&admin_name=$admin_name&search=$search&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('admin');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>