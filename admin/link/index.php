<?php
require_once '../login/login_check.php';

    $serch_sql=" where 1=1 ";
	if($link_type!="")$serch_sql.=" and link_type=$link_type ";
    if($com_ok!="")$serch_sql.=" and com_ok=$com_ok ";
	if($show_ok!="")$serch_sql.=" and show_ok=$show_ok ";
	if($link_lang!="")$serch_sql.=" and link_lang=$link_lang ";
	
	$order_sql=" order by orderno desc";
    if($search == "detail_search") {
        
        if($c_webname) { $serch_sql .= " and c_webname like '%$c_webname%' "; }
        $total_count = $db->counter($met_news, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_news, "$serch_sql", "*");
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
	if($list[c_webname]=="")$list[c_webname]=$list[e_webname];
	if($list[c_info]=="")$list[c_info]=$list[e_info];
	$list[show_ok]=($list[show_ok])?"是":"否";
	$list[com_ok]=($list[com_ok])?"是":"否";
	$list[link_type]=($list[link_type])?"LOGO链接":"文字连接";
    $link_list[]=$list;
    }
$met_weburl=substr($met_weburl, 0, -1);
$page_list = $rowset->link("index.php?link_type=$link_type&com_ok=$com_ok&show_ok=$show_ok&link_lang=$link_lang&search=$search&c_webname=$c_webname&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('link');
footer();
?>