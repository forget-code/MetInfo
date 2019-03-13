<?php
# 文件名称:index.php 2009-08-15 15:58:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
    if($search == "detail_search") {  
	$serch_sql=" where 1=1 ";
	$item=$langusenow=="en"?"e_name":($langusenow=="other"?"o_name":"c_name");
    if($name) { $serch_sql .= " and $item like '%$name%' "; }
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
	$list['name']=$langusenow=="en"?$list['e_name']:($langusenow=="other"?$list['o_name']:$list['c_name']);
	if($langusenow=="en" && $met_e_lang_ok!=1) $list['name']=$met_c_lang_ok==1?$list['c_name']:$list['o_name'];
	if($langusenow=="cn" && $met_c_lang_ok!=1) $list['name']=$met_e_lang_ok==1?$list['e_name']:$list['o_name'];
	if($langusenow=="other" && $met_o_lang_ok!=1) $list['name']=$met_c_lang_ok==1?$list['c_name']:$list['e_name'];
    $online_list[]=$list;
    }
$page_list = $rowset->link("index.php?search=$search&c_name=$c_name&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('online');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>