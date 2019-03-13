<?php
require_once '../login/login_check.php';

    $class1_info=$db->get_one("select * from $met_column where id='$class1'");
	if(!class1_info){
	okinfo('../site/sysadmin.php',$lang[noid]);
	};
	$query="select * from $met_column where bigclass='$class1'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class2_list[]=$list;
	$class2_listok=1;
	}
    $serch_sql=" where class1=$class1 ";
	if($admincp_ok[admin_issueok]==1)$serch_sql .= " and(issue='$metinfo_admin_name' or issue='') ";
	if($class2){
	$serch_sql .= " and class2=$class2";
	$query="select * from $met_column where bigclass='$class2'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class3_list[]=$list;
	$class3_listok=1;
	}
	}
	if($class3){$serch_sql .= " and class3=$class3"; }
	$order_sql=list_order($class1_info[list_order]);
    if($search == "detail_search") {
        
        if($c_title) { $serch_sql .= " and c_title like '%$c_title%' "; }
        $total_count = $db->counter($met_img, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_img, "$serch_sql", "*");
    }
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_img $serch_sql $order_sql LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$list[new_ok] = $list[new_ok] ? $lang[yes] : $lang[no];
	$list[com_ok] = $list[com_ok] ? $lang[yes] : $lang[no];
	$list[updatetime] = date('Y-m-d',strtotime($list[updatetime]));
    $img_list[]=$list;
    }
$page_list = $rowset->link("index.php?class1=$class1&class2=$class2&class3=$class3&search=$search&c_title=$c_title&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('img');
footer();
?>