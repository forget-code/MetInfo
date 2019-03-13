<?php
# 文件名称:index.php 2009-08-14 10:23:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
 $serch_sql=" where usertype <> 3 ";
    if($search == "detail_search") {
          
        if($admin_id) { $serch_sql .= " and admin_id like '%$admin_id%' "; }
        if($usertype){ $serch_sql .= " and usertype = '$usertype' "; }
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
	 switch($list['usertype'])
    {
    	case '1':$list['usertype']=$lang_memberUserType1;break;
    	case '2':$list['usertype']=$lang_memberUserType2;break;
	}
	 $list['checked']=$list['checkid']==1?$lang_memberChecked:$lang_memberUnChecked;
     $admin_list[]=$list;
    }
$page_list = $rowset->link("index.php?admin_id=$admin_id&admin_name=$admin_name&search=$search&page=");

switch($usertype)
{
	case '1':$user1="selected='selected'";break;
	case '2':$user2="selected='selected'";break;
	default:$user0="selected='selected'";break;
}

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('member');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>