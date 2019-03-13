<?php
# 文件名称:index.php 2009-08-12 14:20:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
$settings = parse_ini_file('../../feedback/config.inc.php');
@extract($settings);
$fdclass1= $db->get_one("SELECT * FROM $met_fdparameter WHERE c_name='$met_fd_class'");
$fdclass2="para".$fdclass1[id];
$query = "SELECT * FROM $met_fdlist where bigid='$fdclass1[id]' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$list['list']=$langusenow=="en"?$list['e_list']:($langusenow=="other"?$list['o_list']:$list['c_list']);
$selectlist[]=$list;
}

    $serch_sql=" where 1=1 ";
	if($readok!="") $serch_sql.=" and readok='$readok' ";
		if($langnow!=""){
	  if($langnow!="cn"){
	  $serch_sql.=" and en='$langnow' ";
	  }else{
	   $serch_sql.=" and (en='cn' or en='' ) ";
	  }
	}
	if($met_fd_classname!="")$serch_sql.=" and $fdclass2='$met_fd_classname' ";
	$order_sql=" order by id desc ";
    if($search == "detail_search") {
        if(isset($customerid)) { $serch_sql .= " and customerid='$customerid' "; }
        if($useinfo) { $serch_sql .= " and useinfo like '%$useinfo%' "; }
        $total_count = $db->counter($met_feedback, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_feedback, "$serch_sql", "*");
    }
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 20;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_feedback $serch_sql $order_sql LIMIT $from_record, $list_num";

    $result = $db->query($query);
	while($list= $db->fetch_array($result)){	
	$list['customerid']=$list['customerid']=='0'?$lang_feedbackAccess0:$list['customerid'];
	$list[readok] = $list[readok] ? $lang_feedbackYes : $lang_feedbackNo;
	//$list[addtime] = date('Y-m-d',strtotime($list[addtime]));
    $feedback_list[]=$list;
    }
$page_list = $rowset->link("index.php?search=$search&readok=$readok&useinfo=$useinfo&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('feedback');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>