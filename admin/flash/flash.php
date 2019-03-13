<?php
# 文件名称:flash.php 2009-08-05 11:21:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
require_once '../../config/flash.inc.php';

	require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 12;
    
if(!isset($_GET['flashmode']) || $_GET['flashmode']==1)
{
$where="where c_img_path <> '' OR e_img_path <> '' OR o_img_path <> ''  order by no_order";
if($module<>"")$where="where (c_img_path <> '' OR e_img_path <> '' OR o_img_path <> '') and module='$module'  order by no_order";
	$total_count = $db->counter($met_flash, "$where", "*");
	$rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
$query = "SELECT * FROM $met_flash $where LIMIT $from_record, $list_num";
$style1='';
$style2='style="display:none"';
$selected1='style="color:red;"';
$selected2='';
$_GET['flashmode']=1;
}else if(($_GET['flashmode']==2))
{
$where="where c_flash_path <> '' OR e_flash_path <> '' OR o_flash_path <> ''  order by no_order";
if($module<>"")$where="where (c_flash_path <> '' OR e_flash_path <> '' OR o_flash_path <> '') and module='$module'  order by no_order";
	$total_count = $db->counter($met_flash, "$where", "*");
	$rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
$query = "SELECT * FROM $met_flash $where LIMIT $from_record, $list_num";
$style1='style="display:none"';
$style2='';
$selected2='style="color:red;"';
$selected1='';
}

$query1="select * from $met_column where if_in='0' order by no_order";
	$result1= $db->query($query1);
	$mod1[0]=$mod[10000]=array(
				id=>10000,
				name=>"$lang_flashGlobal",
				bigclass=>0
			);
	$mod1[1]=$mod[10001]=array(
				id=>10001,
				name=>"$lang_flashHome",
				bigclass=>0
			);
	$i=2;
	while($list = $db->fetch_array($result1)){
	$list['name']=$langusenow=="en"?$list['e_name']:($langusenow=="other"?$list['o_name']:$list['c_name']);	
	if($langusenow=="en" && $met_e_lang_ok!=1) $list['name']=$met_c_lang_ok==1?$list['c_name']:$list['o_name'];
	if($langusenow=="cn" && $met_c_lang_ok!=1) $list['name']=$met_e_lang_ok==1?$list['e_name']:$list['o_name'];
	if($langusenow=="other" && $met_o_lang_ok!=1) $list['name']=$met_c_lang_ok==1?$list['c_name']:$list['e_name'];
	if($list[classtype]==1){
	                        $mod1[$i]=$list;
							$i++;
							}
	if($list[classtype]==2)$mod2[$list[bigclass]][]=$list;
	if($list[classtype]==3)$mod3[$list[bigclass]][]=$list;
	$mod[$list['id']]=$list;
	}
	
	foreach($mod as $key=>$val)
	{
		if($val['bigclass']==0)	$mod[$key]['name']="<font color='blue'>".$mod[$key]['name']."[1]</font>";
		else	if($mod[$val['bigclass']]['bigclass']==0)	$mod[$key]['name']="<font color='red'>".$mod[$key]['name']."[2]</font>";
		else	if($mod[$mod[$val['bigclass']]['bigclass']]['bigclass']==0)	$mod[$key]['name']="<font color='black'>".$mod[$key]['name']."[3]</font>";
	}
	
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
$list['modulename']=$mod[$list['module']]['name'];
$list['img_title']=$langusenow=="en"?$list['e_img_title']:($langusenow=="other"?$list['o_img_title']:$list['c_img_title']);
if($langusenow=="en" && $met_e_lang_ok!=1) $list['img_title']=$met_c_lang_ok==1?$list['c_img_title']:$list['o_img_title'];
if($langusenow=="cn" && $met_c_lang_ok!=1) $list['img_title']=$met_e_lang_ok==1?$list['e_img_title']:$list['o_img_title'];
if($langusenow=="other" && $met_o_lang_ok!=1) $list['img_title']=$met_c_lang_ok==1?$list['c_img_title']:$list['e_img_title'];
$list['img_path']=$langusenow=="en"?$list['e_img_path']:($langusenow=="other"?$list['o_img_path']:$list['c_img_path']);
if($langusenow=="en" && $met_e_lang_ok!=1) $list['img_path']=$met_c_lang_ok==1?$list['c_img_path']:$list['o_img_path'];
if($langusenow=="cn" && $met_c_lang_ok!=1) $list['img_path']=$met_e_lang_ok==1?$list['e_img_path']:$list['o_img_path'];
if($langusenow=="other" && $met_o_lang_ok!=1) $list['img_path']=$met_c_lang_ok==1?$list['c_img_path']:$list['e_img_path'];
$list['img_link']=$langusenow=="en"?$list['e_img_link']:($langusenow=="other"?$list['o_img_link']:$list['c_img_link']);
if($langusenow=="en" && $met_e_lang_ok!=1) $list['img_link']=$met_c_lang_ok==1?$list['c_img_link']:$list['o_img_link'];
if($langusenow=="cn" && $met_c_lang_ok!=1) $list['img_link']=$met_e_lang_ok==1?$list['e_img_link']:$list['o_img_link'];
if($langusenow=="other" && $met_o_lang_ok!=1) $list['img_link']=$met_c_lang_ok==1?$list['c_img_link']:$list['e_img_link'];
$list['flash_path']=$langusenow=="en"?$list['e_flash_path']:($langusenow=="other"?$list['o_flash_path']:$list['c_flash_path']);
if($langusenow=="en" && $met_e_lang_ok!=1) $list['flash_path']=$met_c_lang_ok==1?$list['c_flash_path']:$list['o_flash_path'];
if($langusenow=="cn" && $met_c_lang_ok!=1) $list['flash_path']=$met_e_lang_ok==1?$list['e_flash_path']:$list['o_flash_path'];
if($langusenow=="other" && $met_o_lang_ok!=1) $list['flash_path']=$met_c_lang_ok==1?$list['c_flash_path']:$list['e_flash_path'];
$list['flash_back']=$langusenow=="en"?$list['e_flash_back']:($langusenow=="other"?$list['o_flash_back']:$list['c_flash_back']);
if($langusenow=="en" && $met_e_lang_ok!=1) $list['flash_back']=$met_c_lang_ok==1?$list['c_flash_back']:$list['o_flash_back'];
if($langusenow=="cn" && $met_c_lang_ok!=1) $list['flash_back']=$met_e_lang_ok==1?$list['e_flash_back']:$list['o_flash_back'];
if($langusenow=="other" && $met_o_lang_ok!=1) $list['flash_back']=$met_c_lang_ok==1?$list['c_flash_back']:$list['e_flash_back'];
$flashrec[]=$list;
}	
	$page_list = $rowset->link("flash.php?flashmode=$_GET[flashmode]&page=");	

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('flash');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>