<?php
# 文件名称:index.php 2009-08-12 08:23:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';

    $class1_info=$db->get_one("select * from $met_column where id='$class1'");
	if(!$class1_info){
	okinfo('../site/sysadmin.php',$lang_loginNoid);
	}
	$class1_info[name]=$langusenow=="en"?$class1_info['e_name']:($langusenow=="other"?$class1_info['o_name']:$class1_info['c_name']);
    if($search == "detail_search") {  
	$serch_sql=" where 1=1 ";   
	if($admincp_ok[admin_issueok]==1)$serch_sql .= " and issue='$metinfo_admin_name' ";   
		$item=$langusenow=="en"?"e_position":($langusenow=="other"?"o_position":"c_position");
        if($position) { $serch_sql .= " and $item like '%$position%' "; }		
		if(isset($top) && $top!="all") { $serch_sql .= " and top_ok ='$top' "; }
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
	$list['place']=$langusenow=="en"?$list['e_place']:($langusenow=="other"?$list['o_place']:$list['c_place']);
	switch($list['access'])
    {
    	case '1':$list['access']=$lang_access1;break;
    	case '2':$list['access']=$lang_access2;break;
    	case '3':$list['access']=$lang_access3;break;
		default:$list['access']=$lang_access0;break;
	}
	$list[top_ok1] = $list[top_ok] ? $lang_YES : $lang_NO;
	if($list[count]==0)$list[count]=$lang_josAlways;
	if($list[useful_life]==0)$list[useful_life]=$lang_josAlways;
    $job_list[]=$list;
    }
$page_list = $rowset->link("index.php?class1=$class1&search=$search&position=$position&page=");
switch($top)
{
	case '1':$top1="selected='selected'";break;
	case '0':$top2="selected='selected'";break;
	default:$top0="selected='selected'";break;
}
switch($langtype)
{
	case 'c':$langtype1="selected='selected'";$urllang='cn';break;
	case 'e':$langtype2="selected='selected'";$urllang='en';break;
	case 'o':$langtype3="selected='selected'";$urllang='other';break;
	default:$langtype0="selected='selected'";$urllang=$langusenow;break;
}
$selectlang = "";
if($met_c_lang_ok==1) $selectlang.="<option value='c' $langtype1>$met_c_lang</option>";
if($met_e_lang_ok==1) $selectlang.="<option value='e' $langtype2>$met_e_lang</option>";
if($met_o_lang_ok==1) $selectlang.="<option value='o' $langtype3>$met_o_lang</option>";

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('job');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>