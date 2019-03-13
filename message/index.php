<?php
require_once '../include/common.inc.php';
$settings = parse_ini_file('config.inc.php');
@extract($settings);
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";

$message_column=$db->get_one("select * from $met_column where module='7'");
$navtitle=($en=="en")?$message_column[e_name]:$message_column[c_name];

    $serch_sql=" where 1=1 ";
	if($met_fd_type==1) $serch_sql.=" and readok='1' ";
	if($en=="en"){
	$serch_sql.=" and en='en' ";
	}else{
	$serch_sql.=" and en!='en' ";
	}
	$order_sql=" order by id desc ";
    $total_count = $db->counter($met_message, "$serch_sql", "*");
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = $met_fd_no;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_message $serch_sql $order_sql LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
    $message_list[]=$list;
    }
$c_page_list = $rowset->link("index.php?page=");
$e_page_list = $rowset->link("index.php?en=en&page=");

require_once '../include/head.php';
if($en=="en"){
$show[e_description]=$message_column[e_description];
$show[e_keywords]=$message_column[e_keywords];
$e_title_keywords=$navtitle."--".$e_title_keywords;
include template('e_message_index');
}
else{
$show[c_description]=$message_column[c_description];
$show[c_keywords]=$message_column[c_keywords];
$c_title_keywords=$navtitle."--".$c_title_keywords;
include template('message_index');
}

footer();
?>