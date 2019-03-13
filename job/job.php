<?php
require_once '../include/common.inc.php';
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";
    $serch_sql=" where 1=1 ";
	$order_sql="order by addtime desc ";
    if($search == "detail_search") {     
        if($c_title) { $serch_sql .= " and c_position like '%$c_position%' "; }
		if($e_title) { $serch_sql .= " and e_position like '%$e_position%' "; }
        $total_count = $db->counter($met_job, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_job, "$serch_sql", "*");
    }
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$met_job_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_job $serch_sql $order_sql LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$list[c_url]="showjob.php?id=".$list[id];
	$list[e_url]="showjob.php?en=en&id=".$list[id];
    $job_list[]=$list;
    }
$c_page_list = $rowset->link("job.php?search=$search&c_position=$c_position&page=");		
$e_page_list = $rowset->link("job.php?en=en&search=$search&e_position=$e_position&page=");	
require_once '../include/head.php';

$class_info=$db->get_one("select * from $met_column where module='6'");
$nav_x[c_name]=$class_info[c_name];
$nav_x[e_name]=$class_info[e_name];


if($en=="en"){
$show[e_description]=$class_info[e_description]?$class_info[e_description]:$met_e_keywords;
$show[e_keywords]=$class_info[e_keywords]?$class_info[e_keywords]:$met_e_keywords;
$e_title_keywords=$class_info[e_name]."--".$e_title_keywords;
include template('e_job');
}
else{
$show[c_description]=$class_info[c_description]?$class_info[c_description]:$met_c_keywords;
$show[c_keywords]=$class_info[c_keywords]?$class_info[c_keywords]:$met_c_keywords;
$c_title_keywords=$class_info[c_name]."--".$c_title_keywords;

include template('job');
}

footer();
?>