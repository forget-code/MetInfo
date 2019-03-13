<?php
# 文件名称:index.php 2009-08-13 08:24:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';

    $serch_sql=" where 1=1 ";
	if($readok!="") $serch_sql.=" and readok='$readok' ";
	if($langnow!=""){
	  if($langnow!="cn"){
	  $serch_sql.=" and en='$langnow' ";
	  }else{
	   $serch_sql.=" and (en='cn' or en='' ) ";
	  }
	}
	$order_sql=" order by id desc ";
    if($search == "detail_search") {
        if(isset($customerid)) { $serch_sql .= " and customerid='$customerid' "; }
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
	$list['customerid']=$list['customerid']=='0'?$lang_messageAccessy:$list['customerid'];
	switch($list['access'])
    {
    	case '1':$list['access']=$lang_access1;break;
    	case '2':$list['access']=$lang_access2;break;
    	case '3':$list['access']=$lang_access3;break;
		default: $list['access']=$lang_access0;break;
	}                               
	$list[readok] = $list[readok] ? $lang_YES : $lang_NO;
	//$list[addtime] = date('Y-m-d',strtotime($list[addtime]));
    $message_list[]=$list;
    }
$page_list = $rowset->link("index.php?search=$search&readok=$readok&useinfo=$useinfo&langnow=$langnow&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('message');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>