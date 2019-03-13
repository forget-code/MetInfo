<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
require_once '../../config/flash_'.$lang.'.inc.php';

	require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 12;
$flashmode=$flashmode?$flashmode:1;  
if($flashmode==1 or $flashmode==3)
{
$where=" where img_path <> '' and lang='$lang'  order by no_order";
if($module<>"")$where="where img_path <> '' and module='$module' and lang='$lang' order by no_order";
	$total_count = $db->counter($met_flash, "$where", "*");
	$rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
$query = "SELECT * FROM $met_flash $where LIMIT $from_record, $list_num";
$selected1='style="color:red;"';
$selected2='';
}else if(($flashmode==2))
{
$where="where flash_path <> '' and lang='$lang' order by no_order";
if($module<>"")$where="where flash_path <> '' and module='$module' and lang='$lang' order by no_order";
	$total_count = $db->counter($met_flash, "$where", "*");
	$rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
$query = "SELECT * FROM $met_flash $where LIMIT $from_record, $list_num";
$selected2='style="color:red;"';
$selected1='';
}

$query1="select * from $met_column where if_in='0' and lang='$lang' order by no_order";
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
$flashrec[]=$list;
}	
	$page_list = $rowset->link("flash.php?lang=$lang&flashmode=$flashmode&page=");	

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('flash');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>