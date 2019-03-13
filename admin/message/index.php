<?php
require_once '../login/login_check.php';

    $serch_sql=" where 1=1 ";
	if($readok!="") $serch_sql.=" and readok='$readok' ";
	$order_sql=" order by id desc ";
    if($search == "detail_search") {
        
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
	$list[readok] = $list[readok] ? $lang[yes] : $lang[no];
	//$list[addtime] = date('Y-m-d',strtotime($list[addtime]));
    $message_list[]=$list;
    }
$page_list = $rowset->link("index.php?search=$search&readok=$readok&useinfo=$useinfo&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('message');
footer();
?>