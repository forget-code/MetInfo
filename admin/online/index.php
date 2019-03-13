<?php
require_once '../login/login_check.php';
    if($search == "detail_search") {  
	$serch_sql=" where 1=1 ";      
    if($c_name) { $serch_sql .= " and c_name like '%$c_name%' "; }
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
    $online_list[]=$list;
    }
$page_list = $rowset->link("index.php?search=$search&c_name=$c_name&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('online');
footer();
?>