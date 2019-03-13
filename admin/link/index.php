<?php
# 文件名称:index.php 2009-08-15 16:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';

    $serch_sql=" where 1=1 ";
	if($link_type!="")$serch_sql.=" and link_type=$link_type ";
    if($com_ok!="")$serch_sql.=" and com_ok=$com_ok ";
	if($show_ok!="")$serch_sql.=" and show_ok=$show_ok ";
	if($link_lang!="")$serch_sql.=" and link_lang=$link_lang ";
	if($langusenow!="")$serch_sql.=($langusenow=="en")?" and e_webname<>'' ":($langusenow=="other"?" and o_webname<>'' ":" and c_webname<>'' ");
	$order_sql=" order by orderno desc";
    if($search == "detail_search") {
        $item=$langusenow=="en"?"e_webname":($langusenow=="other"?"o_webname":"c_webname");		
        if($webname) { $serch_sql .= " and $item like '%$webname%' "; }
        $total_count = $db->counter($met_link, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_link, "$serch_sql", "*");
    }
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_link $serch_sql $order_sql LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list = $db->fetch_array($result)){
	$list['webname']=$langusenow=="en"?$list['e_webname']:($langusenow=="other"?$list['o_webname']:$list['c_webname']);
    if($langusenow=="en" && $met_e_lang_ok!=1) $list['webname']=$met_c_lang_ok==1?$list['c_webname']:$list['o_webname'];
	if($langusenow=="cn" && $met_c_lang_ok!=1) $list['webname']=$met_e_lang_ok==1?$list['e_webname']:$list['o_webname'];
	if($langusenow=="other" && $met_o_lang_ok!=1) $list['webname']=$met_c_lang_ok==1?$list['c_webname']:$list['e_webname'];
	if($list['webname']=="")$list['webname']=($list['e_webname']<>'')?$list['e_webname']:($list['o_webname']<>''?$list['o_webname']:$list['c_webname']);
	$list['info']=$langusenow=="en"?$list['e_info']:($langusenow=="other"?$list['o_info']:$list['c_info']);
	if($langusenow=="en" && $met_e_lang_ok!=1) $list['info']=$met_c_lang_ok==1?$list['c_info']:$list['o_info'];
	if($langusenow=="cn" && $met_c_lang_ok!=1) $list['info']=$met_e_lang_ok==1?$list['e_info']:$list['o_info'];
	if($langusenow=="other" && $met_o_lang_ok!=1) $list['info']=$met_c_lang_ok==1?$list['c_info']:$list['e_info'];
	$list[show_ok]=($list[show_ok])?$lang_YES:$lang_NO;
	$list[com_ok]=($list[com_ok])?$lang_YES:$lang_NO;
	$list[link_type]=($list[link_type])?$lang_linkType5:$lang_linkType4;
    $link_list[]=$list;
    }
$met_weburl=substr($met_weburl, 0, -1);
$page_list = $rowset->link("index.php?link_type=$link_type&com_ok=$com_ok&show_ok=$show_ok&link_lang=$link_lang&search=$search&webname=$webname&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('link');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>