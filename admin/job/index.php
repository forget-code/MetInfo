<?php
require_once '../login/login_check.php';

    $class1_info=$db->get_one("select * from $met_column where id='$class1'");
	if(!class1_info){
	okinfo('../site/sysadmin.php',$lang[noid]);
	}
    if($search == "detail_search") {  
	$serch_sql=" where 1=1 ";      
        if($c_position) { $serch_sql .= " and c_position like '%$c_position%' "; }
        $total_count = $db->counter($met_job, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_job, "$serch_sql", "*");
    }
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_job $serch_sql order by addtime desc LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list = $db->fetch_array($result)){
	if($list[count]==0)$list[count]="不限";
	if($list[useful_life]==0)$list[useful_life]="不限";
    $job_list[]=$list;
    }
$page_list = $rowset->link("index.php?class1=$class1&search=$search&c_position=$c_position&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('job');
footer();
?>